@extends('pages_user.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Perkembangan Komoditi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Perkembangan Komoditi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                         <div class="card-header">
                            <h3 class="card-title">
                                <span class="h4">
                                    <input type="text" readonly style="width:200px" name="tanggal" class="form-control form-control-sm date-range input-daterange-datepicker "  value="{{ $firstDate }} / {{ $lastDate }}">
                                </span>
                            </h3>
                            <div class="card-tools pull-right">
                                <div class="btn-group ">
                                    <a href="{{ route('perkembangan-komoditi.create') }}" class="btn btn-primary btn-sm" style="text-transform:capitalize;"><i class="fe-plus"></i> Tambah Data</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%; font-size:12px;">
                                <thead>
                                    <tr>
                                        <th width="1%" style="text-align: center;">No</th>
                                        <th width="15%" style="text-align: center;">Jenis Komoditi</th>
                                        <th width="15%" style="text-align: center;">Luas Lahan (Ha)</th>
                                        <th width="15%" style="text-align: center;">Luas Tanam/Area/Populasi(Ha)/(Ekor)</th>
                                        <th width="20%" style="text-align: center;">Luas Panen (Ha)</th>
                                        <th width="20%" style="text-align: center;">Produksi (Ton)</th>
                                        <th width="20%" style="text-align: center;">Produktivitas (Ton/Ha)</th>
                                        <th width="20%" style="text-align: center;">Tanggal</th>
                                        <th width="20%" style="text-align: center;">Status</th>
                                        <th width="20%" style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-style')
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
@endpush
@push('after-script')
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        $(function() {
            // Datatables Responsive
            let dataTable = $("#dataTable").DataTable({
                responsive: true,
                processing: true,
                serverside: true,
                scrollX   : true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : "{{ $ajax }}",
                    dataType    : "json",
                    type        : "POST",
                    cache       : false,
                    data        : function(data){
                        data.tanggal = $('.date-range').val();
                    },
                },
                columns: [{
                        "data": "DT_RowIndex",
                        "sClass": "text-center"
                    },
                    {
                        "data": "jenis_komoditi",
                        "sClass": "text-left"
                    },
                    {
                        "data": "luas_lahan",
                        "sClass": "text-center"
                    },
                    {
                        "data": "luas_tanam",
                        "sClass": "text-center"
                    },
                    {
                        "data": "luas_panen",
                        "sClass": "text-center"
                    },
                    {
                        "data": "produksi",
                        "sClass": "text-center"
                    },
                    {
                        "data": "produktifitas",
                        "sClass": "text-center"
                    },
                    {
                        "data": "tanggal",
                        "sClass": "text-center"
                    },
                    {
                        "data": "status",
                        "sClass": "text-center"
                    },
                    {
                        "data": "action",
                        "sClass": "text-center",
                        orderable: false,
                        searchable: false
                    },
                ],
                language: {
                    url: '/id.json'
                },
            });
            $(".date-range").change( function(){
                dataTable.ajax.reload();
            });
        });
        var dateToday = new Date();
            $(".input-daterange-datepicker").daterangepicker({
                buttonClasses: ["btn", "btn-sm"],
                applyClass: "btn-secondary",
                cancelClass: "btn-primary",
                maxDate: "{{ $lastDate }}",
            })
            $('.input-daterange-datepicker').daterangepicker()
    </script>
@endpush
