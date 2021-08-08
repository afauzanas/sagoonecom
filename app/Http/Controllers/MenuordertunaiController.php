<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Master_order_t;
use App\Ekspedisi;
use App\Metode_bayar;
use App\Detail_order_tunai;

class MenuordertunaiController extends Controller
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
        $masterorderts = Master_order_t::all();
        return view('admin.menuordert', compact('masterorderts'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pbts = Master_order_t::where('id', $id)->first();
        $ekspedisis = Ekspedisi::all();
        $detailorderts = Detail_order_tunai::where('Master_order_t_id', $id)->get();
        return view('admin.createpbt', compact('pbts', 'ekspedisis', 'detailorderts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detailorderts = Detail_order_tunai::where('Master_order_t_id', $id)->get();
        return view('admin.detailordert', compact('detailorderts', 'id'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
