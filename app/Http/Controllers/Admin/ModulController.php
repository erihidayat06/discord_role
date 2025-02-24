<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modul;

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
        $request->validate([
            'judul' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi,wmv',
        ]);

        if ($request->hasFile('video')) {
            // Mulai Transaksi
            DB::beginTransaction();

            // Inisialisasi variabel
            $videoPath = null;
            $watermarkedVideoPath = null;

            try {
                // Upload Video Asli
                $videoPath = $request->file('video')->store('modul', 'public');

                // Tentukan path watermark
                $watermarkImagePath = public_path('assets/img/logo-main.png');

                // Tentukan path untuk video yang sudah di-watermark
                $watermarkedVideoPath = 'modul/watermarked_' . basename($videoPath);

                // Proses Watermark menggunakan FFmpeg
                $ffmpegCommand = "ffmpeg -i " . storage_path('app/public/' . $videoPath) .
                    " -i $watermarkImagePath -filter_complex \"overlay=W-w-10:H-h-10\" " .
                    storage_path('app/public/' . $watermarkedVideoPath);

                // Jalankan perintah FFmpeg
                exec($ffmpegCommand);

                // Perkecil ukuran video (dengan kualitas 80%)
                $compressedVideoPath = 'modul/compressed_' . basename($videoPath);
                $ffmpegCompressCommand = "ffmpeg -i " . storage_path('app/public/' . $watermarkedVideoPath) .
                    " -vcodec libx264 -crf 23 " .
                    storage_path('app/public/' . $compressedVideoPath);

                // Jalankan perintah kompresi
                exec($ffmpegCompressCommand);

                // Buat slug dengan angka berdasarkan jam, menit, detik
                $slug = Str::slug($request->judul) . '-' . date('dHis');

                // Simpan informasi video ke database
                Modul::create([
                    'judul' => $request->judul,
                    'slug' => $slug,
                    'video' =>  $compressedVideoPath, // Simpan video yang sudah dikompresi
                    'kelas_id' => $request->kelas_id,
                ]);

                // Commit Transaksi
                DB::commit();

                // Hapus video asli dan yang sudah di-watermark dari storage setelah digunakan
                Storage::disk('public')->delete($videoPath);
                Storage::disk('public')->delete($watermarkedVideoPath);

                return redirect('/kelas/' . $request->kelas_id)
                    ->with('success', 'Video berhasil diunggah dengan watermark!');
            } catch (\Exception $e) {
                // Jika gagal, kembalikan transaksi
                DB::rollBack();

                // Hapus file yang sudah terupload jika ada
                if ($videoPath && Storage::disk('public')->exists($videoPath)) {
                    Storage::disk('public')->delete($videoPath);
                }

                // Redirect dengan pesan error
                return back()->with('error', 'Gagal mengunggah video: ' . $e->getMessage());
            }
        }

        return redirect('/kelas/' . $request->kelas_id)->with('error', 'Gagal mengunggah video.');
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
