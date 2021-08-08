<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class LpersediaanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('admin');
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.lpersediaan.produk', compact('products'));
    }

    public function kp($id)
    {
        $barang = [];
        $kepala = Product::where('id', $id)->first();
        $products = Product::where('id', $id)->get();
        // dd($products);
                // $barang['name'] = $barang['name'];
                // print_r ($p->Detail_persediaan);
                $index2 = 0;
                foreach($products[0]->Detail_persediaan as $key=> $c) {
                    // $x = $c->unit_masuk;
                    // echo $x;
                    // echo "<br>";
                    // echo "$barang->name";
                    $barang[$index2]['identitas'] = $c->master_persediaan->no_mutasi;
                    $barang[$index2]['tgl'] = $c->master_persediaan->tgl_masuk;
                    $barang[$index2]['unit_masuk'] = $c->unit_masuk;
                    $barang[$index2]['unit_keluar'] = 0;
                    $index2++;
                }
                foreach($products[0]->Detail_order_k as $key=> $c) {
                    if($c->master_order_k->order_kredit_disetujui->id !=0) {
                    $y = $c->master_order_k->created_at->toArray();
                    $barang[$index2]['identitas'] = $c->master_order_k->no_order;
                    $barang[$index2]['tgl'] = $y['formatted'];
                    $barang[$index2]['unit_masuk'] = 0;
                    $barang[$index2]['unit_keluar'] = $c->qty;
                    $index2++;
                    }
                }
                foreach($products[0]->Detail_order_tunai as $key=> $c) {
                    $y = $c->master_order_t->created_at->toArray();
                    $barang[$index2]['identitas'] = $c->master_order_t->no_order;
                    $barang[$index2]['tgl'] = $y['formatted'];
                    $barang[$index2]['unit_masuk'] = 0;
                    $barang[$index2]['unit_keluar'] = $c->qty;
                    $index2++;
                }
                foreach($products[0]->Detail_nota_luring as $key=> $c) {
                    $y = $c->master_nota_luring->created_at->toArray();
                    $barang[$index2]['identitas'] = $c->master_nota_luring->no_nota_luring;
                    $barang[$index2]['tgl'] = $y['formatted'];
                    $barang[$index2]['unit_masuk'] = 0;
                    $barang[$index2]['unit_keluar'] = $c->unit;
                    $index2++;
                }

            // dd($barang);
        return view('admin.lpersediaan.kp', ['barang' => $barang], compact('kepala'));
    }
}
