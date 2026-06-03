<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {

            $table->string('no_rkm_medis', 15)->primary();

            $table->string('nm_pasien', 40)->nullable();
            $table->string('no_ktp', 20)->nullable();

            $table->enum('jk', ['L', 'P'])->nullable();

            $table->string('tmp_lahir', 15)->nullable();
            $table->date('tgl_lahir')->nullable();

            $table->string('nm_ibu', 40);

            $table->string('alamat', 200)->nullable();

            $table->enum('gol_darah', [
                'A',
                'B',
                'O',
                'AB',
                '-'
            ])->nullable();

            $table->string('pekerjaan', 60)->nullable();

            $table->enum('stts_nikah', [
                'BELUM MENIKAH',
                'MENIKAH',
                'JANDA',
                'DUDHA',
                'JOMBLO'
            ])->nullable();

            $table->string('agama', 12)->nullable();

            $table->date('tgl_daftar')->nullable();

            $table->string('no_tlp', 40)->nullable();

            $table->string('umur', 30);

            $table->enum('pnd', [
                'TS',
                'TK',
                'SD',
                'SMP',
                'SMA',
                'SLTA/SEDERAJAT',
                'D1',
                'D2',
                'D3',
                'D4',
                'S1',
                'S2',
                'S3',
                '-'
            ]);

            $table->enum('keluarga', [
                'AYAH',
                'IBU',
                'ISTRI',
                'SUAMI',
                'SAUDARA',
                'ANAK',
                'DIRI SENDIRI',
                'LAIN-LAIN'
            ])->nullable();

            $table->string('namakeluarga', 50);

            $table->char('kd_pj', 3);

            $table->string('no_peserta', 25)->nullable();

            $table->integer('kd_kel');
            $table->integer('kd_kec');
            $table->integer('kd_kab');

            $table->string('pekerjaanpj', 35);
            $table->string('alamatpj', 100);
            $table->string('kelurahanpj', 60);
            $table->string('kecamatanpj', 60);
            $table->string('kabupatenpj', 60);

            $table->string('perusahaan_pasien', 8);

            $table->integer('suku_bangsa');
            $table->integer('bahasa_pasien');
            $table->integer('cacat_fisik');

            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('nip', 30);

            $table->integer('kd_prop');

            $table->string('propinsipj', 30);

            // Index
            $table->index('kd_pj');
            $table->index('kd_kec');
            $table->index('kd_kab');
            $table->index('nm_pasien');
            $table->index('alamat');
            $table->index('kd_kel');
            $table->index('no_ktp');
            $table->index('no_peserta');
            $table->index('perusahaan_pasien');
            $table->index('suku_bangsa');
            $table->index('bahasa_pasien');
            $table->index('cacat_fisik');
            $table->index('kd_prop');

            $table->index(
                ['no_rkm_medis', 'nm_pasien'],
                'idx_pasien_rkm_nama'
            );

            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}