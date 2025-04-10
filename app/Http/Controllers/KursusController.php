<?php

namespace App\Http\Controllers;

use App\Models\Look;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KursusController extends Controller
{
    public function index()
    {

        $kelases = Kelas::latest()
            ->when(request('kategori'), function ($query, $kategori) {
                return $query->kategori($kategori);
            })
            ->when(request('query'), function ($query, $search) {
                return $query->search($search);
            })
            ->get();

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
        $kelas = Kelas::where('slug', $slug)->firstOrFail();

        $modul = Modul::where('slug', $slug_modul)->firstOrFail();
        $slugSebelumnya = request('slugSaatIni');

        $look = Look::firstOrCreate(
            ['kela_id' => $kelas->id, 'user_id' => auth()->id()],
            ['modul' => json_encode([['modul' => []]])]
        );

        $modul_terlihat = json_decode($look->modul, true) ?? [];
        $modul_list = $modul_terlihat[0]['modul'] ?? [];

        $modul_valid = $kelas->moduls->pluck('slug')->toArray();

        if ($slugSebelumnya && in_array($slugSebelumnya, $modul_valid) && !in_array($slugSebelumnya, $modul_list)) {
            $modul_list[] = $slugSebelumnya;
        }

        $modul_list = array_values(array_intersect($modul_list, $modul_valid));

        if (json_encode([['modul' => $modul_list]]) !== $look->modul) {
            $look->update(['modul' => json_encode([['modul' => $modul_list]])]);
        }

        $total_modul = count($modul_valid);
        $modul_selesai = count($modul_list);
        $progress = ($total_modul > 0) ? round(($modul_selesai / $total_modul) * 100) : 0;

        $moduls = $kelas->moduls()->orderBy('sub_kelas', 'ASC')->get();

        // Cari index modul saat ini
        $currentIndex = $moduls->search(fn($m) => $m->slug === $slug_modul);

        $prevModul = $currentIndex > 0 ? $moduls[$currentIndex - 1] : null;
        $nextModul = $currentIndex < $moduls->count() - 1 ? $moduls[$currentIndex + 1] : null;

        return view('user.show_modul', [
            'moduls' => $moduls,
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


    public function logout()
    {
        $guild_id = 1274717645236862976;
        $bot_token = profil_web()->discord_bot_token  ?? '';
        $user_id = auth()->user()->discord_id;

        User::where('id', auth()->user()->id)->update(['discord_active' => 0]);

        Http::withHeaders([
            'Authorization' => "Bot $bot_token",
            'Content-Type' => 'application/json',
        ])->delete("https://discord.com/api/v10/guilds/{$guild_id}/members/{$user_id}/roles/1287469825974603806");

        return redirect()->back()->with('success', 'discord logout');
    }
}
