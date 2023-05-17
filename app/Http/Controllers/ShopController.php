<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;
// use App\Models\Province;
// use App\Models\City;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
      
        $query = Shop::query();

        // Apply filters if provided
        if ($request->filled('filter_name')) {
            $query->where('shop_name', 'like', '%' . $request->input('filter_name') . '%');
        }
        if ($request->filled('filter_region')) {
            $query->where('shop_region', 'like', '%' . $request->input('filter_region') . '%');
        }
        if ($request->filled('filter_city')) {
            $query->where('shop_city', 'like', '%' . $request->input('filter_city') . '%');
        }

        $shops = $query->get();

        return view('shops.index', compact('shops'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $provinces = Province::all();
        return view('shops.create', compact('provinces'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $shop = new Shop;

        $shop->shop_name = $request->shop_name;
        $shop->shop_address = $request->shop_address;

        $shop->shop_region = Province::find($request->provinsi)->name;
        $shop->shop_city = City::find($request->kota)->name;
        $shop->shop_district = District::find($request->kecamatan)->name;
        $shop->shop_subdistrict = Village::find($request->desa)->name;

        $shop->shop_uuid = Uuid::uuid4();

        $shop->save();

        return redirect()->route('shops.index')->with('success', 'Shop created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $shop = Shop::findOrFail($id);
        return view('shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

       
        $shop = Shop::findOrFail($id);

        $shop->shop_name = $request->shop_name;
        $shop->shop_address = $request->shop_address;


        $shop->shop_region = Province::find($request->provinsi)->name;
        $shop->shop_city = City::find($request->kota)->name;
        $shop->shop_district = District::find($request->kecamatan)->name;
        $shop->shop_subdistrict = Village::find($request->desa)->name;


        
        $shop->save();

        return redirect()->route('shops.index')->with('success', 'Shop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd('a');
        $shop = Shop::findOrFail($id);
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'Data toko berhasil dihapus');
    }





}
