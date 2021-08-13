<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_order_t;
use App\Pengiriman_barang_t;
use App\Detail_order_tunai;
use App\Konfir_terima_barang_t;
use App\Master_order_k;
use App\Order_kredit_disetujui;
use App\Pengiriman_barang_k;
use App\Detail_order_k;
use App\Konfir_terima_barang_k;
use Auth;
use PDF;

class DpController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function tunai()
    {
        $dpts = Master_order_t::where('user_id', Auth::user()->id)->get();
        $name = Master_order_k::where('user_id', Auth::user()->id)->first();
        return view('user.daftarpesanan', compact('dpts', 'name'));
    }

    public function showtunai($id)
    {
        $pbts = Pengiriman_barang_t::where('master_order_t_id', $id)->first();
        $pdf = PDF::loadview('enota_pdf', ['pbts'=>$pbts])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function createtunai($id)
    {
        $pbts = Master_order_t::where('id', $id)->first();
        $details = Detail_order_tunai::where('master_order_t_id', $id)->get();
        return view('user.createkonfirtunai', compact('pbts', 'details'));
    }

    public function storetunai(Request $request)
    {
        $request->validate([
            'tgl_terima' => 'required'
        ]);
        $duplicate = Konfir_terima_barang_t::where('pengiriman_barang_t_id' , $request->pengiriman_barang_t_id)->first();

        if($duplicate) {
            return redirect('/daftarpesanantunai')->with('error', 'Tolong Konfirmasi Orderan yang BELUM dikonfir sebelumnya. JANGAN Konfirmasi yang SUDAH dikonfirmasi sebelumnya!');
        }
        Konfir_terima_barang_t::create([
            'pengiriman_barang_t_id' => $request->pengiriman_barang_t_id,
            'tgl_terima' => $request->tgl_terima,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/daftarpesanantunai')->with('success', 'Orderan Diterima SUDAH dikonfirmasi!');
    }

    public function kredit()
    {
        $dpks = Master_order_k::where('user_id', Auth::user()->id)->get();
        $name = Master_order_k::where('user_id', Auth::user()->id)->first();
        return view('user.daftarpesanank', compact('dpks', 'name'));
    }

    public function showkredit($id)
    {
        $okd = Order_kredit_disetujui::where('master_order_k_id', $id)->first();
        $pbks = Pengiriman_barang_k::where('order_kredit_disetujui_id', $okd->id)->first();
        $pdf = PDF::loadview('faktur_pdf', ['pbks'=>$pbks])->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function createkredit($id)
    {
        $pbks = Master_order_k::where('id', $id)->first();
        $details = Detail_order_k::where('master_order_k_id', $id)->get();
        return view('user.createkonfirkredit', compact('pbks', 'details'));
    }

    public function storekredit(Request $request)
    {
        $request->validate([
            'tgl_terima' => 'required'
        ]);
        $duplicate = Konfir_terima_barang_k::where('pengiriman_barang_k_id' , $request->pengiriman_barang_k_id)->first();

        if($duplicate) {
            return redirect('/daftarpesanankredit')->with('error', 'Tolong Konfirmasi Orderan yang BELUM dikonfir sebelumnya. JANGAN Konfirmasi yang SUDAH dikonfirmasi sebelumnya!');
        }
        Konfir_terima_barang_k::create([
            'pengiriman_barang_k_id' => $request->pengiriman_barang_k_id,
            'tgl_terima' => $request->tgl_terima,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/daftarpesanankredit')->with('success', 'Orderan Diterima SUDAH dikonfirmasi!');
    }

    public function destroykredit($id)
    {
        Detail_order_k::where('master_order_k_id', $id)->delete();
        Master_order_k::destroy($id);
        return back()->with('success', 'Order Kredit sukses dibatalkan!');
    }

}
