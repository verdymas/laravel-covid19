<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $data['isolasi'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->where('stat_skt', 1)
            ->get();

        $data['berlanjut'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->where(['stat_skt' => 0, 'st_skt' => 2])
            ->get();

        $data['sehat'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->where(['stat_skt' => 0, 'st_skt' => 0])
            ->get();

        $data['isolasibln'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->whereMonth('tgl_skt', date('m'))
            ->where('stat_skt', 1)
            ->get();

        $data['berlanjutbln'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->whereMonth('tgl_skt', date('m'))
            ->where(['stat_skt' => 0, 'st_skt' => 2])
            ->get();

        $data['sehatbln'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->whereMonth('tgl_smb', date('m'))
            ->where(['stat_skt' => 0, 'st_skt' => 0])
            ->get();

        $graphSql = "
        SELECT tgl, SUM(sakit) AS pasien_isolasi, SUM(sembuh) AS pasien_sembuh, SUM(berlanjut) AS pasien_berlanjut
        FROM (
            SELECT tgl_skt AS tgl, COUNT(*) AS sakit, 0 AS sembuh, 0 AS berlanjut, st_skt
            FROM historiskt
            WHERE st_skt = 1
            GROUP BY tgl_skt
            UNION
            SELECT tgl_sls AS tgl, 0 AS sakit, COUNT(*) AS sembuh, 0 AS berlanjut, st_skt
            FROM historiskt
            WHERE st_skt = 0
            GROUP BY tgl_sls
            UNION
            SELECT tgl_sls AS tgl, 0 AS sakit, 0 AS sembuh, COUNT(*) AS berlanjut, st_skt
            FROM historiskt
            WHERE st_skt = 2
            GROUP BY tgl_sls
        ) AS b
        GROUP BY tgl
        ";

        $data['grafik'] = DB::select(DB::raw($graphSql));

        return view('admin.home', $data);
    }

    public function laporan()
    {
        $data['isolasi'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->where('stat_skt', 1)
            ->get();

        $data['berlanjut'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->where(['stat_skt' => 0, 'st_skt' => 2])
            ->get();

        $data['sehat'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->where(['stat_skt' => 0, 'st_skt' => 0])
            ->get();

        $data['isolasibln'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->whereMonth('tgl_skt', date('m'))
            ->where('stat_skt', 1)
            ->get();

        $data['berlanjutbln'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->whereMonth('tgl_skt', date('m'))
            ->where(['stat_skt' => 0, 'st_skt' => 2])
            ->get();

        $data['sehatbln'] = DB::table('historiskt AS h')
            ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
            ->join('kk', 'kk.id_kk', 'w.id_kk')
            ->whereMonth('tgl_smb', date('m'))
            ->where(['stat_skt' => 0, 'st_skt' => 0])
            ->get();

        return view('admin.laporan', $data);
    }
}
