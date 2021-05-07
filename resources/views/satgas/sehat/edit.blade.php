@extends('satgas.base')
@section('title', 'Kesehatan Warga')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <span class="badge badge-success"><i class="fa fa-edit"></i> Kesehatan</span> ID. Warga:
                <span class="badge badge-success">{{ $data->id_wrg }}</i>
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5 class="mb-3">Ubah Status Kesehatan</h5>
                    @if ($data->stat_skt == 0)
                        <form method="post" action="{{ route('kesehatan.update', $data->id_wrg) }}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="act" value="0">
                            <div class="form-group row">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="">Tgl. Sakit</label>
                                    <span class="d-block">{{ date('d-m-Y') }}</span>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="">Tgl. Cek Ulang (+ 2 Minggu)</label>
                                    <span
                                        class="d-block">{{ date('d-m-Y', strtotime(date('d-m-Y') . '+14 days')) }}</span>
                                </div>
                            </div>
                            <div class="form-group" x-data="bantuanData()">
                                <label for="">Bantuan</label>
                                <div class="row d-flex align-items-center">
                                    @if ($kk_skt)
                                    <div class="col-lg-4 col-sm-12">
                                        <input value="{{ $kk_skt->jml_ban }}" type="number" name="jml" class="form-control" required readonly>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        x {{ $kk_skt->interval }} Hari
                                        <input value="{{ $kk_skt->interval }}" type="hidden" name="hri" required readonly>
                                    </div>
                                    <div class="col-lg-5 col-sm-12">
                                        <input value="{{ $kk_skt->jml_ban*$kk_skt->interval }}" type="number" name="total" class="form-control" required readonly>
                                    </div>    
                                    @else
                                    <div class="col-lg-4 col-sm-12">
                                        <input x-ref="jml_" x-model.number="jml" @focus="$refs.jml_.select()" @keyup="tot = jml*hri;"  type="number" name="jml" class="form-control" required>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        x 14 Hari
                                        <input value="14" type="hidden" name="hri" required readonly>
                                    </div>
                                    <div class="col-lg-5 col-sm-12">
                                        <input x-model.number="tot" type="number" name="total" class="form-control" required readonly>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                        </form>
                    @elseif ($his->tgl_sls == date('Y-m-d'))
                        <p>Masa Isolasi pasien telah selesai.
                            <br>Pilih salah satu option di bawah.
                        </p>
                        <ul class="pl-4">
                            <li>Sehat</li>
                            <li>Berlanjut</li>
                        </ul>
                        <div class="d-flex justify-content-around">
                            <select name="st_skt" id="st_skt" class="form-control" required>
                                <option value="">-- pilih satu --</option>
                                @foreach ($st_skt as $v)
                                    <option value="{{ $v->code_help }}">{{ $v->val_help }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Ubah</button>
                            <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                        </div>
                    @elseif ($data->stat_skt == 1)
                        <p>Pasien sedang dalam masa Isolasi.
                            <br>Isolasi dimulai dari tanggal
                            <b>{{ date('d-m-Y', strtotime($his->tgl_skt)) }}</b>
                            <br>Isolasi berakhir sampai dengan tanggal
                            <b>{{ date('d-m-Y', strtotime($his->tgl_sls)) }}</b>.
                        </p>
                    @endif
                </div>
                <div class="col-md-6 col-sm-12">
                    <table class="table table-hover table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <b>No. Kartu Keluarga</b><br>
                                    <span class="d-block"><span
                                            class="mr-2 font-weight-bold">|</span>{{ $data->no_kk }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Nama</b><br>
                                    <span class="d-block"><span
                                            class="mr-2 font-weight-bold">|</span>{{ $data->nm_wrg }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Tempat, Tanggal Lahir</b><br>
                                    <span class="d-block"><span
                                            class="mr-2 font-weight-bold">|</span>{{ $data->tmplhr_wrg }},
                                        {{ date('d-m-Y', strtotime($data->tgllhr_wrg)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Jenis Kelamin</b><br>
                                    <span class="d-block"><span
                                            class="mr-2 font-weight-bold">|</span>{{ $data->jk_wrg == 1 ? 'Pria' : 'Wanita' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Alamat</b><br>
                                    <span class="d-block"><span
                                            class="mr-2 font-weight-bold">|</span>{{ $data->almt_wrg }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Kesehatan</b><br>
                                    <span class="d-block"><span
                                            class="mr-2 font-weight-bold">|</span>{{ $data->kesehatan }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extrajs')
    <script>
        function bantuanData() {
            return {
                jml: 0,
                hri: 14,
                tot: 0
            }
        }
        $(document).ready(function() {
            $("#no_kk").inputFilter(function(value) {
                return /^\d*$/.test(value);
            });
        });

    </script>
@endsection
