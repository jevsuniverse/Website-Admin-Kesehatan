<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';

    protected $fillable = [
        'id',
        'nama_dokter',
        'email_dokter',
        'nohp_dokter',
        'alamat_dokter',
    ];
}
