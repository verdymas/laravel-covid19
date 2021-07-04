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
                                    <span class="d-block"><span class="mr-2 font-weight-bold">|</span>{{ $data->no_kk }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Nama</b><br>
                                    <span class="d-block"><span class="mr-2 font-weight-bold">|</span>{{ $data->nm_wrg }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Tempat, Tanggal Lahir</b><br>
                                    <span class="d-block"><span class="mr-2 font-weight-bold">|</span>{{ $data->tmplhr_wrg }},
                                        {{ date('d-m-Y', strtotime($data->tgllhr_wrg)) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Jenis Kelamin</b><br>
                                    <span class="d-block"><span class="mr-2 font-weight-bold">|</span>{{ $data->jk_wrg == 1 ? 'Pria' : 'Wanita' }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-sm-12" x-data="bantuanData()">
                    <table class="table table-hover table-striped table-bordered">
                        <tr>
                            <td colspan="5">
                                <h3 class="mb-0 font-weight-bold">Informasi Kesehatan</h3>
                            </td>
                        </tr>
                        <form method="post" x-ref="formSehat" action="{{ route('kesehatan.update', $data->nik_wrg) }}">
                            @csrf
                            @method('patch')
                            @if ($data->stat_skt == 0)
                                <input type="hidden" name="act" value="isolasi">
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
                                        @if ($kk_skt)
                                            (<span class="font-italic">pre-calculate</span>)
                                        @endif
                                    </td>
                                </tr>
                                @if ($kk_skt)
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Per Hari
                                        </td>
                                        <td class="text-right"><b>Rp. {{ number_format($kk_skt->jml_ban) }}</b></td>
                                        <input value="{{ $kk_skt->jml_ban }}" type="hidden" name="jml" required readonly>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Jumlah
                                        </td>
                                        <td class="text-right"><b>x{{ $kk_skt->interval }}</b></td>
                                        <input value="{{ $kk_skt->interval }}" type="hidden" name="hri" required readonly>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Total Bantuan
                                        </td>
                                        <td class="text-right"><b>Rp.
                                                {{ number_format($kk_skt->jml_ban * $kk_skt->interval) }}</b></td>
                                        <input value="{{ $kk_skt->jml_ban * $kk_skt->interval }}" type="hidden" name="total" required readonly>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="align-middle">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Per Hari
                                        </td>
                                        <td class="w-25">
                                            <input x-ref="jml_" x-model.number="jml" @focus="$refs.jml_.select()" @keyup="tot = jml*hri;" type="number" name="jml" class="form-control form-control-sm text-right" required>
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
                            @elseif ($his->tgl_sls < date('Y-m-d')) <input type="hidden" name="act" value="sehat">
                                    <tr>
                                        <td colspan="2">
                                            <i class="fas fa-sticky-note mr-2"></i>
                                            Masa isolasi pasien telah selesai
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            Pilih salah satu option di bawah
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Sehat
                                        </td>
                                        <td>Pasien dinyatakan telah sembuh dari penyakit covid19</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Berlanjut
                                        </td>
                                        <td>Pasien dinyatakan belum sembuh, dan masa isolasi diperpanjang kembali selama 2
                                            Minggu
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Option</td>
                                        <td>
                                            <select name="st_skt" id="st_skt" class="form-control form-control-sm" x-model="st_skt" required>
                                                <option value="">-- pilih satu --</option>
                                                @foreach ($st_skt as $v)
                                                    <option value="{{ $v->code_help }}">{{ $v->val_help }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <template x-if="st_skt == 0 && st_skt != ''">
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button type="submit" @click="$refs.formSehat.submit()" class="btn btn-primary ml-2">Ubah</button>
                                                <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                                            </td>
                                        </tr>
                                    </template>
                                    <template x-if="st_skt == 1 && st_skt != ''">
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <button type="submit" @click="$refs.formSakit.submit()" class="btn btn-primary ml-2">Ubah</button>
                                                <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                                            </td>
                                        </tr>
                                    </template>
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
                                    <tr>
                                        <td colspan="2">
                                            <select name="st_skt" id="st_skt" class="form-control form-control-sm" x-model="st_skt" required>
                                                <option value="">-- pilih satu --</option>
                                                <option value="0">Sehat</option>
                                            </select>
                                        </td>
                                    </tr>
                            @endif
                        </form>
                    </table>
                    <form method="post" x-ref="formBerlanjut" action="{{ route('kesehatan.update', $data->nik_wrg) }}">
                        <template x-if="st_skt == 2">
                            <table class="table table-hover table-striped table-bordered">
                                <tr>
                                    <td colspan="5">
                                        <h3 class="mb-0 font-weight-bold">Isolasi Berlanjut</h3>
                                    </td>
                                </tr>
                                @csrf
                                @method('patch')
                                <input type="hidden" name="st_skt" value="2">
                                <input type="hidden" name="act" value="berlanjut">
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
                                        <input value="{{ $kk_skt->interval }}" type="hidden" name="hri" required readonly>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Total Bantuan (<span class="font-italic">pre-calculate</span>)
                                        </td>
                                        <td class="text-right"><b>Rp.
                                                {{ number_format($kk_skt->jml_ban * $kk_skt->interval) }}</b></td>
                                        <input value="{{ $kk_skt->jml_ban * $kk_skt->interval }}" type="hidden" name="total" required readonly>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="align-middle">
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Per Hari
                                        </td>
                                        <td class="w-25">
                                            <input x-ref="jml_" x-model.number="jml" @focus="$refs.jml_.select()" @keyup="tot = jml*hri;" type="number" name="jml" class="form-control form-control-sm text-right" required>
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
                                        <button type="submit" @click="$refs.formBerlanjut.submit()" class="btn btn-primary">Ubah</button>
                                        <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                                    </td>
                                </tr>
                            </table>
                        </template>
                    </form>
                    @if ($data->stat_skt == 1 && $his->tgl_sls < date('Y-m-d'))
                        <form method="post" x-ref="formSakit" action="{{ route('kesehatan.update', $data->nik_wrg) }}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="st_skt" value="1">
                            <input type="hidden" name="act" value="pasiensakit">
                        </form>
                    @endif
                    @if ($data->stat_skt == 1 && !($his->tgl_sls < date('Y-m-d')))
                        <form method="post" x-ref="formSehat" action="{{ route('kesehatan.update', $data->nik_wrg) }}">
                            <template x-if="st_skt == 0">
                                <table class="table table-hover table-striped table-bordered">
                                    <tr>
                                        <td colspan="5">
                                            <h3 class="mb-0 font-weight-bold">Pasien Sehat</h3>
                                        </td>
                                    </tr>
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="st_skt" value="0">
                                    <input type="hidden" name="act" value="pasiensehat">
                                    <tr>
                                        <td colspan="2">
                                            <i class="fas fa-sticky-note mr-2"></i>
                                            Keterangan (<span class="font-italic">* pembaruan data</span>)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Tanggal Isolasi
                                        </td>
                                        <td><b>{{ date('d-m-Y', strtotime($his->tgl_skt)) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Tanggal selesai Isolasi
                                        </td>
                                        <td><b>{{ date('d-m-Y') }}</b></td>
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl_sls">
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <i class="fas fa-hands-helping mr-2"></i>
                                            Bantuan (<span class="font-italic">* pembaruan data</span>)
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
                                        @php
                                            $date1 = date_create($his->tgl_skt);
                                            $date2 = date_create(date('Y-m-d'));
                                            
                                            $interval = date_diff($date1, $date2)->format('%a');
                                        @endphp
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Jumlah
                                        </td>
                                        <td class="text-right"><b>x{{ $interval }}</b></td>
                                        <input type="hidden" value="{{ $interval }}" name="hri_ban">
                                    </tr>
                                    <tr>
                                        @php
                                            $tot = $ban->jml_ban * $interval;
                                        @endphp
                                        <td>
                                            <span class="mr-2 font-weight-bold">|</span>
                                            Total Bantuan
                                        </td>
                                        <td class="text-right"><b>Rp. {{ number_format($tot) }}</b></td>
                                        <input type="hidden" value="{{ $tot }}" name="tot_ban">
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-right">
                                            <button type="submit" @click="$refs.formSehat.submit()" class="btn btn-primary">Ubah</button>
                                            <a href="{{ route('kesehatan.index') }}" class="btn btn-default ml-2">Batal</a>
                                        </td>
                                    </tr>
                                </table>
                            </template>
                        </form>
                    @endif
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
                tot: 0,
                st_skt: null,
            }
        }
        $(document).ready(function() {
            $("#no_kk").inputFilter(function(value) {
                return /^\d*$/.test(value);
            });
        });

    </script>
@endsection
