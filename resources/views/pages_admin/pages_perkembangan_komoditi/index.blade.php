@extends('pages_admin.main')
@section('content')
<div class="container-fluid p-0"> 
    <div class="row">
        <div class="col-12">
            <div class="card"> 
                <div class="card-body">
                    <h4 class="cars-title mb-3">
                        {{ hapus_underscore(request()->segment(2)) }}
                    </h4>
                    <table id="dataTable" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%; font-size:12px;">
                        <thead>
                            <tr>
                                <th width="1%" style="text-align: center;">No</th>
                                <th width="15%" style="text-align: center;">Nama Kelompok</th>
                                <th width="15%" style="text-align: center;">Jenis Komoditi</th>
                                <th width="15%" style="text-align: center;">Luas Lahan(Ha)</th>
                                <th width="5%" style="text-align: center;">Luas Tanam(Ha)/(Ekor)</th>
                                <th width="20%" style="text-align: center;">Luas Panen(Ha)</th>
                                <th width="20%" style="text-align: center;">Produksi(Ton)</th>
                                <th width="20%" style="text-align: center;">Produktivitas(Ton/Ha)</th>
                                <th width="20%" style="text-align: center;">Tanggal</th>
                                <th width="20%" style="text-align: center;">Status</th>
                                <th width="20%" style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
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
                        "data": "nama_kelompok",
                        "sClass": "text-left"
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
                maxDate: dateToday,
            })
            $('.input-daterange-datepicker').daterangepicker()
    </script>
@endpush
@push('modal')
<div id="verifikasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content ">
            <form action="javascript:void(0);" method="post" class="form-verifikasi">
                @method('put') @csrf 
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Perkembangan Komoditi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <p class="mb-0 text-justify">Anda akan melakukan verifikasi perkembangan komoditi silahkan klik tombol submit.</p>
                </div>
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-primary">Submit</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
     
@endpush
@push('after-script')
    <script>
        $(function() {
            $('#verifikasi').on('show.bs.modal', function (e) {
                $(this).find('.form-verifikasi').attr('action', $(e.relatedTarget).data('href'));
            });
        });
    </script>
@endpush