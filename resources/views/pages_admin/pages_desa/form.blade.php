@extends('pages_admin.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="header-title">{{ ucwords(request()->segment(3)) }} {{ hapus_underscore(request()->segment(2)) }}</h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <form class="form-horizontal parsley-form" action="{{ $route }}" method="post" enctype="multipart/form-data" autocomplete="off"  data-parsley-validate novalidate autocomplete="off">
                            @csrf
                            @if(request()->segment(3) == 'edit')
                            @method('PUT') 
                            @endif
                            
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="kecamatan_id">Nama Kecamatan</label>
                                <div class="col-sm-3">
                                    <select name="kecamatan_id" id="kecamatan_id" class="form-control custom-select">
                                        <option value="">Pilih--</option>
                                        @foreach ($kecamatan as $item)
                                            @if(request()->segment(3) == 'edit')
                                                <option {{ $data->kecamatan_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="nama">Nama Desa</label>
                                <div class="col-sm-5">
                                    <input type="text" id="nama" name="nama" placeholder="Nama Desa" autocomplete="off"
                                        class="form-control required "
                                        value="{{ request()->segment(3) == 'edit' ? $data->nama : old('nama') }}"
                                        required>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button onClick="window.location.href='{{route(request()->segment(2).'.index')}}'"
                                        type="button" class="btn btn-secondary waves-effect waves-light">Batal</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
</div> 
@endsection