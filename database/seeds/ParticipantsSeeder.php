<?php

use App\Participants;
use Illuminate\Database\Seeder;

class ParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participants::insert([
            [
                'participant_id' => 'P00001',
                'event_id' => 1,
                'name' => 'Dr. Hartono.Azas.L, SE.,MBA',
                'jabatan' => 'Ketua',
                'no_hp' => '08123123123',
                'instansi' => 'ABP PTSI Kalimantan Barat',
                'alamat_instansi' => 'Kota Pontianak',
                'tanggal_kedatangan' => '2023-08-30',
                'penginapan' => 'Grand City Hall Hotel',
                'tanggal_kembali' => '2023-09-02',
                'qr_code' => Str::random(10),
                'created_at' => '2023-07-30 11:41:32'
            ],
            [
                'participant_id' => 'P00002',
                'event_id' => 1,
                'name' => 'Dr. Drs. Chandra Setiawan, M.M., Ph.D.',
                'jabatan' => 'ketua pengawas YPUP Yayasan Pendidikan Universitas Presiden dan Dosen',
                'no_hp' => '0816970795',
                'instansi' => 'President University',
                'alamat_instansi' => 'Jababeka Education Park, Jl. Ki Hajar Dewantara, RT.2/RW.4, Mekarmukti, Cikarang Utara, Bekasi Regency, West Java 17530',
                'tanggal_kedatangan' => '2023-08-02',
                'penginapan' => 'Grand City Hall Hotel',
                'tanggal_kembali' => '2023-09-02',
                'qr_code' => Str::random(10),
                'created_at' => '2023-08-01 11:43:00'
            ],
        ]);
    }
}
