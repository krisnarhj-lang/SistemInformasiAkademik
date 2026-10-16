@extends('layouts.main')

@section('title', 'Edit Data Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-edit mr-2 text-warning"></i>Edit Data Siswa</h1>
            <p class="text-muted small mb-0">Perbarui profil dan data akademik siswa <strong>{{ $siswa->nama }}</strong>.</p>
        </div>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning text-white">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-edit mr-1"></i> Form Edit Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nis" class="font-weight-bold">Nomor Induk Siswa (NIS) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nis') is-invalid @enderror"
                                    id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}"
                                    placeholder="Contoh: 2026001" required>
                                @error('nis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="kelas_id" class="font-weight-bold">Kelas / Rombel <span class="text-danger">*</span></label>
                                <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                                    @foreach($kelasList as $kelas)
                                        <option value="{{ $kelas->id }}" {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>
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
                                id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}"
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
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                                    <label class="custom-control-label" for="gender_l">
                                        <i class="fas fa-mars text-primary mr-1"></i> Laki-laki
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline mt-1">
                                    <input type="radio" id="gender_p" name="jenis_kelamin" value="P" class="custom-control-input @error('jenis_kelamin') is-invalid @enderror"
                                        {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
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
                                    id="no_hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}"
                                    placeholder="Contoh: 081234567890">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Alamat Lengkap Tempat Tinggal</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan alamat lengkap tempat tinggal">{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('siswa.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-dark font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Perbarui Data Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-body">
                    <h6 class="font-weight-bold text-gray-800"><i class="fas fa-id-card mr-1 text-warning"></i> Ringkasan Siswa</h6>
                    <div class="text-center my-3">
                        <i class="fas fa-user-circle fa-4x text-gray-300"></i>
                        <h6 class="font-weight-bold mt-2 mb-0">{{ $siswa->nama }}</h6>
                        <span class="badge badge-primary">{{ $siswa->nis }}</span>
                    </div>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Kelas Saat Ini:
                            <span class="font-weight-bold">{{ $siswa->kelas->nama_kelas ?? '-' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Jumlah Entri Nilai:
                            <span class="badge badge-info">{{ $siswa->nilais()->count() }} Mata Pelajaran</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
