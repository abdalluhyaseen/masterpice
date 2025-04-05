<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function authenticated()
    {
        if (Auth::user()->role === 'admin') {
            return redirect('dash');
        }elseif (Auth::user()->role === 'superadmin') {
            return redirect('dash');
            }  
        return redirect('/');
    }

    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
