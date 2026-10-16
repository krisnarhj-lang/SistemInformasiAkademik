@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit mr-2 text-warning"></i>Edit Data Kelas</h1>
            <p class="text-muted small mb-0">Perbarui data rombongan belajar <strong>{{ $kelas->nama_kelas }}</strong>.</p>
        </div>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning text-white">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-edit mr-1"></i> Form Edit Kelas</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_kelas" class="font-weight-bold">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                                id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}"
                                placeholder="Contoh: X RPL 1, XI TKJ 2" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tingkat" class="font-weight-bold">Tingkat / Jenjang <span class="text-danger">*</span></label>
                            <select class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                                <option value="X" {{ old('tingkat', $kelas->tingkat) == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                                <option value="XI" {{ old('tingkat', $kelas->tingkat) == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                                <option value="XII" {{ old('tingkat', $kelas->tingkat) == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                            </select>
                            @error('tingkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jurusan" class="font-weight-bold">Jurusan / Kompetensi Keahlian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                id="jurusan" name="jurusan" value="{{ old('jurusan', $kelas->jurusan) }}"
                                placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $kelas->tahun_ajaran) }}"
                                placeholder="Contoh: 2025/2026" required>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('kelas.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-dark font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Perbarui Kelas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-5">
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-body">
                    <h6 class="font-weight-bold text-gray-800"><i class="fas fa-info-circle mr-1 text-warning"></i> Info Rombel Saat Ini</h6>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            ID Kelas:
                            <span class="font-weight-bold">#{{ $kelas->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Jumlah Siswa:
                            <span class="badge badge-primary badge-pill">{{ $kelas->siswas()->count() }} Siswa</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Terakhir Diperbarui:
                            <span class="text-muted">{{ $kelas->updated_at ? $kelas->updated_at->format('d/m/Y H:i') : '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
