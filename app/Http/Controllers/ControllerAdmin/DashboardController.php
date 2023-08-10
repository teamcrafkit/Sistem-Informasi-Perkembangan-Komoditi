<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JenisKomoditi;
use App\Models\KelompokTani;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages_admin.pages_dashboard.index')->with([
            'count_1'  => Kecamatan::count(),
            'count_2'  => Desa::count(),
            'count_3'  => JenisKomoditi::count(),
            'count_4'  => KelompokTani::count(),
        ]);
    }
}
