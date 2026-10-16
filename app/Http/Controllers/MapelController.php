<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mapels = Mapel::withCount('nilais')->latest()->get();

        return view('mapel.index', compact('mapels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|numeric|min:0|max:100',
        ]);

        Mapel::create($validated);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel): RedirectResponse
    {
        return redirect()->route('mapel.edit', $mapel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel): View
    {
        return view('mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel): RedirectResponse
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:50|unique:mapels,kode_mapel,'.$mapel->id,
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|numeric|min:0|max:100',
        ]);

        $mapel->update($validated);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel): RedirectResponse
    {
        if ($mapel->nilais()->exists()) {
            return redirect()->route('mapel.index')->with('error', 'Mata pelajaran tidak dapat dihapus karena masih memiliki data nilai siswa terkait.');
        }

        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}
