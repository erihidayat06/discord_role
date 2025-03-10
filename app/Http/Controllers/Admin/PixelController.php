<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pixel;
use Illuminate\Http\Request;

class PixelController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika tidak ada buat baru
        $data = Pixel::first();

        if (!$data) {
            $data = Pixel::create([
                'pixel' => '',
                'token' => null,
            ]);
        }

        return view('admin.pixel.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pixel' => 'required|string|max:255',
            'token' => 'nullable|string|max:255',
        ]);

        $data = Pixel::findOrFail($id);
        $data->update([
            'pixel' => $request->pixel,
            'token' => $request->token,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}
