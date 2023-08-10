@extends('pages_admin.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Perkembangan Komoditi</h3>
                <div class="card-tools">
                    <div class="btn-group pull-right">
                        <a href="{{ route('perkembangan-komoditi-admin.index') }}" class="btn btn-sm btn-default "  > <i class="fe-arrow-left"></i> Kembali</a>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-md table-bordered">
                  <tbody>
                    <tr>
                      <td width="15%">Nama Kecamatan</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->kecamatan->nama }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Nama Desa</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->desa->nama }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Jenis Komoditi</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->jenis->nama }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Nama Kelompok Tani</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->kelompok->nama_kelompok }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Luas Lahan(Ha)</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->luas_lahan }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Luas Tanam(Ha)/(Ekor)</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->luas_tanam }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Luas Panen(Ha)</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->luas_panen }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Produksi(Ton)</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->produksi }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Produktivitas(Ton/Ha)</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->produktifitas }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Tanggal</td>
                      <td width="1%">:</td>
                      <td width="80%">{{ $data->tanggal }}</td>
                    </tr>
                    <tr>
                      <td width="15%">Status</td>
                      <td width="1%">:</td>
                      <td width="80%">
                        @if ($data->status == 0)
                            <a href="javascript:void(0);" class="btn btn-danger btn-xs">Belum Verifikasi </a>
                        @else
                            <a href="javascript:void(0);" class="btn btn-success btn-xs">Sudah Verifikasi </a>
                        @endif  
                        </td>
                    </tr>
                  </tbody>
                </table>
                <br>
                @if ($data->status == 0)
                <a data-toggle="modal" data-target="#verifikasi" href="javascript:void(0);" data-id="{{ $data->id }}" data-href="{{ route('perkembangan-komoditi-admin.status', _encdec('enc', $data->id)) }}" class="btn btn-sm btn-primary"> Verifikasi <i class="fe-check-square fa-lg"></i></a>
                @endif
            </div>
              <!-- /.card-body -->
               
            </div>
            <!-- /.card -->
         
    </div>
</div> 
@endsection

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