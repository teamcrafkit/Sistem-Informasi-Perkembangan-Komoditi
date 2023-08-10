@extends('pages_user.main')
@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Registrasi</div>
                        <div class="card-body">
                            <form method="POST" class="parsley-form"  action="{{ route('register') }}" data-parsley-validate novalidate>
                                @csrf
                                <div class="form-group row">
                                    <label for="nama_kelompok" class="col-md-4 col-form-label text-md-right">Nama Kelompok</label>
                                    <div class="col-md-6">
                                        <input id="nama_kelompok" type="text" placeholder="Nama Kelompok" value="{{ old('nama_kelompok') }}" class="form-control required @error('nama_kelompok') is-invalid @enderror" name="nama_kelompok" value="" required
                                            autocomplete="nama_kelompok" autofocus>
                                        @error('nama_kelompok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik" class="col-md-4 col-form-label text-md-right">NIK</label>
                                    <div class="col-md-6">
                                        <input id="nik" type="text" placeholder="NIK" onkeypress="return _isNumber(event)" value="{{ old('nik') }}" class="form-control required @error('nik') is-invalid @enderror" name="nik" value="" required
                                            autocomplete="nik">
                                        @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ketua_kelompok" class="col-md-4 col-form-label text-md-right">Nama Ketua</label>
                                    <div class="col-md-6">
                                        <input id="ketua_kelompok" type="text" placeholder="Nama Ketua" value="{{ old('ketua_kelompok') }}" class="form-control required @error('ketua_kelompok') is-invalid @enderror" name="ketua_kelompok" value="" required
                                            autocomplete="ketua_kelompok">
                                        @error('ketua_kelompok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kecamatan_id" class="col-md-4 col-form-label text-md-right">Kecamatan</label>
                                    <div class="col-md-5">
                                        <select name="kecamatan_id" class="form-control required kecamatan_id @error('kecamatan_id') is-invalid @enderror" required>
                                            <option value="">Pilih--</option>
                                        </select>
                                        @error('kecamatan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="desa_id" class="col-md-4 col-form-label text-md-right">Desa</label>
                                    <div class="col-md-5">
                                        <select name="desa_id" class="form-control required desa_id @error('desa_id') is-invalid @enderror" required>
                                            <option value="">Pilih--</option>
                                        </select>
                                        @error('desa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Alamat E-Mail</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" placeholder="Alamat E-Mail"value="{{ old('email') }}" class="form-control required @error('email') is-invalid @enderror" name="email" value="" required
                                            autocomplete="email">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Kata Sandi</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" placeholder="Kata Sandi" value="{{ old('password') }}" class="form-control required @error('password') is-invalid @enderror" name="password" required
                                            autocomplete="new-password" >
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirmasi Kata Sandi</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" placeholder="Konfirmasi Kata Sandi" type="password" class="form-control required"
                                            name="password_confirmation" data-parsley-equalto="#password" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Registrasi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
 