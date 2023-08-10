<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PenggunaController extends Controller
{
    protected $table        = User::class;
    protected $path         = 'pages_admin.pages_pengguna';
    protected $routes       = 'pengaturan-pengguna';
    protected $field_exist  = ['username'];

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
            'route'     => route($this->routes . '.store'),
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
            $data               = $request->all();
            if ($request->hasFile('avatar')) {
                $request->file('avatar')->store('assets/avatar', 'public');
                $name            = $request->avatar->hashName();
                $path            = 'assets/avatar/';
                $property        = [
                    'name'          => $name,
                    'path'          => $path,
                    'path_uploaded' => config('app.url') . Storage::url($path . $name),
                    'width'         => 300,
                    'height'        => 300,
                    'mimetype'      => $request->avatar->getClientMimeType()
                ];
                uploadGambar($property, '');
                $data['avatar']  = $name;
            }
            $data['password']   = bcrypt($request->password);
            $this->table::create($data);
            return redirect()->route($this->routes . '.index')
            ->with([
                'title' => 'Sukses!',
                'data'  => 'Data user dengan nama ' . $request->nama . ' berhasil di simpan',
                'alert' => 'success',
            ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => 'Data username yang anda isi sudah ada.',
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
            'route' => route($this->routes . '.update', $id),
            'user'  => User::find(_encdec('dec', $id)),
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
        $data  = $request->all();
        $check = $this->data_cek('edit', $request, $id);
        if ($check['status'] == TRUE) {
            $data   = $request->all();
            $item   = $this->table::findOrFail(_encdec('dec', $id));
            if ($request->hasFile('avatar')) {
                $request->file('avatar')->store('assets/avatar', 'public');
                $name            = $request->avatar->hashName();
                $path            = 'assets/avatar/';
                $property        = [
                    'name'          => $name,
                    'path'          => $path,
                    'path_uploaded' => config('app.url') . Storage::url($path . $name),
                    'width'         => 300,
                    'height'        => 300,
                    'mimetype'      => $request->avatar->getClientMimeType()
                ];
                uploadGambar($property, $item->avatar);
                $data['avatar']  = $name;
            }
            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            } else {
                $data['password'] = $item->password;
            }
            $item->update($data);
            return redirect()->route($this->routes . '.index')
            ->with([
                'title' => 'Sukses!',
                'data'  => 'Data user dengan nama ' . $request->nama . ' berhasil di update',
                'alert' => 'success',
            ]);
        } else {
            return back()->with([
                'title' => 'Error!',
                'data'  => 'Data user yang anda isi sudah ada.',
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
        Storage::disk('public')->delete('assets/avatar/' . $data->avatar);
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => 'Data user dengan nama ' . $data->nama . ' berhasil di hapus',
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
            ->addColumn('avatar', function ($user) {
                return  '<img src="' . $user->getAvatar() . '" height="50" width="50" style="border:1px solid #dee2e6; border-radius:.2rem; background-color:#fff; padding:.10rem; max-width:80%; height:auto;">';
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                $action .= '<form id="' . _encdec('enc', $data->id) . '"  action="' . route($this->routes . '.destroy', _encdec('enc', $data->id)) . '" method="POST" class="d-inline"> <input name="_token" type="hidden" value=' . csrf_token() . '> <input type="hidden" name="_method" value="delete"> <input type="hidden" value="' . _encdec('enc', $data->id) . '" name="id"> <a href="#" data-id="' . _encdec('enc', $data->id) . '" data-debug="' . $data->username . '" class=" btn-delete btn-custom" > <i class="fe-trash fa-lg" ></i></a> </form>';
                return $action;
            })
            ->rawColumns(['avatar', 'action'])
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
