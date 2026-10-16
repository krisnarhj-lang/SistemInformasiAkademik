@extends('layouts.main')

@section('title', 'Detail Data Siswa - ' . $siswa->nama)

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-id-card mr-2 text-primary"></i>Detail Siswa</h1>
            <p class="text-muted small mb-0">Informasi profil lengkap dan riwayat nilai akademik peserta didik.</p>
        </div>
        <div>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary btn-sm shadow-sm mr-2">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali
            </a>
            <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm shadow-sm text-dark font-weight-bold">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit Siswa
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Student Info Card -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 bg-primary text-white text-center">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle mr-1"></i> Profil Peserta Didik</h6>
                </div>
                <div class="card-body text-center pt-4">
                    <div class="mb-3">
                        @if($siswa->jenis_kelamin == 'L')
                            <div class="avatar-circle mx-auto bg-primary text-white d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; font-size: 32px;">
                                <i class="fas fa-male"></i>
                            </div>
                        @else
                            <div class="avatar-circle mx-auto bg-danger text-white d-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; font-size: 32px;">
                                <i class="fas fa-female"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="font-weight-bold text-gray-900 mb-1">{{ $siswa->nama }}</h5>
                    <p class="badge badge-light border text-dark mb-3">NIS: {{ $siswa->nis }}</p>

                    <div class="text-left mt-3">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <th class="text-muted font-weight-normal" width="40%"><i class="fas fa-door-open mr-1 text-primary"></i> Kelas</th>
                                <td class="font-weight-bold">: {{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted font-weight-normal"><i class="fas fa-graduation-cap mr-1 text-info"></i> Jurusan</th>
                                <td>: {{ $siswa->kelas->jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted font-weight-normal"><i class="fas fa-calendar-alt mr-1 text-secondary"></i> Tahun Ajaran</th>
                                <td>: {{ $siswa->kelas->tahun_ajaran ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted font-weight-normal"><i class="fas fa-venus-mars mr-1 text-warning"></i> Kelamin</th>
                                <td>: {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted font-weight-normal"><i class="fas fa-phone mr-1 text-success"></i> No. HP</th>
                                <td>: {{ $siswa->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted font-weight-normal"><i class="fas fa-map-marker-alt mr-1 text-danger"></i> Alamat</th>
                                <td>: {{ $siswa->alamat ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Academic Grades Card -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-star mr-1"></i> Riwayat Nilai Akademik
                    </h6>
                    <a href="{{ route('nilai.create') }}?siswa_id={{ $siswa->id }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Nilai Siswa
                    </a>
                </div>
                <div class="card-body">
                    @if($siswa->nilais->isNotEmpty())
                        @php
                            $avgNilai = round($siswa->nilais->avg('nilai_akhir'), 2);
                            $lulusCount = $siswa->nilais->where('keterangan', 'Lulus')->count();
                            $totalNilai = $siswa->nilais->count();
                        @endphp
                        <div class="row mb-3">
                            <div class="col-sm-6 mb-2">
                                <div class="p-3 bg-light rounded border border-left-primary">
                                    <span class="text-muted small">Rata-rata Nilai Akhir:</span>
                                    <h4 class="font-weight-bold text-primary mb-0">{{ $avgNilai }}</h4>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="p-3 bg-light rounded border border-left-success">
                                    <span class="text-muted small">Kelulusan Mapel:</span>
                                    <h4 class="font-weight-bold text-success mb-0">{{ $lulusCount }} / {{ $totalNilai }} Lulus</h4>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Mata Pelajaran</th>
                                        <th width="10%" class="text-center">KKM</th>
                                        <th width="12%" class="text-center">Tugas (30%)</th>
                                        <th width="12%" class="text-center">UTS (30%)</th>
                                        <th width="12%" class="text-center">UAS (40%)</th>
                                        <th width="14%" class="text-center">Nilai Akhir</th>
                                        <th width="15%" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswa->nilais as $idx => $nilai)
                                        <tr>
                                            <td class="text-center align-middle">{{ $idx + 1 }}</td>
                                            <td class="align-middle font-weight-bold text-gray-800">
                                                {{ $nilai->mapel->nama_mapel ?? '-' }}
                                                <small class="d-block text-muted">Kode: {{ $nilai->mapel->kode_mapel ?? '-' }}</small>
                                            </td>
                                            <td class="text-center align-middle">{{ $nilai->mapel->kkm ?? 75 }}</td>
                                            <td class="text-center align-middle">{{ $nilai->nilai_tugas }}</td>
                                            <td class="text-center align-middle">{{ $nilai->nilai_uts }}</td>
                                            <td class="text-center align-middle">{{ $nilai->nilai_uas }}</td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-info px-2 py-1 h6 mb-0">{{ $nilai->nilai_akhir }}</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-{{ $nilai->keterangan == 'Lulus' ? 'success' : 'danger' }} px-2 py-1">
                                                    <i class="fas fa-{{ $nilai->keterangan == 'Lulus' ? 'check-circle' : 'times-circle' }} mr-1"></i>
                                                    {{ $nilai->keterangan }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-clipboard-list fa-3x text-gray-300 mb-3 d-block"></i>
                            <p class="mb-2">Siswa ini belum memiliki rekaman nilai mata pelajaran.</p>
                            <a href="{{ route('nilai.create') }}?siswa_id={{ $siswa->id }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus mr-1"></i> Input Nilai Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
