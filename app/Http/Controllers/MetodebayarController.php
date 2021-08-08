<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metode_bayar;

class MetodebayarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function index()
    {
        $metode_bayars = Metode_bayar::paginate(5);
        return view('admin.metode_bayar', compact('metode_bayars'));
    }

    public function formstore()
    {
        return view('admin.createmetode_bayar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_metode' => 'required',
            'metode_bayar' => 'required'
        ]);

        $duplicate = Metode_bayar::where('kode_metode' , $request->kode_metode)->orWhere('metode_bayar', $request->metode_bayar)->first();

        if($duplicate) {
            return redirect('/metode_bayar')->with('error', 'Kode Metode Sudah Ada!');
        }
        Metode_bayar::create([
            'kode_metode' => $request->kode_metode,
            'metode_bayar' => $request->metode_bayar
        ]);
        return redirect('/metode_bayar')->with('success', 'Sukses menambah metode pembayaran!');
    }

    public function formedit($id)
    {
        $metode_bayars = Metode_bayar::where('id', $id)->first();
        return view('admin.editmetode_bayar', compact('metode_bayars'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'kode_metode' => 'required',
            'name' => 'required'
        ]);

        Metode_bayar::where('id', $id)->update([
            'kode_metode' => $request->kode_metode,
            'metode_bayar' => $request->name
        ]);
        return redirect('/metode_bayar')->with('success', 'Sukses Mengedit Metode Pembayaran');
    }

    public function delete($id)
    {
        Metode_bayar::destroy($id);
        return back();
    }
}
