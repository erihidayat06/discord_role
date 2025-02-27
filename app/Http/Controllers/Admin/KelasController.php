<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kelas;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Support\Facades\Storage;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelases =  Kelas::kategori()->latest()->get();
        return view('admin.kelas.index', ['kelases' => $kelases]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::latest()->get();
        return view('admin.kelas.cerate', ['kategoris' => $kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        // Buat slug dengan angka berdasarkan jam, menit, detik
        $slug = Str::slug($validatedData['judul']) . '-' . date('dHis');

        // Handle file upload setelah validasi berhasil
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
        }

        // Simpan data ke database
        Kelas::create([
            'judul' => $validatedData['judul'],
            'slug' => $slug,
            'gambar' => $gambarPath,
            'kategori_id' => $validatedData['kategori_id'],
        ]);

        return redirect('/kelas')->with('success', 'Kelas berhasil dibuat.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {

        return view('admin.kelas.modul', ['kelas' => $kelas, 'moduls' => $kelas->moduls]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {

        $kategoris = Kategori::latest()->get();
        return view('admin.kelas.edit', ['kelas' => $kelas, 'kategoris' => $kategoris]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        // Cek apakah ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kelas->gambar) {
                Storage::delete('public/' . $kelas->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
        } else {
            $gambarPath = $kelas->gambar; // Gunakan gambar lama jika tidak ada upload baru
        }

        // Update data
        $kelas->update([
            'judul' => $validatedData['judul'],
            'gambar' => $gambarPath,
            'kategori_id' => $validatedData['kategori_id'],
        ]);

        return redirect('/kelas')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        // Hapus gambar jika ada
        if ($kelas->gambar) {
            Storage::disk('public')->delete($kelas->gambar);
        }

        $kelas->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }


    public function lihatVideo($kelas_id, $id)
    {
        $video = Modul::find($id);
        if (!$video) {
            return redirect()->back()->with('error', 'Video tidak ditemukan.');
        }
        return view('admin.modul.view', ['video' => $video, 'kelas_id' => $kelas_id]);
    }

    public function moveUp($id)
    {
        $kelas = Kelas::findOrFail($id);
        $previous = Kelas::where('created_at', '<', $kelas->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($previous) {
            $tempTime = $kelas->created_at;
            $kelas->update(['created_at' => $previous->created_at->subSecond()]);
            $previous->update(['created_at' => $tempTime->addSecond()]);
        }

        return back();
    }

    public function moveDown($id)
    {
        $kelas = Kelas::findOrFail($id);
        $next = Kelas::where('created_at', '>', $kelas->created_at)
            ->orderBy('created_at', 'asc')
            ->first();

        if ($next) {
            $tempTime = $kelas->created_at;
            $kelas->update(['created_at' => $next->created_at->addSecond()]);
            $next->update(['created_at' => $tempTime->subSecond()]);
        }

        return back();
    }



    public function subKelas(Request $request, Kelas $kelas)
    {
        $request->validate([
            'sub_kelas' => 'nullable|array',  // Pastikan sub_kelas adalah array
            'sub_kelas.*' => 'nullable|string' // Validasi tiap item dalam array
        ]);

        // Simpan sebagai JSON di kolom `sub_kelas` (pastikan kolom ini bertipe JSON atau TEXT di database)
        $kelas->update([
            'sub_kelas' => json_encode($request->sub_kelas)
        ]);

        return back()->with('success', 'Berhasil menambahkan sub kelas');
    }
}
