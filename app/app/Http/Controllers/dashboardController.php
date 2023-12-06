<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Sesi;

class DashboardController extends Controller
{
    public function index()
    {
        $pasien = Pasien::get()->count();

        $done = Sesi::where('status_sesi', 'Approved')->get()->count();

        $pending = Sesi::where('status_sesi', 'Pending')->get()->count();

        $sesi = Sesi::get()->count();

        if ($sesi == 0) {
            $proses = 0;
        } else {
            $proses = ($done / $sesi) * 100;
        }

        $data = Sesi::all();

        return view('Dashboard.Dashboard', [
            'pasien_count' => $pasien,
            'proses_count' => $proses,
            'done_count' => $done,
            'pending_count' => $pending,
            'data' => $data,
        ]);
    }
}
