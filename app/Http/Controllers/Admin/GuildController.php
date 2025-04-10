<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guild;
use App\Models\Choose;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GuildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guilds = Guild::latest()->get();

        return view('admin.guild.index', ['guilds' => $guilds]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guild.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $bot_id = profil_web()->discord_client_id; // ID Bot
        $bot_token = profil_web()->discord_bot_token ?? ''; // Token Bot

        $response = Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->get("https://discord.com/api/v10/guilds/{$request->id_guild}/members/{$bot_id}");

        // dd($response->successful());

        $validate =   $request->validate([
            'name_guild' => 'required|string|max:255',
            'id_guild' => 'required|integer|unique:guilds,id_guild',
            'expires' => 'required',
        ]);

        Guild::create($validate);

        $link = "/guild";

        if ($response->successful() == false) {
            // $link = "https://discord.com/oauth2/authorize?client_id=1337610380842897418&permissions=17448347702&response_type=code&redirect_uri=https%3A%2F%2Faddrole.belajarsatupersen.com%2Fauth%2Fdiscord%2Fcallback&integration_type=0&scope=identify+guilds+guilds.join+gdm.join+messages.read+bot";
            Auth::logout(); // Logout pengguna
            $request->session()->invalidate(); // Hapus session
            $request->session()->regenerateToken(); // Regenerasi CSRF token
            $link = "https://discord.com/oauth2/authorize?client_id=1337610380842897418&permissions=17448347702&response_type=code&redirect_uri=http%3A%2F%2F127.0.0.1%3A8000%2Fauth%2Fdiscord%2Fcallback&integration_type=0&scope=identify+guilds+guilds.join+gdm.join+messages.read+bot";
        }
        return redirect($link)->with('success', 'Guild berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guild $guild)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guild $guild)
    {
        return view('admin.guild.edit', compact('guild'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guild $guild)
    {
        $guild = Guild::findOrFail($guild->id);

        $validate = $request->validate([
            'name_guild' => 'required|string|max:255',
            'id_guild' => 'required|integer|unique:guilds,id,' . $guild->id,
            'expires' => 'required',
        ]);

        $guild->update($validate);

        return redirect('/guild')->with('success', 'Guild berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guild $guild)
    {
        $guild->delete();
        return redirect('/guild')->with('success', 'Guild berhasil dihapus!');
    }


    public function updateGuild(Request $request)
    {
        $request->validate([
            'id_guild' => 'required|exists:guilds,id_guild'
        ]);

        $choose = Choose::latest()->first();

        if (!$choose) {
            $choose = Choose::create([
                'id_guild' => $request->id_guild
            ]);
        } else {
            $choose->update([
                'id_guild' => $request->id_guild
            ]);
        }

        return response()->json(['message' => 'Guild berhasil diperbarui!']);
    }
}
