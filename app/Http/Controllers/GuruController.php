<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $gurus = Guru::latest()->get();

        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:gurus,nip',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Guru::create($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru): RedirectResponse
    {
        return redirect()->route('guru.edit', $guru);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru): View
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:gurus,nip,'.$guru->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru): RedirectResponse
    {
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
