@extends('admin.base')
@section('title', 'Tambah Kartu Keluarga')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="badge badge-success">
                    <i class="fa fa-plus"></i> Tambah</span> Kartu Keluarga</h3>
        </div>
        <form method="post" action="{{ route('kartu-keluarga.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>No. Kartu Keluarga</label>
                    <input type="text" name="no_kk" id="no_kk" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="stat_kk" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kartu-keluarga.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('extrajs')
    <script>
        $(document).ready(function () {
            $("#no_kk").inputFilter(function(value) {
                return /^\d*$/.test(value);
            });
        });
    </script>
@endsection
