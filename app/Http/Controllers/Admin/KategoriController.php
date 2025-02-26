<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::orderBy('order', 'asc')->get();

        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nm_kategori' => 'required'
        ]);

        Kategori::create($validate);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', ['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validate = $request->validate([
            'nm_kategori' => 'required'
        ]);

        Kategori::where('id', $kategori->id)->update($validate);

        return redirect('/kategori')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }


    public function moveUp($id)
    {
        $kategori = Kategori::findOrFail($id);
        $previous = Kategori::where('order', '<', $kategori->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($previous) {
            $tempOrder = $kategori->order;
            $kategori->update(['order' => $previous->order]);
            $previous->update(['order' => $tempOrder]);
        }

        return response()->json(['success' => true]);
    }

    public function moveDown($id)
    {
        $kategori = Kategori::findOrFail($id);
        $next = Kategori::where('order', '>', $kategori->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($next) {
            $tempOrder = $kategori->order;
            $kategori->update(['order' => $next->order]);
            $next->update(['order' => $tempOrder]);
        }

        return response()->json(['success' => true]);
    }
}
