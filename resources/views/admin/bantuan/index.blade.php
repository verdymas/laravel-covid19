@extends('admin.base')
@section('title', 'Bantuan')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title">Bantuan</h3>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table-bntu-i table table-striped table-bordered table-hover mb-3">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%" class="text-center">#</th>
                        <th scope="col">No. Kartu Keluarga</th>
                        <th scope="col" style="width: 20%" class="text-center">Jumlah</th>
                        <th scope="col" style="width: 20%" class="text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data->count() != 0)
                        <?php $i = ($data->currentPage() - 1) * $data->perPage() + 1  ?>
                        @foreach($data as $k => $v)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>
                                    <a href="{{ route('kartu-keluarga.show', $v->kk->id_kk) }}">{{ $v->kk->no_kk }}</a>
                                </td>
                                <td>{{ App\Helpers\Helper::formatRupiah($v->jml_ban, 0) }}</td>
                                <td>{{ $v->tgl_ban }}</td>
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
