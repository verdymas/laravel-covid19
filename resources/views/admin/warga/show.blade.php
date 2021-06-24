@extends('admin.base')
@section('title', 'Warga')
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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">ID. Warga: <span class="badge badge-success">{{ $data->nik_wrg  }}</span></h3>
                <div class="card-tools">
                    <a href="{{ route('warga.edit', $data->nik_wrg) }}" class="btn btn-primary btn-sm" title="Edit">
                        <i class="fa fa-edit"></i></a>
                    <button onclick="history.back();" class="btn btn-primary btn-sm" title="Kembali">
                        <i class="fa fa-arrow-left"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-2col table-hover table-striped table-bordered">
                <tbody>
                    <tr>
                        <th scope="col">No. Kartu Keluarga</th>
                        <td>
                            <a href="{{ route('kartu-keluarga.show', $data->kk->id_kk) }}">{{ $data->kk->no_kk }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">NIK</th>
                        <td>{{ $data->nik_wrg }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Nama</th>
                        <td>{{ $data->nm_wrg }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Tempat, Tanggal Lahir</th>
                        <td>{{ $data->tmplhr_wrg }}, {{ date('d-m-Y', strtotime($data->tgllhr_wrg)) }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Jenis Kelamin</th>
                        <td>{{ $data->jk_wrg == 1 ? 'Pria' : 'Wanita' }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Kesehatan</th>
                        <td>{{ $data->statskt_wrg != 1 ? 'Sehat' : 'Sakit' }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Status</th>
                        <td>{{ $data->stat_wrg == 1 ? 'Active' : 'Inactive' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
