<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        // Ambil user dengan role terbaru berdasarkan user_id dan role_id
        $users = UserRole::select('id', 'user_id', 'role_id', 'discord_id', 'expires_at')
            ->whereNotNull('expires_at') // Pastikan expires_at ada
            ->orderBy('user_id') // Urutkan berdasarkan user_id terlebih dahulu
            ->orderBy('role_id') // Urutkan berdasarkan role_id
            ->orderByDesc('expires_at') // Ambil data dengan expires_at terbaru
            ->distinct('user_id', 'role_id') // Ambil hanya data yang unik berdasarkan user_id dan role_id
            ->get();

        foreach ($users as $user) {
            // Pastikan expires_at tidak null sebelum dibandingkan dengan now()
            if (Carbon::parse($user->expires_at)->lessThan(now())) {
                // Pastikan discord_id dan role_id tidak kosong sebelum menghapus role
                if ($user->discord_id && $user->role_id) {
                    // Kirim request DELETE ke API Discord
                    Http::withHeaders([
                        'Authorization' => "Bot $bot_token",
                        'Content-Type' => 'application/json',
                    ])->delete("https://discord.com/api/v10/guilds/{$guild_id}/members/{$user->discord_id}/roles/{$user->role_id}");
                }
            }
        }

        return $next($request);
    }
}
