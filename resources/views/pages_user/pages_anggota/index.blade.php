@extends('pages_user.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Anggota Kelompok</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Anggota Kelompok</li>
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
                                 Data Anggota Kelompok
                            </h3>
                            <div class="card-tools pull-right">
                                <div class="btn-group ">
                                    <a href="{{ $route }}" class="btn btn-primary btn-sm" style="text-transform:capitalize;"><i class="fe-plus"></i> Tambah Data</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%; font-size:12px;">
                                <thead>
                                    <tr>
                                        <th width="1%" style="text-align: center;">No</th>
                                        <th width="12%" style="text-align: center;">NIK</th>
                                        <th width="15%" style="text-align: center;">Nama</th>
                                        <th width="20%" style="text-align: center;">Jenis Kelamin</th>
                                        <th width="15%" style="text-align: center;">Volume</th>
                                        <th width="10%"  style="text-align: center;">Aksi</th>
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
            $("#dataTable").DataTable({
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
                columns: [  { "data"    : "DT_RowIndex",        "sClass"  : "text-center" },
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
