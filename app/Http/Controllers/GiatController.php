<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GiatServices;
use App\Http\Resources\GiatResource;

class GiatController extends Controller
{
    protected $giatServices;
    function __construct(){
        $this->giatServices = new GiatServices();
    }

    public function index(){
        $giat = $this->giatServices->getAll();
        return response()->json([
            'Status' => true,
            'Message' => "Semua Data Giat",
            'Data' => GiatResource::collection($giat)
        ]);
    }

    public function show($id){
        $results = $this->giatServices->doShow($id);
        return $results;
    }

    public function store(Request $request){
        $request->validate([
            'kegiatan' => 'required',
            'detail_kegiatan' => 'required',
            'tempat' => 'required',
            'kendaraan' => 'required',
            'beban_biaya' => 'required',
            'tanggal_mulai' => 'required',
            'akses_mulai' => 'required',
        ]);
        $results = $this->giatServices->doStore($request->all());
        return $results;
    }

    public function update (Request $request, $id){
        $request->validate([
            'kegiatan' => 'required',
            'detail_kegiatan' => 'required',
            'tempat' => 'required',
            'kendaraan' => 'required',
            'beban_biaya' => 'required',
            'tanggal_mulai' => 'required',
            'akses_mulai' => 'required',
        ]);
        $results = $this->giatServices->doUpdate($request->all(), $id);
        return $results;
    }

    public function destroy($id){
        $results = $this->giatServices->doDestroy($id);
        return $results;
    }
}
