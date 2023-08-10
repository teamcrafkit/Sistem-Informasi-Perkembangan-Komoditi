@extends('pages_admin.main')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">
                        {{ hapus_underscore(request()->segment(2)) }}
                        <div class="btn-group float-right"><button onClick="window.location.href='{{ $route }}'" class="btn btn-primary btn-sm" style="text-transform:capitalize;">Tambah</button></div>
                    </h4>
                    <table class="table table-striped table-bordered dt-responsive nowrap dataTable">
                        <thead>
                            <tr>
                                <th width="1%" style="text-align: center; ">No</th>
                                <th width="30%" style="text-align: center; ">Nama Peran</th>
                                <th width="15%" style="text-align: center; ">Nama Guard</th>
                                <th width="13%" style="text-align: center; ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <!-- third party js -->
    <script>
        $(function() {
            // Datatables Responsive
            $(".dataTable").DataTable({
                responsive      : true,
                processing      : true,
                serverside      : true,
                autoWidth       : false,
                ajax      : {
                    headers     : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url         : "{{ $ajax }}",
                    type        : "POST",
                },
                pageLength      : 10,
                order           : [[ 0, 'asc' ]],
                columns : [
                    { "data"    : "DT_RowIndex",        "sClass"  : "text-center" },
                    { "data"    : "name",               "sClass"  : "text-left"   },
                    { "data"    : "guard_name",         "sClass"  : "text-center" },
                    { "data"    : "action",             "sClass"  : "text-center" , orderable: false, searchable: false },
                ],
                language: {
                    loadingRecords: "Loading..",
                    emptyTable    : "Data tidak ada..",
                    url: '/id.json'
                }
            });
        });
    </script>
@endpush