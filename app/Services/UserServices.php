<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserServices
{
    public function getAll()
    {
        $users = User::all();
        return $users;
    }

    public function doLogin($NIP, $password)
    {
        $user = User::where('NIP', $NIP)->first();
        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'Status' => false,
                'Message' => 'NIP atau Password Salah!',
            ]);
        }
        $token = $user->createToken('Login User')->plainTextToken;
        return response()->json([
            'Status' => true,
            'Message' => "Login Berhasil",
            'Token' => $token
        ]);
    }

    public function doStore($data)
    {
        try {
            $password = Hash::make($data['password']);
            $data['password'] = $password;
            $user = User::create($data);
            // return $user;
            if ($user){
                return ([
                    'Status' => true,
                    'Message' => 'Data Berhasil Disimpan!'
                ]);
            }
        } catch (QueryException $th) {
            if ($th->errorInfo[1] == 1062){
                return ([
                    'status' => false,
                    'message' => "NIP sudah terdaftar!"
                ]);
            }
            return response([
                'status' => false,
                'message' => 'Terjadi kesalahan dalam menyimpan data!'
            ]);
        }
    }

    public function doUpdate($data, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                if (isset($data['NIP']) && $data['NIP'] != $user->NIP) {
                    if (User::where('NIP', $data['NIP'])->where('id', '!=', $id)->exists()) {
                        return [
                            'Status' => false,
                            'Message' => 'NIP sudah digunakan oleh pengguna lain.'
                        ];
                    }
                }
                $user->update($data);
                return ([
                    'Status' => true,
                    'Message' => 'Data Berhasil Diubah!'
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'Status' => false,
                'Message' => 'Data Tidak Ditemukan!'
            ]);
        }
    }

    public function doDestroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                $user->delete();
                return ([
                    'Status' => true,
                    'Message' => "Data Berhasil Dihapus!"
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'Status' => false,
                'Message' => "Data Tidak Ditemukan!"
            ]);
        }
    }
}
