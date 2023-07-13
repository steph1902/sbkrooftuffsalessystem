<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Visit;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VisitController extends Controller
{
    //
    public function show($id)
    {
        $visit = Visit::findOrFail($id);      


        // dd($visit);  

        $visit = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        ->where('sales_visit.id', $id)
        ->select('sales_visit.*', 'shop.shop_name', 'shop.shop_address', 'shop.shop_region', 'shop.shop_city', 'shop.shop_district', 'shop.shop_subdistrict', 'shop.shop_googlemaps_coord', 'shop.shop_uuid')
        ->first();

        

        // $visit2 = DB::table('sales_visit')              
        // ->where('sales_visit.id', $id)
        // ->select('sales_visit.*')
        // ->first();

        // dd($visit2);
        // dd($visit);
        return view('visits.show', compact('visit'));


    }

    // public function show($location)
    // {
    //     $visit = DB::table('sales_visit')
    //         ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')
    //         ->where('sales_visit.location', $location)
    //         ->select('sales_visit.*', 'shop.shop_name', 'shop.shop_address', 'shop.shop_region', 'shop.shop_city', 'shop.shop_district', 'shop.shop_subdistrict', 'shop.shop_googlemaps_coord', 'shop.shop_uuid')
    //         ->first();

    //     return view('visits.show', compact('visit'));
    // }




    public function create($id)
    {
        $shop = Shop::findOrFail($id);
        return view('visits.create', compact('shop'));
    }

    public function store(Request $request)
    {
                
        $visit = new Visit();
        $visit->shop_id = $request->input('shop_id');
        $visit->location = $request->input('location');
        $visit->notes = $request->input('notes');
        
        
        $materials = $request->input('materials');
        $materialsString = implode(',', $materials);
        $visit->materials = $materialsString;

        $visit->sales_id = Auth::id(); 


       
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $photo->store('photos', 'public');
            
            // Add timestamp watermark to the photo
            $image = Image::make(storage_path('app/public/' . $photoPath));
            $timestamp = Carbon::now()->format('Y-m-d H:i:s');
            $image->text($timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
                $font->file(public_path('fonts/arial.ttf'));
                $font->size(22);
                $font->color('#ffffff');
                $font->align('right');
                $font->valign('bottom');
            });
            $image->save();
            
            $visit->photo = $photoPath;
        }
        
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $photoPaths = [];
    
            foreach ($photos as $photo) {
                $photoPath = $photo->store('visit-photos', 'public');
    
                // Compress the photo and add timestamp watermark
                $image = Image::make(storage_path('app/public/' . $photoPath));
                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $timestamp = Carbon::now()->format('Y-m-d H:i:s');
                $image->text($timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
                    $font->file(public_path('fonts/arial.ttf'));
                    $font->size(22);
                    $font->color('#ffffff');
                    $font->align('right');
                    $font->valign('bottom');
                });
                $image->save();
    
                $photoPaths[] = $photoPath;
            }

            $visit->photos = $photoPaths; // Assign array of photo paths
            $photosString = implode(',', $photoPaths);
            $visit->photos = $photosString;

            
        }
        
    
        $visit->save();
        dd('success');
        // return redirect()->route('shop.details', $visit->shop_id)->with('success', 'Visit recorded successfully.');

    


    }
}



