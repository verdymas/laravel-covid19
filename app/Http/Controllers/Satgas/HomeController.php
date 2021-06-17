<?php

namespace App\Http\Controllers\Satgas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $id_adm = auth()->guard('satgas')->user()->id_adm;

        $data['isolasi'] = DB::table('historiskt AS h')
        ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
        ->join('kk', 'kk.id_kk', 'w.id_kk')
        ->where(['stat_skt' => 1, 'kk.id_adm' => $id_adm])
        ->get();

        $data['berlanjut'] = DB::table('historiskt AS h')
        ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
        ->join('kk', 'kk.id_kk', 'w.id_kk')
        ->where(['stat_skt' => 0, 'st_skt' => 2, 'kk.id_adm' => $id_adm])
        ->get();

        $data['sehat'] = DB::table('historiskt AS h')
        ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
        ->join('kk', 'kk.id_kk', 'w.id_kk')
        ->where(['stat_skt' => 0, 'st_skt' => 0, 'kk.id_adm' => $id_adm])
        ->get();

        $data['isolasibln'] = DB::table('historiskt AS h')
        ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
        ->join('kk', 'kk.id_kk', 'w.id_kk')
        ->whereMonth('tgl_skt', date('m'))
        ->where(['stat_skt' => 1, 'kk.id_adm' => $id_adm])
        ->get();

        $data['berlanjutbln'] = DB::table('historiskt AS h')
        ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
        ->join('kk', 'kk.id_kk', 'w.id_kk')
        ->whereMonth('tgl_skt', date('m'))
        ->where(['stat_skt' => 0, 'st_skt' => 2, 'kk.id_adm' => $id_adm])
        ->get();

        $data['sehatbln'] = DB::table('historiskt AS h')
        ->join('warga AS w', 'h.nik_wrg', 'w.nik_wrg')
        ->join('kk', 'kk.id_kk', 'w.id_kk')
        ->whereMonth('tgl_smb', date('m'))
        ->where(['stat_skt' => 0, 'st_skt' => 0, 'kk.id_adm' => $id_adm])
        ->get();
        
    	return view('satgas.home', $data);
    }
}
