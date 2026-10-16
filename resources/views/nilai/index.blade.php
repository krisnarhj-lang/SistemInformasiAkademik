@extends('layouts.main')

@section('title', 'Nilai Akademik Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Nilai Akademik Siswa</h1>
            <p class="text-muted small mb-0">Kelola dan pantau perolehan nilai tugas, UTS, UAS, dan status kelulusan peserta didik.</p>
        </div>
        <a href="{{ route('nilai.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Input Nilai Siswa
        </a>
    </div>

    <!-- Summary Metrics -->
    @if($nilais->isNotEmpty())
        @php
            $totalNilai = $nilais->count();
            $avgAkhir = round($nilais->avg('nilai_akhir'), 2);
            $totalLulus = $nilais->where('keterangan', 'Lulus')->count();
            $totalTidakLulus = $nilais->where('keterangan', 'Tidak Lulus')->count();
        @endphp
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body py-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penilaian</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalNilai }} Data</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body py-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rata-rata Nilai Akhir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $avgAkhir }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body py-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Status Lulus</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLulus }} Siswa</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body py-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Perlu Remedial</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTidakLulus }} Siswa</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-table mr-1"></i> Rekapitulasi Nilai Siswa</h6>
            <span class="badge badge-primary px-2 py-1">{{ $nilais->count() }} Entri Nilai</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="4%" class="text-center">No</th>
                            <th>Nama Siswa</th>
                            <th width="12%">Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th width="10%" class="text-center">Tugas (30%)</th>
                            <th width="10%" class="text-center">UTS (30%)</th>
                            <th width="10%" class="text-center">UAS (40%)</th>
                            <th width="10%" class="text-center">Nilai Akhir</th>
                            <th width="12%" class="text-center">Status</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($nilais as $index => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle font-weight-bold text-gray-900">
                                    <a href="{{ route('siswa.show', $item->siswa_id) }}" class="text-primary text-decoration-none">
                                        {{ $item->siswa->nama ?? '-' }}
                                    </a>
                                    <small class="d-block text-muted">NIS: {{ $item->siswa->nis ?? '-' }}</small>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-secondary px-2 py-1">
                                        {{ $item->siswa->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-800">
                                    {{ $item->mapel->nama_mapel ?? '-' }}
                                    <small class="d-block text-muted">KKM: {{ $item->mapel->kkm ?? 75 }}</small>
                                </td>
                                <td class="text-center align-middle font-weight-bold">{{ $item->nilai_tugas }}</td>
                                <td class="text-center align-middle font-weight-bold">{{ $item->nilai_uts }}</td>
                                <td class="text-center align-middle font-weight-bold">{{ $item->nilai_uas }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-info px-2 py-1" style="font-size: 0.95rem;">
                                        {{ $item->nilai_akhir }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-{{ $item->keterangan == 'Lulus' ? 'success' : 'danger' }} px-2 py-1">
                                        <i class="fas fa-{{ $item->keterangan == 'Lulus' ? 'check-circle' : 'times-circle' }} mr-1"></i>
                                        {{ $item->keterangan }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Nilai">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data nilai {{ $item->siswa->nama ?? '' }} pada mapel {{ $item->mapel->nama_mapel ?? '' }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit" title="Hapus Nilai">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    <i class="fas fa-star fa-3x text-gray-300 mb-3 d-block"></i>
                                    Belum ada data nilai akademik yang ditambahkan.
                                    <div class="mt-2">
                                        <a href="{{ route('nilai.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Input Nilai Siswa Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
