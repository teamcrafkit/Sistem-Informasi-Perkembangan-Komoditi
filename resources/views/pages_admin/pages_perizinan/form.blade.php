@extends('pages_admin.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h3 class="header-title">Form {{ hapus_underscore(request()->segment(2)) }}</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <form class="form-horizontal parsley-form" action="{{ $route }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @if(request()->segment(3) == 'edit')
                            @method('PUT') 
                            @endif 
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="name">Nama Perizinan</label>
                                <div class="col-sm-3">
                                    <input type="text" id="name" name="name" placeholder="Nama Perizinan"
                                        class="form-control required @error('name') is-invalid @enderror"
                                        value="{{ request()->segment(3) == 'edit' ? $data->name : old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="guard_name">Nama Guard</label>
                                <div class="col-sm-3">
                                    <input type="text" id="guard_name" guard_name="guard_name" placeholder="Nama Guard"
                                        class="form-control required @error('guard_name') is-invalid @enderror"
                                        value="{{ request()->segment(3) == 'edit' ? $data->guard_name : 'web'}}" required>
                                    @error('guard_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
