<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
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
            return [
                'status' => false,
                'message' => 'NIP atau Password Salah!',
            ];
        }
        Auth::login($user);

        // Membuat token
        $token = $user->createToken('Login User')->plainTextToken;

        return [
            'status' => true,
            'message' => 'Login Berhasil',
            'data' => [
                'id' => Crypt::encrypt($user->id),
                'NIP' => $user->NIP,
                "jabatan" => $user->jabatan,
                "nama" => $user->nama,
                "role" => $user->role,
                'token' => $token
            ],
        ];
    }


    public function doStore($data)
    {
        try {
            $password = Hash::make($data['password']);
            $data['password'] = $password;
            $user = User::create($data);
            // return $user;
            if ($user) {
                return ([
                    'status' => true,
                    'message' => 'Data Berhasil Disimpan!'
                ]);
            }
        } catch (QueryException $th) {
            if ($th->errorInfo[1] == 1062) {
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
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            if ($user) {
                if (isset($data['NIP']) && $data['NIP'] != $user->NIP) {
                    if (User::where('NIP', $data['NIP'])->where('id', '!=', $id)->exists()) {
                        return [
                            'status' => false,
                            'message' => 'NIP sudah digunakan oleh pengguna lain.'
                        ];
                    }
                }

                if ($data['password']) {
                    $password = Hash::make($data['password']);
                    $data['password'] = $password;
                } else {
                    unset($data['password']);
                }
                $user->update($data);
                return ([
                    'status' => true,
                    'message' => 'Data Berhasil Diubah!'
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => 'Data Tidak Ditemukan!'
            ]);
        }
    }

    public function doDestroy($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            if ($user) {
                $user->delete();
                return ([
                    'status' => true,
                    'message' => "Data Berhasil Dihapus!"
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => "Data Tidak Ditemukan!"
            ]);
        }
    }
}