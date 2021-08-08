<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_persediaan;
use App\Detail_persediaan;
use App\product;
use Auth;

class PersediaanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mps = Master_persediaan::all();
        return view('admin.menupersediaan', compact('mps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.createpersediaan', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $id = Master_persediaan::create([
            'tgl_masuk' => $request->tgl_masuk,
            'user_id' => Auth::user()->id
        ])->id;

        $index = 0;
        $product_id = $request->product_id;
        $unit = $request->unit;
        foreach($product_id as $barisproduct)
        {
            $baris_unit = $unit[$index];

            Detail_persediaan::create([
                'master_persediaan_id' => $id,
                'product_id' => $barisproduct,
                'unit_masuk' => $baris_unit,
            ]);
            $index = $index+1;
        }

        return redirect('/menupersediaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailpersediaans = Detail_persediaan::where('master_persediaan_id', $id)->get();
        return view('admin.detailpersediaan', compact('detailpersediaans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $masterpersediaans = Master_persediaan::where('id', $id)->first();
        $detailpersediaans = Detail_persediaan::where('master_persediaan_id', $id)->get();
        return view('admin.editpersediaan', compact('masterpersediaans', 'detailpersediaans', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        Master_persediaan::where('id', $id)->update([
            'tgl_masuk' => $request->tgl_masuk,
            'user_id' => Auth::user()->id
        ]);

        $index = 0;
        // $data_details = $request->data_detail;

        foreach($request->data_detail as $baris_detail)
        {
            // $baris_product = $baris_detail['product_id'];
            // $baris_unit = $baris_detail['unit_masuk'];
            // $baris_id = $baris_detail['id'];

            Detail_persediaan::where('id', $baris_detail['id'])->update([
                'product_id' => $baris_detail['product_id'],
                'unit_masuk' => $baris_detail['unit_masuk']
            ]);
            $index = $index+1;
        }

        return redirect('/menupersediaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Detail_persediaan::where('master_persediaan_id', $id)->delete();
        Master_persediaan::destroy($id);
        return redirect('/menupersediaan')->with('success', 'SUKSES menghapus data barang/produk yang masuk!!!');
    }
}
