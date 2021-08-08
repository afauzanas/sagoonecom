<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hb_kredit_disetujui;
use Auth;

class HbkdController extends Controller
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
        $hbkds = Hb_kredit_disetujui::all();
        return view('admin.hbkd', compact('hbkds'));
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
        $duplicate = Hb_kredit_disetujui::where('permintaan_hb_kredit_id' , $request->permintaan_hb_kredit_id)->first();

        if($duplicate) {
            return redirect('/hbkd')->with('error', 'anda SEBELUMNYA SUDAH menyetujui Permintaan, MOHON SETUJUI yang BELUM disetujui!');
        }
        Hb_kredit_disetujui::create([
            'permintaan_hb_kredit_id' => $request->permintaan_hb_kredit_id,
            'user_id' => Auth::user()->id
        ]);
        return redirect('/hbkd')->with('success', 'Sukses Menyetujui Permintaan Hak Beli Kredit Pelanggan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        Hb_kredit_disetujui::destroy($id);
        return back()->with('success', 'Hak Beli Kredit SUKSES dihapus!!!');
    }
}
