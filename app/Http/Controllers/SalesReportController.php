<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Shop; // Sesuaikan dengan model toko Anda

// use Illuminate\Http\Request;

// use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\Visit;
use Carbon\Carbon; // Untuk bekerja dengan tanggal
use App\Models\SalesVisit;




class SalesReportController extends Controller
{
    //
    

    // 
    // 
    public function showSalesReport(Request $request)
    {
        // Step 1: Mengambil bulan dan tahun dari permintaan
        $bulan = $request->input('bulan', date('m')); // Default ke bulan saat ini jika tidak ada input
        $tahun = $request->input('tahun', date('Y')); // Default ke tahun saat ini jika tidak ada input

        // Dapatkan tanggal awal dan akhir dari bulan yang dipilih
        // $tanggal_awal = Carbon::create($tahun, $bulan, 1, 0, 0, 0);
        // $tanggal_akhir = $tanggal_awal->endOfMonth();

        // Perbarui jumlah hari berdasarkan bulan dan tahun
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $dates = range(1, $jumlah_hari);

        // Mengambil data toko dari database berdasarkan nama sales yang sedang login
        $user = Auth::user();
        $userName = $user->name;
        $userId = $user->id;
        $shops = DB::table('shop')->where('nama_sales', $userName)->get();

        // Ambil bulan dan tahun yang dipilih oleh pengguna dari permintaan
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Dapatkan tanggal awal dan akhir dari bulan yang dipilih
        $tanggal_awal = "$tahun-$bulan-01";
        $tanggal_akhir = "$tahun-$bulan-" . date('t', strtotime($tanggal_awal));

        // Mengambil data kunjungan penjualan untuk bulan dan tahun yang dipilih
        $kunjungan = DB::table('sales_visit')
            ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
            ->where('sales_visit.sales_id', $userId)
            ->whereBetween('sales_visit.created_at', [$tanggal_awal, $tanggal_akhir])
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

        // Membuat matriks laporan dengan tanggal dan toko
        $report = [];
        foreach ($dates as $date) {
            $report[$date] = [];
            foreach ($shops as $shop) {
                $report[$date][$shop->shop_name] = false; // Awalnya tidak ada kunjungan
                foreach ($kunjungan as $visit) {
                    $visit_date = date('j', strtotime($visit->created_at)); // Mengambil tanggal kunjungan
                    if ($visit_date == $date && $visit->shop_id == $shop->id) {
                        $report[$date][$shop->shop_name] = true; // Ada kunjungan pada tanggal dan toko tersebut
                        break; // Kita sudah menemukan kunjungan, lanjutkan ke tanggal berikutnya
                    }
                }
            }
        }


        // // Hitung total toko yang belum dikunjungi pada bulan Oktober
        // $totalTokoBelumDikunjungi = Shop::whereDoesntHave('sales_visit', function ($query) use ($tahun, $bulan) {
        //     $query->whereYear('visit_date', $tahun)->whereMonth('visit_date', $bulan);
        // })->count();

        // // Hitung total toko yang sudah dikunjungi pada bulan Oktober
        // $totalTokoSudahDikunjungi = Shop::whereHas('sales_visit', function ($query) use ($tahun, $bulan) {
        //     $query->whereYear('visit_date', $tahun)->whereMonth('visit_date', $bulan);
        // })->count();

        // Hitung total toko yang belum dikunjungi pada bulan Oktober
    // $totalTokoBelumDikunjungi = Shop::whereDoesntHave('sales_visits', function ($query) use ($tahun, $bulan) {
    //     $query->whereYear('visit_date', $tahun)->whereMonth('visit_date', $bulan);
    // })->count();

    // // Hitung total toko yang sudah dikunjungi pada bulan Oktober
    // $totalTokoSudahDikunjungi = Shop::whereHas('sales_visits', function ($query) use ($tahun, $bulan) {
    //     $query->whereYear('visit_date', $tahun)->whereMonth('visit_date', $bulan);
    // })->count();



        // Mengirim data ke tampilan
        return view('report.sales-report', compact('dates', 'shops', 'report', 'bulan', 'tahun'));
    }



}
