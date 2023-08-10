@extends('pages_admin.main')
@section('content')
<div class="container-fluid p-0"> 
    <div class="row">
        <div class="col-12">
            <div class="card"> 
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="h4">
                            Data Grafik Jenis Komoditi {{ $jenis->nama }}
                        </span>
                    </h3>
                    <div class="card-tools">
                        <div class="btn-group pull-right">
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafik" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
<script src="/js/highcharts.js"></script>
<script src="/js/exporting.js"></script>
<script>
    $(function () {
         
        $('#grafik').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'column',
                
            },
            xAxis: {
                categories: {!! json_encode($tahun,JSON_NUMERIC_CHECK) !!} ,
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total'
                }
            },
            title: {
                text: 'Data Grafik Jenis Komoditi {{ $jenis->nama }}'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series:  {!! json_encode($grafik,JSON_NUMERIC_CHECK) !!}
        });
         
    });
</script>
@endpush