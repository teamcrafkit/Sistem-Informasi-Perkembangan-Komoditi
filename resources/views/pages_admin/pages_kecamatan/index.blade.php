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
                    <table id="dataTable" class="table table-bordered table-striped dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th width="1%" style="text-align: center;">No</th>
                                <th width="20%" style="text-align: center;" >Nama Kecamatan</th>
                                <th width="8%"  style="text-align: center;">Aksi</th>
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
                { "data"    : "nama",               "sClass"  : "text-left"   }, 
                { "data"    : "action",             "sClass"  : "text-center" , orderable: false, searchable: false },
            ],
            language: {
                url: '/id.json'
            },
        });
    });
</script>
@endpush