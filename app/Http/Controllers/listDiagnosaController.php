<?php

namespace App\Http\Controllers;

use App\Models\Sesi;

class listDiagnosaController extends Controller
{
    public function index()
    {
        $data = Sesi::all();

        return view('Diagnosa.listDiagnose', [
            'data' => $data,
        ]);
    }
}
