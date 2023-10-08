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

        // Mengambil semua data toko yang memiliki nama sales yang sesuai dengan pagination
    $shops = DB::table('shop')->where('nama_sales', $userName)->paginate(10); // Gantilah 10 dengan jumlah data per halaman yang Anda inginkan

    return view('home', compact('user', 'shops'));
    // return view('home', compact('sales', 'assignedShops','visitedShops'));  

        // $assignedShops = 

        // return 'berhasil login';
        // $userEmail = Auth::user()->email;
        
        // $sales = DB::table('sales')
        //     ->where('email', $userEmail)
        //     ->get();

          
       
        // $userId = Auth::user()->id;
       

        // $assignedShops = DB::table('sales_shop')
        //     ->join('shop', 'sales_shop.shop_id', '=', 'shop.id')
        //     ->join('sales', 'sales_shop.salesperson_id', '=', 'sales.id')
        //     ->where('sales_shop.salesperson_id', $userId)
        //     ->select('shop.*')
        //     ->get();

        // $visitedShops = DB::table('sales_visit')
        // ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        // ->where('sales_visit.sales_id', $userId)
        // ->select('sales_visit.*', 'shop.shop_name', 'shop.shop_address', 'shop.shop_region', 'shop.shop_city', 'shop.shop_district', 'shop.shop_subdistrict', 'shop.shop_googlemaps_coord', 'shop.shop_uuid')
        // ->get();


       
        // return view('home', compact('sales', 'assignedShops','visitedShops'));        
    }
}
