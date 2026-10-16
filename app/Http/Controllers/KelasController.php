<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kelasList = Kelas::withCount('siswas')->latest()->get();

        return view('kelas.index', compact('kelasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        Kelas::create($validated);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela): RedirectResponse
    {
        return redirect()->route('kelas.edit', $kela);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela): View
    {
        return view('kelas.edit', ['kelas' => $kela]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        $kela->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela): RedirectResponse
    {
        if ($kela->siswas()->exists()) {
            return redirect()->route('kelas.index')->with('error', 'Kelas tidak dapat dihapus karena masih memiliki data siswa terkait.');
        }

        $kela->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
