@extends('pages_admin.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h3 class="header-title">Form {{ hapus_underscore(request()->segment(2)) }}</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class=" ">
                        <form class="form-horizontal parsley-form" action="{{ $route }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @if(request()->segment(3) == 'edit')
                            @method('PUT') 
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label text-sm-right">Root Menu</label>
                                    <select name="parent_id" class="form-control custom-select " >
                                        <option value="">Pilih--</option> 
                                        @foreach ($navigations as $item)
                                            @if(request()->segment(3) == 'edit')
                                                <option {{ $data->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach 
                                    </select> 
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label  text-sm-right">Perizinan</label>
                                    <select name="permission_name" class="form-control custom-select @error('permission_name') is-invalid @enderror" required>
                                        <option value="">Pilih--</option> 
                                        @foreach ($permissions as $item)
                                            @if(request()->segment(3) == 'edit')
                                                <option {{ $data->permission_name == $item->name ? 'selected' : '' }} value="{{ $item->name }}">{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach 
                                    </select> 
                                    @error('permission_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="col-form-label  text-sm-right" for="name">Nama</label>
                                        <input type="text" id="name" name="name" placeholder="Nama"
                                            class="form-control required @error('name') is-invalid @enderror"
                                            value="{{ request()->segment(3) == 'edit' ? $data->name : old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="col-form-label text-sm-right" for="url">URL</label>
                                        <input type="text" id="url" name="url" placeholder="URL"
                                            class="form-control"
                                            value="{{ request()->segment(3) == 'edit' ? $data->url : old('url') }}" >
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="col-form-label  text-sm-right" for="icon">Icon</label>
                                        <input type="text" id="icon" name="icon" placeholder="contoh : fe-home"
                                            class="form-control  "
                                            value="{{ request()->segment(3) == 'edit' ? $data->icon : old('icon') }}">
                                        <span class="help-block"><small>contoh <a href="https://remixicon.com/" target="_blank">click this link</a></small></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="col-form-label  text-sm-right" for="sort">Urutan</label>
                                        <input type="number" id="sort" name="sort" placeholder="Urutan"
                                            class="form-control  "
                                            value="{{ request()->segment(3) == 'edit' ? $data->sort : old('sort') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class=" col-form-label"></label>
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
