<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Master_order_k;
use App\Master_order_t;
use App\Master_nota_luring;
use DB;

class CheckoutController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function storekredit(Request $request)
    {
        $kps = DB::select("SELECT Tabel_bantuans.id, Tabel_bantuans.name, Tabel_bantuans.unit_masuk, Tabel_bantuans.keluar_tunai, Tabel_bantuans.keluar_luring, Tabel_bantuans.keluar_kredit, Tabel_bantuans.saldo FROM 
                            (SELECT Products.id, Products.name, ifnull(satus.unit_masuk, 0) AS unit_masuk, ifnull(duas.qty, 0) AS keluar_tunai, ifnull(tigas.unit, 0) AS keluar_luring, ifnull(empats.qty, 0) AS keluar_kredit, 
                            (satus.unit_masuk - duas.qty - tigas.unit - empats.qty) AS saldo FROM Products
                                LEFT JOIN (SELECT Detail_persediaans.product_id, SUM(unit_masuk) AS unit_masuk FROM Detail_persediaans GROUP BY product_id) satus
                                ON Products.id = satus.product_id
                                LEFT JOIN (SELECT Detail_order_tunais.product_id, SUM(qty) AS qty FROM Detail_order_tunais GROUP BY product_id) duas
                                ON products.id = duas.product_id
                                LEFT JOIN (SELECT Detail_nota_lurings.product_id, SUM(unit) AS unit FROM Detail_nota_lurings GROUP BY product_id) tigas
                                ON products.id = tigas.product_id
                                LEFT JOIN (SELECT Detail_order_ks.product_id, SUM(qty) AS qty FROM Detail_order_ks
                                    INNER JOIN Master_order_ks ON Detail_order_ks.master_order_k_id = master_order_ks.id
                                    INNER JOIN Order_kredit_disetujuis ON Master_order_ks.id = Order_kredit_disetujuis.master_order_k_id
                                    WHERE Order_kredit_disetujuis.id != 0 GROUP BY product_id) empats
                                ON products.id = empats.product_id) AS Tabel_bantuans
                        ");
        // dd($kps);
                            

        //////////////////////////////////////////////////

        $request->validate([
            'alamat_terima' => 'required',
            'metode_bayar_id' => 'required'
        ]);

        $carts = Cart::where('user_id', Auth::user()->id);

        $cartUser = $carts->get();


        foreach ($cartUser as $cart) {
            $idakandicek = $cart->product_id;
            $kolom = array_column($kps, 'id');
            $hasil_cari = array_search($idakandicek, $kolom); 
                if($kps[$hasil_cari]->saldo < $cart->qty) {
                    return redirect('/cart')->with('error', 'Jumlah Barang/Produk yang anda butuhkan melebihi jumlah barang/produk yang tersedia, Silahkan cek jumlah barang tersedia di halaman sebelumnya!');
                }
        }


        $transaction = Master_order_k::create([
            'user_id' => Auth::user()->id,
            'alamat_terima' => $request->alamat_terima,
            'metode_bayar_id' => $request->metode_bayar_id
        ]);

        foreach ($cartUser as $cart) {
            $transaction->detail()->create([
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'harga' => $cart->product->price
            ]);
        }

        $carts->delete();
        return redirect('/cart');
    }

    public function storetunai(Request $request)
    {
        $kps = DB::select("SELECT Tabel_bantuans.id, Tabel_bantuans.name, Tabel_bantuans.unit_masuk, Tabel_bantuans.keluar_tunai, Tabel_bantuans.keluar_luring, Tabel_bantuans.keluar_kredit, Tabel_bantuans.saldo FROM 
                            (SELECT Products.id, Products.name, ifnull(satus.unit_masuk, 0) AS unit_masuk, ifnull(duas.qty, 0) AS keluar_tunai, ifnull(tigas.unit, 0) AS keluar_luring, ifnull(empats.qty, 0) AS keluar_kredit, 
                            (satus.unit_masuk - duas.qty - tigas.unit - empats.qty) AS saldo FROM Products
                                LEFT JOIN (SELECT Detail_persediaans.product_id, SUM(unit_masuk) AS unit_masuk FROM Detail_persediaans GROUP BY product_id) satus
                                ON Products.id = satus.product_id
                                LEFT JOIN (SELECT Detail_order_tunais.product_id, SUM(qty) AS qty FROM Detail_order_tunais GROUP BY product_id) duas
                                ON products.id = duas.product_id
                                LEFT JOIN (SELECT Detail_nota_lurings.product_id, SUM(unit) AS unit FROM Detail_nota_lurings GROUP BY product_id) tigas
                                ON products.id = tigas.product_id
                                LEFT JOIN (SELECT Detail_order_ks.product_id, SUM(qty) AS qty FROM Detail_order_ks
                                    INNER JOIN Master_order_ks ON Detail_order_ks.master_order_k_id = master_order_ks.id
                                    INNER JOIN Order_kredit_disetujuis ON Master_order_ks.id = Order_kredit_disetujuis.master_order_k_id
                                    WHERE Order_kredit_disetujuis.id != 0 GROUP BY product_id) empats
                                ON products.id = empats.product_id) AS Tabel_bantuans
                        ");

        $request->validate([
            'alamat_terima' => 'required',
            'metode_bayar_id' => 'required'
        ]);

        $token = $this->generate_token();

        $carts = Cart::where('user_id', Auth::user()->id);

        $cartUser = $carts->get();

        foreach ($cartUser as $cart) {
            $idakandicek = $cart->product_id;
            $kolom = array_column($kps, 'id');
            $hasil_cari = array_search($idakandicek, $kolom); 
                if($kps[$hasil_cari]->saldo < $cart->qty) {
                    return redirect('/cart')->with('error', 'Jumlah Barang/Produk yang anda butuhkan melebihi jumlah barang/produk yang tersedia, Silahkan cek jumlah barang tersedia di halaman sebelumnya!');
                }
        }

        $transaction = Master_order_t::create([
            'user_id' => Auth::user()->id,
            'alamat_terima' => $request->alamat_terima,
            'metode_bayar_id' => $request->metode_bayar_id,
            'token' => $token
        ]);

        foreach ($cartUser as $cart) {
            $transaction->detail()->create([
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'harga' => $cart->product->price
            ]);
        }

        $carts->delete();
        return redirect('/cart');
    }

    public function storeluring(Request $request)
    {
        $kps = DB::select("SELECT Tabel_bantuans.id, Tabel_bantuans.name, Tabel_bantuans.unit_masuk, Tabel_bantuans.keluar_tunai, Tabel_bantuans.keluar_luring, Tabel_bantuans.keluar_kredit, Tabel_bantuans.saldo FROM 
                            (SELECT Products.id, Products.name, ifnull(satus.unit_masuk, 0) AS unit_masuk, ifnull(duas.qty, 0) AS keluar_tunai, ifnull(tigas.unit, 0) AS keluar_luring, ifnull(empats.qty, 0) AS keluar_kredit, 
                            (satus.unit_masuk - duas.qty - tigas.unit - empats.qty) AS saldo FROM Products
                                LEFT JOIN (SELECT Detail_persediaans.product_id, SUM(unit_masuk) AS unit_masuk FROM Detail_persediaans GROUP BY product_id) satus
                                ON Products.id = satus.product_id
                                LEFT JOIN (SELECT Detail_order_tunais.product_id, SUM(qty) AS qty FROM Detail_order_tunais GROUP BY product_id) duas
                                ON products.id = duas.product_id
                                LEFT JOIN (SELECT Detail_nota_lurings.product_id, SUM(unit) AS unit FROM Detail_nota_lurings GROUP BY product_id) tigas
                                ON products.id = tigas.product_id
                                LEFT JOIN (SELECT Detail_order_ks.product_id, SUM(qty) AS qty FROM Detail_order_ks
                                    INNER JOIN Master_order_ks ON Detail_order_ks.master_order_k_id = master_order_ks.id
                                    INNER JOIN Order_kredit_disetujuis ON Master_order_ks.id = Order_kredit_disetujuis.master_order_k_id
                                    WHERE Order_kredit_disetujuis.id != 0 GROUP BY product_id) empats
                                ON products.id = empats.product_id) AS Tabel_bantuans
                        ");

        $carts = Cart::where('user_id', Auth::user()->id);

        $cartUser = $carts->get();

        foreach ($cartUser as $cart) {
            $idakandicek = $cart->product_id;
            $kolom = array_column($kps, 'id');
            $hasil_cari = array_search($idakandicek, $kolom); 
                if($kps[$hasil_cari]->saldo < $cart->qty) {
                    return redirect('/cart')->with('error', 'Jumlah Barang/Produk yang anda butuhkan melebihi jumlah barang/produk yang tersedia, Silahkan cek jumlah barang tersedia di halaman sebelumnya!');
                }
        }

        $transaction = Master_nota_luring::create([
            'user_id' => Auth::user()->id,
            'ket' => $request->ket
        ]);
        foreach ($cartUser as $cart) {
            $transaction->detail()->create([
                'product_id' => $cart->product_id,
                'unit' => $cart->qty,
                'harga' => $cart->product->price
            ]);
        }
        $carts->delete();
        return redirect ('/cart');
    }

    public function generate_token()
    {
        $characters = '1234567890abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString= '';
        for ($i = 1; $i<=6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
