<?php

use App\Models\Guild;
use App\Models\Kelas;
use App\Models\Modul;
use App\Models\Pixel;
use App\Models\Choose;
use App\Models\Kategori;

if (!function_exists('pilih_guild')) {
    function pilih_guild()
    {
        // Ambil data terbaru dari tabel Choose
        $choose = Choose::latest()->first();

        // Jika tabel Choose kosong, ambil guild pertama
        if (!$choose) {
            $firstGuild = Guild::orderBy('id_guild')->first();

            // Jika guild juga kosong, gunakan default
            if (!$firstGuild) {
                return 1; // ID default jika tidak ada guild
            }

            // Simpan data baru di Choose dengan ID guild pertama
            $choose = Choose::create([
                'id_guild' => $firstGuild->id_guild,
            ]);
        }

        return $choose->id_guild;
    }
}

if (!function_exists('guild')) {
    function guild()
    {

        $guilds = Guild::latest()->get();

        return $guilds;
    }
}

if (!function_exists('kategori')) {
    function kategori()
    {

        $kategori = Kategori::orderBy('order', 'asc')->get();

        return $kategori;
    }
}


if (!function_exists('pixel')) {
    function pixel()
    {

        $pixel = Pixel::first();


        return $pixel;
    }
}
