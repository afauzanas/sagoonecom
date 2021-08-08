<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faktur_lunas;
use App\Detail_order_k;
use Auth;

class FlController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $fls = Faktur_lunas::all();
        return view('admin.fl', compact('fls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengiriman_barang_k_id' => 'required',
            'tgl_lunas' => 'required'
        ]);
        $duplicate = Faktur_lunas::where('pengiriman_barang_k_id' , $request->pengiriman_barang_k_id)->first();

        if($duplicate) {
            return redirect('/pbk')->with('error', 'Faktur Lunas SUDAH diinput sebelumnya, TOLONG Input Data yang BELUM diinput!');
        }

        Faktur_lunas::create([
            'pengiriman_barang_k_id' => $request->pengiriman_barang_k_id,
            'tgl_lunas' => $request->tgl_lunas,
            'ket' => $request->ket,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/fl')->with('success', 'SUKSES menambahkan Faktur Lunas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fl = Faktur_lunas::where('id', $id)->first();
        $detailorderks = Detail_order_k::where('master_order_k_id', $fl->Pengiriman_barang_k->order_kredit_disetujui->master_order_k_id)->paginate(5);
        return view('admin.lihatorderk', compact('fl', 'detailorderks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fls = Faktur_lunas::where('id', $id)->first();
        return view('admin.editfl', compact('fls'));
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
        Faktur_lunas::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'tgl_lunas' => $request->tgl_lunas,
            'ket' => $request->ket
        ]);
        return redirect('/fl');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faktur_lunas::destroy($id);
        return back()->with('success', 'SUKSES menghapus Data Faktur Lunas!!!');
    }
}
