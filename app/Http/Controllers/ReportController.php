<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ShopExport;
use App\Exports\ReportExport;
// use App\Model\Shop;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Visit;
// use Maatwebsite\Excel\Facades\Excel;




class ReportController extends Controller
{
    

    // public function export(Request $request)
    // {
    //     $query = Shop::query();

        
    //     if ($request->filled('shop_name')) {
    //         $query->where('shop_name', 'like', '%' . $request->input('shop_name') . '%');
    //     }
    //     if ($request->filled('sales_name')) {
    //         $query->whereHas('sales', function ($query) use ($request) {
    //             $query->where('name', 'like', '%' . $request->input('sales_name') . '%');
    //         });
    //     }
    //     if ($request->filled('province')) {
    //         $query->where('shop_province', 'like', '%' . $request->input('province') . '%');
    //     }

    //     $shops = $query->get();

    //     return Excel::download(new ShopExport($shops), 'report.xlsx');
    // }

    public function export()
    {
        $reportData = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->join('sales', 'sales.id', '=', 'sales_visit.sales_id')
            ->select('sales_visit.*', 'shop.*', 'sales.*')
            ->get();

        

        return Excel::download(new ReportExport($reportData), 'report.xlsx');
    }

    // public function mapDetailView()
    // {
    //     $shops = Shop::all();
    //     $sales = Sales::all();
    //     $users = User::all();
    //     $visits = Visit::all();



    //     return view('mapDetailView', compact('shops','sales', 'users', 'visits'));  

    // }

    // public function insertMapData(Request $request)
    // {
    //     $mapData = $request
    // }



    

    public function index(Request $request)
    {
        // dd('a');
        $query = Shop::query();

        // Apply filters
        if ($request->filled('shop_name')) {
            $query->where('shop_name', 'like', '%' . $request->input('shop_name') . '%');
        }
        if ($request->filled('sales_name')) {
            $query->whereHas('sales', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->input('sales_name') . '%');
            });
        }
        if ($request->filled('province')) {
            $query->where('shop_city', 'like', '%' . $request->input('province') . '%');
        }

        $shops = $query->get();

        // Fetch the filtered data
        $reportData = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
            ->join('sales', 'sales.id', '=', 'sales_visit.sales_id')
            ->select('sales_visit.*', 'shop.*','sales.*')
            ->when($request->filled('shop_name'), function ($query) use ($request) {
                $query->where('shop.shop_name', 'like', '%' . $request->input('shop_name') . '%');
            })
            ->when($request->filled('sales_name'), function ($query) use ($request) {
                $query->where('sales.nama', 'like', '%' . $request->input('sales_name') . '%');
            })
            ->when($request->filled('province'), function ($query) use ($request) {
                $query->where('shop.shop_city', 'like', '%' . $request->input('province') . '%');
            })
            ->get();

            // dd($reportData);

        return view('report.index', compact('reportData', 'shops'));
    }



}
