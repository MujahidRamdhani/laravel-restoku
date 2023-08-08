<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\menu;
use App\Models\pemesanan;
use App\Models\pemesananDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class PemesananController extends Controller
{
    public function Statistics()
    {
        $menuCount = menu::count();
        $pemesananCount = pemesanan::count();
        $pemasukanCount = pemesanan::sum('totalHarga');
        return view('./dashboard/index', ['menu_count' => $menuCount, 'pemesanan_count' => $pemesananCount, 'pemasukan_sum' => $pemasukanCount]);
    }

    public function index()
    {
        $pemesanans = pemesanan::with(['pemesanan_detail' , 'pemesanan_detail.menu'])
        ->where('status', 'diprosses')
        ->get();
        return view('dashboard.pemesanans.index', [
            'pemesanans' => $pemesanans,
        ]);
    }

    public function pesananMasuk()
    {
        $pemesanans = pemesanan::select("*")
        ->where('status', 'pesanan masuk')
        ->get();
        return view('dashboard.pemesananMasuk.index', [
        'pemesanans' => $pemesanans,
]);
    }

    public function pemesananSelesai(Request $request, pemesanan $pemesanan)
    {
        $this->authorize('kasir');
        $status = 'pesanan selesai';
        $pemesanan->where('id', $request->id)->update([
            'status' => $status
        ]);
        return redirect()->back()->with('success', 'Pesanan Telah Selesai');
    }

    public function cetakNota(Request $request, pemesanan $pemesanan)
    {
        $pemesanans = pemesanan::select("*")
        ->where('status', 'pesanan selesai')
        ->get();
        return view('dashboard.cetakNota.index', [
        'pemesanans' => $pemesanans,]);
    }

    public function cetakInvoice(Request $request)
    {
        
        $pemesanan = pemesanan::with(['pemesanan_detail' , 'pemesanan_detail.menu'])
        ->findOrFail($request->id);
        if(request('output') == 'pdf'){
        $pdf = Pdf::loadView('dashboard.cetakNota.invoice_pdf', compact('pemesanan'));
        $namaFile = "Nota" . $pemesanan->kodeTransaksi . '.pdf';
         return $pdf->download($namaFile);
        }
        return view('dashboard.invoicepdf');
    }

    public function destroy(Request $request, pemesanan $pemesanan, $id)
    {
    
        $pemesanan = pemesanan::findOrFail($id);
        $pemesanan->delete();
        return redirect()->to('/dashboard/cetakNota')->with('success', 'Pemesanan has been deleted.');
    }
}
