@extends('pages_user.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Form {{ hapus_underscore(request()->segment(1)) }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item "><a href="{{ route(request()->segment(1) . '.index') }}">Perkembangan Komoditi</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">
                                Tambah Data Perkembangan Komoditi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-2">
                                        <form class="form-horizontal parsley-form" action="{{ $route }}"
                                            method="post" enctype="multipart/form-data" autocomplete="off"
                                            data-parsley-validate novalidate autocomplete="off">
                                            @csrf
                                            @if (request()->segment(2) == 'edit')
                                                @method('PUT')
                                            @endif
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right"
                                                    for="jenis_komoditi_id">Jenis Komoditi</label>
                                                <div class="col-sm-4">
                                                    <select name="jenis_komoditi_id"
                                                        class="form-control @error('jenis_komoditi_id') is-invalid @enderror required jenis_komoditi_id"
                                                        id="jenis_komoditi_id" required>
                                                        <option value="">Pilih--</option>
                                                        @foreach ($jenis as $item)
                                                            @if(request()->segment(2) == 'edit')
                                                                <option {{ $data->jenis_komoditi_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_komoditi_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right" for="luas_lahan">Luas Lahan</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" name="luas_lahan"
                                                            onkeypress="return _isNumber(event)"
                                                            class="form-control @error('luas_lahan') is-invalid @enderror required"
                                                            id="luas_lahan"
                                                            value="{{ request()->segment(2) == 'edit' ? $data->luas_lahan : old('luas_lahan') }}"
                                                            placeholder="Luas Lahan" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon1">Ha</span>
                                                        </div>
                                                    </div>
                                                    @error('luas_lahan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right" for="luas_tanam">Luas Tanam</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" name="luas_tanam"
                                                            onkeypress="return _isNumber(event)"
                                                            class="form-control @error('luas_tanam') is-invalid @enderror required"
                                                            id="luas_tanam"
                                                            value="{{ request()->segment(2) == 'edit' ? $data->luas_tanam : old('luas_tanam') }}"
                                                            placeholder="Luas Tanam" required>
                                                    <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon1">Ha / Ekor</span>
                                                        </div>
                                                    </div>
                                                    @error('luas_tanam')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right" for="luas_panen">Luas Panen</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" name="luas_panen"
                                                            onkeypress="return _isNumber(event)"
                                                            class="form-control @error('luas_panen') is-invalid @enderror required"
                                                            id="luas_panen"
                                                            value="{{ request()->segment(2) == 'edit' ? $data->luas_panen : old('luas_panen') }}"
                                                            placeholder="Luas Panen" required>
                                                    <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon1">Ha</span>
                                                        </div>
                                                    </div>
                                                    @error('luas_panen')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right" for="produksi">Produksi</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" name="produksi" onkeypress="return _isNumber(event)"
                                                            class="form-control @error('produksi') is-invalid @enderror required"
                                                            id="produksi"
                                                            value="{{ request()->segment(2) == 'edit' ? $data->produksi : old('produksi') }}"
                                                            placeholder="Produksi" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon1">Ton</span>
                                                        </div>
                                                    </div>
                                                    @error('produksi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right" for="produktifitas">Produktifitas</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                    <input type="text" name="produktifitas"
                                                        onkeypress="return _isNumber(event)"
                                                        class="form-control @error('produktifitas') is-invalid @enderror required"
                                                        id="produktifitas"
                                                        value="{{ request()->segment(2) == 'edit' ? $data->produktifitas : old('produktifitas') }}"
                                                        placeholder="Produktifitas" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon1">Ton/Ha</span>
                                                        </div>
                                                    </div>
                                                    @error('produktifitas')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right" for="tanggal">Tanggal</label>
                                                <div class="col-sm-3">
                                                    <input type="date" name="tanggal" onkeypress="return _isNumber(event)"
                                                        class="form-control @error('tanggal') is-invalid @enderror required"
                                                        id="tanggal"
                                                        value="{{ request()->segment(2) == 'edit' ? $data->tanggal : old('tanggal') }}"
                                                        placeholder="Tanggal" required>
                                                    @error('tanggal')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label"></label>
                                                <div class="col-md-9">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    <button
                                                        onClick="window.location.href='{{ route(request()->segment(1) . '.index') }}'"
                                                        type="button"
                                                        class="btn btn-secondary waves-effect waves-light">Batal</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $('.jenis_komoditi_id').select2({
            placeholder: 'Pilih--',
            ajax: {
                url: "{{ route('autocomplete.jenis') }}",
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
