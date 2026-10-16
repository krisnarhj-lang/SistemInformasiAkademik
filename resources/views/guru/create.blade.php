@extends('layouts.main')

@section('title', 'Tambah Data Guru')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Data Guru</h1>
            <p class="text-muted small mb-0">Daftarkan tenaga pendidik baru ke dalam sistem informasi.</p>
        </div>
        <a href="{{ route('guru.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-chalkboard-teacher mr-1"></i> Form Data Guru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nip" class="font-weight-bold">Nomor Induk Pegawai (NIP) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                    id="nip" name="nip" value="{{ old('nip') }}"
                                    placeholder="Contoh: 198501152010011001" required>
                                @error('nip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="nama" class="font-weight-bold">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Contoh: Drs. Ahmad Dahlan, M.Pd" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
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

                            <div class="form-group col-md-4">
                                <label for="email" class="font-weight-bold">Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="guru@sekolah.sch.id">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
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
                                placeholder="Masukkan alamat lengkap tempat tinggal guru">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('guru.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Data Guru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-1"></i> Ketentuan Data Guru</h6>
                    <ul class="small text-muted pl-3 mb-0">
                        <li><strong>NIP</strong> harus unik dan tidak boleh ganda dengan data pendidik lain.</li>
                        <li>Gunakan format nama lengkap beserta gelar akademik formal.</li>
                        <li>Email dapat digunakan sebagai saluran notifikasi atau kontak dinas.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
