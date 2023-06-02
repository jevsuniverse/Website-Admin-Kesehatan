<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\ResepHasObat;
use App\Models\ResepObat;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class obatcontroller extends Controller
{
    public function index()
    {
        return view('dataObat.Obat');
    }

    public function listObat()
    {
        $data = Obat::all();

        return view('dataObat.listObat', [
            'data' => $data,
        ]);
    }

    public function editObat($id)
    {
        $obat = Obat::findOrfail($id);

        return view('dataObat.editObat', [
            'obat' => $obat,
        ]);
    }

    public function updateObat(Request $request, $id)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
        ]);

        $obat = Obat::findOrfail($id);

        $obat->update([
            'nama_obat' => $data['name'],
            'harga' => $data['price'],
        ]);

        return redirect()->route('obat.list')->with('success_message', 'Update Success!');
    }

    public function deleteObat($id)
    {
        $obat = Obat::findOrfail($id);

        $keyExists = DB::select(
            DB::raw(
                'SELECT * FROM resep_obat WHERE id_obat=' . $obat['id']
            )
        );

        if (count($keyExists) > 0) {
            return redirect()->route('obat.list')->with('error_message', 'Obat ini masih ada dalam Resep Obat!');
        } else {
            $obat->delete();

            return redirect()->route('obat.list')->with('success_message', 'Delete Success!');
        }
    }

    public function storeObat(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
        ]);

        Obat::create([
            'nama_obat' => $data['name'],
            'harga' => $data['price'],
        ]);

        return redirect()->route('obat.list')->with('success_message', 'Success!');
    }

    public function resep()
    {
        $meds = Obat::all();
        $patients = Sesi::all();

        return view('dataObat.resepObat', [
            'meds' => $meds,
            'patients' => $patients,
        ]);
    }

    public function resepList()
    {
        $data = ResepObat::all();

        $obat = ResepHasObat::all();

        // dd($data);
        return view('dataObat.listResepObat', [
            'data' => $data,
            'obat' => $obat,
        ]);
    }

    public function storeResep(Request $request)
    {
        $data = $request->all();
        $meds = $request->input('obat');
        $date = date('Y-m-d H:i:s');

        $request->validate([
            'keterangan' => 'required|max:500'
        ]);

        $resep = ResepObat::create([
            'id_pasien' => $data['pasien'],
            'keterangan_resep' => $data['keterangan'],
        ]);

        foreach ($meds as $obat) {
            DB::insert("
                INSERT INTO resep_has_obat
                (id_resep_obat, id_obat, created_at, updated_at)
                VALUES (?, ?, ?, ?)
            ", [$resep->id, $obat, $date, $date]);
        }

        return redirect()->route('resep.list')->with('success_message', 'Success!');
    }

    public function editResep($id)
    {
        $meds = Obat::all();
        $patients = Sesi::all();

        $resep = ResepObat::findOrFail($id);

        return view('dataObat.editResepObat', [
            'meds' => $meds,
            'patients' => $patients,
            'resep' => $resep,
        ]);
    }

    public function updateResep(Request $request, $id)
    {
        $data = $request->all();
        $meds = $request->input('obat');
        $resep = ResepObat::findOrFail($id);
        $date = date('Y-m-d H:i:s');

        $request->validate([
            'keterangan' => 'required|max:500'
        ]);

        $resep->update([
            'id_pasien' => $data['pasien'],
            'keterangan_resep' => $data['keterangan'],
        ]);

        if ($meds != NULL) {
            DB::delete("
                DELETE FROM resep_has_obat
                WHERE
                id_resep_obat = ?
            ", [$id]);

            foreach ($meds as $obat) {
                DB::insert("
                    INSERT INTO resep_has_obat
                    (id_resep_obat, id_obat, created_at, updated_at)
                    VALUES (?, ?, ?, ?)
                ", [$resep->id, $obat, $date, $date]);
            }
        }

        return redirect()->route('resep.list')->with('success_message', 'Success!');
    }

    public function deleteResep($id)
    {
        $resep = ResepObat::findOrFail($id);

        $keyExists = DB::select(
            DB::raw(
                'SELECT * FROM payment WHERE id_resep_obat=' . $resep['id']
            )
        );

        if (count($keyExists) > 0) {
            return redirect()->route('resep.list')->with('error_message', 'Obat ini masih ada dalam Resep Obat!');
        } else {

            DB::delete("
                DELETE FROM resep_has_obat
                WHERE
                id_resep_obat = ?
            ", [$id]);

            $resep->delete();

            return redirect()->route('resep.list')->with('success_message', 'Delete Success!');
        }
    }
}
