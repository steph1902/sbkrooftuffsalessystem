<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Add this line


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $userEmail = Auth::user()->email;
        
        $sales = DB::table('sales')
            ->where('email', $userEmail)
            ->get();

            // dd($sales);
        
        
            // $assignedShops = DB::table('shops')
            // ->join('user_shop', 'shops.id', '=', 'user_shop.shop_id')
            // ->join('users', 'user_shop.user_id', '=', 'users.id')
            // ->where('users.email', $userEmail)
            // ->select('shops.*')
            // ->get();
            $userEmail = Auth::user()->email;


        // $assignedShops = DB::table('sales_shop')
        //     ->join('shops', 'sales_shop.shop_id', '=', 'shops.id')
        //     ->join('sales', 'sales_shop.salesperson_id', '=', 'sales.id')
        //     ->join('users', 'sales.user_id', '=', 'users.id')
        //     ->where('users.email', $userEmail)
        //     ->select('shops.*')
        //     ->get();

        $userEmail = Auth::user()->email;
        $userId = Auth::user()->id;
        // dd($userId);

        $assignedShops = DB::table('sales_shop')
            ->join('shop', 'sales_shop.shop_id', '=', 'shop.id')
            ->join('sales', 'sales_shop.salesperson_id', '=', 'sales.id')
            ->where('sales_shop.salesperson_id', $userId)
            ->select('shop.*')
            ->get();



            // dd($assignedShops);

        
    
        return view('home', compact('sales', 'assignedShops'));        
    }
}
