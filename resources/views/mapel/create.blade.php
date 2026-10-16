@extends('layouts.main')

@section('title', 'Tambah Data Mata Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Mata Pelajaran</h1>
            <p class="text-muted small mb-0">Tambahkan mata pelajaran baru beserta standar kriteria ketuntasan minimal.</p>
        </div>
        <a href="{{ route('mapel.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-book mr-1"></i> Form Data Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('mapel.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="kode_mapel" class="font-weight-bold">Kode Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_mapel') is-invalid @enderror"
                                id="kode_mapel" name="kode_mapel" value="{{ old('kode_mapel') }}"
                                placeholder="Contoh: MP-PWPB, MP-MTK, MP-BINDO" required>
                            @error('kode_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_mapel" class="font-weight-bold">Nama Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_mapel') is-invalid @enderror"
                                id="nama_mapel" name="nama_mapel" value="{{ old('nama_mapel') }}"
                                placeholder="Contoh: Pemrograman Web dan Perangkat Bergerak" required>
                            @error('nama_mapel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kkm" class="font-weight-bold">Kriteria Ketuntasan Minimal (KKM) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('kkm') is-invalid @enderror"
                                id="kkm" name="kkm" value="{{ old('kkm', 75) }}" min="0" max="100"
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Mata Pelajaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-5">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-1"></i> Panduan Input Mapel</h6>
                    <ul class="small text-muted pl-3 mb-0">
                        <li><strong>Kode Mapel</strong> harus unik untuk mempermudah identifikasi saat rekap nilai.</li>
                        <li><strong>Nilai KKM</strong> akan otomatis digunakan sebagai penentu status <em>Lulus</em> atau <em>Tidak Lulus</em> pada penilaian siswa.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
