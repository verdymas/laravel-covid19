@extends('satgas.base')
@section('title', 'Kesehatan')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">Kesehatan</h3>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table-wrg table table-striped table-bordered table-hover mb-3">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%" class="text-center">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col" style="width: 5%" class="text-center">Usia</th>
                        <th scope="col" style="width: 15%" class="text-center">Jenis Kelamin</th>
                        <th scope="col" style="width: 10%" class="text-center">Kesehatan</th>
                        <th scope="col" style="width: 15%" class="text-center"><i class="fa fa-exclamation-circle"></i>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count() != 0)
                        <?php $i = ($data->currentPage() - 1) * $data->perPage() + 1  ?>
                        @foreach($data as $k => $v)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $v->nm_wrg }}</td>
                                <td>{{ $v->umur_wrg }}</td>
                                <td>{{ $v->jk }}</td>
                                <td>{{ $v->st_skt }}</td>
                                <td>
                                    <a href="{{ route('kesehatan.edit', $v->id_wrg) }}" class="btn btn-primary btn-sm"
                                       title="Ubah"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('kesehatan.show', $v->id_wrg) }}" class="btn btn-info btn-sm"
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