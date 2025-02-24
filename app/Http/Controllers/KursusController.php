<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Look;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KursusController extends Controller
{
    public function index()
    {

        $kelases =  Kelas::latest()->kategori(request('kategori'))->search(request('query'))->get();
        return view('user.index', ['kelases' => $kelases]);
    }

    public function show(Kelas $kelas)
    {
        $look = Look::firstOrCreate(
            ['kela_id' => $kelas->id, 'user_id' => auth()->id()],
            ['modul' => json_encode([['modul' => []]])] // Awalnya kosong jika belum ada
        );

        // Decode modul dari JSON
        $modul_terlihat = json_decode($look->modul, true);

        // Pastikan formatnya sesuai dan ambil daftar modul yang ditonton
        if (!is_array($modul_terlihat) || !isset($modul_terlihat[0]['modul']) || !is_array($modul_terlihat[0]['modul'])) {
            $modul_list = []; // Jika format tidak valid, buat kosong
        } else {
            $modul_list = $modul_terlihat[0]['modul'];
        }

        // Ambil semua slug modul yang valid dari kelas
        $modul_valid = $kelas->moduls->pluck('slug')->toArray();

        // Hapus slug yang tidak ada dalam daftar modul valid
        $modul_list = array_values(array_intersect($modul_list, $modul_valid));

        // Simpan kembali data yang sudah difilter ke dalam database jika ada perubahan
        if (json_encode([['modul' => $modul_list]]) !== $look->modul) {
            $look->update(['modul' => json_encode([['modul' => $modul_list]])]);
        }

        // Hitung progress
        $total_modul = $kelas->moduls->count();
        $modul_selesai = count($modul_list);
        $progress = $total_modul > 0 ? round(($modul_selesai / $total_modul) * 100) : 0;


        return view('user.modul', [
            'moduls' => $kelas->moduls,
            'kelas' => $kelas,
            'look' => $look,
            'progress' => $progress, // Kirim nilai progress ke view
        ]);
    }



    public function showModul($slug, $slug_modul)
    {
        $kelas = Kelas::where('slug', $slug)->with('moduls')->firstOrFail();
        $modul = Modul::where('slug', $slug_modul)->firstOrFail();

        // Tangkap slug modul sebelumnya jika ada
        $slugSebelumnya = request('slugSaatIni');

        // Ambil atau buat Look untuk user dan kelas ini
        $look = Look::firstOrCreate(
            ['kela_id' => $kelas->id, 'user_id' => auth()->id()],
            ['modul' => json_encode([['modul' => []]])] // Awalnya kosong jika belum ada
        );

        // Decode JSON untuk mendapatkan daftar modul yang sudah dilihat
        $modul_terlihat = json_decode($look->modul, true) ?? [];
        $modul_list = $modul_terlihat[0]['modul'] ?? [];

        // Ambil daftar slug modul yang valid dari kelas
        $modul_valid = $kelas->moduls->pluck('slug')->toArray();

        // Pastikan slug sebelumnya valid dan belum ada dalam daftar
        if ($slugSebelumnya && in_array($slugSebelumnya, $modul_valid) && !in_array($slugSebelumnya, $modul_list)) {
            $modul_list[] = $slugSebelumnya;
        }

        // Hapus modul yang sudah tidak valid
        $modul_list = array_values(array_intersect($modul_list, $modul_valid));

        // Simpan kembali jika ada perubahan
        if (json_encode([['modul' => $modul_list]]) !== $look->modul) {
            $look->update(['modul' => json_encode([['modul' => $modul_list]])]);
        }

        // Hitung progress belajar
        $total_modul = count($modul_valid);
        $modul_selesai = count($modul_list);
        $progress = ($total_modul > 0) ? round(($modul_selesai / $total_modul) * 100) : 0;

        // Ambil semua modul untuk navigasi
        $moduls = $kelas->moduls()->orderBy('id')->get();

        // Cari index modul saat ini
        $currentIndex = $moduls->search(fn($m) => $m->slug === request('slug_modul'));

        // Tentukan modul sebelumnya dan berikutnya
        $prevModul = $currentIndex > 0 ? $moduls[$currentIndex - 1] : null;
        $nextModul = $currentIndex < $moduls->count() - 1 ? $moduls[$currentIndex + 1] : null;


        return view('user.show_modul', [
            'moduls' => $kelas->moduls,
            'kelas' => $kelas,
            'showModul' => $modul,
            'progress' => $progress,
            'prevModul' => $prevModul,
            'nextModul' => $nextModul
        ]);
    }



    public function secureVideo(Request $request, $filename)
    {
        // Validasi Signed URL
        if (!$request->hasValidSignature()) {
            abort(403, 'Akses Ditolak');
        }

        Log::error("Video Request: " . $filename);

        // Path ke dalam storage/modul/
        $path = $filename;

        // Cek apakah file ada
        if (!Storage::exists($path)) {
            abort(404, 'Video Tidak Ditemukan');
        }

        // Streaming video agar tidak bisa di-download langsung
        return new StreamedResponse(function () use ($path) {
            $stream = Storage::readStream($path);
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            'Content-Type' => 'video/mp4',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }
}
