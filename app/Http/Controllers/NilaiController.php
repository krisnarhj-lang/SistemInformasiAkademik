<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->latest()->get();

        return view('nilai.index', compact('nilais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        $exists = Nilai::where('siswa_id', $validated['siswa_id'])
            ->where('mapel_id', $validated['mapel_id'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nilai untuk siswa dan mata pelajaran yang dipilih sudah ada. Silakan edit data tersebut.');
        }

        $mapel = Mapel::findOrFail($validated['mapel_id']);
        $nilaiAkhir = round(($validated['nilai_tugas'] * 0.3) + ($validated['nilai_uts'] * 0.3) + ($validated['nilai_uas'] * 0.4), 2);
        $keterangan = $nilaiAkhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        Nilai::create([
            'siswa_id' => $validated['siswa_id'],
            'mapel_id' => $validated['mapel_id'],
            'nilai_tugas' => $validated['nilai_tugas'],
            'nilai_uts' => $validated['nilai_uts'],
            'nilai_uas' => $validated['nilai_uas'],
            'nilai_akhir' => $nilaiAkhir,
            'keterangan' => $keterangan,
        ]);

        return redirect()->route('nilai.index')->with('success', 'Data nilai siswa berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai): RedirectResponse
    {
        return redirect()->route('nilai.edit', $nilai);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai): View
    {
        $siswas = Siswa::with('kelas')->orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ]);

        $exists = Nilai::where('siswa_id', $validated['siswa_id'])
            ->where('mapel_id', $validated['mapel_id'])
            ->where('id', '!=', $nilai->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nilai untuk siswa dan mata pelajaran yang dipilih sudah ada pada entri lain.');
        }

        $mapel = Mapel::findOrFail($validated['mapel_id']);
        $nilaiAkhir = round(($validated['nilai_tugas'] * 0.3) + ($validated['nilai_uts'] * 0.3) + ($validated['nilai_uas'] * 0.4), 2);
        $keterangan = $nilaiAkhir >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        $nilai->update([
            'siswa_id' => $validated['siswa_id'],
            'mapel_id' => $validated['mapel_id'],
            'nilai_tugas' => $validated['nilai_tugas'],
            'nilai_uts' => $validated['nilai_uts'],
            'nilai_uas' => $validated['nilai_uas'],
            'nilai_akhir' => $nilaiAkhir,
            'keterangan' => $keterangan,
        ]);

        return redirect()->route('nilai.index')->with('success', 'Data nilai siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai siswa berhasil dihapus.');
    }
}
