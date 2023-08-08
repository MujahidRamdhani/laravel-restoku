<?php

namespace App\Http\Controllers;

use App\Models\pemesanan;
use App\Models\pemesananDetail;
use Illuminate\Http\Request;

class KokiController extends Controller
{
    public function pesananMasuk()
    {
        $this->authorize('koki');

        $pemesanans = pemesanan::with(['pemesanan_detail' , 'pemesanan_detail.menu'])
        ->where('status', 'pesanan masuk')
        ->get();
        return view('dashboard.pemesananMasuk.index', [
        'pemesanans' => $pemesanans,
        ]);

        // $this->authorize('koki');
        // $pemesanans = pemesanan::select("*")
        // ->where('status', 'pesanan masuk')
        // ->get();
        // return view('dashboard.pemesananMasuk.index', [
        // 'pemesanans' => $pemesanans,
        // ]);
    }

    public function prosses(Request $request, pemesanan $pemesanan)
    {
        $this->authorize('koki');
        $status = 'diprosses';
        $pemesanan->where('id', $request->id)->update([
            'status' => $status
        ]);

        return redirect()->back()->with('success', 'Pesanan Telah di Terima');
    }

}
