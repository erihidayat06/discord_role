<?php

namespace App\Http\Controllers;

use App\Models\ProfilWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilWebController extends Controller
{
    public function index()
    {
        $profil = ProfilWeb::first();

        if (!$profil) {
            $profil = ProfilWeb::create([
                'nama_website' => 'Nama Website',
                'logo' => '',
                'logo_title' => '',
                'bunny_stream_library_id' => '',
                'bunny_stream_api_key' => '',
                'bunny_stream_watermark_url' => '',
                'cloudflare_site_key' => '',
                'cloudflare_secret_key' => '',
                'midtrans_merchant_id' => '',
                'midtrans_client_key' => '',
                'midtrans_server_key' => '',
                'midtrans_url' => '',
                'midtrans_is_production' => false,
                // 🔥 Tambahan untuk Discord
                'discord_client_id' => '',
                'discord_client_secret' => '',
                'discord_bot_token' => '',
            ]);
        }

        return view('admin.profil_web.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilWeb::first();

        $data = $request->validate([
            'nama_website' => 'required|string',
            'logo' => 'nullable',
            'logo_title' => 'nullable',

            'bunny_stream_library_id' => 'nullable|string',
            'bunny_stream_api_key' => 'nullable|string',

            'cloudflare_site_key' => 'nullable|string',
            'cloudflare_secret_key' => 'nullable|string',

            'midtrans_merchant_id' => 'nullable|string',
            'midtrans_client_key' => 'nullable|string',
            'midtrans_server_key' => 'nullable|string',
            'midtrans_url' => 'nullable|string',
            'midtrans_is_production' => 'nullable',

            // 🔥 Tambahan untuk Discord
            'discord_client_id' => 'nullable|string',
            'discord_client_secret' => 'nullable|string',
            'discord_bot_token' => 'nullable|string',
        ]);

        // Handle logo
        if ($request->hasFile('logo')) {
            if ($profil && $profil->logo && Storage::exists($profil->logo)) {
                Storage::delete($profil->logo);
            }

            $path = $request->file('logo')->store('logo', 'public');
            $data['logo'] = 'storage/' . $path;
        } else {
            $data['logo'] = $profil->logo ?? null;
        }

        // Handle logo title
        if ($request->hasFile('logo_title')) {
            $file = $request->file('logo_title');
            $path = $file->store('logo_title', 'public');
            $data['logo_title'] = 'storage/' . $path;
        }

        // Checkbox boolean
        $data['midtrans_is_production'] = $request->has('midtrans_is_production');

        // Simpan data
        if ($profil) {
            $profil->update($data);
        } else {
            ProfilWeb::create($data);
        }

        return redirect()->route('admin.profil-web')->with('success', 'Data berhasil disimpan!');
    }
}
