<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\JenisKomoditi;
use App\Models\Kecamatan;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponse;

    public function kecamatan(Request $request)
    {
        $query = Kecamatan::where('nama', 'LIKE', "%$request->search%")->get();
        if ($query->count() > 0) {
            $map = $query->map(function ($items) {
                $data['id']   = $items->id;
                $data['nama'] = $items->nama;
                return $data;
            });
        } else {
            $map = array();
        }
        if ($query)
            return $this->successResponse($map, 'Data berhasil di ambil', 200);
        else
            return $this->errorResponse(null, 'Data gagal di ambil', 400);
    }

    public function desa(Request $request)
    {
        $query = Desa::whereRaw('kecamatan_id  = '. $request->id.'')->where('nama', 'LIKE', "%$request->search%")->get();

        if ($query->count() > 0) {
            $map = $query->map(function ($items) {
                $data['id']   = $items->id;
                $data['nama'] = $items->nama;
                return $data;
            });
        } else {
            $map = array();
        }
        if ($query)
            return $this->successResponse($map, 'Data berhasil di ambil', 200);
        else
            return $this->errorResponse(null, 'Data gagal di ambil', 400);
    }

    public function jenis(Request $request)
    {
        $query = JenisKomoditi::where('nama', 'LIKE', "%$request->search%")->get();
        if ($query->count() > 0) {
            $map = $query->map(function ($items) {
                $data['id']   = $items->id;
                $data['nama'] = $items->nama;
                return $data;
            });
        } else {
            $map = array();
        }
        if ($query)
            return $this->successResponse($map, 'Data berhasil di ambil', 200);
        else
            return $this->errorResponse(null, 'Data gagal di ambil', 400);
    }
}
