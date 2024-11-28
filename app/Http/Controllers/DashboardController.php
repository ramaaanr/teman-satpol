<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashboardServices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardServices;
    function __construct(){
        $this->dashboardServices = new DashboardServices;
    }

    public function showByIdUser($id){
        $results = $this->dashboardServices->doShowByIdUser($id);
        return $results;
    }
}
