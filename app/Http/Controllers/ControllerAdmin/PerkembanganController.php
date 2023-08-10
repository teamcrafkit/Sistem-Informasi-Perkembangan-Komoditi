<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PerkembanganKomoditi;
use Yajra\DataTables\Facades\DataTables;

class PerkembanganController extends Controller
{
    protected $table        = PerkembanganKomoditi::class;
    protected $path         = 'pages_admin.pages_perkembangan_komoditi';
    protected $routes       = 'perkembangan-komoditi-admin';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . '.index')->with([
            'ajax'  => route($this->routes . '.ajax'),
        ]);
    }
 
    public function detail($id)
    {
        return view($this->path . '.detail')->with([
            'data'  => $this->table::with(['kecamatan', 'desa', 'kelompok', 'jenis'])->find(_encdec('dec',$id)),
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
            'data'  => "Data perkembangan komoditi berhasil di hapus",
            'alert' => 'success',
        ]);
    }

    /**
     * Datatables ajax serverside data
     * 
     * @return \JsonData
     */
    public function ajaxdata(Request $request)
    {
        if ($request->status != null) {
            $data = $this->table::with(['kecamatan', 'desa', 'kelompok', 'jenis'])->where('status', '=', $request->status)->orderBy('created_at', 'DESC');
        } else {
            $data = $this->table::with(['kecamatan', 'desa', 'kelompok', 'jenis'])->orderBy('created_at', 'DESC');
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jenis_komoditi', function ($data) {
                return $data->jenis->nama;
            })
            ->addColumn('nama_kelompok', function ($data) {
                return $data->kelompok->nama_kelompok;
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
                $action = '';
                if (auth()->user()->roles()->pluck('name')->implode(', ') == "Penyuluh") {
                $action .= '<a href="' . route($this->routes . '.detail', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-file fa-lg"></i></a> ';
                    if($data->status == 0){
                        $action .= '<a data-toggle="modal" data-target="#verifikasi" href="javascript:void(0);" data-id="' . $data->id . '" data-href="' . route($this->routes . '.status', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-check-square fa-lg"></i></a> ';
                    }else{
                        $action .= '<a href="javascript:void(0);"   class="btn-custom text-muted"> <i class="fe-check-square fa-lg"></i></a> ';
                    }
                }
                if (auth()->user()->can('Delete')) {
                    $action .= '<form id="' . _encdec('enc', $data->id) . '"  action="' . route($this->routes . '.destroy', _encdec('enc', $data->id)) . '" method="POST" class="d-inline"> <input name="_token" type="hidden" value=' . csrf_token() . '> <input type="hidden" name="_method" value="delete"> <input type="hidden" value="' . _encdec('enc', $data->id) . '" name="id"> <a href="#" data-id="' . _encdec('enc', $data->id) . '" data-debug="' . $data->no_proposal . '" class="btn-custom btn-delete" > <i class="fe-trash fa-lg" ></i></a> </form>';
                }
                return $action;
            })
            ->rawColumns(['jenis_komoditi','status', 'action'])
            ->toJson();
    }

    /**
     * Set status show/hide images
     * 
     * @return success response
     */

    public function status(Request $request)
    {
        $data         = $this->table::findOrFail(_encdec('dec', $request->id));
        $data->status = 1;
        $data->save();
        return redirect()->route($this->routes . '.index')
                    ->with([
                        'title' => 'Sukses!',
                        'data'  => "Data perkembangan komoditi berhasil di verifikasi",
                        'alert' => 'success',
                    ]);
    }
}
