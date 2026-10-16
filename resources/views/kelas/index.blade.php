@extends('layouts.main')

@section('title', 'Data Kelas')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Data Kelas</h1>
            <p class="text-muted small mb-0">Kelola informasi rombongan belajar, jurusan, dan tahun ajaran.</p>
        </div>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Kelas
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list mr-1"></i> Daftar Rombongan Belajar</h6>
            <span class="badge badge-primary px-2 py-1">{{ $kelasList->count() }} Total Kelas</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>Nama Kelas</th>
                            <th width="12%" class="text-center">Tingkat</th>
                            <th>Jurusan</th>
                            <th width="15%" class="text-center">Tahun Ajaran</th>
                            <th width="15%" class="text-center">Jumlah Siswa</th>
                            <th width="14%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelasList as $index => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle font-weight-bold text-gray-800">
                                    <i class="fas fa-graduation-cap text-gray-400 mr-2"></i>{{ $item->nama_kelas }}
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-info px-2 py-1">Tingkat {{ $item->tingkat }}</span>
                                </td>
                                <td class="align-middle text-gray-700">{{ $item->jurusan }}</td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-light border text-dark">{{ $item->tahun_ajaran }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-success px-2 py-1">
                                        <i class="fas fa-users mr-1"></i> {{ $item->siswas_count }} Siswa
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $item->nama_kelas }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3 d-block"></i>
                                    Belum ada data kelas yang ditambahkan.
                                    <div class="mt-2">
                                        <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Tambah Kelas Pertama
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
