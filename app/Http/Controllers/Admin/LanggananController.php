<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class LanggananController extends Controller
{
    public function index()
    {

        $users = User::where('is_admin', 0)->latest()->get();

        return view('admin.langganan.index', ['users' => $users]);
    }
    public function adminUser()
    {

        $users = User::where('is_admin', 1)->latest()->get();

        return view('admin.langganan.admin', ['users' => $users]);
    }

    public function updateExpired(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$request->has('expired_date')) {
            return response()->json(['error' => 'Expired date is required'], 400);
        }

        $newExpiredDate = $request->expired_date ? Carbon::parse($request->expired_date) : null;

        // Jika expired dihapus atau di-set null, nonaktifkan Discord dan hapus role
        if (is_null($newExpiredDate)) {
            $user->expired = null;
            $user->discord_active = false;
            $user->save();

            // Hapus role dari Discord
            $this->removeDiscordRole($user->discord_id);
        } else {
            $user->expired = $newExpiredDate;
            $user->save();
        }

        return response()->json([
            'message' => 'Expired updated successfully!',
            'new_expired' => $user->expired ? $user->expired->toDateString() : null,
            'discord_active' => $user->discord_active
        ]);
    }

    // 🔹 Fungsi untuk hapus role di Discord
    private function removeDiscordRole($userId)
    {
        $guildId = '1274717645236862976'; // Ganti dengan Guild ID server Discord
        $roleId = '1287469825974603806'; // Ganti dengan Role ID yang akan dihapus
        $botToken = profil_web()->discord_bot_token  ?? '';

        Http::withHeaders([
            'Authorization' => "Bot $botToken",
            'Content-Type' => 'application/json',
        ])->delete("https://discord.com/api/v10/guilds/{$guildId}/members/{$userId}/roles/{$roleId}");
    }
}
