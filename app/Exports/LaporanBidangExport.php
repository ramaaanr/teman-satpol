<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBidangExport implements FromArray, WithHeadings
{
    private $data;
    private $fileName = 'laporan-bidang.xlsx'; // Default nama file
    private $writerType = 'Xlsx'; // Format file (Xlsx, Csv, dll.)
    private $headers = [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    // Konstruktor untuk menerima data
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Data yang akan diekspor ke dalam file Excel
    public function array(): array
    {
        return $this->data;
    }

    // Header kolom Excel
    public function headings(): array
    {
        return ['No', 'Butir Kegiatan', 'Volume Kegiatan'];
    }

    public function exportToFile()
    {
        $fileName = 'laporan_bidang_' . now()->format('d_m_Y_Hi') . '.xlsx';
        $destinationPath = 'public/exports/' . $fileName;

        Excel::store($this, $destinationPath, 'local');

        return $destinationPath;
    }
}
