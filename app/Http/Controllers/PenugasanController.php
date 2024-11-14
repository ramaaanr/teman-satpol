<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenugasanServices;
use App\Http\Controllers\Controller;
use App\Services\DetailItemServices;

class PenugasanController extends Controller
{
    protected $penugasanServices;
    protected $detailItemServices;
    function __construct(){
        $this->penugasanServices = new PenugasanServices;
        $this->detailItemServices = new DetailItemServices;
    }
    public function index (Request $request){
        $idGiat = $request->query('id_giat');
        $idUser = $request->query('id_user');
        $results = $this->penugasanServices->getAll($idGiat, $idUser);
        return $results;
    }

    public function show ($id){
        $results = $this->penugasanServices->doShow($id);
        return $results;
    }

    public function update (Request $request, $id){
        $request->validate([
            'durasi' => 'required',
            'detail' => 'required',
            'dokumen_lapangan' => 'required|file|mimes:jpg,jpeg,png',
            'status' => 'required',
            'id_giat' => 'required',
            'id_user' => 'required',
            'item' => 'required|array'
        ]);
        $dataPenugasan = $request->except('item');
        $dataItem = $request->input('item');
        $file = $request->file('dokumen_lapangan');
        $penugasan = $this->penugasanServices->doUpdate($dataPenugasan, $id, $file);
        if ($penugasan) {
            foreach ($dataItem as $itemId) {
                $this->detailItemServices->doAdd($penugasan->id, $itemId);
            }
            return ([
                'status' => true,
                'message' => "Data Berhasil Diubah!"
            ]);
        } 
        return ([
            'status' => false,
            'message' => "Data Gagal Diubah!"
        ]);
    }

    public function destroy($id){
        $results = $this->penugasanServices->doDestroy($id);
        return $results;
    }

}
