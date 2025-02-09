<?php

// app/Http/Controllers/Auth/DiscordController.php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{

    public function index()
    {
        // Ambil token dan guild ID dari .env
        $guild_id = env('DISCORD_GUILD_ID');
        $bot_token = env('DISCORD_BOT_TOKEN');
        // Ambil daftar role dari API Discord
        $get_roles = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/roles");

        // Cek apakah request API role berhasil
        if ($get_roles->failed()) {
            return response()->json(['error' => 'Gagal mengambil data role dari Discord.'], 400);
        }

        $discord_roles = collect($get_roles->json())->pluck('name', 'id')->toArray(); // Simpan role dalam format [id => name]



        // Ambil data user dari API Discord
        $get_users = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/members?limit=1000");

        // Cek apakah request API user berhasil
        if ($get_users->failed()) {
            return response()->json(['error' => 'Gagal mengambil data pengguna dari Discord.'], 400);
        }

        $users = $get_users->json();

        // Format data untuk output
        $formattedUsers = collect($users)->map(function ($user) use ($discord_roles) {
            $userData = $user['user'] ?? [];

            return [
                'id' => $userData['id'] ?? null,
                'username' => $userData['username'] ?? 'Unknown',
                'discriminator' => $userData['discriminator'] ?? '0000',
                'avatar' => isset($userData['avatar'])
                    ? "https://cdn.discordapp.com/avatars/{$userData['id']}/{$userData['avatar']}.png"
                    : "https://cdn.discordapp.com/embed/avatars/" . (($userData['discriminator'] ?? 0) % 5) . ".png",
                'roles' => collect($user['roles'] ?? [])->map(fn($roleId) => [
                    'id' => $roleId,
                    'name' => $discord_roles[$roleId] ?? 'Unknown Role'
                ])->toArray(), // Mengembalikan ID dan Nama Role
            ];
        });



        $response = Http::withHeaders([
            'Authorization' => 'Bot ' . $bot_token,
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/roles");

        if ($response->successful()) {
            $roles = $response->json();
            return view('admin.discord.add-role', ['roles' => $roles, 'users' => $formattedUsers]); // Mengembalikan daftar role dalam format JSON
        } else {
            Log::error('Discord API error: ' . $response->body());
            return null;
        }
    }



    public function handleProviderCallback()
    {
        $discordUser = Socialite::driver('discord')->user();

        // Menyusun data pengguna
        $discord_id = $discordUser->getId();
        $name = $discordUser->getName();
        $avatar = $discordUser->getAvatar();
        $email = $discordUser->getEmail();
        $token = $discordUser->token;

        // Cek apakah user dengan discord_id sudah ada
        $user = User::where('discord_id', $discord_id)->first();

        if ($user) {
            // Jika user sudah ada, update data avatar & token
            $user->update([
                'avatar' => $avatar,
                'token' => $token,
                'updated_at' => now(),
            ]);
        } else {
            // Jika user belum ada, buat user baru
            $user = User::create([
                'discord_id' => $discord_id,
                'name' => $name,
                'avatar' => $avatar,
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Login user ke Laravel
        auth()->login($user);

        // Join otomatis ke server Discord
        $guild_id = env('DISCORD_GUILD_ID'); // ID Server Discord
        $bot_token = env('DISCORD_BOT_TOKEN'); // Bot Token

        $response = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->asJson()->put("https://discord.com/api/v10/guilds/{$guild_id}/members/{$discord_id}", [
            'access_token' => $token, // Token dari OAuth2
        ]);

        // Cek apakah request berhasil
        if ($response->failed()) {
            $errorMessage = 'Gagal masuk ke server Discord: ' . $response->body();
            return redirect('/')->withErrors(['error' => $errorMessage]);
        }

        return redirect(auth()->user()->is_admin == false ? '/' : '/discord/data-role/view')->with('success', 'Login dan bergabung ke server berhasil!');
    }



    public function addRole(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'discord_id' => 'required|string',
            'role_id' => 'required|string',
            'days' => 'required|min:1',
        ]);

        UserRole::create([
            'user_id' => $request->discord_id,
            'discord_id' => $request->discord_id,
            'role_id' => $request->role_id,
            'add_at' => $request->days,
        ]);



        // Jika gagal menambahkan role, tampilkan pesan error
        return redirect('/discord/data-role/view')->with('success', 'Data berhasil disimpan');
    }


    public function editRoleUSer(Request $request, UserRole $userRole)
    {
        $guild_id = env('DISCORD_GUILD_ID'); // ID Server Discord
        $bot_token = env('DISCORD_BOT_TOKEN'); // Bot Token

        // Ambil semua user dari database (UserRole)
        $user_roles = UserRole::latest()->get();

        // Ambil daftar role dari Discord
        $get_roles = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/roles");

        // Pastikan respons berhasil
        if ($get_roles->failed()) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil data role dari Discord.']);
        }

        // Ubah data role menjadi array dengan key role_id -> role_name
        $roles = collect($get_roles->json());
        $discord_roles = $roles->pluck('name', 'id')->toArray(); // Buat array role ID => Nama Role

        // Ambil daftar pengguna dari Discord
        $get_users = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/members?limit=1000");

        if ($get_users->failed()) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil data pengguna dari Discord.']);
        }

        $users = collect($get_users->json())->keyBy('user.id'); // Simpan data user berdasarkan ID mereka

        // Gabungkan data dari database dengan data API
        $formattedUsers = $user_roles->map(function ($userRole) use ($users, $discord_roles) {
            $userId = $userRole->user_id;
            $discordUser = $users->get($userId, []);

            $userData = $discordUser['user'] ?? [];

            return [
                'id' => $userId,
                'tanggal_aktif' => $userRole->add_at,
                'username' => $userData['username'] ?? 'Unknown',
                'discriminator' => $userData['discriminator'] ?? '0000',
                'avatar' => isset($userData['avatar'])
                    ? "https://cdn.discordapp.com/avatars/{$userId}/{$userData['avatar']}.png"
                    : "https://cdn.discordapp.com/embed/avatars/" . (($userData['discriminator'] ?? 0) % 5) . ".png",
                'roles' => collect($discordUser['roles'] ?? [])
                    ->map(fn($roleId) => $discord_roles[$roleId] ?? 'Unknown Role') // Mapping role dari API
                    ->toArray(),
                'database_role' => $discord_roles[$userRole->role_id] ?? 'Tidak Ada Role', // Ambil role dari database
            ];
        });

        return view('admin.discord.edit', compact('formattedUsers', 'userRole', 'roles'));
    }

    public function update(Request $request, UserRole $userRole)
    {
        // Validasi input dari request
        $request->validate([
            'discord_id' => 'required|string',
            'role_id' => 'required|string',
            'days' => 'required|min:1',
        ]);

        UserRole::where('id', $userRole->id)->update([
            'user_id' => $request->discord_id,
            'discord_id' => $request->discord_id,
            'role_id' => $request->role_id,
            'add_at' => $request->days,
        ]);



        // Jika gagal menambahkan role, tampilkan pesan error
        return redirect('/discord/data-role/view')->with('success', 'Data berhasil di ubah');
    }

    public function delete(UserRole $userRole)
    {

        $userRole->delete();
        // Jika gagal menambahkan role, tampilkan pesan error
        return redirect('/discord/data-role/view')->with('success', 'Data berhasil dihapus');
    }




    public function roleUser()
    {
        $guild_id = env('DISCORD_GUILD_ID'); // ID Server Discord
        $bot_token = env('DISCORD_BOT_TOKEN'); // Bot Token


        // Ambil semua user dari database (UserRole)
        $user_roles = UserRole::latest()->get(); // Ambil semua data tanpa keyBy()

        // Ambil daftar role dari API Discord
        $get_roles = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/roles");

        // Cek apakah request API berhasil
        if ($get_roles->failed()) {
            return redirect()->back()->withErrors(['error' => 'Gagal mengambil data role dari Discord.']);
        }

        $discord_roles = collect($get_roles->json())->pluck('name', 'id')->toArray(); // Ubah jadi array key-value (id => name)

        // Ambil data user dari API Discord
        $get_users = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$guild_id}/members?limit=1000");

        // Cek apakah request API berhasil
        if ($get_users->failed()) {
            return redirect()->back()->with('error', 'Gagal mengambil data pengguna dari Discord.');
        }

        $users = collect($get_users->json())->keyBy('user.id'); // Simpan data user berdasarkan ID mereka

        // Gabungkan data dari database dengan data API
        $formattedUsers = $user_roles->map(function ($userRole) use ($users, $discord_roles) {
            $userId = $userRole;
            $user_id = $userRole->user_id;
            $discordUser = $users->get($userId->user_id, []);

            $userData = $discordUser['user'] ?? [];

            return [
                'id' => $userId->id,
                'tanggal_aktif' => $userId->add_at,
                'username' => $userData['username'] ?? 'Unknown', // Jika user tidak ditemukan di API, gunakan 'Unknown'
                'discriminator' => $userData['discriminator'] ?? '0000',
                'avatar' => isset($userData['avatar'])
                    ? "https://cdn.discordapp.com/avatars/{$user_id}/{$userData['avatar']}.png"
                    : "https://cdn.discordapp.com/embed/avatars/" . (($userData['discriminator'] ?? 0) % 5) . ".png",
                'roles' => collect($discordUser['roles'] ?? [])->map(fn($user_id) => $discord_roles[$user_id] ?? 'Unknown Role')->toArray(),
                'database_role' => $discord_roles[$userRole->role_id] ?? 'Tidak Ada Role', // Ambil role name dari API Discord berdasarkan role_id di database
            ];
        });


        return view('admin.discord.data-user', compact('formattedUsers'));
    }


    /**
     * Logout dari Laravel
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
