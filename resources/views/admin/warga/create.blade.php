@extends('admin.base')
@section('title', 'Tambah Warga')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <span class="badge badge-success"><i class="fa fa-plus"></i> Tambah</span> Warga
            </h3>
        </div>
        <form method="post" action="{{ route('warga.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>No. Kartu Keluarga</label>
                    <select name="id_kk" id="id_kk" class="form-control" required>
                        <option value="">-- pilih satu --</option>
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
                    <label for="nm_wrg">Nama</label>
                    <input type="text" name="nm_wrg" class="form-control" required>
                </div>
                <div class="row form-group">
                    <div class="col-5 col-lg-5">
                        <label for="tmplhr_wrg">Tempat Lahir</label>
                        <input type="text" name="tmplhr_wrg" class="form-control" required>
                    </div>
                    <div class="col-7 col-lg-7">
                        <label for="tgllhr_wrg">Tanggal Lahir</label>
                        <input type="date" name="tgllhr_wrg" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jk_wrg">Jenis Kelamin</label>
                    <select name="jk_wrg" id="jk_wrg" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        <option value="1">Pria</option>
                        <option value="0">Wanita</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="almt_wrg">Alamat</label>
                    <textarea name="almt_wrg" id="" almt_wrg cols="30" rows="3" class="form-control"
                              required></textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="stat_wrg" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
