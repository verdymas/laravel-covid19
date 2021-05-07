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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title"><span class="badge badge-success">Data</span> Kartu Keluarga</h3>
                <div class="card-tools">
                    <a href="{{ route('kartu-keluarga.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table-kk table table-striped table-bordered table-hover mb-3">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%" class="text-center">#</th>
                        <th scope="col">No. Kartu Keluarga</th>
                        <th scope="col" style="width: 10%" class="text-center">Jumlah</th>
                        <th scope="col" style="width: 10%" class="text-center">Admin</th>
                        <th scope="col" style="width: 10%" class="text-center">Status</th>
                        <th scope="col" style="width: 15%" class="text-center"><i class="fa fa-exclamation-circle"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count() != 0)
                        <?php $i = ($data->currentPage() - 1) * $data->perPage() + 1  ?>
                        @foreach($data as $k => $v)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $v->no_kk}}</td>
                                <td>{{ $v->warga_count  }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $v->akun_admin->username }} | {{ $v->akun_admin->nm_adm }}</span>
                                </td>
                                <td>
                                <span
                                    class="badge badge-{{ $v->stat_kk == 1 ? 'success' : 'danger' }}">
                                    {{ $v->stat_kk == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('kartu-keluarga.edit', $v->id_kk) }}"
                                       class="btn btn-primary btn-sm"
                                       title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('kartu-keluarga.show', $v->id_kk) }}" class="btn btn-info btn-sm"
                                       title="Detail"><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th scope="row" colspan="5" class="text-center">Tidak ada data</th>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="float-right">
                {{ $data->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
@endsection
