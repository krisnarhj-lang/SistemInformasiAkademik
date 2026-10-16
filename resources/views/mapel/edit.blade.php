@extends('layouts.main')

@section('title', 'Edit Data Mata Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit mr-2 text-warning"></i>Edit Data Mata Pelajaran</h1>
            <p class="text-muted small mb-0">Perbarui data kurikulum mata pelajaran <strong>{{ $mapel->nama_mapel }}</strong>.</p>
        </div>
        <a href="{{ route('mapel.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning text-white">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-book mr-1"></i> Form Edit Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="kode_mapel" class="font-weight-bold">Kode Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_mapel') is-invalid @enderror"
                                id="kode_mapel" name="kode_mapel" value="{{ old('kode_mapel', $mapel->kode_mapel) }}"
                                placeholder="Contoh: MP-PWPB" required>
                            @error('kode_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_mapel" class="font-weight-bold">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_mapel') is-invalid @enderror"
                                id="nama_mapel" name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                                placeholder="Contoh: Pemrograman Web dan Perangkat Bergerak" required>
                            @error('nama_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kkm" class="font-weight-bold">Kriteria Ketuntasan Minimal (KKM) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('kkm') is-invalid @enderror"
                                id="kkm" name="kkm" value="{{ old('kkm', $mapel->kkm) }}" min="0" max="100"
                                placeholder="75" required>
                            <small class="form-text text-muted">Standar nilai kelulusan siswa (skala 0 - 100).</small>
                            @error('kkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('mapel.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-dark font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Perbarui Mata Pelajaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-5">
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-body">
                    <h6 class="font-weight-bold text-gray-800"><i class="fas fa-info-circle mr-1 text-warning"></i> Info Mapel</h6>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            ID Mapel:
                            <span class="font-weight-bold">#{{ $mapel->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Entri Nilai Terhubung:
                            <span class="badge badge-primary badge-pill">{{ $mapel->nilais()->count() }} Siswa</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Terakhir Diubah:
                            <span class="text-muted">{{ $mapel->updated_at ? $mapel->updated_at->format('d/m/Y H:i') : '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
