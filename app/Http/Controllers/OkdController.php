<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_kredit_disetujui;
use App\Master_order_k;
use App\Detail_order_k;
use App\Ekspedisi;
use App\Pengiriman_barang_k;
use Auth;
use DB;

class OkdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $okds = Order_kredit_disetujui::all();
        return view('admin.okd', compact('okds'));
    }

    public function store(Request $request)
    {
        $kps = DB::select("SELECT Tabel_bantuans.id, Tabel_bantuans.name, Tabel_bantuans.unit_masuk, Tabel_bantuans.keluar_tunai, Tabel_bantuans.keluar_luring, Tabel_bantuans.keluar_kredit, Tabel_bantuans.saldo FROM 
                            (SELECT Products.id, Products.name, ifnull(satus.unit_masuk, 0) AS unit_masuk, ifnull(duas.qty, 0) AS keluar_tunai, ifnull(tigas.unit, 0) AS keluar_luring, ifnull(empats.qty, 0) AS keluar_kredit, 
                            (ifnull(satus.unit_masuk,0) - ifnull(duas.qty,0) - ifnull(tigas.unit,0) - ifnull(empats.qty,0)) AS saldo FROM Products
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
        
        $orderans = Detail_order_k::where('master_order_k_id', $request->master_order_k_id)->get();
        foreach ($orderans as $orderan){
            $iddicek = $orderan->product_id;
            $kolom = array_column($kps, 'id');
            $hasil_cari = array_search($iddicek, $kolom);
                if($kps[$hasil_cari]->saldo < $orderan->qty) {
                    return redirect('/menuorderk')->with('error', 'Jumlah Barang/Produk yang dipesan melebihi jumlah barang/produk yang tersedia, Silahkan hubungi pelanggan bersangkutan!');
                }
        }


        $token = $this->generate_token();

        $request->validate([
            'dl_bayar' => 'required'
        ]);
        $duplicate = Order_kredit_disetujui::where('master_order_k_id' , $request->master_order_k_id)
            ->orwhere('token' , $token)->first();

        if($duplicate) {
            return redirect('/menuorderk')->with('error', 'Tolong setujui nomor order yang BELUM disetujui sebelumnya. JANGAN setujui yang SUDAH disetujui sebelumnya!');
        }
        Order_kredit_disetujui::create([
            'master_order_k_id' => $request->master_order_k_id,
            'user_id' => Auth::user()->id,
            'token' => $token,
            'dl_bayar' => $request->dl_bayar
        ]);
        return redirect('/okd')->with('success', 'Orderan SUDAH disetujui!');
    }

    public function edit($id)
    {
        $okd = Order_kredit_disetujui::where('id', $id)->first();
        return view('admin.editokd', compact('okd'));
    }

    public function update(Request $request, $id)
    {
        Order_kredit_disetujui::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'dl_bayar' => $request->dl_bayar
        ]);
        return redirect('/okd');
    }

    public function show($id)
    {
        $okds = Order_kredit_disetujui::where('id', $id)->first();
        $ekspedisis = Ekspedisi::all();
        $details = Detail_order_k::where('master_order_k_id', $okds['master_order_k_id'])->get();
        return view('admin.createpbk', compact('okds', 'ekspedisis', 'details'));
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

    public function delete($id)
    {
        $duplicate = Pengiriman_barang_k::where('order_kredit_disetujui_id' , $id)->first();

        if($duplicate) {
            return redirect('/okd')->with('error', 'Orderan TELAH DIKIRIM, hubungi bagian pengiriman untuk menghapus data pengiriman terlebih dahulu!');
        }

        Order_kredit_disetujui::destroy($id);
        return back()->with('success', 'Order Kredit Disetujui SUKSES dihapus!!!');
    }

    public function view($id)
    {
        $okd = Order_kredit_disetujui::where('id', $id)->first();
        $detailorderks = Detail_order_k::where('master_order_k_id', $okd->master_order_k_id)->paginate(5);
        return view('admin.lihatorderk1', compact('okd', 'detailorderks'));
    }
}
