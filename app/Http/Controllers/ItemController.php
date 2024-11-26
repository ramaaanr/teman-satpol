<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ItemServices;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemServices;
    function __construct(){
        $this->itemServices = new ItemServices;
    }

    public function index (){
        $result = $this->itemServices->getAll();
        return $result;
    }
}
