 <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            @php
                if(request()->segment(2) == 'dashboard'){
                    $text = 'Beranda';
                }else{
                    $text = hapus_underscore(request()->segment(2));
                }
            @endphp
        <h1 class="m-0 text-dark">{{ $text }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            @if (request()->segment(2) != "dashboard")
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active"><a href="{{ route(request()->segment(2).'.index') }}"> {{ hapus_underscore(request()->segment(2)) }}</a></li>
            @endif
            @if (!empty(request()->segment(3)))
            @php $route_name = explode('.',Route::currentRouteName()); @endphp
                <li class="breadcrumb-item active">{{  $route_name[1] != "edit" ? hapus_underscore(request()->segment(3)) : hapus_underscore(request()->segment(3)) }}</li>
            @endif
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
