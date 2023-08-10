@extends('pages_admin.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h3 class="header-title">{{ ucwords(request()->segment(3)) }} {{ hapus_underscore(request()->segment(2)) }}</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <form class="form-horizontal parsley-form" action="{{ $route }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @if(request()->segment(3) == 'edit')
                            @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="nama">Nama Lengkap</label>
                                <div class="col-sm-5">
                                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap"
                                        class="form-control required @error('nama') is-invalid @enderror"
                                        value="{{ request()->segment(3) == 'edit' ? $data->nama : old('nama') }}"
                                        required>
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="username">Username</label>
                                <div class="col-sm-4">
                                    <input type="text" id="username" name="username" placeholder="username" class="form-control required @error('username') is-invalid @enderror" 
                                        value="{{ request()->segment(3) == 'edit' ? $data->username : old('username') }}" @if (request()->segment(3) == 'edit') required @endif>
                                    @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                                <div class="col-sm-3">
                                    <input type="password" name="password" class="form-control @if (request()->segment(3) == 'create') required @endif @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}" placeholder="Password" @if (request()->segment(3) == 'create') required @endif>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">Konfirmasi Password</label>
                                <div class="col-sm-3">
                                    <input type="password" name="password_confirmation" class="form-control @if (request()->segment(3) == 'create') required @endif @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') }}" placeholder="Konfirmasi Password" @if (request()->segment(3) == 'create') required @endif>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="customFile">Avatar</label>
                                <div class="col-sm-3">
                                    <div class="custom-file">
                                        <input name="avatar" type="file" id="customFile"
                                            class="form-control @if (request()->segment(3) == 'create') required @endif custom-file-input @error('avatar') is-invalid @enderror" value="{{old('avatar')}}"
                                            accept="image/png, image/jpeg, image/jpg" @if (request()->segment(3) == 'create') required @endif>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div> 
                            @if (request()->segment(3) == 'edit')
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-sm-right" for="customFile">  </label>
                                <div class="col-sm-5">
                                    <img src="{{ request()->segment(3) == 'edit' ? $data->getAvatar() : '' }}" width="200" style="border:1px solid #dee2e6; border-radius:.25rem; background-color:#fff; padding:.25rem; max-width:80%; height:auto;">
                                </div>
                            </div>
                            @endif 
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
@push('after-script') 
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush