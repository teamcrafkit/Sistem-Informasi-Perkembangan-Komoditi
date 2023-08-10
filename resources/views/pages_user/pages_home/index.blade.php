@extends('pages_user.main')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container">
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
 <div class="content">
    <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="jumbotron">
                    <h1 class="display-4">Selamat Datang!</h1>
                    <p class="lead">Sistem Informasi Perkembangan Komoditi Tanaman Pangan</p>
                    @if (Auth::guard('poktan')->check())
                    <p>
                        Nama Kelompok : {{ auth('poktan')->user()->nama_kelompok }} <br>
                        Nama Ketua Kelompok : {{ auth('poktan')->user()->ketua_kelompok }}
                    </p>
                    @endif
                </div>
                 <!-- /.card -->
             </div>
         </div>
     </div>
 </div>           
@endsection