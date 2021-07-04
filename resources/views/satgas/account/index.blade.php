@extends('satgas.base')
@section('title', 'Account')
@section('content')
    @if ($msg = session()->get('success'))
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
                <h3 class="card-title">Account</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row" x-data="accountData()">
                <div class="col-md-6 col-sm-12">
                    <table class="table table-hover table-striped table-bordered">
                        @php
                            $user = auth()
                                ->guard('satgas')
                                ->user();
                        @endphp
                        <tbody>
                            <form method="post" action="{{ route('stg.account.update', $user->id_adm) }}"
                                x-ref="accountForm" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <tr>
                                    <td>
                                        <b>Username</b><br>
                                        <template x-if="!stateEdit">
                                            <span class="d-block"><span
                                                    class="mr-2 font-weight-bold">|</span>{{ $user->username }}</span>
                                        </template>
                                        <input x-show="stateEdit" type="text" value="{{ $user->username }}"
                                            class="form-control form-control-sm" name="username" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Nama</b><br>
                                        <template x-if="!stateEdit">
                                            <span class="d-block"><span
                                                    class="mr-2 font-weight-bold">|</span>{{ $user->nm_adm }}</span>
                                        </template>
                                        <input x-show="stateEdit" type="text" value="{{ $user->nm_adm }}"
                                            class="form-control form-control-sm" name="nm_adm" required>
                                    </td>
                                </tr>
                                <tr x-show="stateEdit">
                                    <td>
                                        <b>Password</b><br>
                                        <input type="password" class="form-control form-control-sm" name="password" placeholder="biarkan kosong, Jika tidak diganti">
                                    </td>
                                </tr>
                                <tr x-show="stateEdit">
                                    <td>
                                        <b>Image</b><br>
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="img_adm" name="img_adm" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="edit" x-model="stateEdit">
                                            <label class="form-check-label" for="edit">Edit Data</label>
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Ubah" x-show="stateEdit">
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-sm-12 d-flex justify-content-center">
                    @php
                        if ($user->img_adm != '') {
                            $pp_adm = $user->img_adm;
                        } else {
                            $pp_adm = 'default-photo.png';
                        }
                    @endphp
                    <img style="object-fit: cover" src="{{ asset('adminlte/avatar/' . $pp_adm) }}" alt="" height="250"
                        width="250">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extrajs')
    <script>
        function accountData() {
            return {
                stateEdit: false,
            }
        }

    </script>
@endsection
