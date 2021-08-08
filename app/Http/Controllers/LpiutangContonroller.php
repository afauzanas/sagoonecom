<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\User;
use App\Pengiriman_barang_k;
use App\Master_order_k;
use App\Detail_order_k;
use App\Order_kredit_disetujui;
use App\Product;
use DB;

class LpiutangContonroller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('admin');
    }

    public function pelanggan()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.lpiutang.pelanggan', compact('users'));
    }

    public function kartu($id)
    {
        $name = User::where('id', $id)->first();
        // $pbks = Pengiriman_barang_k::join('Order_kredit_disetujuis', 'Pengiriman_barang_ks.order_kredit_disetujui_id', '=', 'Order_kredit_disetujuis.id')
        //                             ->join('Master_order_ks', 'Order_kredit_disetujuis.master_order_k_id', '=', 'Master_order_ks.id')
        //                             ->where('Master_order_ks.user_id', $id)->get();
        $mks = Master_order_k::where('user_id', $id)->get();
        return view('admin.lpiutang.kartupiutang', compact('mks', 'name', 'id'));
    }

    public function tpp()
    {
        // $x = Pengiriman_barang_k::all();
        $pbks = Pengiriman_barang_k::tpp();
        
        return view('admin.lpiutang.tpp', compact('pbks'));
    }

    // $tpps = DB::select("
        //     SELECT Pengiriman_barang_ks.*, pbks.nilai From Pengiriman_barang_ks
        //     INNER JOIN (SELECT Order_kredit_disetujuis.*, orders.nilai FROM Order_kredit_disetujuis
        //         INNER JOIN (SELECT master_order_k_id, SUM(qty * harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) orders
        //         ON Order_kredit_disetujuis.master_order_k_id = orders.master_order_k_id) pbks
        //     ON Pengiriman_barang_ks.order_kredit_disetujui_id = pbks.id
        // ");
        //     dd($tpps);
        // $x = Pengiriman_barang_k->tpp();
        // dd($x);
        // $tpps = DB::select("
        //     SELECT Order_kredit_disetujuis.*, orders.nilai FROM Order_kredit_disetujuis
        //     INNER JOIN (SELECT master_order_k_id, SUM(qty * harga) AS nilai FROM Detail_order_ks GROUP BY master_order_k_id) orders
        //     ON Order_kredit_disetujuis.master_order_k_id = orders.master_order_k_id
        //     ");
        //     dd($tpps);
        // $tpps = DB::select("SELECT master_order_k_id, SUM(qty * harga) AS saldo_akhir FROM Detail_order_ks GROUP BY master_order_k_id");
        //     dd($tpps);

    public function umurpiutang()
    {
        $ups = Order_kredit_disetujui::umurpiutang();
        return view('admin.lpiutang.umurpiutang', compact('ups'));
    }

}
