<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pasien::create([
            'no_rkm_medis' => '0000001',
            'nm_pasien' => 'rifqi',
            'nm_ibu' => '-',
            'umur' => '20',
            'pnd' => 'S1',
            'namakeluarga' => '-',
            'kd_pj' => '001',
            'kd_kel' => 1,
            'kd_kec' => 1,
            'kd_kab' => 1,
            'pekerjaanpj' => '-',
            'alamatpj' => '-',
            'kelurahanpj' => '-',
            'kecamatanpj' => '-',
            'kabupatenpj' => '-',
            'perusahaan_pasien' => '00000001',
            'suku_bangsa' => 1,
            'bahasa_pasien' => 1,
            'cacat_fisik' => 1,
            'email' => null,
            'password' => null,
            'nip' => '-',
            'kd_prop' => 1,
            'propinsipj' => '-'
        ]);
    }
}
