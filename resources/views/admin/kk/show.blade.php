@extends('admin.base')
@section('title', 'Kartu Keluarga')
@section('content')
    @if($msg = session()->get('success'))
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
    <div class="card p-0">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">
                    No. {{ $data->no_kk }}&emsp;<span
                        class="badge badge-{{ $data->stat_kk == 1 ? 'success' : 'danger' }}">
                    {{ $data->stat_kk == 1 ? 'Active' : 'Inactive' }}</span>
                    <span class="badge badge-info">{{ $data->akun_admin->username }} | {{ $data->akun_admin->nm_adm }}</span>
                </h3>
                <div class="card-tools">
                    <a href="{{ route('warga.create', 'id_kk=' . $data->id_kk) }}" class="btn btn-primary btn-sm"
                       title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                    <a href="{{ route('kartu-keluarga.edit', $data->id_kk) }}"class="btn btn-primary btn-sm"
                       title="Ubah"><i class="fa fa-edit"></i></a>
                    <button onclick="history.back();" class="btn btn-primary btn-sm" title="Kembali">
                        <i class="fa fa-arrow-left"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table-wrg table table-striped table-bordered table-hover mb-3">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%" class="text-center">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col" style="width: 15%" class="text-center">Jenis Kelamin</th>
                        <th scope="col" style="width: 10%" class="text-center">Kesehatan</th>
                        <th scope="col" style="width: 10%" class="text-center">Status</th>
                        <th scope="col" style="width: 15%" class="text-center"><i class="fa fa-exclamation-circle"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->warga->count() != 0)
                        @foreach($data->warga as $k => $v)
                            <tr>
                                <th scope="row">{{ $k+1 }}</th>
                                <td>{{ $v->nm_wrg}}</td>
                                <td>{{ $v->jk_wrg == '1' ? 'Pria' : 'Wanita' }}</td>
                                <td>
                                    <span class="badge badge-{{ $v->statskt_wrg == 0 ? 'success' : 'danger' }}">
                                        {{ $v->statskt_wrg == 0 ? 'Sehat' : 'Sakit' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $v->stat_wrg == 1 ? 'success' : 'danger' }}">
                                        {{ $v->stat_wrg == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('warga.edit', $v->id_wrg) }}" class="btn btn-primary btn-sm"
                                       title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('warga.show', $v->id_wrg) }}" class="btn btn-info btn-sm"
                                       title="Detail"><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th scope="row" colspan="7" class="text-center">Tidak ada data</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
