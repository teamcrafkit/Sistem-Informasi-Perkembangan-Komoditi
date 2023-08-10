<?php

namespace App\Http\Controllers\ControllerAdmin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PerizinanPeranController extends Controller
{
    protected $path   = 'pages_admin.pages_perizinan_peran';
    protected $routes = 'perizinan-peran';

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
            'route'       => route($this->routes . '.store'),
            'roles'       => Role::get(),
            'permissions' => Permission::get(),
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
        request()->validate([
            'role' => 'required',
            'permission' => 'array|required'
        ]);
        $role = Role::find($request->role);
        $role->givePermissionTo($request->permission);
        return redirect()->route($this->routes . '.index')
                        ->with([
                            'title' => 'Sukses!',
                            'data'  => "Permisson has been assigned to the role {$role->name}",
                            'alert' => 'success',
                        ]);
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
        $data = Role::findOrFail(_encdec('dec', $id));
        return view($this->path . '.form')->with([
            'data'        => $data,
            'roles'       => Role::get(),
            'permissions' => Permission::get(),
            'route'       => route($this->routes . '.update', $id)
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
        request()->validate([
            'role' => 'required',
            'permission' => 'array|required'
        ]);
        $item = Role::findOrFail(_encdec('dec', $id));
        $item->syncPermissions($request->permission);
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => 'The Permission has been synced.',
            'alert' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Datatables ajax serverside data
     * 
     * @return \JsonData
     */
    public function ajaxdata()
    {
        $data = Role::orderBy('id', 'ASC');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('permission', function ($data) {
                return implode(', <br>', $data->getPermissionNames()->toArray());
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                return $action;
            })
            ->rawColumns(['permission', 'action'])
            ->toJson();
    }
}
