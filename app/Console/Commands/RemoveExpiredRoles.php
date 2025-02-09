<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\UserRole;
use Carbon\Carbon;

// class RemoveExpiredRoles extends Command
// {
//     protected $signature = 'discord:remove-expired-roles';
//     protected $description = 'Menghapus role Discord yang telah kadaluarsa';

//     public function handle()
//     {
//         $guild_id = env('DISCORD_GUILD_ID');
//         $bot_token = env('DISCORD_BOT_TOKEN');

//         $expiredRoles = UserRole::where('expires_at', '<', Carbon::now())->get();

//         foreach ($expiredRoles as $role) {
//             $response = Http::withHeaders([
//                 'Authorization' => "Bot $bot_token",
//                 'Content-Type' => 'application/json',
//             ])->delete("https://discord.com/api/v10/guilds/$guild_id/members/$role->discord_id/roles/$role->role_id");

//             if ($response->successful()) {
//                 $role->delete();
//                 $this->info("Role {$role->role_id} dihapus dari user {$role->discord_id}");
//             }
//         }
//     }
// }
