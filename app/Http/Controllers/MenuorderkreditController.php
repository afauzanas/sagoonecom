<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_order_k;
use App\Metode_bayar;
use App\Detail_order_k;
use App\Order_kredit_disetujui;

class MenuorderkreditController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $masterorderks = Master_order_k::all();
        return view('admin.menuorderk', compact('masterorderks'));
    }

    public function detail($id)
    {
        $detailorderks = Detail_order_k::where('master_order_k_id', $id)->paginate(5);
        return view('admin.detailorderk', compact('detailorderks', 'id'));
    }

    public function show($id)
    {
        $MOK = Master_order_k::where('id', $id)->first();
        $detailorderks = Detail_order_k::where('master_order_k_id', $id)->paginate(5);
        return view('admin.createokd', compact('MOK', 'detailorderks'));
    }

}
