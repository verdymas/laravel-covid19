@extends('admin.base')
@section('title', 'Kartu Keluarga')
@section('content')
    @if ($msg = session()->get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $msg }}
        </div>
    @elseif($msg = session()->get('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ $msg }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            @foreach ($errors->all() as $error)
                @if (!$loop->first)<br>@endif
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="card p-0">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">
                    No. {{ $data->no_kk }}&emsp;<span class="badge badge-{{ $data->stat_kk == 1 ? 'success' : 'danger' }}">
                        {{ $data->stat_kk == 1 ? 'Active' : 'Inactive' }}</span>
                    <span class="badge badge-info">{{ $data->akun_admin->username }} |
                        {{ $data->akun_admin->nm_adm }}</span>
                </h3>
                <div class="card-tools">
                    {{-- <a href="{{ route('warga.create', 'id_kk=' . $data->id_kk) }}" class="btn btn-primary btn-sm"
                        title="Tambah"><i class="fa fa-plus"></i> Tambah</a> --}}
                    <a href="{{ route('kartu-keluarga.edit', $data->id_kk) }}" class="btn btn-primary btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
                    <button onclick="history.back();" class="btn btn-primary btn-sm" title="Kembali">
                        <i class="fa fa-arrow-left"></i></button>
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
                        <input type="text" value="{{ $data->no_kk }}" class="form-control" readonly disabled>
                        <input type="hidden" value="{{ $data->id_kk }}" name="id_kk">
                    </div>
                    <div class="form-group">
                        <input type="number" value="{{ old('nik_wrg') }}" name="nik_wrg" class="form-control" placeholder="NIK" required>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('nm_wrg') }}" name="nm_wrg" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-5 col-lg-5">
                            <input type="text" value="{{ old('tmplhr_wrg') }}" name="tmplhr_wrg" class="form-control" placeholder="Tempat" required>
                        </div>
                        <div class="col-7 col-lg-7">
                            <input type="date" value="{{ old('tgllhr_wrg') }}" name="tgllhr_wrg" class="form-control" placeholder="Tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="jk_wrg" id="jk_wrg" class="form-control" required>
                            <option value="">-- pilih kelamin --</option>
                            <option value="1" {{ old('jk_wrg') == 1 ? 'selected' : '' }}>Pria</option>
                            <option value="0" {{ old('jk_wrg') == 0 ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Alamat" disabled>Alamat:   {{ $data->almt_kk }}</textarea>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-md-12 mb-3">
                <table class="table table-striped table-bordered table-hover" id="table-wrg">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col" class="text-center">Kelamin</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center"><span class="d-none">Settings</span><i class="fa fa-exclamation-circle"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->warga as $k => $v)
                            <tr>
                                <td>{{ $v->nm_wrg }}</td>
                                <td>{{ $v->jk_wrg == '1' ? 'Pria' : 'Wanita' }}</td>
                                <td>
                                    <span class="badge badge-{{ $v->stat_wrg == 1 ? 'success' : 'danger' }}">
                                        {{ $v->stat_wrg == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('warga.edit', $v->nik_wrg) }}" class="btn btn-primary btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('warga.show', $v->nik_wrg) }}" class="btn btn-info btn-sm" title="Detail"><i class="fa fa-info"></i></a>
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
