<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Master_order_k;
use App\Detail_order_k;
use App\Order_kredit_disetujui;
use App\Pengiriman_barang_k;
use App\Pengiriman_barang_t;
use App\Product;
use App\Detail_order_tunai;

class LpController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('admin');
    }

    public function index()
    {
        //
    }

    public function pelanggan()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.lp.pelanggan', compact('users'));
    }

    public function pelv($id)
    {
        
        $pbks = Pengiriman_barang_k::join('Order_kredit_disetujuis', 'Pengiriman_barang_ks.order_kredit_disetujui_id', '=', 'Order_kredit_disetujuis.id')
                                    ->join('Master_order_ks', 'Order_kredit_disetujuis.master_order_k_id', '=', 'Master_order_ks.id')
                                    ->where('Master_order_ks.user_id', $id)->get();
        
        return view('admin.lp.pelv', compact('pbks', 'id'));
    }

    public function pelvt($id)
    {
        $mts = Pengiriman_barang_t::join('Master_order_ts', 'Pengiriman_barang_ts.master_order_t_id', '=', 'Master_order_ts.id')
                                    ->where('Master_order_ts.user_id', $id)->get();
        return view('admin.lp.pelvt', compact('mts', 'id'));
    }

    public function produk()
    {
        $products = product::all();
        return view('admin.lp.produk', compact('products'));
    }

    public function produkk($id)
    {
        // BELAJAR JOIN beberapa TABEL
        // $pbks = Pengiriman_barang_k::join('Order_kredit_disetujuis', 'Pengiriman_barang_ks.order_kredit_disetujui_id', '=', 'Order_kredit_disetujuis.id')
        //                             ->join('Master_order_ks', 'Order_kredit_disetujuis.master_order_k_id', '=', 'Master_order_ks.id')
        //                             ->join('Detail_order_ks', 'Master_order_ks.id', '=', 'Detail_order_ks.master_order_k_id')
        //                             ->where('Detail_order_ks.product_id', $id)->get();
        $details = Detail_order_k::where('product_id', $id)->get();
        return view('admin.lp.produkk', compact('details', 'id'));
    }

    public function produkt($id)
    {
        $details = Detail_order_tunai::where('product_id', $id)->get();
        return view('admin.lp.produkt', compact('details', 'id'));
    }
}
