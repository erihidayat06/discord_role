<?php

namespace App\Http\Controllers\Admin;

use App\Models\Research;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $research = Research::latest('tanggal')->get();


        return view('admin.research.index', ['researchs' => $research]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.research.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'required|url',
            'tanggal' => 'required|date',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('research', 'public');
        }

        // Ekstrak file ID dari link Google Drive
        preg_match('/\/d\/(.+?)\//', $request->link, $matches);
        $fileId = $matches[1] ?? null;

        if (!$fileId) {
            return back()->withErrors(['link' => 'Format link Google Drive tidak valid.'])->withInput();
        }


        $research = new Research();
        $research->judul = $request->judul;
        $research->slug = Str::slug($request->jusul);
        $research->gambar = $gambarPath;
        $research->link = $fileId;
        $research->tanggal = $request->tanggal;
        $research->save();

        return redirect('/admin/research')->with('success', 'research berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $research = Research::latest('tanggal')->get();
        return view('user.reserch', ['researchs' => $research]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Research $research)
    {
        return view('admin.research.edit', ['research' => $research]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Research $research)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'required|url',
            'tanggal' => 'required|date',
        ]);

        // Ekstrak file ID dari link Google Drive
        preg_match('/\/d\/(.+?)\//', $request->link, $matches);
        $fileId = $matches[1] ?? null;

        if (!$fileId) {
            return back()->withErrors(['link' => 'Format link Google Drive tidak valid.'])->withInput();
        }

        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar')) {
            if ($research->gambar) {
                Storage::disk('public')->delete($research->gambar); // Hapus gambar lama
            }
            $gambarPath = $request->file('gambar')->store('research', 'public'); // Simpan gambar baru
        } else {
            $gambarPath = $research->gambar; // Tetap gunakan gambar lama jika tidak ada perubahan
        }

        // Update data research
        $research->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul), // Fix typo
            'gambar' => $gambarPath,
            'link' => $fileId,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/admin/research')->with('success', 'Research berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Research $research)
    {
        // Hapus gambar dari storage jika ada
        if ($research->gambar) {
            Storage::disk('public')->delete($research->gambar);
        }

        // Hapus data dari database
        $research->delete();

        return back()->with('success', 'Berhasil dihapus');
    }
}
