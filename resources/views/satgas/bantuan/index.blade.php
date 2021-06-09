@extends('satgas.base')
@section('title', 'Bantuan')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">Bantuan</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover mb-3" id="table-bntu-i">
                <thead>
                    <tr>
                        <th scope="col">No. Kartu Keluarga</th>
                        <th scope="col" class="text-right">Jumlah</th>
                        <th scope="col" class="text-right">Hari</th>
                        <th scope="col" class="text-right">Total</th>
                        <th scope="col" class="text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $v)
                        <tr>
                            <td>
                                {{ $v->no_kk }}
                            </td>
                            <td>{{ App\Helpers\Helper::formatRupiah($v->jml_ban, 0) }}</td>
                            <td>x{{ $v->hri_ban }}</td>
                            <td>{{ App\Helpers\Helper::formatRupiah($v->tot_ban, 0) }}</td>
                            <td>
                                {{ date('d-m-Y', strtotime($v->tgl_skt)) }}
                                <span class="badge badge-success mx-2"><i class="fas fa-arrow-right"></i></span>
                                {{ date('d-m-Y', strtotime($v->tgl_sls)) }}
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
            $('#table-bntu-i').DataTable({
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
