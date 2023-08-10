@extends('pages_admin.main')
@section('content') 
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $count_1 }}</h3>
                    <p>Data Kecamatan</p>
                </div>
                <div class="icon">
                    <i class="fe-grid"></i>
                </div>
                {{-- <a href="{{ route('data-partai.index') }}" class="small-box-footer">
                    More info <i class="fe-arrow-right"></i>
                </a> --}}
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $count_2 }}</h3>
                    <p>Data Desa </p>
                </div>
                <div class="icon">
                    <i class="fe-share-2"></i>
                </div>
                {{-- <a href="{{ route('calon-legislatif.index') }}" class="small-box-footer">
                    More info <i class="fe-arrow-right"></i>
                </a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $count_3 }}</h3>
                    <p>Data Jenis Komoditi</p>
                </div>
                <div class="icon">
                    <i class="fe-gift"></i>
                </div>
                {{-- <a href="" class="small-box-footer">
                    More info <i class="fe-arrow-right"></i>
                </a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $count_4 }}</h3>
                    <p>Data Kelompok Tani</p>
                </div>
                <div class="icon">
                    <i class="fe-image"></i>
                </div>
                {{-- <a href="{{ route('data-dapil.index') }}" class="small-box-footer">
                    More info <i class="fe-arrow-right"></i>
                </a> --}}
            </div>
        </div>
        
    </div>
@endsection