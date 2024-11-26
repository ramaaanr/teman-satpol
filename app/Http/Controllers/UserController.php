<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userServices;
    function __construct()
    {
        $this->userServices = new UserServices();
    }

    public function index()
    {
        $users = $this->userServices->getAll();
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'NIP' => 'required',
            'jabatan' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
        $result = $this->userServices->doStore($request->all());
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'NIP' => 'required',
            'jabatan' => 'required',
            'role' => 'required',
        ]);
        $result = $this->userServices->doUpdate($request->all(), $id);
        return response()->json($result);
    }

    public function destroy($id)
    {
        $result = $this->userServices->doDestroy($id);
        return response()->json($result);
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'NIP' => 'required',
            'password' => 'required',
        ]);

        $result = $this->userServices->doLogin($request->NIP, $request->password);        // Coba autentikasi dengan sesi
        $request->session()->regenerate();  // Regenerasi sesi untuk keamanan

        return response()->json($result);
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccesstoken()->delete();
        // Logout the user

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate CSRF token to avoid session fixation
        $request->session()->regenerateToken();
        return response()->json([
            'status' => 200,
            'message' => 'token Has Been Revoke',
        ]);
    }
}