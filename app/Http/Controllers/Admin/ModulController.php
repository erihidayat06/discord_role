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
    public function create()
    {
        // $cloudinary = [
        //     'cloud' => [
        //         'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        //         'api_key'    => env('CLOUDINARY_API_KEY'),
        //         'api_secret' => env('CLOUDINARY_API_SECRET'),
        //     ],
        // ];

        // dd($cloudinary);

        if (empty(request('kelas'))) {
            return redirect()->back();
        } else {

            return view('admin.modul.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Request diterima: ', $request->all());

        $request->validate([
            'judul' => 'required|string|max:255',
            'video' => 'required|mimes:mp4',
        ]);

        Log::info('Validasi berhasil.');

        $client = new Client();
        $libraryId = env('BUNNY_STREAM_LIBRARY_ID');
        $apiKey = env('BUNNY_STREAM_API_KEY');

        // Upload video ke Bunny Stream
        $file = $request->file('video');
        $fileName = time() . '_' . $file->getClientOriginalName();

        Log::info('File video ditemukan: ', [
            'fileName' => $fileName,
            'size' => $file->getSize(),
            'mime' => $file->getMimeType(),
        ]);

        try {
            // Step 1: Buat video di Bunny Stream
            Log::info('Mengirim permintaan untuk membuat video di Bunny Stream...');
            // Generate slug dari judul + timestamp
            $slug = Str::slug($request->judul) . '-' . time();


            $response = $client->post("https://video.bunnycdn.com/library/$libraryId/videos", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'AccessKey' => $apiKey,
                ],
                'json' => [
                    'title' => $slug,
                    'collectionId' => null, // Optional
                ],
            ]);

            $videoData = json_decode($response->getBody(), true);
            Log::info('Response dari Bunny Stream (Pembuatan Video): ', $videoData);

            $videoId = $videoData['guid'] ?? null;

            if (!$videoId) {
                Log::error('Gagal membuat video di Bunny Stream.', ['response' => $videoData]);
                return back()->with('error', 'Gagal membuat video di Bunny Stream.');
            }

            // Step 2: Upload file ke Bunny Stream
            Log::info('Mengupload file ke Bunny Stream...', ['videoId' => $videoId]);

            $uploadResponse = $client->put("https://video.bunnycdn.com/library/$libraryId/videos/$videoId", [
                'headers' => [
                    'AccessKey' => $apiKey,
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => fopen($file->getPathname(), 'r'),
            ]);

            Log::info('Upload selesai!', ['statusCode' => $uploadResponse->getStatusCode()]);


            // Simpan ke database
            Modul::create([
                'judul' => $request->judul,
                'slug' => $slug,
                'kelas_id' => $request->kelas_id,
                'video' => "https://iframe.mediadelivery.net/embed/$libraryId/$videoId",
            ]);

            Log::info('Video berhasil disimpan ke database.');

            return redirect()->back()->with('success', 'Video berhasil diunggah ke Bunny Stream!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan:', ['message' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat mengunggah video.');
        }
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
        return view('admin.modul.edit', ['modul' => $modul]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv',
        ]);

        // Mulai Transaksi
        DB::beginTransaction();

        try {
            // Buat slug dengan angka berdasarkan jam, menit, detik
            $slug = Str::slug($request->judul) . '-' . date('dHis');
            // Simpan judul
            $modul->judul = $request->judul;
            $modul->slug = $slug;

            // Cek apakah ada video baru yang diunggah
            if ($request->hasFile('video')) {
                // Hapus video lama jika ada
                if ($modul->video && Storage::disk('public')->exists($modul->video)) {
                    Storage::disk('public')->delete($modul->video);
                }

                // Upload video baru
                $videoPath = $request->file('video')->store('modul', 'public');
                $modul->video = $videoPath;
            }

            // Simpan perubahan
            $modul->save();

            DB::commit();

            return redirect('/kelas/' . $modul->kelas_id)->with(['success' => 'Modul berhasil diperbarui!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal memperbarui modul! ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        DB::beginTransaction();

        try {
            // Hapus video dari storage jika ada
            if ($modul->video && Storage::disk('public')->exists($modul->video)) {
                Storage::disk('public')->delete($modul->video);
            }

            // Hapus modul dari database
            $modul->delete();

            DB::commit();

            return redirect('/kelas/' . $modul->kelas_id)->with('success', 'Modul berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus modul! ' . $e->getMessage());
        }
    }
}
