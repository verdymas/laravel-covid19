@extends('admin.base')
@section('title', 'Warga')
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
                <h3 class="card-title"><span class="badge badge-success">Data</span> Warga</h3>
                <div class="card-tools">
                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body row">
            <div class="col-lg-4 col-md-12 mb-3">
                <form method="post" action="{{ route('warga.store') }}">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge badge-primary">Form Tambah</span>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div class="form-group">
                        <select name="id_kk" id="id_kk" class="form-control" required>
                            <option value="">-- pilih kartu keluarga --</option>
                            @foreach($kk as $v)
                                @if($v->id_kk == request()->id_kk)
                                    <option value="{{ $v->id_kk }}" selected>{{ $v->no_kk }}</option>
                                @else
                                    <option value="{{ $v->id_kk }}">{{ $v->no_kk }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="nik_wrg" class="form-control" placeholder="NIK" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nm_wrg" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-5 col-lg-5">
                            <input type="text" name="tmplhr_wrg" class="form-control" placeholder="Tempat" required>
                        </div>
                        <div class="col-7 col-lg-7">
                            <input type="date" name="tgllhr_wrg" class="form-control" placeholder="Tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="jk_wrg" id="jk_wrg" class="form-control" required>
                            <option value="">-- pilih kelamin --</option>
                            <option value="1">Pria</option>
                            <option value="0">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="almt_wrg" id="" almt_wrg cols="30" rows="3" class="form-control"
                            placeholder="Alamat" required></textarea>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-12 mb-3">
                <table class="table table-striped table-bordered table-hover mb-3" id="table-wrg">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">No KK</th>
                            <th scope="col" class="text-center">Kelamin</th>
                            {{-- <th scope="col" class="text-center">Status</th> --}}
                            <th scope="col" class="text-center"><span class="d-none">Settings</span><i
                                    class="fa fa-exclamation-circle"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $k => $v)
                            <tr>
                                <td>{{ $v->nm_wrg }}</td>
                                <td>{{ $v->kk->no_kk }}</td>
                                <td>{{ $v->jk_wrg == '1' ? 'Pria' : 'Wanita' }}</td>
                                {{-- <td>
                                    <span class="badge badge-{{ $v->stat_wrg == 1 ? 'success' : 'danger' }}">
                                        {{ $v->stat_wrg == 1 ? 'Active' : 'Inactive' }}</span>
                                </td> --}}
                                <td>
                                    <a href="{{ route('warga.edit', $v->nik_wrg) }}" class="btn btn-primary btn-sm"
                                        title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('warga.show', $v->nik_wrg) }}" class="btn btn-info btn-sm"
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
