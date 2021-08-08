<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->middleware('admin');
    }

    public function __constructor()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    Public function formeditakun()
    {
        $akuns = User::where('id', Auth::user()->id)->first();
        return view('admin.editakun', compact('akuns'));
    }

    public function editakunadmin(Request $request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'kota_kab' => $request->kota_kab,
            'address' => $request->address,
            'phone' => $request->phone
        ]);
        return redirect('/admin')->with('success', 'BERHASIL MENGEDIT data akun admin!');
    }

}
