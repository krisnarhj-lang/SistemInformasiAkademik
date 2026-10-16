@extends('layouts.main')

@section('title', 'Data Guru')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-chalkboard-teacher mr-2 text-primary"></i>Data Guru</h1>
            <p class="text-muted small mb-0">Kelola informasi data tenaga pendidik dan pengajar sekolah.</p>
        </div>
        <a href="{{ route('guru.create') }}" class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Tambah Guru
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-tie mr-1"></i> Daftar Guru & Tenaga Pendidik</h6>
            <span class="badge badge-primary px-2 py-1">{{ $gurus->count() }} Total Guru</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="16%">NIP</th>
                            <th>Nama Guru</th>
                            <th width="10%" class="text-center">L / P</th>
                            <th width="18%">Email</th>
                            <th width="13%">No. HP</th>
                            <th>Alamat</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gurus as $index => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle font-weight-bold">
                                    <span class="badge badge-light border text-dark">{{ $item->nip }}</span>
                                </td>
                                <td class="align-middle font-weight-bold text-gray-900">
                                    <i class="fas fa-user-circle text-gray-400 mr-1"></i> {{ $item->nama }}
                                </td>
                                <td class="text-center align-middle">
                                    @if($item->jenis_kelamin == 'L')
                                        <span class="badge badge-primary px-2 py-1" title="Laki-laki"><i class="fas fa-mars mr-1"></i> L</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1" title="Perempuan"><i class="fas fa-venus mr-1"></i> P</span>
                                    @endif
                                </td>
                                <td class="align-middle text-gray-700">
                                    @if($item->email)
                                        <a href="mailto:{{ $item->email }}" class="text-muted"><i class="fas fa-envelope mr-1 text-primary"></i>{{ $item->email }}</a>
                                    @else
                                        -
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
                                        <a href="{{ route('guru.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit Guru">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('guru.destroy', $item->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru {{ $item->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Guru">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-chalkboard-teacher fa-3x text-gray-300 mb-3 d-block"></i>
                                    Belum ada data guru yang ditambahkan.
                                    <div class="mt-2">
                                        <a href="{{ route('guru.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus mr-1"></i> Tambah Guru Pertama
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
