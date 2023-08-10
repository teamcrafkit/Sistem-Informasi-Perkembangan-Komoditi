@extends('pages_admin.main')
@section('content')
<div class="container-fluid p-0"> 
    <div class="row">
        <div class="col-12">
            <div class="card"> 
                <div class="card-body">
                    <h4 class="cars-title mb-3">
                        {{ hapus_underscore(request()->segment(2)) }}
                        <div class="btn-group pull-right">
                            <a href="{{ $route }}" class="btn btn-primary btn-sm "style="text-transform:capitalize;">Tambah</a>
                        </div>
                    </h4>
                    <table id="dataTable" class="table table-bordered table-striped dt-responsive" style="width:100%; font-size:12px;">
                        <thead>
                            <tr>
                                <th width="1%" style="text-align: center;">No</th>
                                <th width="12%" style="text-align: center;">Nama Kelompok Tani</th>
                                <th width="12%" style="text-align: center;">NIK</th>
                                <th width="15%" style="text-align: center;">Nama</th>
                                <th width="20%" style="text-align: center;">Jenis Kelamin</th>
                                <th width="15%" style="text-align: center;">Volume</th>
                                <th width="10%"  style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody ></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script>
    $(function() {
        // Datatables Responsive
        $("#dataTable").DataTable({
            responsive: true,
            processing: true,
            serverside: true,
            ajax      :{
                headers     : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url         : "{{ $ajax }}",
                dataType    : "json",
                type        : "POST"
            },
            columns : [
                { "data"    : "DT_RowIndex",        "sClass"  : "text-center" },
                { "data"    : "kelompok_tani",               "sClass"  : "text-center"   }, 
                { "data"    : "nik",               "sClass"  : "text-center"   }, 
                { "data"    : "nama",               "sClass"  : "text-left"   }, 
                { "data"    : "jenis_kelamin",               "sClass"  : "text-left"   }, 
                { "data"    : "volume",               "sClass"  : "text-left"   }, 
                { "data"    : "action",             "sClass"  : "text-center" , orderable: false, searchable: false },
            ],
            language: {
                url: '/id.json'
            },
        });
    });
</script>
@endpush