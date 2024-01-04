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

        $visit = DB::table('sales_visit')
        ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
        ->where('sales_visit.id', $id)
        ->select('sales_visit.*', 
        'shop.shop_name', 
        'shop.shop_address', 
        'shop.provinsi', 
        'shop.kota', 
        'shop.kecamatan', 
        'shop.kelurahan', 
        'shop.shop_googlemaps_coord', 
        'shop.shop_uuid')
        ->first();

        return view('visits.show', compact('visit'));

    }

    public function showVisitedStoreData()
    {
        $userId = Auth::user()->id;
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

       return view('visits.data', compact('visitedShops'));
    }


    public function create($id)
    {
        $shop = Shop::findOrFail($id);
        return view('visits.create', compact('shop'));
    }

    // public function store(Request $request)
    // {
                
        
    //     $visit = new Visit();
    //     $visit->shop_id = $request->input('shop_id');
    //     $visit->location = $request->input('location');
    //     $visit->notes = $request->input('notes');
        
        
    //     $materials = $request->input('materials');
    //     $materialsString = implode(',', $materials);
    //     $visit->materials = $materialsString;

    //     $visit->sales_id = Auth::id(); 


    // //    dd($request);
    //     if ($request->hasFile('photo')) {
    //         // dd('b');
    //         $photo = $request->file('photo');
    //         $photoPath = $photo->store('photos', 'public');
            
    //         // Add timestamp watermark to the photo
    //         $image = Image::make(storage_path('app/public/' . $photoPath));
    //         $timestamp = Carbon::now()->format('Y-m-d H:i:s');
    //         $image->text($timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
    //             $font->file(public_path('fonts/arial.ttf'));
    //             $font->size(22);
    //             $font->color('#ffffff');
    //             $font->align('right');
    //             $font->valign('bottom');
    //         });
    //         $image->save();
            
    //         $visit->photo = $photoPath;
    //     }

    //     // dd($image);

    //     // dd($photoPath);
        
    //     if ($request->hasFile('photos')) {
    //         // dd('c');
    //         $photos = $request->file('photos');
    //         $photoPaths = [];
    
    //         foreach ($photos as $photo) {
    //             $photoPath = $photo->store('visit-photos', 'public');
    
    //             // Compress the photo and add timestamp watermark
    //             $image = Image::make(storage_path('app/public/' . $photoPath));
    //             $image->resize(800, null, function ($constraint) {
    //                 $constraint->aspectRatio();
    //                 $constraint->upsize();
    //             });
    //             $timestamp = Carbon::now()->format('Y-m-d H:i:s');
    //             $image->text($timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
    //                 $font->file(public_path('fonts/arial.ttf'));
    //                 $font->size(22);
    //                 $font->color('#ffffff');
    //                 $font->align('right');
    //                 $font->valign('bottom');
    //             });
    //             $image->save();
    
    //             $photoPaths[] = $photoPath;
    //         }

    //         $visit->photos = $photoPaths; // Assign array of photo paths
    //         $photosString = implode(',', $photoPaths);
    //         $visit->photos = $photosString;

            
    //     }


        
    
    //     $visit->save();

    //     // dd($visit);
        
    //     return redirect()->route('visits.show', $visit->id);
    //     // dd('success');
    //     // return redirect()->route('shop.details', $visit->shop_id)->with('success', 'Visit recorded successfully.');

    


    // }


    public function store(Request $request)
    {

        $this->request = $request; // Tambahkan baris ini di awal metode store

        $stringSales = 'di isikan menyusul';


        $visit = new Visit();
        $visit->shop_id = $request->input('shop_id');
        // $visit->location = $request->input('location');
        $visit->location = $request->input('address'); // Menggunakan alamat dari form

        $visit->notes = $stringSales;

        $materials = $request->input('materials');
        // $materialsString = implode(',', $materials);
        $visit->materials = $stringSales;

        $visit->sales_id = Auth::id();

        // Upload and stamp the main photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoPath = $this->uploadAndStampPhoto($photo, 'photos');
            $visit->photo = $photoPath;
        }

        $visit->save();

        return redirect()->route('visits.show', $visit->id);
    }

    private function uploadAndStampPhoto($photo, $folder)
    {        
        // working old code

        // /
        $photoPath = $photo->store($folder, 'public');        
        $image = Image::make(storage_path('app/public/' . $photoPath));
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $location = $this->request->input('address'); // Menggunakan $this->request

        $image->text($location . ' - ' . $timestamp, $image->width() - 10, $image->height() - 10, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(14);
            $font->color('#ffffff');
            $font->align('right');
            $font->valign('bottom');
        });
        $image->save();

        return $photoPath;

        // /

        // working old code



        // $photoPath = $photo->store($folder, 'public');

        // // Stamp the photo with location and timestamp
        // $image = Image::make(storage_path('app/public/' . $photoPath));

        // $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        // $location = $this->request->input('address'); // Menggunakan $this->request

        // // Menyesuaikan ukuran teks berdasarkan lebar foto
        // $textWidth = $image->width() * 0.8; // Misalnya, teks akan mengambil 80% dari lebar foto
        // $fontSize = 22;

        // do {
        //     $fontSize--;
        //     $font = $image->text($location . ' - ' . $timestamp, $image->width() - 10, $image->height() - 10, function ($font) use ($fontSize) {
        //     $font->file(public_path('fonts/arial.ttf'));
        //     $font->size($fontSize);
        //     $font->color('#ffffff');
        //     $font->align('right');
        //     $font->valign('bottom');
        // });
        //     $textWidth = $font->width();
        // } 
        // while ($textWidth > $image->width() * 0.8); // Ulangi hingga ukuran teks sesuai

        // $image->save();

        // return $photoPath;


    //     $photoPath = $photo->store($folder, 'public');

    // // Stamp the photo with location and timestamp
    // $image = Image::make(storage_path('app/public/' . $photoPath));

    // $timestamp = Carbon::now()->format('Y-m-d H:i:s');
    // $location = $this->request->input('address'); // Menggunakan $this->request

    // // Menghitung ukuran teks dengan ukuran font 22
    // $font = function ($font) {
    //     $font->file(public_path('fonts/arial.ttf'));
    //     $font->size(22);
    // };

    // $textWidth = $image->textWidth($location . ' - ' . $timestamp, $font);

    // // Menyesuaikan ukuran font sesuai batas
    // $fontSize = $textWidth > 0 ? (int)($image->width() * 0.8 / $textWidth * 22) : 22;
    // $font = function ($font) use ($fontSize) {
    //     $font->file(public_path('fonts/arial.ttf'));
    //     $font->size($fontSize);
    //     $font->color('#ffffff');
    //     $font->align('right');
    //     $font->valign('bottom');
    // };

    // $image->text($location . ' - ' . $timestamp, $image->width() - 10, $image->height() - 10, $font);
    // $image->save();

    // return $photoPath;

    // $photoPath = $photo->store($folder, 'public');

    // // Stamp the photo with location and timestamp
    // $image = Image::make(storage_path('app/public/' . $photoPath));

    // $timestamp = Carbon::now()->format('Y-m-d H:i:s');
    // $location = $this->request->input('address'); // Menggunakan $this->request

    // // Menyesuaikan ukuran teks berdasarkan lebar foto
    // $text = $location . ' - ' . $timestamp;
    // $textWidthLimit = $image->width() * 0.8; // Misalnya, teks akan mengambil 80% dari lebar foto
    // $fontSize = (int)($image->width() * 0.8 / $image->text($text, 0, 0, function ($font) {
    //     $font->file(public_path('fonts/arial.ttf'));
    //     $font->size(22);
    // })->width($text));

    // $font = function ($font) use ($fontSize) {
    //     $font->file(public_path('fonts/arial.ttf'));
    //     $font->size($fontSize);
    //     $font->color('#ffffff');
    //     $font->align('right');
    //     $font->valign('bottom');
    // };

    // // Mengatur ukuran font yang sesuai
    // $image->text($text, $image->width() - 10, $image->height() - 10, $font);

    // $image->save();

    // return $photoPath;


    // $photoPath = $photo->store($folder, 'public');

    // // Stamp the photo with location and timestamp
    // $image = Image::make(storage_path('app/public/' . $photoPath));

    // $timestamp = Carbon::now()->format('Y-m-d H:i:s');
    // $location = $this->request->input('address'); // Menggunakan $this->request

    // // Menyesuaikan ukuran teks berdasarkan lebar foto
    // $text = $location . ' - ' . $timestamp;
    // $textWidthLimit = $image->width() * 0.8; // Misalnya, teks akan mengambil 80% dari lebar foto
    // $fontSize = 22;

    // do {
    //     $font = function ($font) use ($fontSize) {
    //         $font->file(public_path('fonts/arial.ttf'));
    //         $font->size($fontSize);
    //     };

    //     $textWidth = $image->text($text, 0, 0, $font)->width($text);

    //     // Cek apakah ukuran teks sudah sesuai
    //     if ($textWidth <= $textWidthLimit) {
    //         break;
    //     }

    //     // Jika ukuran teks terlalu besar, kurangi ukuran font
    //     $fontSize--;
    // } while ($fontSize > 0);

    // $font = function ($font) use ($fontSize) {
    //     $font->file(public_path('fonts/arial.ttf'));
    //     $font->size($fontSize);
    //     $font->color('#ffffff');
    //     $font->align('right');
    //     $font->valign('bottom');
    // };

    // // Mengatur ukuran font yang sesuai
    // $image->text($text, $image->width() - 10, $image->height() - 10, $font);

    // $image->save();

    // return $photoPath;



    }






}



