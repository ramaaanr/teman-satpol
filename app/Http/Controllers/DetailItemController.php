<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DetailItemServices;
use Illuminate\Http\Request;

class DetailItemController extends Controller
{
    protected $detailItemService;
    function __construct(){
        $this->detailItemService = new DetailItemServices;
    }

    public function index (Request $request){
        $idPenugasan = $request->query('id_penugasan');
        $result = $this->detailItemService->getAll($idPenugasan);
        return $result;
    }
}
