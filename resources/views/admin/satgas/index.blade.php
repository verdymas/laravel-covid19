@extends('admin.base')
@section('title', 'Satuan Petugas')
@section('content')
    @if ($msg = session()->get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $msg }}
        </div>
    @elseif($msg = session()->get('success'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $msg }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title"><span class="badge badge-success">Data</span> Satuan Petugas</h3>
                <div class="card-tools">
                    <a href="{{ route('satgas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body row">
            <div class="col-lg-4 col-md-12 mb-3">
                <form method="post" action="{{ route('satgas.store') }}">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge badge-primary">Form Tambah</span>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nm_adm" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="col-6">
                            <input type="password" name="password" class="form-control" placeholder="********" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-12 mb-3">
                <table class="table table-striped table-bordered table-hover mb-3" id="table-stg">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col" class="text-center">Username</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center"><span class="d-none">Settings</span><i
                                    class="fa fa-exclamation-circle"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $k => $v)
                            <tr>
                                <td>{{ $v->nm_adm }}</td>
                                <td>{{ $v->username }}</td>
                                <td>
                                    <span class="badge badge-{{ $v->stat_adm == 1 ? 'success' : 'danger' }}">
                                        {{ $v->stat_adm == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('satgas.edit', $v->id_adm) }}" class="btn btn-primary btn-sm"
                                        title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('satgas.show', $v->id_adm) }}" class="btn btn-info btn-sm"
                                        title="Detail"><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extrajs')
    <script>
        $(function() {
            $('#table-stg').DataTable({
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
