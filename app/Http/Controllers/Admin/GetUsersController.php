<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserRole;
use Illuminate\Support\Facades\Http;

class GetUsersController extends Controller
{
    public function getUsersByRole(Request $request)
    {

        $guildId = pilih_guild(); // ID Server Discord
        $botToken = env('DISCORD_BOT_TOKEN');
        $roleId = $request->query('role_id');



        // 🔹 Ambil daftar discord_id yang sudah ada di database berdasarkan role_id
        $existingUserIds = UserRole::where('role_id', $roleId)->where('id_guild', $guildId)
            ->pluck('discord_id') // Ambil hanya discord_id
            ->toArray(); // Konversi ke array untuk pencarian cepat

        // 🔹 Panggil API Discord untuk mengambil semua member
        $response = Http::withHeaders([
            'Authorization' => "Bot $botToken"
        ])->get("https://discord.com/api/v10/guilds/$guildId/members", [
            'limit' => 1000
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Gagal mengambil data'], 500);
        }

        $members = $response->json();

        // 🔹 Filter berdasarkan role yang dipilih dan exclude yang sudah ada di database
        $filteredMembers = array_filter($members, function ($member) use ($roleId, $existingUserIds) {
            return isset($member['roles'])
                && in_array($roleId, $member['roles']) // Pastikan user punya role yang dipilih
                && !in_array($member['user']['id'], $existingUserIds); // Pastikan user belum ada di database
        });

        // 🔹 Ambil hanya ID dan Username dari user yang belum ada dalam database
        $formattedMembers = array_map(function ($member) {
            return [
                'id' => $member['user']['id'] ?? 'N/A',
                'username' => $member['user']['username'] ?? 'Unknown'
            ];
        }, array_values($filteredMembers));

        return response()->json($formattedMembers);
    }


    public function addRoleMultiple(Request $request)
    {

        $request->validate([
            'discord_id' => 'required|array',
            'discord_id.*' => 'required|string',
            'expires_at' => 'required|array',
            'expires_at.*' => 'nullable|date',
        ]);

        $data = [];
        foreach ($request->discord_id as $key => $discordId) {
            if ($request->expires_at[$key] != null) {
                $data[] = [
                    'discord_id' => $discordId,
                    'user_id' => $discordId,
                    'role_id' => $request->role_id,
                    'id_guild' => pilih_guild(),
                    'expires_at' => $request->expires_at[$key] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        UserRole::insert($data);

        return redirect('/discord/data-role/view')->with('success', 'Role berhasil ditambahkan!');
    }
}
