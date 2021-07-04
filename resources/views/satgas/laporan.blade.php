@extends('satgas.base')
@section('title', 'Laporan')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-6 col-sm-12">
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
        <div class="col-lg-6 col-sm-12">
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
        <div class="col-lg-6 col-sm-12">
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
        <div class="col-lg-6 col-sm-12">
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
