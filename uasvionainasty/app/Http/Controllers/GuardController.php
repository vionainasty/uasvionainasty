<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guard;

class GuardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan data guard terbaru di atas
        $guards = Guard::orderBy('created_at', 'desc')->paginate(5);
        $total = Guard::count();
        return view('guards.index', compact('guards', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form tambah guard
        return view('guards.create', [
            'title' => 'Tambah Guard Baru',
            'subtitle' => 'Silakan isi data dengan benar.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input user
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:guards,email'],
        ]);
        // Simpan data guard baru
        $guard = Guard::create($validated);
        // Redirect dengan notifikasi sukses
        return redirect()
            ->route('guards.index')
            ->with('success', 'Guard "' . $guard->name . '" berhasil didaftarkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guard = Guard::findOrFail($id);
        return view('guards.show', compact('guard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guard = Guard::findOrFail($id);
        return view('guards.edit', compact('guard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:guards,email,' . $id,
        ]);
        $guard = Guard::findOrFail($id);
        $guard->update($validated);
        // Logika tambahan: simpan waktu update terakhir
        // $guard->updated_at sudah otomatis oleh Laravel
        return redirect()->route('guards.index')->with('success', 'Data guard berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guard = Guard::findOrFail($id);
        $guard->delete();
        // Logika tambahan: notifikasi penghapusan
        return redirect()->route('guards.index')->with('success', 'Guard telah dihapus dari sistem!');
    }
}
