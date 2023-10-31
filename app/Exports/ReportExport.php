<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromCollection, WithStyles, WithColumnFormatting, WithDefaultStyles, ShouldAutoSize, WithHeadings
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
    
    public function styles(Worksheet $sheet)
    {        
        return [

            1    => ['font' => ['bold' => true]],
            
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
    public function defaultStyles(Style $defaultStyle)
    {
        return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);
    }

    public function headings(): array
    {
        return [
            'Unique Id.',
            'Nama Sales',
            'Nama Toko',
            'Alamat Toko',
            'Kota',
            // 'Foto Toko Depan',
            'Kunjungan Terakhir',
            
        ];
    }

    private function formatTanggal($data)
    {        
        $formattedDates = [];
        $kunjunganTerakhir = $data->kunjungan_terakhir; // Gantilah dengan atribut yang sesuai di model Anda

        // Pastikan ada data dalam array kunjungan terakhir
        if (is_array($kunjunganTerakhir) && count($kunjunganTerakhir) > 0) {
            $count = min(count($kunjunganTerakhir), 3); // Ambil maksimal 3 data kunjungan terakhir
            $kunjunganTerakhir = array_slice($kunjunganTerakhir, 0, $count);

            foreach ($kunjunganTerakhir as $tanggal) {
                $formattedDates[] = Carbon::parse($tanggal)->format('l, d F Y');
            }
        }

        return implode(', ', $formattedDates);
    }




}



