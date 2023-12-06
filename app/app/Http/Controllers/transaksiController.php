<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Payment;
use App\Models\ResepHasObat;
use App\Models\ResepObat;
use App\Models\Sesi;
use Illuminate\Http\Request;

class transaksiController extends Controller
{
    public function index()
    {
        $patients = Sesi::all();
        $resep = ResepObat::all();
        $obat = ResepHasObat::all();

        return view('Transaksi.Transaksi', [
            'patients' => $patients,
            'resep' => $resep,
            'obat' => $obat,
        ]);
    }

    public function storeTransaksi(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'date' => 'required|date',
            'total' => 'required|integer',
        ]);

        Payment::create([
            'id_resep_obat' => $data['resep'],
            'id_pasien' => $data['pasien'],
            'tanggal_payment' => $data['date'],
            'total_harga' => $data['total'],
        ]);

        return redirect()->route('list.transaksi')->with('success_message', 'Success!');
    }

    public function datatransaksi()
    {
        $payment = Payment::all();
        $obat = ResepHasObat::all();

        return view('Transaksi.listTransaksi', [
            'payment' => $payment,
            'obat' => $obat,
        ]);
    }

    public function editTransaksi($id)
    {
        $payment = Payment::findOrFail($id);
        $patients = Sesi::all();
        $resep = ResepObat::all();
        $obat = ResepHasObat::all();

        return view('Transaksi.editTransaksi', [
            'patients' => $patients,
            'resep' => $resep,
            'obat' => $obat,
            'payment' => $payment,
        ]);
    }

    public function updateTransaksi(Request $request, $id)
    {
        $data = $request->all();

        $request->validate([
            'date' => 'required|date',
            'total' => 'required|integer',
        ]);

        $transaksi = Payment::findOrFail($id);

        $transaksi->update([
            'id_resep_obat' => $data['resep'],
            'id_pasien' => $data['pasien'],
            'tanggal_payment' => $data['date'],
            'total_harga' => $data['total'],
        ]);

        return redirect()->route('list.transaksi')->with('success_message', 'Success!');
    }

    public function deleteTransaksi($id)
    {
        $transaksi = Payment::findOrFail($id);

        $transaksi->delete();

        return redirect()->route('list.transaksi')->with('success_message', 'Success!');
    }
}
