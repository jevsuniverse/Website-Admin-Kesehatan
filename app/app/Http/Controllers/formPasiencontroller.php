<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class formpasiencontroller extends Controller
{
    public function index()
    {
        return view('DataPasien.formPasien');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($data['type'] == "Dokter") {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|unique:dokter,email_dokter',
                'nohp' => 'required',
                'alamat' => 'required|max:200',
            ]);

            Dokter::create([
                'nama_dokter' => $data['name'],
                'email_dokter' => $data['email'],
                'nohp_dokter' => $data['nohp'],
                'alamat_dokter' => $data['alamat'],
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|unique:pasien,email_pasien',
                'nohp' => 'required',
                'alamat' => 'required|max:200',
            ]);

            Pasien::create([
                'nama_pasien' => $data['name'],
                'email_pasien' => $data['email'],
                'nohp_pasien' => $data['nohp'],
                'alamat_pasien' => $data['alamat'],
            ]);
        }

        return redirect()->route('list.pasien')->with('success_message', 'Success!');
    }

    public function editPasien($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('DataPasien.editPasien', [
            'pasien' => $pasien,
        ]);
    }

    public function updatePasien(Request $request, $id)
    {
        $data = $request->all();
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:pasien,email_pasien,' . $pasien->id,
            'nohp' => 'required',
            'alamat' => 'required|max:200',
        ]);

        $pasien->update([
            'nama_pasien' => $data['name'],
            'email_pasien' => $data['email'],
            'nohp_pasien' => $data['nohp'],
            'alamat_pasien' => $data['alamat'],
        ]);

        return redirect()->route('list.pasien')->with('success_message', 'Update Success!');
    }

    public function deletePasien($id)
    {
        $pasien = Pasien::findOrFail($id);

        $keyExists = DB::select(
            DB::raw(
                'SELECT * FROM sesi WHERE id_pasien='.$pasien['id']
            )
        );

        if (count($keyExists) > 0) {
            return redirect()->route('list.pasien')->with('error_message', 'Pasien ini masih ada dalam sesi!');
        } else {
            $pasien->delete();

            return redirect()->route('list.pasien')->with('success_message', 'Delete Success!');
        }
    }

    public function editDokter($id)
    {
        $dokter = Dokter::findOrFail($id);

        return view('DataPasien.editDokter', [
            'dokter' => $dokter,
        ]);
    }

    public function updateDokter(Request $request, $id)
    {
        $data = $request->all();
        $dokter = Dokter::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:dokter,email_dokter,' . $dokter->id,
            'nohp' => 'required',
            'alamat' => 'required|max:200',
        ]);

        $dokter->update([
            'nama_dokter' => $data['name'],
            'email_dokter' => $data['email'],
            'nohp_dokter' => $data['nohp'],
            'alamat_dokter' => $data['alamat'],
        ]);

        return redirect()->route('list.dokter')->with('success_message', 'Update Success!');
    }

    public function deleteDokter($id)
    {
        $dokter = Dokter::findOrFail($id);

        $keyExists = DB::select(
            DB::raw(
                'SELECT * FROM sesi WHERE id_dokter='.$dokter['id']
            )
        );

        if (count($keyExists) > 0) {
            return redirect()->route('list.dokter')->with('error_message', 'Dokter ini masih ada dalam sesi!');
        } else {
            $dokter->delete();

            return redirect()->route('list.dokter')->with('success_message', 'Delete Success!');
        }
    }
}
