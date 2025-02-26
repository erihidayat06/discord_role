<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LanggananController extends Controller
{
    public function index()
    {

        $users = User::latest()->get();
        return view('admin.langganan.index', ['users' => $users]);
    }

    public function updateExpired(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Pastikan 'days' dikirim
        if (!$request->has('days')) {
            return response()->json(['error' => 'Days value is required'], 400);
        }

        // Konversi jumlah hari ke tanggal baru
        $user->expired = Carbon::now()->addDays($request->days);
        $user->save();

        return response()->json([
            'message' => 'Expired updated successfully!',
            'new_expired' => $user->expired
        ]);
    }
}
