<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Models\User;
use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Models\UserKelompokTani;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PeranPenggunaController extends Controller
{
    protected $path   = 'pages_admin.pages_peran_pengguna';
    protected $routes = 'peran-pengguna';

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
        $id_poktan = UserKelompokTani::pluck('kelompok_tani_id')->all();
        return view($this->path . '.form')->with([
            'route'  => route($this->routes . '.store'),
            'user'   => User::get(),
            'role'   => Role::get(),
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
        $role = User::find($request->id);
        $role->assignRole($request->role);
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => "User has been assigned to the role {$role->name}",
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
        $data = User::findOrFail(_encdec('dec', $id));
        return view($this->path . '.form')->with([
            'data'      => $data,
            'role'      => Role::get(),
            'user'      => User::has('roles')->get(),
            'route'     => route($this->routes . '.update', $id)
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
        $item = User::findOrFail(_encdec('dec', $id));
        $item->syncRoles($request->role);
        return redirect()->route($this->routes . '.index')
        ->with([
            'title' => 'Sukses!',
            'data'  => "User has been sync to the role {$request->name}",
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
        $data = User::has('roles')->orderBy('id', 'ASC');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('role', function ($data) {
                return implode(', ', $data->getRoleNames()->toArray());
            })
            ->addColumn('action', function ($data) {
                $action  = '<a href="' . route($this->routes . '.edit', _encdec('enc', $data->id)) . '" class="btn-custom"> <i class="fe-edit fa-lg"></i></a>';
                return $action;
            })
            ->rawColumns(['role', 'action'])
            ->toJson();
    }
}
