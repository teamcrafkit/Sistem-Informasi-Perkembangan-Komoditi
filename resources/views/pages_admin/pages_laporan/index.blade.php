@extends('pages_admin.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="header-title">{{ ucwords(request()->segment(3)) }}
                    {{ hapus_underscore(request()->segment(2)) }}</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-2">
                            <form class="form-horizontal parsley-form" action="{{ $route }}" target="_blank"
                                method="post" enctype="multipart/form-data" autocomplete="off" data-parsley-validate
                                novalidate autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2  text-sm-right" for="jenis">Jenis Laporan</label>
                                    <div class="col-sm-3">
                                        <select name="jenis" id="jenis" class="form-control custom-select required jenis"
                                            required>
                                            <option value="">Pilih</option>
                                            <option value="Perkembangan Komoditi">Perkembangan Komoditi</option>
                                            <option value="Kelompok Tani">Kelompok Tani</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row field-kecamatan" style="display: none;">
                                    <label for="kecamatan_id"
                                        class="col-md-2 col-form-label text-md-right">Kecamatan</label>
                                    <div class="col-md-3">
                                        <select name="kecamatan_id" class="form-control required kecamatan_id" required>
                                            <option value="">Pilih--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row field-desa" style="display: none;">
                                    <label for="desa_id" class="col-md-2 col-form-label text-md-right">Desa</label>
                                    <div class="col-md-3">
                                        <select name="desa_id" class="form-control required desa_id" required>
                                            <option value="">Pilih--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row field-tanggal" style="display: none;">
                                    <label class="col-form-label col-md-2  text-sm-right" for="Tanggal">Tanggal</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="tanggal" name="tanggal" placeholder="Tanggal"
                                            autocomplete="off" class="form-control required tanggal" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
@endpush
@push('after-script')
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        $(function() {
            $('#tanggal').daterangepicker({
                locale: {
                    format: "YYYY-MM-DD"
                }
            })
            $(".jenis").change(function() {
                let jenis = $(".jenis").val();
                if (jenis == "Perkembangan Komoditi") {
                    $(".field-kecamatan").show();
                    $(".field-desa").show();
                    $(".field-tanggal").show();

                    $(".tanggal").attr('required')
                    $(".desa_id").attr('required')
                    $(".kecamatan_id").attr('required')

                } else if (jenis == "Kelompok Tani") {
                    $(".field-kecamatan").show();
                    $(".field-desa").show();
                    $(".field-tanggal").hide();

                    $(".tanggal").removeAttr('required')
                    $(".desa_id").attr('required')
                    $(".kecamatan_id").attr('required')
                }
            });
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
                                    id: e.params.data.id
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
