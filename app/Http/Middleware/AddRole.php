<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Jobs\RemoveDiscordRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AddRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Ambil token dan guild ID dari .env
        $guild_id = pilih_guild();
        $bot_token = env('DISCORD_BOT_TOKEN');


        // Ambil daftar discord_id yang masih memiliki expires di masa depan
        $excludedDiscordIds = UserRole::where('expires_at', '>=', now())
            ->pluck('discord_id');

        // Ambil data expired terbaru untuk setiap discord_id yang tidak ada dalam daftar excluded
        $users = UserRole::whereNotNull('expires_at')
            ->where('expires_at', '<', now()) // Hanya ambil yang sudah expired
            ->whereNotIn('discord_id', $excludedDiscordIds) // Abaikan discord_id yang masih aktif
            ->orderBy('expires_at', 'desc') // Urutkan agar yang terbaru muncul dulu
            ->get()
            ->unique('discord_id'); // Ambil hanya satu per discord_id (yang terbaru)


        foreach ($users as $user) {
            if ($user->discord_id && $user->role_id) {
                RemoveDiscordRole::dispatch($user->discord_id, $user->role_id, $bot_token, $guild_id);
            }
        }

        return $next($request);
    }
}
