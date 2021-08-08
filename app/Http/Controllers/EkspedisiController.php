<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ekspedisi;

class EkspedisiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $ekspedisis = Ekspedisi::paginate(5);
        return view('admin.ekspedisi', compact('ekspedisis'));
    }

    public function formstore()
    {
        return view('admin.createekspedisi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ekspedisi' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required'
        ]);
        $duplicate = Ekspedisi::where('kode_ekspedisi' , $request->kode_ekspedisi)
            ->orwhere('nama_ekspedisi' , $request->nama_ekspedisi)->orwhere('no_tlp', $request->no_tlp)->first();

        if($duplicate) {
            return redirect('/ekspedisi')->with('error', 'Nama/Kode/Nomor Telepon Ekspedisi sudah ada di daftar sebelumnya!');
        }

        Ekspedisi::create([
            'kode_ekspedisi' => $request->kode_ekspedisi,
            'nama_ekspedisi' => $request->name,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp
        ]);
        return redirect('/ekspedisi')->with('success', 'Sukses menambahkan ekspedisi');
    }

    public function formedit($id)
    {
        $ekspedisi = Ekspedisi::where('id', $id)->first();
        return view('admin.editekspedisi', compact('ekspedisi'));
    }

    public function edit(Request $request, $id)
    {
        Ekspedisi::where('id', $id)->update([
            'kode_ekspedisi' => $request->kode_ekspedisi,
            'nama_ekspedisi' => $request->name,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp
        ]);
        return redirect('/ekspedisi');
    }

    public function delete($id)
    {
        Ekspedisi::destroy($id);
        return back();
    }
}
