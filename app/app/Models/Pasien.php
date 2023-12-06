<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'id',
        'nama_pasien',
        'email_pasien',
        'nohp_pasien',
        'alamat_pasien',
    ];
}
