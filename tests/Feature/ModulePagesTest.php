<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModulePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_kelas_crud_and_views(): void
    {
        $this->seed();

        // 1. Index
        $response = $this->get(route('kelas.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Kelas');
        $response->assertSee('XI RPL 1');

        // 2. Create
        $response = $this->get(route('kelas.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Kelas');

        // 3. Store
        $postData = [
            'nama_kelas' => 'X TKJ 1',
            'tingkat' => 'X',
            'jurusan' => 'Teknik Komputer & Jaringan',
            'tahun_ajaran' => '2025/2026',
        ];
        $response = $this->post(route('kelas.store'), $postData);
        $response->assertRedirect(route('kelas.index'));
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'X TKJ 1']);

        $kelas = Kelas::where('nama_kelas', 'X TKJ 1')->first();

        // 4. Edit
        $response = $this->get(route('kelas.edit', $kelas));
        $response->assertStatus(200);
        $response->assertSee('Edit Data Kelas');
        $response->assertSee('X TKJ 1');

        // 5. Update
        $response = $this->put(route('kelas.update', $kelas), [
            'nama_kelas' => 'X TKJ 2',
            'tingkat' => 'X',
            'jurusan' => 'Teknik Komputer & Jaringan',
            'tahun_ajaran' => '2025/2026',
        ]);
        $response->assertRedirect(route('kelas.index'));
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'X TKJ 2']);

        // 6. Destroy
        $response = $this->delete(route('kelas.destroy', $kelas));
        $response->assertRedirect(route('kelas.index'));
        $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);
    }

    public function test_siswa_crud_and_views(): void
    {
        $this->seed();
        $kelas = Kelas::first();

        // 1. Index
        $response = $this->get(route('siswa.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Siswa');
        $response->assertSee('Budi Santoso');

        // 2. Create
        $response = $this->get(route('siswa.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Data Siswa');

        // 3. Store
        $postData = [
            'nis' => '9999001',
            'nama' => 'Test Siswa Baru',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Uji Coba No. 1',
            'no_hp' => '08999999999',
            'kelas_id' => $kelas->id,
        ];
        $response = $this->post(route('siswa.store'), $postData);
        $response->assertRedirect(route('siswa.index'));
        $this->assertDatabaseHas('siswas', ['nis' => '9999001']);

        $siswa = Siswa::where('nis', '9999001')->first();

        // 4. Show
        $response = $this->get(route('siswa.show', $siswa));
        $response->assertStatus(200);
        $response->assertSee('Detail Siswa');
        $response->assertSee('Test Siswa Baru');

        // 5. Edit
        $response = $this->get(route('siswa.edit', $siswa));
        $response->assertStatus(200);
        $response->assertSee('Edit Data Siswa');

        // 6. Update
        $response = $this->put(route('siswa.update', $siswa), [
            'nis' => '9999001',
            'nama' => 'Test Siswa Updated',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jl. Uji Coba No. 2',
            'no_hp' => '08999999998',
            'kelas_id' => $kelas->id,
        ]);
        $response->assertRedirect(route('siswa.index'));
        $this->assertDatabaseHas('siswas', ['nama' => 'Test Siswa Updated']);

        // 7. Destroy
        $response = $this->delete(route('siswa.destroy', $siswa));
        $response->assertRedirect(route('siswa.index'));
        $this->assertDatabaseMissing('siswas', ['id' => $siswa->id]);
    }

    public function test_guru_crud_and_views(): void
    {
        $this->seed();

        // 1. Index
        $response = $this->get(route('guru.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Guru');
        $response->assertSee('Drs. Ahmad Dahlan, M.Pd');

        // 2. Create
        $response = $this->get(route('guru.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Data Guru');

        // 3. Store
        $postData = [
            'nip' => '199512312020011005',
            'nama' => 'Guru Penguji, S.Pd',
            'jenis_kelamin' => 'L',
            'email' => 'penguji@guru.sch.id',
            'no_hp' => '08777777777',
            'alamat' => 'Jl. Pendidikan No. 7',
        ];
        $response = $this->post(route('guru.store'), $postData);
        $response->assertRedirect(route('guru.index'));
        $this->assertDatabaseHas('gurus', ['nip' => '199512312020011005']);

        $guru = Guru::where('nip', '199512312020011005')->first();

        // 4. Edit
        $response = $this->get(route('guru.edit', $guru));
        $response->assertStatus(200);
        $response->assertSee('Edit Data Guru');

        // 5. Update
        $response = $this->put(route('guru.update', $guru), [
            'nip' => '199512312020011005',
            'nama' => 'Guru Penguji Diperbarui, M.Pd',
            'jenis_kelamin' => 'L',
            'email' => 'penguji.update@guru.sch.id',
            'no_hp' => '08777777778',
            'alamat' => 'Jl. Pendidikan No. 8',
        ]);
        $response->assertRedirect(route('guru.index'));
        $this->assertDatabaseHas('gurus', ['nama' => 'Guru Penguji Diperbarui, M.Pd']);

        // 6. Destroy
        $response = $this->delete(route('guru.destroy', $guru));
        $response->assertRedirect(route('guru.index'));
        $this->assertDatabaseMissing('gurus', ['id' => $guru->id]);
    }

    public function test_mapel_crud_and_views(): void
    {
        $this->seed();

        // 1. Index
        $response = $this->get(route('mapel.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Mata Pelajaran');

        // 2. Create
        $response = $this->get(route('mapel.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Mata Pelajaran');

        // 3. Store
        $postData = [
            'kode_mapel' => 'MP-KIMIA',
            'nama_mapel' => 'Kimia Dasar',
            'kkm' => 75,
        ];
        $response = $this->post(route('mapel.store'), $postData);
        $response->assertRedirect(route('mapel.index'));
        $this->assertDatabaseHas('mapels', ['kode_mapel' => 'MP-KIMIA']);

        $mapel = Mapel::where('kode_mapel', 'MP-KIMIA')->first();

        // 4. Edit
        $response = $this->get(route('mapel.edit', $mapel));
        $response->assertStatus(200);
        $response->assertSee('Edit Data Mata Pelajaran');

        // 5. Update
        $response = $this->put(route('mapel.update', $mapel), [
            'kode_mapel' => 'MP-KIMIA-LANJUT',
            'nama_mapel' => 'Kimia Lanjutan',
            'kkm' => 80,
        ]);
        $response->assertRedirect(route('mapel.index'));
        $this->assertDatabaseHas('mapels', ['kode_mapel' => 'MP-KIMIA-LANJUT']);

        // 6. Destroy
        $response = $this->delete(route('mapel.destroy', $mapel));
        $response->assertRedirect(route('mapel.index'));
        $this->assertDatabaseMissing('mapels', ['id' => $mapel->id]);
    }

    public function test_nilai_crud_and_views(): void
    {
        $this->seed();

        $siswa = Siswa::first();
        $mapelBaru = Mapel::create([
            'kode_mapel' => 'MP-FISIKA',
            'nama_mapel' => 'Fisika Terapan',
            'kkm' => 75,
        ]);

        // 1. Index
        $response = $this->get(route('nilai.index'));
        $response->assertStatus(200);
        $response->assertSee('Nilai Akademik Siswa');

        // 2. Create
        $response = $this->get(route('nilai.create'));
        $response->assertStatus(200);
        $response->assertSee('Input Nilai Siswa');

        // 3. Store (Formula calculation: 80*0.3 + 80*0.3 + 90*0.4 = 24 + 24 + 36 = 84)
        $postData = [
            'siswa_id' => $siswa->id,
            'mapel_id' => $mapelBaru->id,
            'nilai_tugas' => 80,
            'nilai_uts' => 80,
            'nilai_uas' => 90,
        ];
        $response = $this->post(route('nilai.store'), $postData);
        $response->assertRedirect(route('nilai.index'));

        $this->assertDatabaseHas('nilais', [
            'siswa_id' => $siswa->id,
            'mapel_id' => $mapelBaru->id,
            'nilai_akhir' => 84.00,
            'keterangan' => 'Lulus',
        ]);

        $nilai = Nilai::where('siswa_id', $siswa->id)->where('mapel_id', $mapelBaru->id)->first();

        // 4. Edit
        $response = $this->get(route('nilai.edit', $nilai));
        $response->assertStatus(200);
        $response->assertSee('Edit Data Nilai Siswa');

        // 5. Update (Formula calculation: 50*0.3 + 50*0.3 + 50*0.4 = 50 -> KKM 75 -> Tidak Lulus)
        $response = $this->put(route('nilai.update', $nilai), [
            'siswa_id' => $siswa->id,
            'mapel_id' => $mapelBaru->id,
            'nilai_tugas' => 50,
            'nilai_uts' => 50,
            'nilai_uas' => 50,
        ]);
        $response->assertRedirect(route('nilai.index'));

        $this->assertDatabaseHas('nilais', [
            'id' => $nilai->id,
            'nilai_akhir' => 50.00,
            'keterangan' => 'Tidak Lulus',
        ]);

        // 6. Destroy
        $response = $this->delete(route('nilai.destroy', $nilai));
        $response->assertRedirect(route('nilai.index'));
        $this->assertDatabaseMissing('nilais', ['id' => $nilai->id]);
    }
}
