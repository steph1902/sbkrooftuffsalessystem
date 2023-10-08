<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesAuthController;
use App\Models\User;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PasswordGenerationController;

// use App\Http\Controllers\SuperAdminController;





Route::get('/', function () {
    return view('welcome');
});


Route::resource('shops', ShopController::class);
Route::resource('sales', SalesController::class);


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);





Route::get('provinces', [DependantDropdownController::class,'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class,'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class,'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class,'villages'])->name('villages');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






Route::get('/assign-sales-to-shop', [SalesController::class, 'showAssignSalesToShopForm'])->name('assign.sales.to.shop');
Route::post('/assign-sales-to-shop/save', [SalesController::class, 'assignSalesToShop'])->name('assign.sales.to.shop.save');
Route::get('/search-shops', [SalesController::class, 'searchShops'])->name('search.shops');



Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.details');


Route::get('/shops/{id}/visits/create', [VisitController::class, 'create'])->name('visits.create');
Route::post('/shops/{id}/visits', [VisitController::class, 'store'])->name('visits.store');


Route::get('visits/{location}', [VisitController::class, 'show'])
    ->name('visits.show');


// Route::get('/report/{token}', [ReportController::class, 'index'])->name('report.index');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/report/export', [ReportController::class, 'export'])->name('report.export');



// Route::get('/sales-passwords', 'PasswordGenerationController@showSalesPasswords');
Route::get('/generate-sales-passwords', [PasswordGenerationController::class, 'generatePasswords']);
Route::get('/sales-passwords', [PasswordGenerationController::class, 'showSalesPasswords']);








// Route::middleware('auth')->group(function () {
//     Route::get('/sales/dashboard', [SalesController::class, 'dashboard'])->name('sales.dashboard');
// });




// 
// sales table:
// id
// nik
// nama
// tempat_lahir
// tanggal_lahir
// alamat_ktp
// alamat_domisili
// nomor_handphone
// email
// username
// password
// created_at
// updated_at
// user_id

// shop table:
// id
// shop_name
// shop_address
// shop_region
// shop_city
// shop_district
// shop_subdistrict
// shop_googlemaps_coord
// shop_uuid
// created_at
// updated_at
// deleted_at

// sales_shop table:
// id
// salesperson_id
// shop_id
// created_at
// updated_at


// the flow is like this:
// 1. user sales login (I finished the login part)
// 2. successful login will direct user with role sales to sales dashboard (finished)
// 3. I need your help from this part to write full code, views with table, controller and route to show the sales list of assigned shops
// 4. the list of the shop if clicked will go to shop details page information, please provide nice UI to it, along with the other necessary code



// 



// http://127.0.0.1:8000/shops/30/visits/create
// tambahan marketing material
// - sticker mobil
// - sample renceng
// - pas upload kompresi dulu fotonya
// - foto tampak toko (depan)
// - foto lain-lain (bisa banyak)
// - 1 sales bisa ke toko yang sama berkali2
// - 3 terakhir last visit (yang di tabel master)
// - data terakhir last visit (yang di tabel detail) (semua)
// - compres kecil fotonya utk foto marketing material 20-50kb 
// - foto toko depan 100kb
// - watermark foto tanggal, waktu, lokasi
// - foto toko tampak depan (sifatnya update)




// - sticker mobil
// - sample renceng