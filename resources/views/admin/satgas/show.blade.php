@extends('admin.base')
@section('title', 'Satuan Petugas')
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
                <h3 class="card-title">ID. Satuan Petugas:
                    <span class="badge badge-success">{{ $data->id_stg  }}</span></h3>
                <div class="card-tools">
                    <a href="{{ route('satgas.edit', $data->id_stg) }}" class="btn btn-primary btn-sm" title="Edit">
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
                        <th scope="col">Nama</th>
                        <td>{{ $data->nm_stg }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Username</th>
                        <td>{{ $data->username }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Status</th>
                        <td>{{ $data->stat_stg == 1 ? 'Active' : 'Inactive' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
