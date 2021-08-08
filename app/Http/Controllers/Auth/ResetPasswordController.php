<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo()
    {
        $role = Auth::user()->role;

        switch($role) {
            case 'admin_owner';
                return '/admin';
            break;
            case 'admin_penjualan';
                return '/admin';
            break;
            case 'admin_bendahara';
                return '/admin';
            break;
            case 'admin_gp';
                return '/admin';
            break;
            case 'user';
                return '/home';
            break;
        }
    }

}
