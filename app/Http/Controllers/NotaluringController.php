<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_nota_luring;
use App\Detail_nota_luring;
use App\Product;
use Auth;

class NotaluringController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index()
    {
        $masternotals = Master_nota_luring::paginate(5);
        return view('admin.menunotaluring', compact('masternotals'));
    }

    public function detail($id)
    {
        $detailnotals = Detail_nota_luring::where('master_nota_luring_id', $id)->paginate(8);
        return view('admin.detailnotal', compact('detailnotals'));
    }

    public function formstore()
    {
        $products = Product::all();
        return view('admin.createnotaluring', compact('products'));
    }

    public function store(Request $request)
    {
        //   

    }

    public function formedit($id)
    {
        $products = Product::all();
        $masternotals = Master_nota_luring::where('id', $id)->first();
        $detailnotals = Detail_nota_luring::where('master_nota_luring_id', $id)->get();
        return view('admin.editnotal', compact('masternotals', 'products', 'detailnotals'));
    }

    public function edit(Request $request, $id)
    {
        Master_nota_luring::where('id', $id)->update([
            'no_nota_luring' => $request->no_nota_luring,
            'ket' => $request->ket,
            'user_id' => Auth::user()->id
        ]);

        $index = 0;
        foreach($request->data_detail as $baris_detail)
        {
            

            Detail_nota_luring::where('id', $baris_detail['id'])->update([
                'product_id' => $baris_detail['product_id'],
                'unit' => $baris_detail['unit'],
                'harga' => $baris_detail['harga']
            ]);
            $index = $index+1;
        }

        return redirect('/menunotaluring');
    }

    public function delete($id)
    {
        Detail_nota_luring::where('master_nota_luring_id', $id)->delete();
        Master_nota_luring::destroy($id);
        return redirect('/menunotaluring')->with('success', 'SUKSES menghapus Nota Luring!!!');
    }

    // public function delete($id)
    // {
    //     $Detail = Detail_nota_luring::where('master_nota_luring_id', $id)->first();
    //     if($Detail) {
    //         return $Detail->delete();
    //     };
    //     $Master = Master_nota_luring::where('id', $id)->first();
    //     if($Master) {
    //         return $Master->delete();
    //     };
    //     return redirect('/menunotaluring')->with('success', 'SUKSES menghapus Nota Luring!!!');
    // }
}
