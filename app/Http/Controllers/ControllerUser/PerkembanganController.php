<?php

namespace App\Http\Controllers\ControllerUser;

use Illuminate\Http\Request;
use App\Models\JenisKomoditi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PerkembanganKomoditi;
use Yajra\DataTables\Facades\DataTables;

class PerkembanganController extends Controller
{
    protected $table        = PerkembanganKomoditi::class;
    protected $path         = 'pages_user.pages_perkembangan';
    protected $routes       = 'perkembangan-komoditi';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startDate = Carbon::now();
        $firstDate = $startDate->startOfMonth()->format('Y-m-d');
        $lastDate  = $startDate->lastOfMonth()->format('Y-m-d');
        return view('pages_user.pages_perkembangan.index')->with([
            'ajax' => route($this->routes.'.ajax'),
            'firstDate'  => $firstDate,
            'lastDate'   => $lastDate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . '.form')->with([
            'route' => route($this->routes . '.store'),
            'jenis' =>JenisKomoditi::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data                       = $request->all();
        $data['kecamatan_id']       = auth()->user()->kecamatan_id;
        $data['desa_id']            = auth()->user()->desa_id;
        $data['kelompok_tani_id']   = auth()->user()->id;
        $this->table::create($data);
        return redirect()->route($this->routes . '.index')
            ->with([
                'title' => 'Sukses!',
                'data'  => 'Perkembangan komoditi berhasil di tambahkan.',
                'alert' => 'success',
            ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PerkembanganKomoditi  $perkembanganKomoditi
     * @return \Illuminate\Http\Response
     */
    public function show(PerkembanganKomoditi $perkembanganKomoditi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PerkembanganKomoditi  $perkembanganKomoditi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        return view($this->path . '.form')->with([
            'data'  => $data,
            'route' => route($this->routes . '.update', $id),
            'jenis' => JenisKomoditi::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PerkembanganKomoditi  $perkembanganKomoditi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = $this->table::findOrFail(_encdec('dec', $id));
        $item->update($data);
        return redirect()->route($this->routes . '.index')
            ->with([
                'title' => 'Sukses!',
                'data'  => "Perkembangan komoditi berhasil di update",
                'alert' => 'success',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PerkembanganKomoditi  $perkembanganKomoditi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        $data->delete();
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => 'Perkembangan komoditi berhasil di hapus',
            'alert' => 'success',
        ]);
    }

    public function ajaxdata(Request $request)
    {
        if (!empty($request->tanggal)) {
            $tanggal   = explode(' / ', $request->tanggal);
            $firstDate = $tanggal[0];
            $lastDate  = $tanggal[1];
        } else {
            $startDate = Carbon::now();
            $firstDate = $startDate->firstOfMonth()->format('Y-m-d');
            $lastDate  = $startDate->lastOfMonth()->format('Y-m-d');
        }
        $data = PerkembanganKomoditi::with(['kecamatan', 'desa', 'kelompok', 'jenis'])
                        ->where('kelompok_tani_id', '=', auth()->user()->id)
                        ->whereBetween('tanggal', [$firstDate, $lastDate])
                        ->orderBy('id', 'desc');
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jenis_komoditi', function ($data){
                return $data->jenis->nama;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    $status = '<a href="javascript:void(0);" class="btn btn-danger btn-block btn-xs">Belum Verifikasi </a>';
                } else {
                    $status = '<a href="javascript:void(0);" class="btn btn-success btn-block btn-xs">Sudah Verifikasi </a>';
                }
                return $status;
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                $action .= '<form id="' . _encdec('enc', $data->id) . '"  action="' . route($this->routes . '.destroy', _encdec('enc', $data->id)) . '" method="POST" class="d-inline"> <input name="_token" type="hidden" value=' . csrf_token() . '> <input type="hidden" name="_method" value="delete"> <input type="hidden" value="' . _encdec('enc', $data->id) . '" name="id"> <a href="#" data-id="' . _encdec('enc', $data->id) . '" data-debug="' . $data->nama . '" class=" btn-delete btn-custom" > <i class="fe-trash fa-lg" ></i></a> </form>';
                return $action;
            })
            ->rawColumns(['status','jenis_komoditi','action'])
            ->toJson();
        
    }
}
