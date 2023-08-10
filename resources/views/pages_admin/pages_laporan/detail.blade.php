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
                   <p>Kelompok Tani : <strong>{{  $kelompok->nama_kelompok }}</strong> <br> Nama Ketua : <strong>{{  $kelompok->ketua_kelompok }}</strong> </p>
                </td>
                <td align="right" style="font-family: 'Arial'">
                    <h5 style="font-family: 'Arial'">Jenis Laporan -<br>
                      Data Laporan Anggota Kelompok Tani
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
          <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th style="text-align: center; font-size:14px;">No</th>
                <th style="text-align: center; font-size:14px;">NIK</th>
                <th style="text-align: center; font-size:14px;">Nama</th>
                <th style="text-align: center; font-size:14px;">Jenis Kelamin</th>
                <th style="text-align: center; font-size:14px;">Volume</th>
            </tr>
            </thead>
            <tbody>
              @forelse($data as $index => $item)
                  <tr>
                      <td align="center">{{ $index + 1 }}</td> 
                      <td align="center">{{ $item->nik }}</td> 
                      <td align="center">{{ $item->nama }}</td> 
                      <td align="center">{{ $item->jenis_kelamin }}</td> 
                      <td align="center">{{ $item->volume }}</td> 
                  </tr>
              @empty
                <tr>
                  <td colspan="5">Data tidak ada</td>
                </tr>
              @endforelse
            </tbody>
             
          </table> 
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

</body>
</html>
