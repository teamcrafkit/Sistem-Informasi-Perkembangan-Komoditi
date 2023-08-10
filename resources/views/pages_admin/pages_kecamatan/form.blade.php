@extends('pages_admin.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="header-title">Form {{ hapus_underscore(request()->segment(2)) }}</h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <form class="form-horizontal parsley-form" action="{{ $route }}" method="post" enctype="multipart/form-data" autocomplete="off"  data-parsley-validate novalidate autocomplete="off">
                            @csrf
                            @if(request()->segment(3) == 'edit')
                            @method('PUT')
                            @endif
                             <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="nama">Nama Kecamatan</label>
                                <div class="col-sm-4">
                                    <input type="text" id="nama" name="nama" placeholder="Nama Kecamatan"
                                        class="form-control required @error('nama') is-invalid @enderror"
                                        value="{{ request()->segment(3) == 'edit' ? $data->nama : old('nama') }}"
                                         required>
                                    @error('nama')
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
@push('after-script')
    <script>
        function _isNumber(e) {
            var unicode = e.charCode ? e.charCode : e.keyCode;
            if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
                if (unicode < 48 || unicode > 57) { //if not a number
                    return false; //disable key press
                }
            }
        }
    </script>
@endpush