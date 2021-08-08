<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    Public function formeditakunpelanggan()
    {
        $akuns = User::where('id', Auth::user()->id)->first();
        return view('user.editakun', compact('akuns'));
    }

    public function editakunpelanggan(Request $request, $id)
    {
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'kota_kab' => $request->kota_kab,
            'address' => $request->address,
            'phone' => $request->phone
        ]);
        if(Auth::user()->role == 'admin_owner' OR Auth::user()->role == 'admin_penjualan' OR 
        Auth::user()->role == 'admin_bendahara' OR Auth::user()->role == 'admin_gp')
        return redirect('/admin')->with('success', 'BERHASIL MENGEDIT data akun admin!');
        else {
        return redirect('/home')->with('success', 'BERHASIL MENGEDIT data akun Anda!');
        }
    }
}
