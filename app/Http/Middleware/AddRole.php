<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserRole;
use Illuminate\Support\Facades\Cache;
use App\Jobs\RemoveDiscordRole;

class AddRole
{
    public function handle($request, Closure $next)
    {
        $guild_id = pilih_guild();
        $bot_token = profil_web()->discord_bot_token  ?? '';

        // Gunakan cache agar hanya berjalan sekali sehari
        $cacheKey = 'remove_discord_roles_today';
        if (Cache::has($cacheKey)) {
            return $next($request); // Lewati jika sudah dijalankan hari ini
        }

        // Ambil daftar discord_id yang masih memiliki expires di masa depan
        $excludedDiscordIds = UserRole::where('expires_at', '>=', now())
            ->pluck('discord_id');

        // Ambil data expired terbaru untuk setiap discord_id yang tidak ada dalam daftar excluded
        $users = UserRole::whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->whereNotIn('discord_id', $excludedDiscordIds)
            ->orderBy('expires_at', 'desc')
            ->get()
            ->unique('discord_id');

        foreach ($users as $user) {
            if ($user->discord_id && $user->role_id) {
                RemoveDiscordRole::dispatch($user->discord_id, $user->role_id, $bot_token, $guild_id);
            }
        }

        // Simpan di cache selama 24 jam agar tidak berjalan ulang
        Cache::put($cacheKey, true, now()->endOfDay());

        return $next($request);
    }
}
