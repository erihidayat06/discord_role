<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('super_admin.index');
    }

    public function user()
    {
        $users = DB::table('users')
            ->get();


        return view('super_admin.user', compact('users'));
    }

    public function admin()
    {
        $users = DB::table('users')->where('is_admin', "1")
            ->get();


        return view('super_admin.user_admin', compact('users'));
    }



    public function toggleAdmin($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        DB::table('users')->where('id', $id)->update([
            'is_admin' => !$user->is_admin,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Status admin berhasil diubah.');
    }
}
