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
        $guards = Guard::all();
        return view('guards.index', compact('guards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:guards,email',
        ]);
        Guard::create($validated);
        return redirect()->route('guards.index')->with('success', 'Guard berhasil ditambahkan!');
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
        return redirect()->route('guards.index')->with('success', 'Guard berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guard = Guard::findOrFail($id);
        $guard->delete();
        return redirect()->route('guards.index')->with('success', 'Guard berhasil dihapus!');
    }
}
