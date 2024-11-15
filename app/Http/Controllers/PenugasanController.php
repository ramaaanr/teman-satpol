<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenugasanServices;
use App\Http\Controllers\Controller;

class PenugasanController extends Controller
{
    protected $penugasanServices;
    function __construct(){
        $this->penugasanServices = new PenugasanServices;
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
            'dokumen_lapangan' => 'file|mimes:jpg,jpeg,png',
            'status' => 'required',
            'id_giat' => 'required',
            'id_user' => 'required',
        ]);
        $file = $request->file('dokumen_lapangan');
        $results = $this->penugasanServices->doUpdate($request->all(), $id, $file);
        return $results;
    }

    public function destroy($id){
        $results = $this->penugasanServices->doDestroy($id);
        return $results;
    }

}
