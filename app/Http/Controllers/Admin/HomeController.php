<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kk;
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

    	return view('admin.home', $data);
    }
}
