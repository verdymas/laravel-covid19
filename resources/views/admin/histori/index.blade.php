@extends('admin.base')
@section('title', 'Histori')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">Histori Sakit</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover mb-3" id="table-histori-i">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col" class="text-center">NIK</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $v)
                        <tr>
                            <td>{{ $v->his->warga->nm_wrg }}</td>
                            <td>{{ $v->his->warga->nik_wrg }}</td>
                            <td>
                                {{ date('d-m-Y', strtotime($v->his->tgl_skt)) }}
                                <span class="badge badge-success mx-2"><i class="fas fa-arrow-right"></i></span>
                                {{ date('d-m-Y', strtotime($v->his->tgl_sls)) }}
                            </td>
                            <td>
                                @if ($v->his->stat_skt === 1)
                                    <span class="badge badge-primary">Isolasi</span>
                                @elseif ($v->his->st_skt == 0)
                                    <span class="badge badge-success">Sembuh</span>
                                @elseif ($v->his->st_skt == 2)
                                    <span class="badge badge-warning">Berlanjut</span>
                                @else
                                    <span class="badge badge-danger">Unknown</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('extrajs')
    <script>
        $(function() {
            $('#table-histori-i').DataTable({
                deferRender: true,
                scrollY: 300,
                scrollCollapse: true,
                scroller: true,
                buttons: [{
                        extend: 'print',
                        className: 'btn-default',
                    }, {
                        extend: 'copy',
                        className: 'btn-info'
                    }, {
                        extend: 'pdf',
                        className: 'btn-warning'
                    }, {
                        extend: 'excel',
                        className: 'btn-success',
                    }, {
                        extend: 'colvis',
                        className: 'btn-danger'
                    },

                ],
                dom: '<"datatable-header d-flex align-items-center justify-content-between"fB><"datatable-scroll-wrap"tr><"d-flex justify-content-between"ip>',
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
