<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Sesi;
use Illuminate\Http\Request;

class formDiagnosaController extends Controller
{
    public function index()
    {
        $doctors = Dokter::all();
        $patients = Pasien::all();

        return view('Diagnosa.formDiagnosa', [
            'doctors' => $doctors,
            'patients' => $patients,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'date' => 'required',
            'description' => 'required',
        ]);

        Sesi::create([
            'id_dokter' => $data['dokter'],
            'id_pasien' => $data['pasien'],
            'deskripsi_hasil' => $data['description'],
            'tanggal_sesi' => $data['date'],
            'status_sesi' => 'On Progress',
        ]);

        return redirect()->route('list.sesi')->with('success_message', 'Success!');
    }

    public function editSesi($id) 
    {
        $doctors = Dokter::all();
        $patients = Pasien::all();

        $sesi = Sesi::findOrFail($id);

        return view('Diagnosa.editDiagnosa', [
            'doctors' => $doctors,
            'patients' => $patients,
            'sesi' => $sesi,
        ]);
    }

    public function updateSesi(Request $request, $id)
    {
        $data = $request->all();

        $request->validate([
            'date' => 'required',
            'description' => 'required',
        ]);

        $sesi = Sesi::findOrFail($id);

        $sesi->update([
            'id_dokter' => $data['dokter'],
            'id_pasien' => $data['pasien'],
            'deskripsi_hasil' => $data['description'],
            'tanggal_sesi' => $data['date'],
            'status_sesi' => $data['status'],
        ]);

        return redirect()->route('list.sesi')->with('success_message', 'Update Success!');
    }

    public function deleteSesi($id)
    {
        $sesi = Sesi::findOrFail($id);

        $sesi->delete();

        return redirect()->route('list.sesi')->with('success_message', 'Delete Success!');
    }
}
