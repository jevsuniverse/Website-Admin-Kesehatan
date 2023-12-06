<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'id',
        'id_resep_obat',
        'id_pasien',
        'tanggal_payment',
        'total_harga',
    ];

    public function resep()
    {
        return $this->belongsTo(ResepObat::class, 'id_resep_obat', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(Sesi::class, 'id_pasien', 'id_pasien');
    }
}
