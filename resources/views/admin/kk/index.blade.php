@extends('admin.base')
@section('title', 'Kartu Keluarga')
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
                <h3 class="card-title"><span class="badge badge-success">Data</span> Kartu Keluarga</h3>
                {{-- <div class="card-tools">
                    <a href="{{ route('kartu-keluarga.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah</a>
                </div> --}}
            </div>
        </div>
        <div class="card-body row">
            <div class="col-lg-4 col-md-12 mb-3">
                <form method="post" action="{{ route('kartu-keluarga.store') }}">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge badge-primary">Form Tambah</span>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    @csrf
                    <div class="form-group">
                        <input type="text" name="no_kk" id="no_kk" class="form-control" placeholder="No. Kartu Keluarga"
                            required>
                    </div>
                    <div class="form-group">
                        <select name="id_adm" id="id_adm" class="form-control" required>
                            <option value="">-- pilih satgas --</option>
                            @foreach ($stg as $i)
                                <option value="{{ $i->id_adm }}">{{ $i->username }} | {{ $i->nm_adm }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-12 mb-3">
                <table id="table-kk" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No. Kartu Keluarga</th>
                            <th scope="col" class="text-center">Jumlah</th>
                            <th scope="col" class="text-center">Admin</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="no-sort text-center"><span class="d-none">Settings</span><i
                                    class="fa fa-exclamation-circle"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extrajs')
    <script>
        $(function() {
            $('#table-kk').DataTable({
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
                ajax: {
                    type: 'get',
                    dataFilter: function(data) {
                        var json = jQuery.parseJSON(data);

                        return JSON.stringify(json);
                    },
                },
            });
        });

    </script>
@endsection
