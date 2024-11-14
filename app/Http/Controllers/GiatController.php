<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GiatServices;
use App\Services\PenugasanServices;
use App\Http\Resources\GiatResource;

class GiatController extends Controller
{
    protected $giatServices;
    protected $penugasanServices;
    function __construct()
    {
        $this->giatServices = new GiatServices();
        $this->penugasanServices = new PenugasanServices();
    }

    public function index()
    {
        $result = $this->giatServices->getAll();
        return $result;
    }

    public function show($id)
    {
        $results = $this->giatServices->doShow($id);
        return $results;
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
            'detail_kegiatan' => 'required',
            'tempat' => 'required',
            'kendaraan' => 'required',
            'beban_biaya' => 'required',
            'tanggal_mulai' => 'required',
            'akses_mulai' => 'required',
            'ditugaskan' => 'required|array'
        ]);
        $dataGiat = $request->except('ditugaskan');
        $dataDitugaskan = $request->input('ditugaskan');
        $giat = $this->giatServices->doStore($dataGiat);
        if ($giat) {
            foreach ($dataDitugaskan as $userId) {
                $penugasan = $this->penugasanServices->doAdd($giat->id, $userId);
            }
            return $penugasan;
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required',
            'detail_kegiatan' => 'required',
            'tempat' => 'required',
            'kendaraan' => 'required',
            'beban_biaya' => 'required',
            'tanggal_mulai' => 'required',
            'akses_mulai' => 'required',
            'ditugaskan' => 'required|array'
        ]);
        $dataGiat = $request->except('ditugaskan');
        $dataDitugaskan = $request->input('ditugaskan');
        $giat = $this->giatServices->doUpdate($dataGiat, $id);
        if ($giat) {
            $existingUsers = $giat->penugasans()->pluck('id_user')->toArray();
            // Bandingkan dengan daftar baru
            $usersToAdd = array_diff($dataDitugaskan, $existingUsers); // Data baru yang perlu ditambahkan
            $usersToRemove = array_diff($existingUsers, $dataDitugaskan); // Data lama yang perlu dihapus
            // Tambahkan pengguna baru ke tabel penugasan
            foreach ($usersToAdd as $userId) {
                $this->penugasanServices->doAdd($giat->id, $userId);
            }
            // Hapus pengguna yang tidak lagi ditugaskan
            foreach ($usersToRemove as $userId) {
                $this->penugasanServices->doDelete($giat->id, $userId);
            }
            return $giat;
        }
        // $results = $this->giatServices->doUpdate($request->all(), $id);
        // return $results;
    }

    public function destroy($id)
    {
        $results = $this->giatServices->doDestroy($id);
        return $results;
    }
}
