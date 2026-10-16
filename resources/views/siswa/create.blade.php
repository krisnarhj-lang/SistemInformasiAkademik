@extends('layouts.main')

@section('title', 'Tambah Data Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-plus mr-2 text-primary"></i>Tambah Data Siswa</h1>
            <p class="text-muted small mb-0">Daftarkan peserta didik baru dan tautkan ke rombongan belajar.</p>
        </div>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-graduate mr-1"></i> Form Data Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nis" class="font-weight-bold">Nomor Induk Siswa (NIS) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                    id="nis" name="nis" value="{{ old('nis') }}"
                                    placeholder="Contoh: 2026001" required>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="kelas_id" class="font-weight-bold">Kelas / Rombel <span class="text-danger">*</span></label>
                                <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                                    <option value="" disabled {{ old('kelas_id') ? '' : 'selected' }}>-- Pilih Kelas --</option>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                            {{ $kelas->nama_kelas }} ({{ $kelas->jurusan }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="font-weight-bold">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap siswa" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="custom-control custom-radio custom-control-inline mt-1">
                                    <input type="radio" id="gender_l" name="jenis_kelamin" value="L" class="custom-control-input @error('jenis_kelamin') is-invalid @enderror"
                                        {{ old('jenis_kelamin', 'L') == 'L' ? 'checked' : '' }} required>
                                    <label class="custom-control-label" for="gender_l">
                                        <i class="fas fa-mars text-primary mr-1"></i> Laki-laki
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mt-1">
                                    <input type="radio" id="gender_p" name="jenis_kelamin" value="P" class="custom-control-input @error('jenis_kelamin') is-invalid @enderror"
                                        {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                                    <label class="custom-control-label" for="gender_p">
                                        <i class="fas fa-venus text-danger mr-1"></i> Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="no_hp" class="font-weight-bold">No. WhatsApp / HP</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                    placeholder="Contoh: 081234567890">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Alamat Lengkap Tempat Tinggal</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap domisili siswa">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Data Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-1"></i> Bantuan & Ketentuan</h6>
                    <ul class="small text-muted pl-3 mb-0">
                        <li><strong>NIS</strong> harus bersifat unik dan belum terdaftar di sistem.</li>
                        <li>Pastikan kelas tujuan sudah dibuat terlebih dahulu di menu <strong>Data Kelas</strong>.</li>
                        <li>Data yang tersimpan dapat dihubungkan langsung dengan modul <strong>Nilai Akademik</strong>.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
