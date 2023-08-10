<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
{
    protected $table        = Desa::class;
    protected $path         = 'pages_admin.pages_desa';
    protected $routes       = 'data-desa';
    protected $field_exist  = ['kecamatan_id','nama'];

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
            'kecamatan'  => Kecamatan::get()
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
            $data                = $request->all();
            $this->table::create($data);
            return redirect()->route($this->routes . '.index')
                ->with([
                    'title' => 'Sukses!',
                    'data'  => "Data desa dengan nama {$request->nama} berhasil di simpan",
                    'alert' => 'success',
                ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => "Data desa dengan nama {$request->nama} yang anda isi sudah ada.",
                'alert' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->path . '.form')->with([
            'data'      => $this->table::findOrFail(_encdec('dec', $id)),
            'route'     => route($this->routes . '.update', $id),
            'kecamatan' => Kecamatan::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $check = $this->data_cek('edit', $request, $id);
        if ($check['status'] == TRUE) {
            $data                 = $request->all();
            $item                 = $this->table::findOrFail(_encdec('dec', $id));
            $item->update($data);
            return redirect()->route($this->routes . '.index')
                ->with([
                    'title' => 'Sukses!',
                    'data'  => "Data desa dengan nama {$request->nama} berhasil di update",
                    'alert' => 'success',
                ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => "Data desa dengan nama {$request->nama} yang anda isi sudah ada.",
                'alert' => 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        $data->delete();
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => 'Data desa dengan nama ' . $data->nama . ' berhasil di hapus',
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
        $data = $this->table::orderBy('id', 'ASC');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('kecamatan', function ($data) {
                return $data->kecamatan->nama;
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                $action .= '<form id="' . _encdec('enc', $data->id) . '"  action="' . route($this->routes . '.destroy', _encdec('enc', $data->id)) . '" method="POST" class="d-inline"> <input name="_token" type="hidden" value=' . csrf_token() . '> <input type="hidden" name="_method" value="delete"> <input type="hidden" value="' . _encdec('enc', $data->id) . '" name="id"> <a href="#" data-id="' . _encdec('enc', $data->id) . '" data-debug="' . $data->nama . '" class="btn-custom btn-delete" > <i class="fe-trash fa-lg" ></i></a> </form>';
                return $action;
            })
            ->rawColumns(['kecamatan', 'action'])
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
                if ($query[$this->field_exist[0]] == $request[$this->field_exist[0]] && $query[$this->field_exist[1]] == $request[$this->field_exist[1]]) {
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
        $query = $this->table::where($this->field_exist[0], $request[$this->field_exist[0]])
            ->where($this->field_exist[1], $request[$this->field_exist[1]])->count();
        if ($query < 1) {
            $data['status'] = TRUE;
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }
}
