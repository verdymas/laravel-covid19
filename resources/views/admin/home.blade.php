@extends('admin.base')
@section('title', 'Home')
@section('content')
    <div class="callout callout-info">
        <div class="d-flex align-items-center">
            <img src="{{ asset('adminlte/dist/img/icon.png') }}" alt="App Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8" width="100">
            <div class="h3 pl-4">
                Selamat Datang di Aplikasi Manajemen COVID19! <br>
                Admin, <span class="font-weight-bold text-uppercase">{{ auth()->guard('admin')->user()->nm_adm }}</span>.
            </div>
        </div>
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-6">
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
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ count($berlanjut) }}</h3>

                    <p>Pasien Berlanjut</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-minus"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
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
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ count($isolasibln) }}</h3>

                    <p>Pasien Masa Isolasi (Bulan Ini)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{ count($berlanjutbln) }}</h3>

                    <p>Pasien Berlanjut (Bulan Ini)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-atlas"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{ count($sehatbln) }}</h3>

                    <p>Pasien Sembuh (Bulan Ini)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book-medical"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    {{-- /.row --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-sm-12">
            <div class="card card-outline card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-injured mr-2"></i>
                        Pasien Isolasi
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl. Isolasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isolasi as $item)
                                <tr>
                                    <td>{{ $item->nm_wrg }}</td>
                                    <td>{{ $item->tgl_skt }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- /.col --}}
        <div class="col-lg-4 col-sm-12">
            <div class="card card-outline card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-plus mr-2"></i>
                        Pasien Berlanjut
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl. Berlanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berlanjut as $item)
                                <tr>
                                    <td>{{ $item->nm_wrg }}</td>
                                    <td>{{ $item->tgl_sls }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- /.col --}}
        <div class="col-lg-4 col-sm-12">
            <div class="card card-outline card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-plus mr-2"></i>
                        Pasien Sembuh
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl. Sembuh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sehat as $item)
                                <tr>
                                    <td>{{ $item->nm_wrg }}</td>
                                    <td>{{ $item->tgl_smb }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-sm-12">
            <div class="card card-outline card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-injured mr-2"></i>
                        Pasien Isolasi (Bulan Ini)
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl. Isolasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isolasibln as $item)
                                <tr>
                                    <td>{{ $item->nm_wrg }}</td>
                                    <td>{{ $item->tgl_skt }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- /.col --}}
        <div class="col-lg-4 col-sm-12">
            <div class="card card-outline card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-plus mr-2"></i>
                        Pasien Berlanjut (Bulan Ini)
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl. Berlanjut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berlanjutbln as $item)
                                <tr>
                                    <td>{{ $item->nm_wrg }}</td>
                                    <td>{{ $item->tgl_sls }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- /.col --}}
        <div class="col-lg-4 col-sm-12">
            <div class="card card-outline card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-plus mr-2"></i>
                        Pasien Sembuh (Bulan Ini)
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Tgl. Sembuh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sehatbln as $item)
                                <tr>
                                    <td>{{ $item->nm_wrg }}</td>
                                    <td>{{ $item->tgl_smb }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@endsection

@section('extrajs')
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
        });

    </script>
@endsection
