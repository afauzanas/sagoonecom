<?php

namespace App\Http\Controllers;
Use App\Product;
Use App\Category;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index(Request $request, $id = null)
    {
        $categories = Category::all();
        //Pagination
        $products = Product::paginate(6);
        return view('shop.index', compact('products', 'categories', 'id'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->paginate(6);
        return view('shop.index', compact('products', 'categories', 'id'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $barang = [];
        $products = Product::where('id', $id)->get();
                $index2 = 0;
                foreach($products[0]->Detail_persediaan as $key=> $c) {
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
        $saldo = 0;
        foreach($barang as $kp) {
            $saldo = $saldo + $kp['unit_masuk'] - $kp['unit_keluar'];
        }
        if($saldo > 0) {
        return view('shop.show', ['saldo' => $saldo], compact('product'));
        } else {
            return back()->with('error', 'Maaf, Barang/Produk yang anda tekan sebelumnya sudah habis');
        }
    }


}
