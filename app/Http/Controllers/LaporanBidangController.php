<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LaporanBidangServices;
use Illuminate\Http\Request;

class LaporanBidangController extends Controller
{
    protected $laporanBidangServices;
    function __construct(){
        $this->laporanBidangServices = new LaporanBidangServices;
    }

    public function show(Request $request){
        $tahun = $request->query('tahun');
        $bulan = $request->query('bulan');
        $results = $this->laporanBidangServices->doShow($tahun, $bulan);
        return $results;
    }
}
