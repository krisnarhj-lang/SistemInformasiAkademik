@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-graduate mr-2 text-primary"></i>Data Siswa</h1>
            <p class="text-muted small mb-0">Kelola informasi data induk peserta didik dan relasi rombongan belajar.</p>
        </div>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-user-plus fa-sm text-white-50 mr-1"></i> Tambah Siswa
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users mr-1"></i> Daftar Peserta Didik</h6>
            <span class="badge badge-primary px-2 py-1">{{ $siswas->count() }} Total Siswa</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="12%">NIS</th>
                            <th>Nama Siswa</th>
                            <th width="14%">Kelas</th>
                            <th width="10%" class="text-center">L / P</th>
                            <th width="13%">No. HP</th>
                            <th>Alamat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $index => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle font-weight-bold">
                                    <span class="badge badge-light border text-dark">{{ $item->nis }}</span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-900">
                                    <a href="{{ route('siswa.show', $item->id) }}" class="text-primary text-decoration-none">
                                        {{ $item->nama }}
                                    </a>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-secondary px-2 py-1">
                                        <i class="fas fa-door-open mr-1"></i>{{ $item->kelas->nama_kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    @if($item->jenis_kelamin == 'L')
                                        <span class="badge badge-primary px-2 py-1" title="Laki-laki"><i class="fas fa-mars mr-1"></i> L</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1" title="Perempuan"><i class="fas fa-venus mr-1"></i> P</span>
                                    @endif
                                </td>
                                <td class="align-middle text-gray-700">
                                    {{ $item->no_hp ?? '-' }}
                                </td>
                                <td class="align-middle small text-gray-600">
                                    {{ Str::limit($item->alamat ?? '-', 40) }}
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('siswa.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail Siswa & Nilai">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ $item->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Siswa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-graduate fa-3x text-gray-300 mb-3 d-block"></i>
                                    Belum ada data siswa yang ditambahkan.
                                    <div class="mt-2">
                                        <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Tambah Siswa Pertama
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
