<?php

namespace App\Http\Controllers\ControllerUser;

use App\Models\Kecamatan;
use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PoktanRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Auth\RedirectsUsers;

class HomeController extends Controller
{
    use RedirectsUsers;
    
    public function index()
    {
        return view('pages_user.pages_home.index');
    }
    public function loginPagePoktan()
    {
        return view('pages_user.login');
    }
    public function registerPagePoktan()
    {
        return view('pages_user.register');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);
        if (Auth::guard('poktan')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('beranda')
            ->with([
                'title' => 'Sukses!',
                'data'  => "Login berhasil.",
                'alert' => 'success',
            ]);
        }
        return redirect()->route('login')
            ->with([
                'title' => 'Gagal!',
                'data'  => "Email Password anda salah / akun anda belum di verifikasi.",
                'alert' => 'error',
            ]);
    }
    public function register(PoktanRequest $request)
    {
        $data              = $request->except(['password_confirmation']);
        $data['password']  = bcrypt($request->password);
        $poktan = KelompokTani::create($data);
        event(new Registered($poktan));
        Auth::guard('poktan')->login($poktan);
        return redirect()->route('beranda')
            ->with([
                'title' => 'Sukses!',
                'data'  => "Silahkan cek email anda untuk melakukan aktivasi.",
                'alert' => 'success',
            ]);
    }
    public function logout()
    {
        Auth::guard('poktan')->logout();
        return redirect('/');
    }

    
}
