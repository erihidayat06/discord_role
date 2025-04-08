<?php

namespace App\Http\Controllers\Super;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $websites = DB::table('websites')
            ->join('users', 'websites.user_id', '=', 'users.id')
            ->select(
                'websites.id',
                'websites.domain as domain',
                'users.name as user_name',
                'users.email',
                'users.no_tlp'
            )
            ->get();


        return view('super_admin.website', compact('websites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')->get();
        return view('super_admin.website.create', compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain' => 'required|string|max:255|unique:websites,domain',
        ]);

        DB::table('websites')->insert([
            'user_id' => $request->user_id,
            'domain' => $request->domain,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('websites.index')->with('success', 'Website berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Website $website)
    {
        $users = DB::table('users')->get(); // Ambil semua user untuk dropdown

        return view('super_admin.website.edit', compact('website', 'users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Website $website)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'domain' => 'required|string|max:255|unique:websites,domain,' . $website->id,
        ]);

        $website->update([
            'user_id' => $request->user_id,
            'domain' => $request->domain,
        ]);

        return redirect()->route('websites.index')->with('success', 'Website berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Website $website)
    {
        $website->delete();
        return redirect()->route('websites.index')->with('success', 'Website berhasil dihapus.');
    }
}
