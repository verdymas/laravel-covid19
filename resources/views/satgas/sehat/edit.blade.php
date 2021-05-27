@extends('satgas.base')
@section('title', 'Kesehatan Warga')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <span class="badge badge-success"><i class="fa fa-edit"></i> Kesehatan</span> ID. Warga:
                <span class="badge badge-success">{{ $data->nik_wrg }}</i>
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
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
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-sm-12">
                    <table class="table table-hover table-striped table-bordered" x-data="bantuanData()">
                        <tr>
                            <td colspan="5">
                                <h3 class="mb-0 font-weight-bold">Informasi Kesehatan</h3>
                            </td>
                        </tr>
                        @if ($data->stat_skt == 0)
                            <form method="post" action="{{ route('kesehatan.update', $data->nik_wrg) }}"
                                x-data="bantuanData()">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="act" value="0">
                                <tr>
                                    <td colspan="2">
                                        <i class="fas fa-sticky-note mr-2"></i>
                                        Keterangan (<span class="font-italic">* apabila sakit</span>)
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="mr-2 font-weight-bold">|</span>
                                        Tanggal Isolasi
                                    </td>
                                    <td><b>{{ date('d-m-Y') }}</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="mr-2 font-weight-bold">|</span>
                                        Tanggal Cek Ulang (+ 2 Minggu)
                                    </td>
                                    <td><b>{{ date('d-m-Y', strtotime(date('d-m-Y') . '+14 days')) }}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <i class="fas fa-hands-helping mr-2"></i>
                                        Bantuan
                                    </td>
                                </tr>
                                @if ($kk_skt)
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Per Hari (<span class="font-italic">pre-calculate</span>)
                                        </td>
                                        <td class="text-right"><b>Rp. {{ number_format($kk_skt->jml_ban) }}</b></td>
                                        <input value="{{ $kk_skt->jml_ban }}" type="hidden" name="jml" required readonly>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Jumlah (<span class="font-italic">pre-calculate</span>)
                                        </td>
                                        <td class="text-right"><b>x{{ $kk_skt->interval }}</b></td>
                                        <input value="{{ $kk_skt->interval }}" type="hidden" name="hri" required
                                            readonly>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Total Bantuan (<span class="font-italic">pre-calculate</span>)
                                        </td>
                                        <td class="text-right"><b>Rp.
                                                {{ number_format($kk_skt->jml_ban * $kk_skt->interval) }}</b></td>
                                        <input value="{{ $kk_skt->jml_ban * $kk_skt->interval }}" type="hidden"
                                            name="total" required readonly>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="align-middle">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Per Hari
                                        </td>
                                        <td class="w-25">
                                            <input x-ref="jml_" x-model.number="jml" @focus="$refs.jml_.select()"
                                                @keyup="tot = jml*hri;" type="number" name="jml"
                                                class="form-control form-control-sm text-right" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Jumlah
                                        </td>
                                        <td class="text-right"><b>x14</b></td>
                                        <input value="14" type="hidden" name="hri" required readonly>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Total Bantuan
                                        </td>
                                        <td class="text-right">
                                            Rp. <span x-text="tot"></span>
                                            <input x-model.number="tot" type="hidden" name="total" required readonly>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="2" class="text-right">
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                        <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                                    </td>
                                </tr>
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
                            <tr>
                                <td colspan="2">
                                    <i class="fas fa-sticky-note mr-2"></i>
                                    Pasien sedang dalam masa Isolasi
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="mr-2 font-weight-bold">|</span>
                                    Isolasi dimulai dari tanggal
                                </td>
                                <td><b>{{ date('d-m-Y', strtotime($his->tgl_skt)) }}</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="mr-2 font-weight-bold">|</span>
                                    Isolasi berakhir sampai dengan tanggal
                                </td>
                                <td><b>{{ date('d-m-Y', strtotime($his->tgl_sls)) }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <i class="fas fa-hands-helping mr-2"></i>
                                    Bantuan
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="mr-2 font-weight-bold">|</span>
                                    Per Hari
                                </td>
                                <td class="text-right"><b>Rp. {{ number_format($ban->jml_ban) }}</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="mr-2 font-weight-bold">|</span>
                                    Jumlah
                                </td>
                                <td class="text-right"><b>x{{ $ban->hri_ban }}</b></td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="mr-2 font-weight-bold">|</span>
                                    Total Bantuan
                                </td>
                                <td class="text-right"><b>Rp. {{ number_format($ban->tot_ban) }}</b></td>
                            </tr>
                        @endif
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
