<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modul;

use GuzzleHttp\Client;
use Cloudinary\Cloudinary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $cloudinary = [
        //     'cloud' => [
        //         'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        //         'api_key'    => env('CLOUDINARY_API_KEY'),
        //         'api_secret' => env('CLOUDINARY_API_SECRET'),
        //     ],
        // ];

        // dd($cloudinary);



        $kelasNama = $request->kelas; // Ambil nilai dari request
        $kelas = Kelas::where('id', $kelasNama)->first(); // Cek apakah kelas ada

        if (empty($kelasNama) || !$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan atau kosong');
        }

        return view('admin.modul.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'video' => 'required|string', // Terima ID video
        ]);
        $libraryId = env('BUNNY_STREAM_LIBRARY_ID');

        // Ambil ID video dari request
        $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/$request->video";


        // Step 2: Simpan judul dan URL video ke database
        Modul::create([
            'judul' => $request->judul,
            'sub_kelas' => $request->sub_kelas,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'video' => $videoUrl, // Simpan URL video
            'kelas_id' => $request->kelas_id
        ]);

        return redirect("/kelas/$request->kelas_id")->with('success', 'Video berhasil diunggah!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Modul $modul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modul $modul)
    {

        $kelasNama = $modul->kelas_id; // Ambil nilai dari request
        $kelas = Kelas::where('id', $kelasNama)->first(); // Cek apakah kelas ada

        if (empty($kelasNama) || !$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan atau kosong');
        }

        return view('admin.modul.edit', ['modul' => $modul, 'kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'video' => 'required|string', // Terima ID video
        ]);

        $libraryId = env('BUNNY_STREAM_LIBRARY_ID');

        // Ambil ID video dari request
        $videoUrl = "https://iframe.mediadelivery.net/embed/$libraryId/$request->video";

        // Step 2: Update data video dan judul ke database
        $modul->update([
            'judul' => $request->judul,
            'sub_kelas' => $request->sub_kelas,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'video' => $videoUrl, // Update URL video
        ]);

        return redirect("/kelas/$modul->kelas_id")->with('success', 'Modul berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        DB::beginTransaction();

        try {
            $libraryId = env('BUNNY_STREAM_LIBRARY_ID');
            $apiKey = env('BUNNY_STREAM_API_KEY');

            // Cek apakah video ada di Bunny Stream
            if ($modul->video) {
                // Ambil video ID dari URL (format: https://iframe.mediadelivery.net/embed/{libraryId}/{videoId})
                $videoId = basename(parse_url($modul->video, PHP_URL_PATH));

                // Hapus video dari Bunny Stream API
                $response = Http::withHeaders([
                    'AccessKey' => $apiKey,
                ])->delete("https://video.bunnycdn.com/library/$libraryId/videos/$videoId");

                if ($response->failed()) {
                    throw new \Exception('Gagal menghapus video dari Bunny Stream: ' . $response->body());
                }
            }

            // Hapus modul dari database
            $modul->delete();

            DB::commit();

            return redirect('/kelas/' . $modul->kelas_id)->with('success', 'Modul dan video berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            $modul->delete();
            return back()->with('error', 'Gagal menghapus modul! ' . $e->getMessage());
        }
    }
}
