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
                                <label for="kelompok_tani_id" class="col-md-2 col-form-label text-md-right">Nama Kelompok</label>
                                <div class="col-md-3">
                                    <select name="kelompok_tani_id" class="form-control required kelompok_tani_id @error('nik') is-invalid @enderror" required>
                                        <option value="">Pilih--</option>
                                        @foreach ($kelompok as $item)
                                            @if(request()->segment(3) == 'edit')
                                                <option {{ $data->kelompok_tani_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama_kelompok }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama_kelompok }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('kelompok_tani_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="nik" class="col-md-2 col-form-label text-md-right">NIK</label>
                                <div class="col-md-3">
                                    <input id="nik" type="text" class="form-control required @error('nik') is-invalid @enderror" onkeypress="return _isNumber(event)" placeholder="NIK" name="nik" value="{{ request()->segment(3) == 'edit' ? $data->nik : old('nik') }}" required
                                        autocomplete="nik">
                                    @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-md-2 col-form-label text-md-right">Nama Lengkap</label>
                                <div class="col-md-5">
                                    <input id="nama" type="text" class="form-control required @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" name="nama" value="{{ request()->segment(3) == 'edit' ? $data->nama : old('nama') }}" required
                                        autocomplete="nama">
                                    @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-sm-2">
                                    <select name="jenis_kelamin" class="form-control custom-select required" required>
                                        <option value="">Pilih--</option>
                                        @if (request()->segment(3) == "edit")
                                            {{ _editSex($data->jenis_kelamin) }}
                                        @else
                                            {{ _inputSex() }}
                                        @endif
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="volume" class="col-md-2 col-form-label text-md-right">Volume</label>
                                <div class="col-md-2">
                                    <input id="volume" type="number" class="form-control required @error('volume') is-invalid @enderror" onkeypress="return _isNumber(event)" placeholder="Volume" name="volume" value="{{ request()->segment(3) == 'edit' ? $data->volume : old('volume') }}" required
                                        autocomplete="volume">
                                    @error('volume')
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
    $(function() { 
        $('.kelompok_tani_id').select2({
            placeholder: 'Pilih--',
        })
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
 