<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Pengiriman_barang_k;
use App\Order_kredit_disetujui;
use App\Detail_order_k;
use App\Ekspedisi;
use App\Faktur_lunas;
use Auth;
use PDF;
use App\Mail\SendFakturMail;

class PbkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $pbks = Pengiriman_barang_k::all();
        return view('admin.pbk', compact('pbks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_kredit_disetujui_id' => 'required',
            'tgl_kirim' => 'required',
            'ongkir' => 'required',
            'estimasi_sampai' => 'required',
            'resi_pengiriman' => 'required'
        ]);
        $duplicate = Pengiriman_barang_k::where('order_kredit_disetujui_id' , $request->order_kredit_disetujui_id)->first();

        if($duplicate) {
            return redirect('/pbk')->with('error', 'Data PBK sudah ada di daftar sebelumnya, Tolong JANGAN input data yang SUDAH diinput sebelumnya!');
        }

        Pengiriman_barang_k::create([
            'order_kredit_disetujui_id' => $request->order_kredit_disetujui_id,
            'tgl_kirim' => $request->tgl_kirim,
            'ongkir' => $request->ongkir,
            'estimasi_sampai' => $request->estimasi_sampai,
            'ekspedisi_id' => $request->ekspedisi_id,
            'resi_pengiriman' => $request->resi_pengiriman,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/pbk')->with('success', 'Data Orderan yang SUDAH Dikirim SUKSES Ditambahkan');
    }

    public function edit($id)
    {
        $pbk = Pengiriman_barang_k::where('id', $id)->first();
        $ekspedisis = Ekspedisi::all();
        return view('admin.editpbk', compact('pbk', 'ekspedisis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_kirim' => 'required',
            'ongkir' => 'required',
            'estimasi_sampai' => 'required',
            'ekspedisi_id' => 'required',
            'resi_pengiriman' => 'required'
        ]);

        Pengiriman_barang_k::where('id', $id)->update([
            'tgl_kirim' => $request->tgl_kirim,
            'ongkir' => $request->ongkir,
            'estimasi_sampai' => $request->estimasi_sampai,
            'ekspedisi_id' => $request->ekspedisi_id,
            'resi_pengiriman' => $request->resi_pengiriman,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/pbk');
    }

    public function show($id)
    {
        $pbk = Pengiriman_barang_k::where('id', $id)->first();
        $details = Detail_order_k::where('master_order_k_id', $pbk->order_kredit_disetujui['master_order_k_id'])->get();
        return view('admin.createfl', compact('pbk', 'details'));
    }

    public function delete($id)
    {
        $duplicate = Faktur_lunas::where('pengiriman_barang_k_id' , $id)->first();

        if($duplicate) {
            return redirect('/pbk')->with('error', 'Data PBK sudah dilunasi oleh pelanggan, ANDA tidak bisa menghapusnya lagi!');
        }

        Pengiriman_barang_k::destroy($id);
        return back()->with('success', 'Order Yang Telah Dikirim SUKSES dihapus!!!');
    }

    public function lihatorderan($id)
    {
        $pbks = Pengiriman_barang_k::where('id', $id)->first();
        $pdf = PDF::loadview('faktur_pdf', ['pbks'=>$pbks])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function sendfaktur($id)
    {
        $pbks = Pengiriman_barang_k::where('id', $id)->first();
        \Mail::to("testing@gmail.com")->send(new SendFakturMail($pbks));
        
        return redirect('/pbk')->with('success', 'Faktur SUKSES Dikirim');
    }
}
