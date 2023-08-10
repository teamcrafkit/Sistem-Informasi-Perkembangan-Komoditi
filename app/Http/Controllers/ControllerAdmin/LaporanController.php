<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    Anggota,
    Desa,
    Kecamatan,
    KelompokTani,
    PerkembanganKomoditi
};

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages_admin.pages_laporan.index', [
            'route'     => route('data-laporan.show'),
        ]);
    }
    public function show(Request $request)
    {
        $tanggal = explode(' / ', $request->tanggal);
        if ($request->jenis == 'Perkembangan Komoditi') {
            $data = PerkembanganKomoditi::with('kecamatan', 'desa', 'jenis', 'kelompok')
                        ->where('kecamatan_id', '=', $request->kecamatan_id)
                        ->where('desa_id', '=', $request->desa_id)
                        ->where('status', '=', 1)
                        ->whereBetween('tanggal', [$tanggal[0], $tanggal[1]])
                        ->get();
        }elseif($request->jenis == 'Kelompok Tani'){
            $data = KelompokTani::with('kecamatan', 'desa', 'anggotakelompok')
                        ->where('kecamatan_id', '=', $request->kecamatan_id)
                        ->where('desa_id', '=', $request->desa_id)
                        ->get();
        }
        if ($data->count() > 0) {
            return view('pages_admin.pages_laporan.show')->with([
                'data'      => $data,
                'tanggal'   => $tanggal,
                'request'   => $request,
                'kecamatan' => Kecamatan::find($request->kecamatan_id),
                'desa'      => Desa::find($request->desa_id),
            ]);
        } else {
            return redirect()->route('data-laporan.show')
            ->with([
                'title' => 'Error!',
                'data'  => 'Data laporan tidak ditemukan',
                'alert' => 'error',
            ]);
        }
        return view('pages_admin.pages_laporan.show', [
            
        ]);
    }
    public function detail($id)
    {
        return view('pages_admin.pages_laporan.detail')->with([
            'data' => Anggota::with('kelompok')->where('kelompok_tani_id' ,'=', $id)->get(),
            'kelompok' => KelompokTani::find($id)
        ]);
    }   
}
