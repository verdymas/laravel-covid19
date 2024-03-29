@extends('admin.base')
@section('title', 'Home')
@section('extracss')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
@endsection
@section('content')
    <div class="callout callout-info">
        <div class="d-flex align-items-center">
            <img src="{{ asset('adminlte/dist/img/icon.png') }}" alt="App Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="100">
            <div class="h3 pl-4">
                Selamat Datang di Aplikasi Manajemen COVID19! <br>
                Admin, <span class="font-weight-bold text-uppercase">{{ auth()->guard('admin')->user()->nm_adm }}</span>.
            </div>
        </div>
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ count($isolasi) }}</h3>

                    <p>Pasien Masa Isolasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-injured"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ count($sehat) }}</h3>

                    <p>Pasien Sembuh</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ count($sakit) }}</h3>

                    <p>Pasien Sakit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    {{-- /.row --}}
    <div class="d-none">
        <pre id="graphData">
                    Day Index, Pasien Isolasi, Pasien Sembuh, Pasien Sakit
                    @foreach ($grafik as $v)
                    {{ "$v->tgl,$v->pasien_isolasi,$v->pasien_sembuh,$v->pasien_sakit" }}
                    @endforeach
            </pre>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="mb-3" id="graphDiagram"></div>
        </div>
    </div>
@endsection

@section('extrajs')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        $(function() {
            $('.table').DataTable({
                pageLength: 5,
                dom: '<"mb-2 datatable-header d-flex align-items-center justify-content-center"f><"datatable-scroll-wrap"tr><"mt-2 d-flex justify-content-center"p>',
                columnDefs: [{
                        targets: 'no-sort',
                        orderable: false,
                    },
                    {
                        targets: 'text-truncate',
                        className: 'text-truncate',
                    },
                    {
                        targets: 'text-center',
                        className: 'text-center',
                    },
                    {
                        targets: 'text-right',
                        className: 'text-right',
                    },
                ],
            });

            var graphData = Highcharts.chart('graphDiagram', {
                chart: {
                    scrollablePlotArea: {
                        minWidth: 700
                    }
                },
                data: {
                    csv: document.getElementById('graphData').innerHTML
                },
                title: {
                    text: 'Grafik Pasien'
                },
                xAxis: {
                    tickInterval: 24 * 3600 * 1000, //one day
                    tickWidth: 0,
                    gridLineWidth: 1,
                    labels: {
                        align: 'left',
                        x: 3,
                        y: -3
                    }
                },
                yAxis: [{ // left y axis
                    title: {
                        text: null
                    },
                    labels: {
                        align: 'left',
                        x: 3,
                        y: 16,
                        format: '{value:.,0f}'
                    },
                    showFirstLabel: false
                }, { // right y axis
                    linkedTo: 0,
                    gridLineWidth: 0,
                    opposite: true,
                    title: {
                        text: null
                    },
                    labels: {
                        align: 'right',
                        x: -3,
                        y: 16,
                        format: '{value:.,0f}'
                    },
                    showFirstLabel: false
                }],
                legend: {
                    align: 'left',
                    verticalAlign: 'top',
                    borderWidth: 0
                },
                tooltip: {
                    shared: true,
                    crosshairs: true
                },
                series: [{
                    name: 'Pasien Isolasi'
                }, {
                    name: 'Pasien Sembuh'
                }, {
                    name: 'Pasien Sakit'
                }]
            });
        });

    </script>
@endsection
