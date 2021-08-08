<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == 'admin_owner') {
        return view('changePassword');
        } elseif(Auth::user()->role == 'admin_penjualan') {
            return view('changePassword');
            } elseif(Auth::user()->role == 'admin_bendahara') {
                return view('changePassword');
                } elseif(Auth::user()->role == 'admin_bendahara') {
                    return view('changePassword');
                    } ELSE {
            return view('changePassworduser');
        }
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        if(Auth::user()->role == 'admin_owner') {
        return redirect('/admin');
        } elseif(Auth::user()->role == 'admin_penjualan') {
            return redirect('/admin');
            } elseif(Auth::user()->role == 'admin_bendahara') {
                return redirect('/admin');
                } elseif(Auth::user()->role == 'admin_gp') {
                    return redirect('/admin');
                    } ELSE {
            return redirect('/home');
        }
    }
}