<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    protected $userServices;
    function __construct(){
        $this->userServices = new UserServices();
    }

    public function index (){
        $users = $this->userServices->getAll();
        return UserResource::collection($users);    
    }

    public function store (Request $request){
        $request->validate([
            'nama' => 'required',
            'NIP' => 'required',
            'jabatan' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
        $result = $this->userServices->doStore($request->all());
        return response()->json($result);
    }

    public function update (Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'NIP' => 'required',
            'jabatan' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
        $result = $this->userServices->doUpdate($request->all(), $id);
        return response()->json($result);
    }

    public function destroy ($id){
        $result = $this->userServices->doDestroy($id);
        return response()->json($result);
    }

    public function login (Request $request){
        $request->validate([
            'NIP' => 'required',
            'password' => 'required'
        ]);
        $result = $this->userServices->doLogin($request->NIP, $request->password);
        return response()->json($result);
    }

    public function logout(Request $request){
        $request->user()->currentAccesstoken()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'token Has Been Revoke'
        ]);
    }


}
