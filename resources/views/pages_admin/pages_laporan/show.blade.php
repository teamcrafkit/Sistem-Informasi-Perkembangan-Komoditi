<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Laporan</title>

  <!-- Google Font: Source Sans Pro -->
  <link  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link href="/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link  href="/css/adminlte.min.css" rel="stylesheet">
  <style>
    .header {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
</head>
<body>
<div class="wrapper p-1">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-md-12">
        <table border="0" cellpadding="1" cellspacing="1" width="100%">
              <tr>
                <td align="left" valign="top">
                  <h4 class="text-left header" ><i class="fe-file-text"></i> {{ strtoupper(hapus_underscore(request()->segment(2))) }}</h4>
               
                </td>
                <td align="right">
                  <p>Tanggal : {{ date('Y-m-d') }}</p>
                </td>
              </tr>
              <tr>
                <td style="font-family: 'Arial'">
                   <p>Kecamatan : {{ $kecamatan->nama }} <br> Desa : {{ $desa->nama }} <br> Tanggal : Dari Tanggal : {{ $tanggal[0] }}  <strong>s/d</strong> {{ $tanggal[1] }}</p>
                </td>
                <td align="right" style="font-family: 'Arial'">
                    <h5 style="font-family: 'Arial'">Jenis Laporan -<br>
                      Data Laporan {{ $request->jenis }}
                    </h5>
                </td>
              </tr>
            </table>
            <hr>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
         <!-- Table row -->
    <div class="row">
      <div class="col-md-12">
        @if ($request->jenis == "Perkembangan Komoditi")
          <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th style="text-align: center; font-size:14px;">No</th>
                <th style="text-align: center; font-size:14px;">Nama Kelompok</th>
                <th style="text-align: center; font-size:14px;">Nama Ketua</th>
                <th style="text-align: center; font-size:14px;">NIK</th>
                <th style="text-align: center; font-size:14px;">Jenis Komoditi</th>
                <th style="text-align: center; font-size:14px;">Luas Lahan (Ha)</th>
                <th style="text-align: center; font-size:14px;">Luas Tanam/Area/Populasi(Ha)/(Ekor)</th>
                <th style="text-align: center; font-size:14px;">Luas Panen (Ha)</th>
                <th style="text-align: center; font-size:14px;">Produksi (Ton)</th>
                <th style="text-align: center; font-size:14px;">Produktifitas (Ton/Ha)</th>
            </tr>
            </thead>
            <tbody>
              @php
                $ll = 0;
                $lt = 0;
                $lp = 0;
                $pk = 0;
                $pf = 0;
              @endphp
              @forelse($data as $index => $item)
                  <tr>
                      <td align="center">{{ $index + 1 }}</td> 
                      <td align="center">{{ $item->kelompok->nama_kelompok }}</td> 
                      <td align="center">{{ $item->kelompok->ketua_kelompok }}</td> 
                      <td align="center">{{ $item->kelompok->nik }}</td> 
                      <td align="center">{{ $item->jenis->nama }}</td> 
                      <td align="center">{{ $item->luas_lahan }}</td> 
                      <td align="center">{{ $item->luas_tanam }}</td> 
                      <td align="center">{{ $item->luas_panen }}</td> 
                      <td align="center">{{ $item->produksi }}</td> 
                      <td align="center">{{ $item->produktifitas }}</td> 
                  </tr>
                  @php
                    $ll += $item->luas_lahan;
                    $lt += $item->luas_tanam;
                    $lp += $item->luas_panen;
                    $pk += $item->produksi;
                    $pf += $item->produktifitas;
                  @endphp
              @empty
                <tr>
                  <td colspan="5">Data tidak ada</td>
                </tr>
              @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td align="left" colspan="4" style="font-weight:bold;">Total</td>  
                    <td align="center" style="font-weight:bold;">{{ $ll }}</td> 
                    <td align="center" style="font-weight:bold;">{{ $lt }}</td> 
                    <td align="center" style="font-weight:bold;">{{ $lp }}</td> 
                    <td align="center" style="font-weight:bold;">{{ $pk }}</td> 
                    <td align="center" style="font-weight:bold;">{{ $pf }}</td> 
                </tr>
            </tfoot>
          </table>
        @elseif($request->jenis == "Kelompok Tani")
          <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th style="text-align: center; font-size:14px;">No</th>
                <th style="text-align: center; font-size:14px;">Nama Kelompok</th>
                <th style="text-align: center; font-size:14px;">NIK</th>
                <th style="text-align: center; font-size:14px;">Ketua Kelomok</th>
                <th style="text-align: center; font-size:14px;">Jumlah Anggota</th>
                <th style="text-align: center; font-size:14px;">Status</th>
            </tr>
            </thead>
            <tbody>
              @forelse($data as $index => $item)
                  <tr>
                      <td align="center">{{ $index + 1 }}</td> 
                      <td align="center">{{ $item->nama_kelompok }}</td> 
                      <td align="center">{{ $item->nik }}</td> 
                      <td align="center">{{ $item->ketua_kelompok }}</td> 
                      <td align="center"><a href="{{ route('data-laporan.detail',$item->id) }}">{{ $item->anggotakelompok->count() }}</a></td> 
                      <td align="center">{{ $item->email_verified_at }}</td> 
                  </tr>
              @empty
                <tr>
                  <td colspan="5">Data tidak ada</td>
                </tr>
              @endforelse
            </tbody>
             
          </table>
        @endif
        {{-- <div class="align-center">
            <a href="javascript:window.print()" class="btn btn-primary hidden-print">Print</a>
        </div> --}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

     
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
