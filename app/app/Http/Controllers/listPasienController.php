<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;

class listpasiencontroller extends Controller
{
    public function index()
    {
        $data = Pasien::all();

        return view('DataPasien.listPasien', [
            'data' => $data
        ]);
    }

    public function dokter()
    {
        $data = Dokter::all();

        return view('DataPasien.listDokter', [
            'data' => $data,
        ]);
    }
}
