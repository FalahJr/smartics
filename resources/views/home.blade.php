@extends('main')

@section('content')


<!-- partial -->
<div class="content-wrapper">
  <div class="row">
    <div class="col-12">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb bg-warning">
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>
    <div class="row col-12 justify-content-start mx-auto">
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6  || Auth::user()->role_id == 7 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 8)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Diajukan</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('status', 'not like', 'Pengisian Dokumen')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 3)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Perlu Penerbitan</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('status', 'Verifikasi Kepala Dinas')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 3)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Riwayat Audit</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('audit')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif
     
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6) 
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Divalidasi</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('status', 'Validasi Operator')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 6)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Diverifikasi</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('status', 'Verifikasi Verifikator')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 1)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Diproses</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->whereNotIn('status', ['Selesai', 'Ditolak', 'Pengisian Dokumen'])->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if ( Auth::user()->role_id == 6  || Auth::user()->role_id == 7 || Auth::user()->role_id == 2 || Auth::user()->role_id == 8)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Disurvey</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            if(Auth::user()->role_id == 7){
              echo DB::table('survey')->join('surat', 'surat.id' ,'=' ,'survey.surat_id')->where('surat.status','Penjadwalan Survey')->where('surat.is_acc_penjadwalan' ,'Y')->where('survey.user_id',Auth::user()->user_id)->count();
            }else if(Auth::user()->role_id == 8){
              echo DB::table('survey')->join('surat', 'surat.id' ,'=' ,'survey.surat_id')->where('surat.status','Penjadwalan Survey')->where('surat.is_acc_penjadwalan' ,'Y')->where('survey.status', 'Sudah Disurvey')->count();
            }
            else{
              echo DB::table('surat')->where('status','Penjadwalan Survey')->where('is_acc_penjadwalan' ,'Y')->count();

            }
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6  || Auth::user()->role_id == 7 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 8)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Ditolak</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('status','Ditolak')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5 || Auth::user()->role_id == 6  || Auth::user()->role_id == 7 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 8)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Perizinan Disetujui</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('status','Selesai')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 1)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Terlambat Diproses</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('surat')->where('is_terlambat','Y')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4 || Auth::user()->role_id == 8)
      <div class="col-md-3 col-6">
        <div class="card px-4 py-2 my-2">
          <div class="row justify-content-between">
            <p>Jumlah Ulasan</p>
            {{-- <a href="" class="text-dark"><i class="fa-solid fa-ellipsis-vertical"></i></a> --}}
          </div>
          <h1 class="row my-0 py-0">
            @php
            echo DB::table('ulasan')->count();
          @endphp
          </h1>
        </div>
      </div>
      @endif

     
    </div>
  </div>

  <div class="row mx-auto mt-4">
    <div class="col-6">
      <figure class="highcharts-figure">
        <div id="chart"></div>
    </figure>
    </div>

  <div class="col-6">
    <figure class="highcharts-figure">
      <div id="container"></div>
  </figure>
  
  </div>
  </div>


  </div>

@endsection

@section('extra_script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
   var columnchart = @json($columnchart);
  Highcharts.chart('chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jumlah Perizinan',
        align: 'left'
    },
    xAxis: {
        categories: columnchart.map(item => item.month),
    },
    series: [
        {
            name: 'Total Perizinan',
            data: columnchart.map(item => item.total),
            color: '#1CC88A'
        },
    ]
});


(function (H) {
    H.seriesTypes.pie.prototype.animate = function (init) {
        const series = this,
            chart = series.chart,
            points = series.points,
            {
                animation
            } = series.options,
            {
                startAngleRad
            } = series;

        function fanAnimate(point, startAngleRad) {
            const graphic = point.graphic,
                args = point.shapeArgs;

            if (graphic && args) {

                graphic
                    // Set inital animation values
                    .attr({
                        start: startAngleRad,
                        end: startAngleRad,
                        opacity: 1
                    })
                    // Animate to the final position
                    .animate({
                        start: args.start,
                        end: args.end
                    }, {
                        duration: animation.duration / points.length
                    }, function () {
                        // On complete, start animating the next point
                        if (points[point.index + 1]) {
                            fanAnimate(points[point.index + 1], args.end);
                        }
                        // On the last point, fade in the data labels, then
                        // apply the inner size
                        if (point.index === series.points.length - 1) {
                            series.dataLabelsGroup.animate({
                                opacity: 1
                            },
                            void 0,
                            function () {
                                points.forEach(point => {
                                    point.opacity = 1;
                                });
                                series.update({
                                    enableMouseTracking: true
                                }, false);
                                chart.update({
                                    plotOptions: {
                                        pie: {
                                            innerSize: '40%',
                                            borderRadius: 8
                                        }
                                    }
                                });
                            });
                        }
                    });
            }
        }

        if (init) {
            // Hide points on init
            points.forEach(point => {
                point.opacity = 0;
            });
        } else {
            fanAnimate(points[0], startAngleRad);
        }
    };
}(Highcharts));

const piechart = @json($piechart);
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Persentase Permohonan',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            borderWidth: 2,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage:.0f}%',
                distance: 20
            }
        }
    },
    series: [{
        // Disable mouse tracking on load, enable after custom animation
        enableMouseTracking: false,
        animation: {
            duration: 1000
        },
        colorByPoint: true,
        data:[
                {
                    name: 'Diterima',
                    y: piechart.acceptedPercentage,
                    color: piechart.acceptedColor
                },
                {
                    name: 'Ditolak',
                    y: piechart.rejectedPercentage,
                    color: piechart.rejectedColor
                },
            ]
        
    }]
});


</script>
@endsection
