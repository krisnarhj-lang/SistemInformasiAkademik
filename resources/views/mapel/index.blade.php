@extends('layouts.main')

@section('title', 'Data Mata Pelajaran')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-book mr-2 text-primary"></i>Data Mata Pelajaran</h1>
            <p class="text-muted small mb-0">Kelola daftar kurikulum mata pelajaran dan standar kriteria ketuntasan minimal (KKM).</p>
        </div>
        <a href="{{ route('mapel.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Mata Pelajaran
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-book-open mr-1"></i> Daftar Mata Pelajaran</h6>
            <span class="badge badge-primary px-2 py-1">{{ $mapels->count() }} Total Mapel</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="20%">Kode Mapel</th>
                            <th>Nama Mata Pelajaran</th>
                            <th width="15%" class="text-center">Nilai KKM</th>
                            <th width="15%" class="text-center">Jumlah Nilai Terinput</th>
                            <th width="14%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $index => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle font-weight-bold">
                                    <span class="badge badge-light border text-dark">{{ $item->kode_mapel }}</span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-900">
                                    <i class="fas fa-book-reader text-gray-400 mr-2"></i>{{ $item->nama_mapel }}
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-info px-3 py-1 font-weight-bold" style="font-size: 0.95rem;">
                                        {{ $item->kkm }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-secondary px-2 py-1">
                                        {{ $item->nilais_count }} Entri
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mapel.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Mapel">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('mapel.destroy', $item->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran {{ $item->nama_mapel }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Mapel">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-book fa-3x text-gray-300 mb-3 d-block"></i>
                                    Belum ada data mata pelajaran yang ditambahkan.
                                    <div class="mt-2">
                                        <a href="{{ route('mapel.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Tambah Mapel Pertama
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
