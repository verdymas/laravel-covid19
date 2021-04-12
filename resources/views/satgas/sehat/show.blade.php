@extends('satgas.base')
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
                <h3 class="card-title">ID. Warga: <span class="badge badge-success">{{ $data->id_wrg  }}</span></h3>
                <div class="card-tools">
                    <a href="{{ route('kesehatan.edit', $data->id_wrg) }}" class="btn btn-primary btn-sm" title="Edit">
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
                        <td>{{ $data->kk->no_kk }}</td>
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
                        <th scope="col">Alamat</th>
                        <td>{{ $data->almt_wrg }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Keterangan Sakit</th>
                        <td>{{ $data->skt_wrg }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Kesehatan</th>
                        <td>{{ $data->statskt_wrg != 1 ? 'Sehat' : 'Sakit' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
