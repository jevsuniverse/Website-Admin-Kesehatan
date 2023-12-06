<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    protected $table = 'resep_obat';

    protected $fillable = [
        'id',
        'id_obat',
        'id_pasien',
        'keterangan_resep',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(Sesi::class, 'id_pasien', 'id');
    }
}
