<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permintaan_hb_kredit;
use App\Master_order_t;
use Auth;

class PhbkController extends Controller
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
        $phbks = Permintaan_hb_kredit::all();
        return view('admin.phbk', compact('phbks'));
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
        $duplicate = Permintaan_hb_kredit::where('user_id' , Auth::user()->id)->first();

        if($duplicate) {
            return redirect('/cart')->with('error', 'anda SEBELUMNYA SUDAH melakukan Permintaan, MOHON TUNGGU PERMINTAAN ANDA DITANGGAPI!');
        }
        Permintaan_hb_kredit::create([
            'user_id' => Auth::user()->id
        ]);
        return redirect('/cart')->with('success', 'Sukses Mengirim Permintaan, Tunggu Jawaban Permintaan Anda!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phbks = Permintaan_hb_kredit::where('id', $id)->first();
        // Belajar JOIN
        // $checks = Master_order_t::join('Detail_order_tunais', 'Master_order_ts.id', '=', 'Detail_order_tunais.master_order_t_id')
        //             ->where('user_id', $phbks->user_id)->get();
        $checks = Master_order_t::where('user_id', $phbks->user_id)->get();
        return view('admin.createhbkd', compact('phbks', 'checks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $duplicate = Permintaan_hb_kredit::where('id' , $id)->first();

        if($duplicate) {
            return redirect('/phbk')->with('error', 'Permintaan sudah disetujui sebelumnya, hapus terlebih dahulu Hak Beli Kredit Pelanggan!');
        }

        Permintaan_hb_kredit::destroy($id);
        return redirect('/phbk')->with('success', 'Permintaan Hak Beli Kredit SUKSES dihapus!!!');
    }
}
