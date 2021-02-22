@extends('admin.base')
@section('title', 'Ubah Warga')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <span class="badge badge-success"><i class="fa fa-edit"></i> Ubah</span> ID. Warga:
                <span class="badge badge-success">{{ $data->id_wrg }}</i>
            </h3>
        </div>
        <form method="post" action="{{ route('warga.update', $data->id_wrg) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    <label>No. Kartu Keluarga</label>
                    <select name="id_kk" id="id_kk" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        @foreach($kk as $v)
                            <option value="{{ $v->id_kk }}" {{ $data->id_kk == $v->id_kk ? 'selected' : '' }}>
                                {{ $v->no_kk }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nm_wrg">Nama</label>
                    <input type="text" name="nm_wrg" class="form-control" value="{{ $data->nm_wrg }}" required>
                </div>
                <div class="row form-group">
                    <div class="col-5 col-lg-5">
                        <label for="tmplhr_wrg">Tempat Lahir</label>
                        <input type="text" name="tmplhr_wrg" class="form-control" value="{{ $data->tmplhr_wrg }}"
                               required>
                    </div>
                    <div class="col-7 col-lg-7">
                        <label for="tgllhr_wrg">Tanggal Lahir</label>
                        <input type="date" name="tgllhr_wrg" class="form-control" value="{{ $data->tgllhr_wrg }}"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jk_wrg">Jenis Kelamin</label>
                    <select name="jk_wrg" id="jk_wrg" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        @if($data->jk_kelamin == 1)
                            <option value="1" selected>Pria</option>
                            <option value="0">Wanita</option>
                        @else
                            <option value="1">Pria</option>
                            <option value="0" selected>Wanita</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="almt_wrg">Alamat</label>
                    <textarea name="almt_wrg" id="" almt_wrg cols="30" rows="3" class="form-control"
                              required>{{ $data->almt_wrg }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="stat_wrg" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        @if($data->stat_wrg == 1)
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        @else
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ route('warga.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('extrajs')
    <script>
        $(document).ready(function () {
            $("#no_kk").inputFilter(function (value) {
                return /^\d*$/.test(value);
            });
        });
    </script>
@endsection
