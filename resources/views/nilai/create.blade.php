@extends('layouts.main')

@section('title', 'Input Nilai Siswa')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus-circle mr-2 text-primary"></i>Input Nilai Siswa</h1>
            <p class="text-muted small mb-0">Masukkan perolehan nilai tugas, UTS, dan UAS siswa untuk mata pelajaran terkait.</p>
        </div>
        <a href="{{ route('nilai.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-star mr-1"></i> Form Penilaian Akademik</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilai.store') }}" method="POST" id="formNilai">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="siswa_id" class="font-weight-bold">Pilih Siswa <span class="text-danger">*</span></label>
                                <select class="form-control @error('siswa_id') is-invalid @enderror" id="siswa_id" name="siswa_id" required>
                                    <option value="" disabled {{ old('siswa_id', request('siswa_id')) ? '' : 'selected' }}>-- Pilih Siswa --</option>
                                    @foreach($siswas as $siswa)
                                        <option value="{{ $siswa->id }}" {{ old('siswa_id', request('siswa_id')) == $siswa->id ? 'selected' : '' }}>
                                            {{ $siswa->nis }} - {{ $siswa->nama }} ({{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mapel_id" class="font-weight-bold">Pilih Mata Pelajaran <span class="text-danger">*</span></label>
                                <select class="form-control @error('mapel_id') is-invalid @enderror" id="mapel_id" name="mapel_id" required>
                                    <option value="" disabled {{ old('mapel_id') ? '' : 'selected' }}>-- Pilih Mata Pelajaran --</option>
                                    @foreach($mapels as $mapel)
                                        <option value="{{ $mapel->id }}" data-kkm="{{ $mapel->kkm }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                            {{ $mapel->nama_mapel }} (KKM: {{ $mapel->kkm }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-3">
                        <h6 class="font-weight-bold text-gray-800 mb-3"><i class="fas fa-calculator mr-1 text-primary"></i> Komponen Penilaian (0 - 100)</h6>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nilai_tugas" class="font-weight-bold">Nilai Tugas (Bobot 30%) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control calc-input @error('nilai_tugas') is-invalid @enderror"
                                    id="nilai_tugas" name="nilai_tugas" value="{{ old('nilai_tugas', 0) }}" required>
                                @error('nilai_tugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nilai_uts" class="font-weight-bold">Nilai UTS (Bobot 30%) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control calc-input @error('nilai_uts') is-invalid @enderror"
                                    id="nilai_uts" name="nilai_uts" value="{{ old('nilai_uts', 0) }}" required>
                                @error('nilai_uts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nilai_uas" class="font-weight-bold">Nilai UAS (Bobot 40%) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control calc-input @error('nilai_uas') is-invalid @enderror"
                                    id="nilai_uas" name="nilai_uas" value="{{ old('nilai_uas', 0) }}" required>
                                @error('nilai_uas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('nilai.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Nilai Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Calculation Preview Card -->
            <div class="card shadow mb-4 border-left-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-chart-pie mr-1"></i> Simulasi Nilai Akhir</h6>
                </div>
                <div class="card-body">
                    <div class="text-center py-2">
                        <small class="text-muted text-uppercase font-weight-bold d-block mb-1">Perkiraan Nilai Akhir</small>
                        <h2 class="font-weight-bold text-gray-800 mb-2" id="preview_nilai_akhir">0.00</h2>
                        <span class="badge badge-secondary p-2 h6 mb-0" id="preview_status">Menunggu Input...</span>
                    </div>

                    <hr>
                    <div class="small text-muted">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Tugas (30%):</span>
                            <span class="font-weight-bold" id="preview_bobot_tugas">0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>UTS (30%):</span>
                            <span class="font-weight-bold" id="preview_bobot_uts">0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>UAS (40%):</span>
                            <span class="font-weight-bold" id="preview_bobot_uas">0.00</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top">
                            <span>Standar KKM Mapel:</span>
                            <span class="font-weight-bold text-info" id="preview_kkm">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 border-left-info">
                <div class="card-body">
                    <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-1"></i> Rumus Perhitungan</h6>
                    <p class="small text-muted mb-0">
                        <code>Nilai Akhir = (Tugas &times; 30%) + (UTS &times; 30%) + (UAS &times; 40%)</code>
                    </p>
                    <p class="small text-muted mt-2 mb-0">
                        Status <strong>Lulus</strong> didapatkan apabila Nilai Akhir &ge; KKM mata pelajaran yang dipilih.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputTugas = document.getElementById('nilai_tugas');
        const inputUts = document.getElementById('nilai_uts');
        const inputUas = document.getElementById('nilai_uas');
        const selectMapel = document.getElementById('mapel_id');

        const previewAkhir = document.getElementById('preview_nilai_akhir');
        const previewStatus = document.getElementById('preview_status');
        const previewBobotTugas = document.getElementById('preview_bobot_tugas');
        const previewBobotUts = document.getElementById('preview_bobot_uts');
        const previewBobotUas = document.getElementById('preview_bobot_uas');
        const previewKkm = document.getElementById('preview_kkm');

        function updateSimulation() {
            const tugas = parseFloat(inputTugas.value) || 0;
            const uts = parseFloat(inputUts.value) || 0;
            const uas = parseFloat(inputUas.value) || 0;

            const bobotTugas = tugas * 0.3;
            const bobotUts = uts * 0.3;
            const bobotUas = uas * 0.4;
            const nilaiAkhir = (bobotTugas + bobotUts + bobotUas).toFixed(2);

            previewBobotTugas.textContent = bobotTugas.toFixed(2);
            previewBobotUts.textContent = bobotUts.toFixed(2);
            previewBobotUas.textContent = bobotUas.toFixed(2);
            previewAkhir.textContent = nilaiAkhir;

            const selectedOption = selectMapel.options[selectMapel.selectedIndex];
            const kkm = selectedOption ? parseFloat(selectedOption.getAttribute('data-kkm')) : null;

            if (kkm !== null && !isNaN(kkm)) {
                previewKkm.textContent = kkm;
                if (parseFloat(nilaiAkhir) >= kkm) {
                    previewStatus.className = 'badge badge-success p-2 h6 mb-0';
                    previewStatus.innerHTML = '<i class="fas fa-check-circle mr-1"></i> LULUS';
                } else {
                    previewStatus.className = 'badge badge-danger p-2 h6 mb-0';
                    previewStatus.innerHTML = '<i class="fas fa-times-circle mr-1"></i> TIDAK LULUS';
                }
            } else {
                previewKkm.textContent = '-';
                previewStatus.className = 'badge badge-secondary p-2 h6 mb-0';
                previewStatus.textContent = 'Pilih Mapel Terlebih Dahulu';
            }
        }

        inputTugas.addEventListener('input', updateSimulation);
        inputUts.addEventListener('input', updateSimulation);
        inputUas.addEventListener('input', updateSimulation);
        selectMapel.addEventListener('change', updateSimulation);

        updateSimulation();
    });
</script>
@endpush
