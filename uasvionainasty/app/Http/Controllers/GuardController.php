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
        // Ambil data guard berdasarkan id
        $guard = Guard::findOrFail($id);
        // Kirim data guard dan judul ke view
        return view('guards.edit', [
            'guard' => $guard,
            'title' => 'Edit Data Guard',
            'subtitle' => 'Perbarui data guard di bawah ini.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input user
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:guards,email,' . $id],
        ]);
        // Update data guard
        $guard = Guard::findOrFail($id);
        $guard->update($validated);
        // Redirect dengan notifikasi sukses
        return redirect()
            ->route('guards.index')
            ->with('success', 'Data guard "' . $guard->name . '" berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guard = Guard::findOrFail($id);
        $name = $guard->name;
        $guard->delete();
        // Redirect dengan notifikasi sukses
        return redirect()
            ->route('guards.index')
            ->with('success', 'Guard "' . $name . '" telah dihapus dari sistem!');
    }
}
