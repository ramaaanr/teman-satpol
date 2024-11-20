<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LaporanBidangServices;
use Illuminate\Http\Request;

class LaporanBidangController extends Controller
{
    protected $laporanBidangServices;
    function __construct()
    {
        $this->laporanBidangServices = new LaporanBidangServices;
    }

    public function show(Request $request)
    {
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');
        $userId = $request->query('id_user');
        $itemId = $request->query('id_item');
        $results = $this->laporanBidangServices->doShow($tahun, $bulan, $userId, $itemId);
        return $results;
    }

    public function export(Request $request)
    {
        $tahun = $request->query('tahun'); // Ambil query param tahun
        $bulan = $request->query('bulan'); // Ambil query param bulan
        try {
            // Panggil services untuk proses export dan penyimpanan file
            $results = $this->laporanBidangServices->exportLaporanBidang($tahun, $bulan);
            return $results;
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengekspor laporan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
