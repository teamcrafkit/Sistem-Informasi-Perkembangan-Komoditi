<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Yajra\DataTables\Facades\DataTables;

class KelompokTaniController extends Controller
{
    protected $table        = KelompokTani::class;
    protected $path         = 'pages_admin.pages_kelompok_tani';
    protected $routes       = 'data-kelompok-tani';
    protected $field_exist  = ['email','nama_kelompok'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . '.index')->with([
            'route' => route($this->routes . '.create'),
            'ajax'  => route($this->routes . '.ajax'),
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
            'kecamatan' => Kecamatan::get(),
            'desa' => Desa::get()
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
        $check = $this->data_cek('create', $request, $id = "");
        if ($check['status'] == TRUE) {
            $data             = $request->except(['password_confirmation']);
            $data['password'] = bcrypt($request->password);
            $poktan = $this->table::create($data);
            event(new Registered($poktan));
            return redirect()->route($this->routes . '.index')
                ->with([
                    'title' => 'Sukses!',
                    'data'  => "Data kelompok tani dengan nama kelompok {$request->nama_kelompok} berhasil di simpan",
                    'alert' => 'success',
                ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => "Data kelompok tani dengan nama kelompok / email yang anda masukkan sudah ada.",
                'alert' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KelompokTani  $kelompokTani
     * @return \Illuminate\Http\Response
     */
    public function show(KelompokTani $kelompokTani)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelompokTani  $kelompokTani
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        return view($this->path . '.form')->with([
            'data'  => $data,
            'route' => route($this->routes . '.update', $id),
            'kecamatan' => Kecamatan::get(),
            'desa' => Desa::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KelompokTani  $kelompokTani
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data  = $request->except(['password_confirmation']);
        $check = $this->data_cek('edit', $request, $id);
        if ($check['status'] == TRUE) {
            $item                = $this->table::findOrFail(_encdec('dec', $id));
            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            } else {
                $data['password'] = $item->password;
            }
            $item->update($data);
            return redirect()->route($this->routes . '.index')
                ->with([
                    'title' => 'Sukses!',
                    'data'  => "Data kelompok tani dengan nama kelompok {$request->nama_kelompok} berhasil di update",
                    'alert' => 'success',
                ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => "Data kelompok tani dengan nama kelompok / email yang anda masukkan sudah ada.",
                'alert' => 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelompokTani  $kelompokTani
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        $data->delete();
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => "Data jenis komoditi dengan nama {$data->nama} berhasil di hapus",
            'alert' => 'success',
        ]);
    }

    /**
     * Datatables ajax serverside data
     * 
     * @return \JsonData
     */
    public function ajaxdata()
    {
        $data = $this->table::with(['kecamatan','desa', 'anggotakelompok'])->orderBy('id', 'ASC');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_kecamatan',function($data){
                return $data->kecamatan->nama;
            })
            ->addColumn('nama_desa',function($data){
                return $data->desa->nama;
            })
            ->addColumn('email_verified',function($data){
                return $data->email_verified_at == NULL ? '<span class="btn btn-block btn-xs btn-danger">Belum Verifikasi</span>' : '<span class="btn btn-xs btn-block btn-success">Sudah Verifikasi</span>';
            })
            ->addColumn('jumlah_anggota',function($data){
                return $data->anggotakelompok->count();
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                $action .= '<form id="' . _encdec('enc', $data->id) . '"  action="' . route($this->routes . '.destroy', _encdec('enc', $data->id)) . '" method="POST" class="d-inline"> <input name="_token" type="hidden" value=' . csrf_token() . '> <input type="hidden" name="_method" value="delete"> <input type="hidden" value="' . _encdec('enc', $data->id) . '" name="id"> <a href="#" data-id="' . _encdec('enc', $data->id) . '" data-debug="' . $data->nama_kelompok . '" class=" btn-delete btn-custom" > <i class="fe-trash fa-lg" ></i></a> </form>';
                return $action;
            })
            ->rawColumns(['nama_kecamatan', 'nama_desa', 'email_verified', 'jumlah_anggota','action'])
            ->toJson();
    }

    /**
     * Data check input or edit
     * 
     * @param action input and edit
     * @return true or false
     */
    protected function data_cek($action, $request, $id)
    {
        if ($action == "create") {
            $data = $this->data_exist($request);
        } elseif ($action == "edit") {
            $query = $this->table::find(_encdec('dec', $id))->toArray();
            if (count($query) > 0) {
                if ($query[$this->field_exist[0]] == $request[$this->field_exist[0]] || $query[$this->field_exist[1]] == $request[$this->field_exist[1]]) {
                    $data['status'] = TRUE;
                } else {
                    $data = $this->data_exist($request);
                }
            }
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }
    /**
     * Check data exist on the table
     * 
     * @param value 
     * @return true or false
     */
    protected function data_exist($request)
    {
        $query = $this->table::where($this->field_exist[0], $request[$this->field_exist[0]])->orWhere($this->field_exist[1], $request[$this->field_exist[1]])
            ->count();
        if ($query < 1) {
            $data['status'] = TRUE;
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }
}
