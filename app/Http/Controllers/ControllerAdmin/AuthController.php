<?php

namespace App\Http\Controllers\ControllerAdmin;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserKelompokTani;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('pages_admin.login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            return $this->successResponse(null, 'These login successfuly.', 200);
        }
        return $this->errorResponse(null, 'These credentials do not match our records.', 200);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/admin');
    }
}
