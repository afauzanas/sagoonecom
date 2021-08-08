<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_kredit_disetujui;
use App\Master_order_k;
use App\Detail_order_k;
use App\Ekspedisi;
use App\Pengiriman_barang_k;
use Auth;

class OkdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $okds = Order_kredit_disetujui::all();
        return view('admin.okd', compact('okds'));
    }

    public function store(Request $request)
    {
        $token = $this->generate_token();

        $request->validate([
            'dl_bayar' => 'required'
        ]);
        $duplicate = Order_kredit_disetujui::where('master_order_k_id' , $request->master_order_k_id)
            ->orwhere('token' , $token)->first();

        if($duplicate) {
            return redirect('/menuorderk')->with('error', 'Tolong setujui nomor order yang BELUM disetujui sebelumnya. JANGAN setujui yang SUDAH disetujui sebelumnya!');
        }
        Order_kredit_disetujui::create([
            'master_order_k_id' => $request->master_order_k_id,
            'user_id' => Auth::user()->id,
            'token' => $token,
            'dl_bayar' => $request->dl_bayar
        ]);
        return redirect('/okd')->with('success', 'Orderan SUDAH disetujui!');
    }

    public function edit($id)
    {
        $okd = Order_kredit_disetujui::where('id', $id)->first();
        return view('admin.editokd', compact('okd'));
    }

    public function update(Request $request, $id)
    {
        Order_kredit_disetujui::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'dl_bayar' => $request->dl_bayar
        ]);
        return redirect('/okd');
    }

    public function show($id)
    {
        $okds = Order_kredit_disetujui::where('id', $id)->first();
        $ekspedisis = Ekspedisi::all();
        $details = Detail_order_k::where('master_order_k_id', $okds['master_order_k_id'])->get();
        return view('admin.createpbk', compact('okds', 'ekspedisis', 'details'));
    }

    public function generate_token()
    {
        $characters = '1234567890abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString= '';
        for ($i = 1; $i<=6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function delete($id)
    {
        $duplicate = Pengiriman_barang_k::where('order_kredit_disetujui_id' , $id)->first();

        if($duplicate) {
            return redirect('/okd')->with('error', 'Orderan TELAH DIKIRIM, hubungi bagian pengiriman untuk menghapus data pengiriman terlebih dahulu!');
        }

        Order_kredit_disetujui::destroy($id);
        return back()->with('success', 'Order Kredit Disetujui SUKSES dihapus!!!');
    }

    public function view($id)
    {
        $okd = Order_kredit_disetujui::where('id', $id)->first();
        $detailorderks = Detail_order_k::where('master_order_k_id', $okd->master_order_k_id)->paginate(5);
        return view('admin.lihatorderk1', compact('okd', 'detailorderks'));
    }
}
