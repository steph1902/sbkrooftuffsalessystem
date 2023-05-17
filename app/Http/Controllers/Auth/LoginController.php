<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;


class LoginController extends Controller
{
    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // protected $redirectTo = '/';
    // protected $redirectTo = '/sales/dashboard';


    // protected function redirectTo()
    // {       
    //     $role = auth()->user()->role;
    
    //     if ($role === User::ROLE_SUPERADMIN) 
    //     {
    //         return '/superadmin/dashboard';
    //         } 
    //         elseif ($role === User::ROLE_SALES) {
    //             return '/sales/dashboard';
    //         } 
    //         else 
    //         {
    //             return '/';
    //         }
    // }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
