<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepHasObat extends Model
{
    use HasFactory;

    protected $table = 'resep_has_obat';

    protected $fillable = [
        'id',
        'id_resep_obat',
        'id_obat',
    ];

    public function resep()
    {
        return $this->belongsTo(ResepObat::class, 'id_resep_obat', 'id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }
}
