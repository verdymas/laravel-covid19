@extends('satgas.base')
@section('title', 'Kesehatan')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">Kesehatan</h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover mb-3" id="table-wrg">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col" style="width: 5%" class="text-center">Usia</th>
                        <th scope="col" style="width: 15%" class="text-center">Jenis Kelamin</th>
                        <th scope="col" style="width: 10%" class="text-center">Kesehatan</th>
                        <th scope="col" style="width: 15%" class="text-center"><i class="fa fa-exclamation-circle"></i>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $k => $v)
                        <tr>
                            <td>{{ $v->nm_wrg }}</td>
                            <td>{{ $v->umur_wrg }}</td>
                            <td>{{ $v->jk }}</td>
                            <td>{{ $v->st_skt }}</td>
                            <td>
                                <a href="{{ route('kesehatan.edit', $v->nik_wrg) }}" class="btn btn-primary btn-sm"
                                    title="Ubah"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('kesehatan.show', $v->nik_wrg) }}" class="btn btn-info btn-sm"
                                    title="Detail"><i class="fa fa-info"></i></a>
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
            $('#table-wrg').DataTable({
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
                dom: '<"datatable-header"<"float-right"B>><"datatable-scroll-wrap"tr><"d-flex justify-content-between"ip>',
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
