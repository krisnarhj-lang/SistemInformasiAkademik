@extends('layouts.main')

@section('title', 'Tambah Data Kelas')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Kelas</h1>
            <p class="text-muted small mb-0">Tambahkan data rombongan belajar baru ke dalam sistem.</p>
        </div>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-door-open mr-1"></i> Form Data Kelas</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('kelas.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nama_kelas" class="font-weight-bold">Nama Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                                id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}"
                                placeholder="Contoh: X RPL 1, XI TKJ 2" required>
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tingkat" class="font-weight-bold">Tingkat / Jenjang <span class="text-danger">*</span></label>
                            <select class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" required>
                                <option value="" disabled {{ old('tingkat') ? '' : 'selected' }}>-- Pilih Tingkat --</option>
                                <option value="X" {{ old('tingkat') == 'X' ? 'selected' : '' }}>X (Sepuluh)</option>
                                <option value="XI" {{ old('tingkat') == 'XI' ? 'selected' : '' }}>XI (Sebelas)</option>
                                <option value="XII" {{ old('tingkat') == 'XII' ? 'selected' : '' }}>XII (Dua Belas)</option>
                            </select>
                            @error('tingkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jurusan" class="font-weight-bold">Jurusan / Kompetensi Keahlian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                id="jurusan" name="jurusan" value="{{ old('jurusan') }}"
                                placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                            @error('jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', date('Y') . '/' . (date('Y') + 1)) }}"
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Kelas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-5">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-1"></i> Petunjuk Pengisian</h6>
                    <p class="small text-muted mb-2">Pastikan data kelas yang Anda masukkan sudah sesuai:</p>
                    <ul class="small text-muted pl-3 mb-0">
                        <li><strong>Nama Kelas:</strong> Nama rombel yang jelas dan unik.</li>
                        <li><strong>Tingkat:</strong> Pilih salah satu jenjang (X, XI, atau XII).</li>
                        <li><strong>Jurusan:</strong> Nama program keahlian lengkap.</li>
                        <li><strong>Tahun Ajaran:</strong> Format penulisan contohnya <code>2025/2026</code>.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
