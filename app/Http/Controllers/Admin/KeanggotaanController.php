<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keanggotaan;
use App\Models\Period;
use Illuminate\Http\Request;

class KeanggotaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $period = Period::firstOrCreate([], [
            'periode' => now(),
        ]);

        $keanggotaans = Keanggotaan::get();
        return view('admin.keanggotaan.index', ['keanggotaans' => $keanggotaans, 'periode' => $period]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keanggotaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric',
            'harga_setahun' => 'required|numeric',
            'bulan' => 'required|numeric',
            'url' => 'required|url',
            'title' => 'required|boolean',
        ]);

        Keanggotaan::create($request->all());

        return redirect()->route('keanggotaan.index')->with('success', 'Keanggotaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keanggotaan $keanggotaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keanggotaan $keanggotaan)
    {
        return view('admin.keanggotaan.edit', compact('keanggotaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keanggotaan $keanggotaan)
    {
        $request->validate([
            'harga' => 'required|numeric',
            'harga_setahun' => 'required|numeric',
            'bulan' => 'required|numeric',
            'url' => 'required|url',
            'title' => 'required|boolean',
        ]);

        $keanggotaan->update($request->all());

        return redirect()->route('keanggotaan.index')->with('success', 'Keanggotaan berhasil diperbarui.');
    }


    public function periode(Request $request, Period $period)
    {
        $period->update(['periode' => $request->periode]);

        return back()->with('success', 'Periode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keanggotaan $keanggotaan)
    {
        $keanggotaan->delete();

        return redirect()->route('keanggotaan.index')->with('success', 'Keanggotaan berhasil dihapus.');
    }
}
