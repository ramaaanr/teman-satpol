<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\ReviewKegiatanServices;

class ReviewKegiatanController extends Controller
{
    protected $reviewKegiatanServices;
    function __construct(){
        $this->reviewKegiatanServices = new ReviewKegiatanServices;
    }
    public function update(Request $request, $id){
        $request->validate(['status' => 'required']);
        $status = $request->input('status');
        $results = $this->reviewKegiatanServices->doUpdate($status, $id);
        return $results;
    }
}
