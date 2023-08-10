<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign In — Sistem Informasi Perkembangan Komuditi Tanaman Pangan</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="{{ __('Sistem Informasi Perkembangan Komuditi Tanaman Pangan') }}" name="description" />
    <meta content="{{ __('Rezky P. Budihartono') }}" name="author" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible"  />
    <meta content="#0091ea" name="theme-color" >
    <meta content="{{ csrf_token() }}" name="csrf-token" >
    <!-- App favicon -->
    <link href="/images/logo.png" rel="shortcut icon" > 
    <!-- Google Material Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Theme style -->
    <link href="/css/icons.min.css" rel="stylesheet">
    <link href="/css/adminlte.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    <div class="background"></div>
    <div class="login-box"> 
        <div class="card">
            <div class="card-body login-card-body"> 
                <div class="m-sm-1">
                    <a href="/">
                    <img src="{{ asset('/images/logo.png') }}" width="60" alt="logo" />
                    </a>
                    <h1 class="h3 font-weight-bold login-text mt-3"> 
                        Sign In
                    </h1>
                    <p class="text-muted h8 mt-1 ">Sign in untuk ke administrator</p>
                    <form action="javascript:void(0);" class="loginForm parsley-form" method="post">
                        <p class="mt-3 mb-1">Nama User</p>
                        <div class="form-group form-group__icon">
                            <svg  width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <input required  class="form-control username" autocomplete="username" type="text"  name="username" placeholder="Nama User" />
                            <div class="invalid-login"></div>
                        </div>
                        <p class="mt-3 mb-1">Kata Sandi</p>
                        <div class="form-group form-group__icon">
                            <svg height="23" width="23" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                            </svg>
                            <input required class="form-control password" autocomplete="password" type="password" name="password" placeholder="Kata Sandi" />
                        </div>
                    <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary logIn">Masuk</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.min.js"></script>
<!-- Validation js (Parsleyjs) -->
<script src="/plugins/parsleyjs/parsley.min.js"></script>
<!-- Main js -->
<script src="/js/main.js"></script>
</body>
</html>
