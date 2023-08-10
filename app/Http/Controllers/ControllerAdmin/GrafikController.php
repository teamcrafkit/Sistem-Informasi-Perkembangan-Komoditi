<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\JenisKomoditi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PerkembanganKomoditi;

class GrafikController extends Controller
{
    public function index()
    {
        
        return view('pages_admin.pages_grafik.index', [
            'route' => route('data-grafik.show'),
            'jenis' => JenisKomoditi::get()
        ]);
    }

    public function show(Request $request)
    {
        
        $tanggal = explode(' / ', $request->tanggal);

        $tahun1 = Carbon::parse( $tanggal[0])->format('Y');
        $tahun2 = Carbon::parse( $tanggal[1])->format('Y');
      
        $data =  PerkembanganKomoditi::select(DB::raw("DATE_FORMAT(tanggal, '%Y') as tahun"),
            DB::raw('SUM(luas_lahan) luas_lahan'),
            DB::raw('SUM(luas_tanam) luas_tanam'),
            DB::raw('SUM(luas_panen) luas_panen'),
            DB::raw('SUM(produksi) produksi'),
            DB::raw('SUM(produktifitas) produktifitas'),
        )
        ->where([['kecamatan_id', $request->kecamatan_id], ['desa_id', $request->desa_id], ['jenis_komoditi_id', $request->jenis]])
            ->whereYear('tanggal', '>=', $tahun1)
            ->whereYear('tanggal', '<=', $tahun2)
            ->groupByRaw("DATE_FORMAT(tanggal, '%Y')")
            ->get();
 
        if ($data->count() > 0) {
            foreach ($data as $item) {
                $tahun[] = $item->tahun;
            }
            foreach ($data as $item) {
                $luas_lahan[]    = $item->luas_lahan;
                $luas_tanam[]    = $item->luas_tanam;
                $luas_panen[]    = $item->luas_panen;
                $produksi[]      = $item->produksi;
                $produktifitas[] = $item->produktifitas;
            }

            $grafik[] = ['name' => 'Luas Lahan (Ha)',        'data' => $luas_lahan];
            $grafik[] = ['name' => 'Luas Tanam (Ha)/(Ekor)', 'data' => $luas_tanam];
            $grafik[] = ['name' => 'Luas Panen (Ha)',        'data' => $luas_panen];
            $grafik[] = ['name' => 'Produksi (Ton)',         'data' => $produksi];
            $grafik[] = ['name' => 'Produktifitas (Ton/Ha)', 'data' => $produktifitas];

            return view('pages_admin.pages_grafik.show')->with([
                'data'      => $data,
                'tanggal'   => $tanggal,
                'request'   => $request,
                'kecamatan' => Kecamatan::find($request->kecamatan_id),
                'desa'      => Desa::find($request->desa_id),
                'jenis'     => JenisKomoditi::find($request->jenis),
                'grafik'    => $grafik,
                'tahun'     => $tahun,
            ]);
        } else {
            return redirect()->route('data-grafik.show')
            ->with([
                'title' => 'Error!',
                'data'  => 'Data grafik tidak ditemukan',
                'alert' => 'error',
            ]);
        }
    }
}
