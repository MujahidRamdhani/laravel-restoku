<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\pemesanan;
use App\Models\pemesananDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    public function index()
    {
        $q = request('search');
        if( !empty( $q ) ) {
        $menus = menu::whereHas('category', function($query) use($q) {
            $query->where('name', 'like', '%'.$q.'%');
        })->orWhere('namaMenu','LIKE','%'.$q.'%')->paginate(5);
       } else {
        $menus = menu::latest()->paginate(5);
       }

        return view('welcome', [
            'menus' => $menus
        ]);
        
    }

   
    public function addToCart($id)
    {
        $menu = menu::findOrFail($id);
 
        $cart = session()->get('cart', []);
 
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "menu_id" => $menu->id,
                "namaMenu" => $menu->namaMenu,
                "category_id" => $menu->categori_id,
                "image" => $menu->image,
                "harga" => $menu->harga,
                "quantity" => 1
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }


    public function cart()
    {
        return view('cart');
    }
    

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }


    public function session(Request $request)
    {
    //     $cart = session()->get('cart');
    //    dd($details['menu_id']);
        $now = Carbon::now();
        $thnBulanhari = $now->year . $now->month . $now->day;
        $cek = pemesanan::count();
       
       
        if($cek == 0 ){
            $urut = 100001;
            $nomor = 'KD' . $thnBulanhari .$urut;
        } else{
            $ambil = pemesanan::all()->last();
            $urut = (int)substr($ambil->kodePemesanan, -6) + 1;
            $nomor = 'KD' . $thnBulanhari.$urut;
        }

        $totalHarga = $request->total;
        $pemesanan_id = pemesanan::insertGetId( [
            'kodePemesanan' => $nomor,
            'noMeja' => $request->noMeja,
            'totalHarga' => $totalHarga,
            'created_at' => now(),
        ]);
 
        foreach (session('cart') as $id => $details) {
           
            $menu_id = $details['menu_id'];
            $quantity = $details['quantity'];

            
            pemesananDetail::create([
            'pemesanan_id' => $pemesanan_id,
            'menu_id' => $menu_id,
            'qty' => $quantity,]);
        }
        
        session()->flush();
        return redirect()->to('/')->with('success', 'Pemesanan Berhasil Silahkan Tunggu');
    }




}
