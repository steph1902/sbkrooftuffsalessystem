<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Visit;


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
        
        $user = Auth::user();
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        $shops = DB::table('shop')->where('nama_sales', $userName)->get();

        $visitedShops = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        ->where('sales_visit.sales_id', $userId)
        ->select('sales_visit.*', 
        'shop.shop_name', 
        'shop.shop_address', 
        'shop.provinsi', 
        'shop.kota', 
        'shop.kecamatan', 
        'shop.kelurahan', 
        'shop.shop_googlemaps_coord', 
        'shop.shop_uuid')
        ->get();

        // dd($visitedShops);
        


        return view('home', compact('user', 'shops','visitedShops'));
            
    }
}
