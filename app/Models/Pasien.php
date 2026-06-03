<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pasien extends Authenticatable
{
    protected $table = 'pasiens';

    protected $primaryKey = 'no_rkm_medis';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'no_rkm_medis',
        'nm_pasien',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}