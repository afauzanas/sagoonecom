<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Pengiriman_barang_t;
use App\Ekspedisi;
use App\Konfir_terima_barang_t;
use App\Detail_order_tunai;
use Auth;
use PDF;
use App\Mail\SendEnotaMail;

class PbtController extends Controller
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
        $pbts = Pengiriman_barang_t::all();
        return view('admin.pbt', compact('pbts'));
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
            'master_order_t_id' => 'required',
            'tgl_kirim' => 'required',
            'ongkir' => 'required',
            'estimasi_sampai' => 'required',
            'resi_pengiriman' => 'required'
        ]);
        $duplicate = Pengiriman_barang_t::where('master_order_t_id' , $request->master_order_t_id)->first();

        if($duplicate) {
            return redirect('/pbt')->with('error', 'Data PBT sudah ada di daftar sebelumnya, Tolong JANGAN input data yang SUDAH diinput sebelumnya!');
        }

        Pengiriman_barang_t::create([
            'master_order_t_id' => $request->master_order_t_id,
            'tgl_kirim' => $request->tgl_kirim,
            'ongkir' => $request->ongkir,
            'estimasi_sampai' => $request->estimasi_sampai,
            'ekspedisi_id' => $request->ekspedisi_id,
            'resi_pengiriman' => $request->resi_pengiriman,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/pbt/sendenota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pbts = Pengiriman_barang_t::where('id', $id)->first();
        $pdf = PDF::loadview('enota_pdf', ['pbts'=>$pbts])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pbt = Pengiriman_barang_t::where('id', $id)->first();
        $ekspedisis = Ekspedisi::all();
        $detailorderts = Detail_order_tunai::where('Master_order_t_id', $pbt->master_order_t_id)->get();
        return view('admin.editpbt', compact('pbt', 'ekspedisis', 'detailorderts'));
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
        $request->validate([
            'tgl_kirim' => 'required',
            'ongkir' => 'required',
            'estimasi_sampai' => 'required',
            'ekspedisi_id' => 'required',
            'resi_pengiriman' => 'required'
        ]);

        Pengiriman_barang_t::where('id', $id)->update([
            'tgl_kirim' => $request->tgl_kirim,
            'ongkir' => $request->ongkir,
            'estimasi_sampai' => $request->estimasi_sampai,
            'ekspedisi_id' => $request->ekspedisi_id,
            'resi_pengiriman' => $request->resi_pengiriman,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/pbt')->with('success', 'SUKSES mengedit Data Pengiriman Barang Tunai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pengiriman_barang_t::destroy($id);
        return back()->with('success', 'Orderan Tunai Yang Telah Dikirim SUKSES dihapus!!!');
    }

    public function sendenota()
    {
        $pbts = Pengiriman_barang_t::latest()->first();
        \Mail::to("testing@gmail.com")->send(new SendEnotaMail($pbts));
        
        return redirect('/pbt')->with('success', 'Data Orderan yang SUDAH Dikirim SUKSES Ditambahkan dan ENOTA telah Dikirim');
    }
}
