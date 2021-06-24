@extends('admin.base')
@section('title', 'Ubah Kartu Keluarga')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <span class="badge badge-success"><i class="fa fa-edit"></i> Ubah</span> ID. Kartu Keluarga:
                <span class="badge badge-{{ $data->stat_kk == 1 ? 'success' : 'danger' }}">{{ $data->id_kk }}</span>
            </h3>
        </div>
        <form method="post" action="{{ route('kartu-keluarga.update', $data->id_kk) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    <label for="no_kk">No. Kartu Keluarga</label>
                    <input type="text" name="no_kk" id="no_kk" class="form-control" value="{{ $data->no_kk }}" required>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="stat_kk">Status</label>
                            <select name="stat_kk" id="stat_kk" class="form-control" required>
                                <option value="">-- pilih satu --</option>
                                @if($data->stat_kk == 1)
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                @else
                                    <option value="1">Active</option>
                                    <option value="0" selected>Inactive</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label>Satgas</label>
                            <select name="id_adm" id="id_adm" class="form-control" required>
                                <option value="">-- pilih satu</option>
                                @foreach ($stg as $i)
                                    <option value="{{ $i->id_adm }}" {{ $data->akun_admin->id_adm == $i->id_adm ? 'selected' : '' }}>{{ $i->username }} | {{ $i->nm_adm }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="almt_kk" rows="3" class="form-control" placeholder="Alamat" required>{{ $data->almt_kk }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="{{ route('kartu-keluarga.index') }}" class="btn btn-default">Batal</a>
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
