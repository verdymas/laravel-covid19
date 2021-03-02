@extends('admin.base')
@section('title', 'Tambah Satuan Petugas')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><span class="badge badge-success">
                    <i class="fa fa-plus"></i> Tambah</span> Satuan Petugas</h3>
        </div>
        <form method="post" action="{{ route('satgas.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nm_stg">Nama</label>
                    <input type="text" name="nm_stg" class="form-control" required>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="stat_stg" class="form-control" required>
                        <option value="">-- pilih satu --</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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
