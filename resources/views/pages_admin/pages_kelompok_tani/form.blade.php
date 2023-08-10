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
                                    <label for="nama_kelompok" class="col-md-2 col-form-label text-md-right">Nama Kelompok</label>
                                    <div class="col-md-4">
                                        <input id="nama_kelompok" type="text" class="form-control required" placeholder="Nama Kelompok" name="nama_kelompok" value="{{ request()->segment(3) == 'edit' ? $data->nama_kelompok : old('nama_kelompok') }}" required
                                            autocomplete="nama_kelompok" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik" class="col-md-2 col-form-label text-md-right">NIK</label>
                                    <div class="col-md-5">
                                        <input id="nik" type="text" class="form-control required" placeholder="Nama Ketua" name="nik" value="{{ request()->segment(3) == 'edit' ? $data->nik : old('nik') }}" required
                                            autocomplete="nik">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ketua_kelompok" class="col-md-2 col-form-label text-md-right">Nama Ketua</label>
                                    <div class="col-md-5">
                                        <input id="ketua_kelompok" type="text" class="form-control required" placeholder="Nama Ketua" name="ketua_kelompok" value="{{ request()->segment(3) == 'edit' ? $data->ketua_kelompok : old('ketua_kelompok') }}" required
                                            autocomplete="ketua_kelompok">

                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="kecamatan_id" class="col-md-2 col-form-label text-md-right">Kecamatan</label>
                                    <div class="col-md-3">
                                        <select name="kecamatan_id" class="form-control required kecamatan_id" required>
                                            <option value="">Pilih--</option>
                                            @foreach ($kecamatan as $item)
                                                @if(request()->segment(3) == 'edit')
                                                    <option {{ $data->kecamatan_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="desa_id" class="col-md-2 col-form-label text-md-right">Desa</label>
                                    <div class="col-md-3">
                                        <select name="desa_id" class="form-control required desa_id" required>
                                            <option value="">Pilih--</option>
                                            @foreach ($desa as $item)
                                                @if(request()->segment(3) == 'edit')
                                                    <option {{ $data->desa_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-right">Alamat E-Mail</label>

                                    <div class="col-md-4">
                                        <input id="email" type="email" class="form-control required" placeholder="Alamat E-Mail" name="email" value="{{ request()->segment(3) == 'edit' ? $data->email : old('email') }}" required
                                            autocomplete="email">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-2 col-form-label text-md-right">Kata Sandi</label>

                                    <div class="col-md-3">
                                        <input id="password" type="password" class="form-control @if (request()->segment(3) == 'create') required @endif" placeholder="Kata Sandi" name="password"
                                            autocomplete="new-password" @if (request()->segment(3) == 'create') required @endif>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-2 col-form-label text-md-right">Konfirmasi Kata Sandi</label>

                                    <div class="col-md-3">
                                        <input id="password-confirm" type="password" class="form-control @if (request()->segment(3) == 'create') required @endif"
                                            name="password_confirmation" data-parsley-equalto="#password" @if (request()->segment(3) == 'create') required @endif placeholder="Konfirmasi Kata Sandi" autocomplete="new-password">
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
    $(function() { 
       
        $('.desa_id').select2({
            placeholder: 'Pilih--',
        })
        $('.kecamatan_id').select2({
            placeholder: 'Pilih--',
            ajax: {
                url: "{{ route('autocomplete.kecamatan') }}",
                type: "POST",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id
                            };
                        })
                    };
                },
                cache: true,
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Status code: ' + jqXHR.status + ' ' + errorThrown);
                }
            }
        }).on("select2:select", function(e) {
            if (e.params.data.id != "") {
                $('.desa_id').select2({
                    placeholder: 'Pilih--',
                    ajax: {
                    url: "{{ route('autocomplete.desa') }}",
                    type: "POST",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term, // search term
                            id : e.params.data.id
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(item) {
                                return {
                                    text: item.nama,
                                    id: item.id
                                };
                            })
                        };
                    },
                    cache: true,
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Status code: ' + jqXHR.status + ' ' + errorThrown);
                    }
                }
                });
            }
        });
        
    });
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
 