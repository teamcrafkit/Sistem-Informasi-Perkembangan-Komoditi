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
                                <label class="col-form-label col-sm-2 text-sm-right" for="name">Nama Peran</label>
                                <div class="col-sm-3">
                                    <select type="text" name="role" id="role" class="form-control custom-select required" required>
                                        <option disabled selected>Pilih Peran</option>
                                        @foreach ($roles as $item)
                                            @if (request()->segment(3) == "edit")
                                                <option {{ $data->id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right" for="permission">Perizinan</label>
                                <div class="col-sm-6">
                                    <select multiple="multiple" name="permission[]" id="permission" data-plugin="multiselect" class="permission required" required>
                                        @foreach ($permissions as $item)
                                            @if (request()->segment(3) == "edit")
                                                <option {{ $data->permissions()->find($item->id) ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
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
@push('after-style')
    <link href="/plugins/multiselect/multi-select.css" rel="stylesheet" type="text/css" />
@endpush
@push('after-script')
    <script src="/plugins/multiselect/jquery.multi-select.js"></script>
    <script>
        $('[data-plugin="multiselect"]').multiSelect($(this).data())
    </script>
@endpush