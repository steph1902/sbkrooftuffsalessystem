<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $reportData;

    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    public function collection()
    {
        //
        return $this->reportData;

    }
    public function headings(): array
    {
        return [
            'id',
            // 'shop_id',
            'visit_date',
            'location',
            'created_at',
            // 'updated_at',
            'materials',
            'photo',
            'photos',
            'notes',
            'sales_id',
            'shop_name',
            'shop_address',
            'shop_region',
            'shop_city',
            'shop_district',
            'shop_subdistrict',
            // 'shop_googlemaps_coord',
            // 'shop_uuid',
            // 'deleted_at',
            // 'nik',
            'nama',
            // 'tempat_lahir',
            // 'tanggal_lahir',
            // 'alamat_ktp',
            // 'alamat_domisili',
            'nomor_handphone',
            'email',
            'username',
            // 'password',
            // 'user_id',
        ];
    }
}



