@extends('admin.base')
@section('title', 'Ubah Satuan Petugas')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="badge badge-success">
                    <i class="fa fa-Edit"></i> Ubah</span> Satuan Petugas</h3>
        </div>
        <form method="post" action="{{ route('satgas.update', $data->id_stg) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    <label for="nm_stg">Nama</label>
                    <input type="text" name="nm_stg" class="form-control" value="{{ $data->nm_stg }}" required>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $data->username }}" required>
                    </div>
                    <div class="col-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" disabled>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="ubah_pass" id="ubah_pass">
                            <label class="form-check-label" for="ubah_pass"><i>ubah password</i></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="stat_stg" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        @if($data->stat_stg == 1)
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('satgas.index') }}" class="btn btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('extrajs')
    <script>
        $(document).ready(function () {
            $('#ubah_pass').on('change', function () {
                $(this).is(':checked')
                    ? $('#password').prop('disabled', false)
                    : $('#password').prop('disabled', true);
            });
        });
    </script>
@endsection
