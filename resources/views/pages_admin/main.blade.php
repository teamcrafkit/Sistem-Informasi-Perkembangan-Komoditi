<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ hapus_underscore(request()->segment(2)) }} — {{ __('Sistem Informasi Perkembangan Komuditi Tanaman Pangan')}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ __('Sistem Informasi Perkembangan Komuditi Tanaman Pangan') }}" />
        <meta name="author" content="{{ __('Rezky P. Budihartono') }}"  />
        <meta name="theme-color" content="#0091ea">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link href="/images/favicon.png" rel="shortcut icon" > 
        <!-- App favicon -->
        <link rel="shortcut icon" href="/images/logo.png">
        <!-- Style -->
        @stack('before-style')
        @include('includes_admin.style')
        @stack('after-style')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
         <!-- Begin page -->
        <div class="wrapper"> 
            {{-- Flash Data --}}
            <div class="flash-data" data-flash="{{ session('data') }}" data-alert="{{ session('alert') }}" data-title="{{ session('title') }}"></div>
            @php $a = '' @endphp
            @foreach ($errors->all() as $index => $message)
                @php  $a .= $index + 1 .'. '. $message .'<br>' @endphp 
            @endforeach
            <div class="error-data" data-flash="{{ count($errors) > 0 ?  '<div class="alert alert-danger">'.$a.'</div>'  : '' }}" data-alert="{{ count($errors) > 0 ? 'error' : '' }}" data-title="{{ count($errors) > 0 ? 'Oops..' : '' }}"></div>
            {{-- End Flash Data --}}
            @include('includes_admin.navbar')
            @include('includes_admin.sidebar')
                <div class="content-wrapper">
                    @include('includes_admin.header')
                    <div class="content">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div> 
                </div>
            @include('includes_admin.footer')
            @include('includes_admin.modal')
            @stack('modal')
        </div>
        <!-- END wrapper --> 
        <!-- Scripts -->
        @stack('before-script')        
        @include('includes_admin.script')
        @stack('after-script')
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    </body>
</html>