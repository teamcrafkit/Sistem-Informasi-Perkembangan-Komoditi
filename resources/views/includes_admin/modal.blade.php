{{-- Modal Delete --}}
<div class="modal fade modal-delete" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" class="form-delete">
                @method('delete') @csrf
                <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body m-3">
                <p class="mb-0">Anda akan menghapus satu baris dari data tabel. Anda yakin untuk menghapus? <br>Delete : <strong><span class="data-debug"></span></strong></p>
                </div>
                <div class="modal-footer"> 
                <button type="submit" class="btn btn-danger">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="confirm-pengaduan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content ">
            <form action="javascript:void(0);" method="post" class="form-verifikasi-pengaduan">
                @method('put') @csrf 
                <input type="hidden" name="title" class="title">
                <div class="modal-header">
                    <h5 class="modal-title">Status Pengaduan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <p class="mb-0 text-justify">Anda akan mengubah status pengaduan menjadi <span class="data-title" style="font-weight: bold;"></span> dengan nomor <span class="data-get" style="font-weight: bold;"></span> silahkan klik tombol submit.</p>
                </div>
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-primary">Submit</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="verifikasi-proposal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-MD">
        <div class="modal-content ">
            <form action="javascript:void(0);" method="post" class="form-verifikasi-proposal parsley-form">
                @method('put') @csrf 
                <input type="hidden" name="title" class="title">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="lokasi_penerima_bantuan" id="lokasi_penerima_bantuan">
                                <label class="custom-control-label" for="lokasi_penerima_bantuan">Lokasi Penerima Bantuan</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="sertifikat_tempat" id="sertifikat_tempat">
                                <label class="custom-control-label" for="sertifikat_tempat">Sertifikat Tempat</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="tempat_strategis" id="tempat_strategis">
                                <label class="custom-control-label" for="tempat_strategis">Tempat Strategis</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="ktp" id="ktp">
                                <label class="custom-control-label" for="ktp">KTP</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="surat_tidak_mampu" id="surat_tidak_mampu">
                                <label class="custom-control-label" for="surat_tidak_mampu">Surat Tidak Mampu</label>
                            </div>
                        </div>
                    </div>
                     
                </div>
                <div class="modal-footer"> 
                    <button type="submit" class="btn btn-primary">Submit</a>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade detail-maps" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="full-width-modalLabel">Detail Lokasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" style="font-size: 14px;">
                        <tr>
                            <td width="50%">Nama Kelompok</td>
                            <td width="50%"><div class="name"></div></td>
                        </tr>
                        <tr>
                            <td width="50%">Jenis Usaha</td>
                            <td width="50%"><div class="jenis"></div></td>
                        </tr>
                        <tr>
                            <td width="50%">Produk Yang Dihasilkan</td>
                            <td width="50%"><div class="produk"></div></td>
                        </tr>
                        <tr>
                            <td width="50%">Jumlah Tenaga Kerja</td>
                            <td width="50%"><div class="tenaga_kerja"></div></td>
                        </tr>
                        <tr>
                            <td width="50%">Perkembangan Usaha</td>
                            <td width="50%"><div class="perkembangan"></div></td>
                        </tr>
                        <tr>
                            <td width="50%">Lokasi Usaha</td>
                            <td width="50%"><div class="lokasi"></div></td>
                        </tr> 
                        <tr>
                            <td width="50%">Keterangan</td>
                            <td width="50%"><div class="keterangan"></div></td>
                        </tr>
                    </table>
                </div>
                 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- Modal Content End -->
{{-- End Modal --}}