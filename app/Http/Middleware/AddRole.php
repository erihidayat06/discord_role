<?php

namespace App\Http\Middleware;

use App\Models\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AddRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil token dan guild ID dari .env
        $guild_id = env('DISCORD_GUILD_ID');
        $bot_token = env('DISCORD_BOT_TOKEN');

        // // Tanggal kedaluwarsa
        // $add_at = now()->addDays($request->days);
        $users = UserRole::get();


        foreach ($users as $user) {
            if ($user->add_at <= now()) {
                Http::withHeaders([
                    'Authorization' => "Bot $bot_token",
                    'Content-Type' => 'application/json',
                ])->put("https://discord.com/api/v10/guilds/{$guild_id}/members/{$user->discord_id}/roles/{$user->role_id}");
            }
        }

        return $next($request);
    }
}
