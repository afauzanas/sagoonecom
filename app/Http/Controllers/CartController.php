<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use App\Metode_bayar;
use App\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }
    
    public function index()
    {
        $metode_bayars = Metode_bayar::all();
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        // $barang = [];
        // $products = Product::all();
        //     $index = 0;
        //     foreach($products as $x){
        //         $barang[$index]['name'] = $x->name;
        //         $index2 = 0;
        //         foreach($x->Detail_persediaan as $key=> $c) {
        //             $barang[$index][$index2]['identitas'] = $c->master_persediaan->no_mutasi;
        //             $barang[$index][$index2]['tgl'] = $c->master_persediaan->tgl_masuk;
        //             $barang[$index][$index2]['unit_masuk'] = $c->unit_masuk;
        //             $barang[$index][$index2]['unit_keluar'] = 0;
        //             $index2++;
        //         }
        //         foreach($x->Detail_order_k as $key=> $c) {
        //             $y = $c->master_order_k->created_at->toArray();
        //             $barang[$index][$index2]['identitas'] = $c->master_order_k->no_order;
        //             $barang[$index][$index2]['tgl'] = $y['formatted'];
        //             $barang[$index][$index2]['unit_masuk'] = 0;
        //             $barang[$index][$index2]['unit_keluar'] = $c->qty;
        //             $index2++;
        //         }
        //         foreach($x->Detail_order_tunai as $key=> $c) {
        //             $y = $c->master_order_t->created_at->toArray();
        //             $barang[$index][$index2]['identitas'] = $c->master_order_t->no_order;
        //             $barang[$index][$index2]['tgl'] = $y['formatted'];
        //             $barang[$index][$index2]['unit_masuk'] = 0;
        //             $barang[$index][$index2]['unit_keluar'] = $c->qty;
        //             $index2++;
        //         }
        //         foreach($x->Detail_nota_luring as $key=> $c) {
        //             $y = $c->master_nota_luring->created_at->toArray();
        //             $barang[$index][$index2]['identitas'] = $c->master_nota_luring->no_nota_luring;
        //             $barang[$index][$index2]['tgl'] = $y['formatted'];
        //             $barang[$index][$index2]['unit_masuk'] = 0;
        //             $barang[$index][$index2]['unit_keluar'] = $c->unit;
        //             $index2++;
        //         }
        //         $saldo = 0;
        //         foreach($barang as $kp) {
        //         $saldo = $saldo + $kp[$index]['unit_masuk'] - $kp[$index]['unit_keluar'];
        //         $index2++;
        //         }
        //         $barang[$index]['saldo'] = $saldo;
        //         $index++;
        //     }
        //     dd($barang);



        return view('cart.index', compact('carts', 'metode_bayars'));
    }

    public function store(Request $request)
    {
        $duplicate = Cart::where('user_id' , Auth::user()->id)->where('product_id' , $request->product_id)->first();

        if($duplicate) {
            return redirect('/cart')->with('error', 'Barang sudah ada di keranjang!');
        }
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => 1
        ]);
        return redirect('/cart')->with('success', 'Sukses menambah barang di keranjang!');
    }

    public function update(Request $request, $id)
    {

        // $barang = [];
        // $products = Cart::where('id', $id)
        //                 ->join('Products', 'Carts.product_id', '=', 'Products.id')->get();
        //         $index2 = 0;
        //         foreach($products[0]->Detail_persediaan as $key=> $c) {
        //             $barang[$index2]['identitas'] = $c->master_persediaan->no_mutasi;
        //             $barang[$index2]['tgl'] = $c->master_persediaan->tgl_masuk;
        //             $barang[$index2]['unit_masuk'] = $c->unit_masuk;
        //             $barang[$index2]['unit_keluar'] = 0;
        //             $index2++;
        //         }
        //         foreach($products[0]->Detail_order_k as $key=> $c) {
        //             $y = $c->master_order_k->created_at->toArray();
        //             $barang[$index2]['identitas'] = $c->master_order_k->no_order;
        //             $barang[$index2]['tgl'] = $y['formatted'];
        //             $barang[$index2]['unit_masuk'] = 0;
        //             $barang[$index2]['unit_keluar'] = $c->qty;
        //             $index2++;
        //         }
        //         foreach($products[0]->Detail_order_tunai as $key=> $c) {
        //             $y = $c->master_order_t->created_at->toArray();
        //             $barang[$index2]['identitas'] = $c->master_order_t->no_order;
        //             $barang[$index2]['tgl'] = $y['formatted'];
        //             $barang[$index2]['unit_masuk'] = 0;
        //             $barang[$index2]['unit_keluar'] = $c->qty;
        //             $index2++;
        //         }
        //         foreach($products[0]->Detail_nota_luring as $key=> $c) {
        //             $y = $c->master_nota_luring->created_at->toArray();
        //             $barang[$index2]['identitas'] = $c->master_nota_luring->no_nota_luring;
        //             $barang[$index2]['tgl'] = $y['formatted'];
        //             $barang[$index2]['unit_masuk'] = 0;
        //             $barang[$index2]['unit_keluar'] = $c->unit;
        //             $index2++;
        //         }
        // $saldo = 0;
        // foreach($barang as $kp) {
        //     $saldo = $saldo + $kp['unit_masuk'] - $kp['unit_keluar'];
        // }


///////////////////////////////////////////////////////////////////////////////////

        Cart::where('id', $id)->update([
            'qty' => $request->quantity
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    public function delete($id)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->first();
        $carts->delete($id);
        return back();
    }

}
