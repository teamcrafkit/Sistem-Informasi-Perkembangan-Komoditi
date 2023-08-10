<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PerizinanController extends Controller
{
    protected $table  = Permission::class;
    protected $path   = 'pages_admin.pages_perizinan';
    protected $routes = 'perizinan';
    protected $field_exist  = ['name'];
    
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
            'route' => route($this->routes . '.store')
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
        $data = $request->all();
        $check = $this->data_cek('create', $request, $id = "");
        if ($check['status'] == TRUE) {
            $this->table::create($data);
            return redirect()->route($this->routes . '.index')
                ->with([
                    'title' => 'Sukses!',
                    'data'  => 'Perizinan dengan nama ' . $request->name . ' berhasil di simpan',
                    'alert' => 'success',
                ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => 'Perizinan dengan nama ' . $request->name . ' yang anda isi sudah ada.',
                'alert' => 'error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        return view($this->path . '.form')->with([
            'data'  => $data,
            'route' => route($this->routes . '.update', $id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $check = $this->data_cek('edit', $request, $id);
        if ($check['status'] == TRUE) {
            $item = $this->table::findOrFail(_encdec('dec', $id));
            $item->update($data);
            return redirect()->route($this->routes . '.index')
                ->with([
                    'title' => 'Sukses!',
                    'data'  => 'Perizinan dengan nama ' . $request->name . ' berhasil di update',
                    'alert' => 'success',
                ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => 'Perizinan dengan nama ' . $request->name . ' yang anda isi sudah ada.',
                'alert' => 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->table::findOrFail(_encdec('dec', $id));
        $data->delete();
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => 'Perizinan dengan nama ' . $data->name . ' berhasil di hapus',
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
            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d F Y');
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                $action .= '<form id="' . _encdec('enc', $data->id) . '"  action="' . route($this->routes . '.destroy', _encdec('enc', $data->id)) . '" method="POST" class="d-inline"> <input name="_token" type="hidden" value=' . csrf_token() . '> <input type="hidden" name="_method" value="delete"> <input type="hidden" value="' . _encdec('enc', $data->id) . '" name="id"> <a href="#" data-id="' . _encdec('enc', $data->id) . '" data-debug="' . $data->name . '" class="btn-custom btn-delete" > <i class="fe-trash fa-lg" ></i></a> </form>';
                return $action;
            })
            ->rawColumns(['created_at', 'action'])
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
                if ($query[$this->field_exist[0]] == $request[$this->field_exist[0]]) {
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
            ->count();
        if ($query < 1) {
            $data['status'] = TRUE;
        } else {
            $data['status'] = FALSE;
        }
        return $data;
    }
}
