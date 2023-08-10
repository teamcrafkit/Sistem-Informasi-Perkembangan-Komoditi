<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="{{ __('Rezky P. Budihartono') }}">
    <meta content="no-cache, no-store, must-revalidate" http-equiv="Cache-Control" />
    <meta content="0" http-equiv="Expires" />
    <title>{{ hapus_underscore(empty(request()->segment(1)) ? 'Beranda' : request()->segment(1)) }} — {{ __('Sistem Informasi Perkembangan Komuditi Tanaman Pangan') }}</title>
    <meta name="theme-color" content="#0091ea">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/images/favicon.png" rel="shortcut icon" > 
    @stack('before-style')
    @include('includes_admin.style')
    @stack('after-style')
</head>
<body class="hold-transition layout-top-nav">
    {{-- Flash Data --}}
    <div class="flash-data" data-flash="{{ session('data') }}" data-alert="{{ session('alert') }}" data-title="{{ session('title') }}"></div>
    @php $a = '' @endphp
    @foreach ($errors->all() as $index => $message)
        @php  $a .= $index + 1 .'. '. $message .'<br>' @endphp 
    @endforeach
    <div class="error-data" data-flash="{{ count($errors) > 0 ?  '<div class="alert alert-danger">'.$a.'</div>'  : '' }}" data-alert="{{ count($errors) > 0 ? 'error' : '' }}" data-title="{{ count($errors) > 0 ? 'Oops..' : '' }}"></div>
    {{-- End Flash Data --}}
    <div class="wrapper">
        @if (Auth::guard('poktan')->check() && !Auth::guard('poktan')->user()->email_verified_at)
        <div class="alert alert-danger text-center p-0 m-0"  role="alert" style="border-radius:0px;">
            Anda belum verifikasi email, 
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-white "><u>{{ __('klik disini untuk mengirim ulang verifikasi') }}</u></button>.
            </form>
        </div>
        @endif
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary ">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="/images/favicon.png" alt="Logo" class="brand-image img-circle ">
                    <span class="font-weight-light"><strong>SI PKTP</strong></span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a href="{{ route('beranda') }}" class="nav-link{{ empty(request()->segment(1)) ? ' active' : '' }}"> Beranda</a>
                        </li>
                        @if (Auth::guard('poktan')->check())
                        <li class="nav-item">
                            <a href="{{ route('perkembangan-komoditi.index') }}" class="nav-link{{ request()->segment(1) == 'perkembangan-komoditi' ? ' active' : '' }}"> Perkembangan Komoditi</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('anggota-kelompok-tani.index') }}" class="nav-link{{ request()->segment(1) == 'anggota-kelompok-tani' ? ' active' : '' }}"> Anggota Kelompok</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    @if (!Auth::guard('poktan')->check())
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown  float-right">
                        <a class="nav-link" href="/login" >
                            Masuk
                        </a>
                    </li>
                    <li class="nav-item dropdown  float-right">
                        <a class="nav-link" href="/register" >
                           Registrasi
                        </a>
                    </li>
                    @else
                    <li class="nav-item dropdown  float-right">
                        <a class="nav-link "  data-toggle="dropdown" href="/logout" >
                            {{ auth('poktan')->user()->nama_kelompok }} <i class="remixicon-arrow-down-s-line "style="position:fixed; padding-top:2px; padding-left:4px; font-size:14px;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                              
                            <a href="{{ route('logout.poktan') }}" class="dropdown-item">
                                Keluar
                            </a>
                            
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        @include('includes_user.footer') 
        <!-- Modal -->
        @include('includes_user.modal')
        <!-- /.modal -->
    </div>
    <!-- ./wrapper -->
    @stack('before-script')        
    @include('includes_user.script')
    @stack('after-script')
</body>

</html>