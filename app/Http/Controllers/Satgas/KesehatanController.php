<?php

namespace App\Http\Controllers\Satgas;

use App\Http\Controllers\Controller;
use App\Models\bantuan;
use App\Models\helper;
use App\Models\historiskt;
use App\Models\warga;
use DB;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{

    public function __construct()
    {
        $this->middleware('sehat', ['except' => ['index']]);

        $this->warga = new warga;
        $this->historiskt = new historiskt;
        $this->bantuan = new bantuan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $select = [
        //     'k.no_kk', 'w.nik_wrg', 
        //     'w.nm_wrg', 'hp.val_help AS jk', 
        //     'he.val_help AS st_skt', 
        //     DB::raw("TIMESTAMPDIFF(YEAR, tgllhr_wrg, CURDATE()) AS umur_wrg"),
        // ];

        // $where['id_adm'] = auth()->guard('satgas')->user()->id_adm;

        // $data = $this->warga->fetch_data(true, 1, $select, $where)->groupBy('w.nik_wrg')->toSql();

        $id_adm = auth()->guard('satgas')->user()->id_adm;

        $sql = "
        SELECT t.*
        FROM
        (SELECT `k`.`no_kk`, `w`.`nik_wrg`, `w`.`nm_wrg`, TIMESTAMPDIFF(YEAR, tgllhr_wrg, CURDATE()) AS umur_wrg, `hp`.`val_help` AS `jk`, `he`.`val_help` AS `st_skt`
        FROM `warga` AS `w` 
        INNER JOIN `kk` AS `k` ON `k`.`id_kk` = `w`.`id_kk` 
        LEFT JOIN `historiskt` AS `h` ON `w`.`nik_wrg` = `h`.`nik_wrg` 
        LEFT JOIN `helper` AS `hp` ON `hp`.`code_help` = `w`.`jk_wrg` AND `hp`.`param_help` = 'JK'
        LEFT JOIN `helper` AS `he` ON `he`.`code_help` = COALESCE(h.stat_skt, 0) AND `he`.`param_help` = 'ST_SKT'
        WHERE (`w`.`stat_wrg` = 1 AND `id_adm` = $id_adm) 
        ORDER BY h.tgl_skt DESC
        LIMIT 18446744073709551615) AS t
        GROUP BY `t`.`nik_wrg`
        ";

        $data = DB::select(DB::raw($sql));

        return view('satgas.sehat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = warga::findOrFail($id);

        return view('satgas.sehat.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            'w.nik_wrg' => $id,            
        ];

        $dt['data'] = $this->warga->fetch_data(true, 1, null, $where)->orderBy('h.id_his', 'desc')->first();

        if ($dt['data']->stat_skt == 1) {
            $dt['his'] = historiskt::find($dt['data']->id_his);
        }

        $kkSktSql = DB::table('kk')
            ->join('warga AS w', function ($j) use ($dt) {
                $j->on('w.id_kk', 'kk.id_kk')
                    ->where('kk.id_kk', $dt['data']->id_kk);
            })
            ->join('historiskt AS h', function ($j) {
                $j->on('h.nik_wrg', 'w.nik_wrg')
                    ->where(['st_skt' => 1, 'stat_skt' => 1]);
            })
            ->join('bantuan AS b', 'b.id_kk', 'kk.id_kk')
            ->orderBy('h.tgl_skt', 'DESC');

        $dt['kk_skt'] = clone $kkSktSql;

        if (!$kkSktSql->count() == 0) {
            $dt['kk_skt'] = $dt['kk_skt']->first();

            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($dt['kk_skt']->tgl_skt);

            $dt['kk_skt']->interval = intval(date_diff($date2, $date1)->format("%a"));
            $dt['ban'] = $kkSktSql->select('b.*')->first();
        } else {
            $dt['kk_skt'] = false;
        }

        $dt['st_skt'] = helper::where('param_help', 'ST_SKT')->whereNotIn('code_help', [2])->get();

        // dd($dt);

        return view('satgas.sehat.edit', $dt);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $w = warga::findOrFail($id);

        if ($request->act == 'isolasi') {

            $msg = ['success' => 'Data berhasil disimpan'];

            DB::transaction(function () use ($request, $w) {
                $h_data = [
                    'nik_wrg' => $w->nik_wrg,
                    'tgl_skt' => date('Y-m-d'),
                    'tgl_sls' => date('Y-m-d', strtotime(date('Y-m-d') . "+14 days")),
                    'st_skt' => 1,
                    'stat_skt' => 1,
                ];

                $h = $this->historiskt->insert($h_data);

                $b_data = [
                    'tgl_ban' => date('Y-m-d'),
                    'jml_ban' => $request->jml,
                    'hri_ban' => $request->hri,
                    'tot_ban' => $request->jml * $request->hri,
                    'id_kk' => $w->kk->id_kk,
                    'id_his' => $h,
                ];

                $b = $this->bantuan->insert($b_data);
            });

        } elseif ($request->act == 'sehat') {
            $h = historiskt::where(['nik_wrg' => $w->nik_wrg, 'stat_skt' => 1])
                ->update([
                    'tgl_smb' => date('Y-m-d'),
                    'st_skt' => $request->st_skt,
                    'stat_skt' => 0,
                ]);

            $msg = ['success' => 'Data berhasil disimpan'];
        } elseif ($request->act == 'berlanjut') {
            DB::transaction(function () use ($request, $w) {
                $h = historiskt::where(['nik_wrg' => $w->nik_wrg, 'stat_skt' => 1])
                    ->update([
                        'st_skt' => $request->st_skt,
                        'stat_skt' => 0,
                    ]);

                $h_data = [
                    'nik_wrg' => $w->nik_wrg,
                    'tgl_skt' => date('Y-m-d'),
                    'tgl_sls' => date('Y-m-d', strtotime(date('Y-m-d') . "+14 days")),
                    'st_skt' => 1,
                    'stat_skt' => 1,
                ];

                $h = $this->historiskt->insert($h_data);

                $b_data = [
                    'tgl_ban' => date('Y-m-d'),
                    'jml_ban' => $request->jml,
                    'hri_ban' => $request->hri,
                    'tot_ban' => $request->jml * $request->hri,
                    'id_kk' => $w->kk->id_kk,
                    'id_his' => $h,
                ];

                $b = $this->bantuan->insert($b_data);
            });

            $msg = ['success' => 'Data berhasil disimpan'];
        } elseif ($request->act == 'pasiensehat') {
            DB::transaction(function () use ($request, $w) {
                $his = historiskt::where(['nik_wrg' => $w->nik_wrg, 'stat_skt' => 1]);

                $ban = bantuan::where('id_his', $his->first()->id_his)->update([
                    'hri_ban' => $request->hri_ban,
                    'tot_ban' => $request->tot_ban,
                ]);

                $his->update([
                    'tgl_sls' => $request->tgl_sls,
                    'tgl_smb' => date('Y-m-d'),
                    'st_skt' => $request->st_skt,
                    'stat_skt' => 0,
                ]);

            });

            $msg = ['success' => 'Data berhasil disimpan'];
        } elseif ($request->act == 'pasiensakit') {
            DB::transaction(function () use ($request, $w) {
                $his = historiskt::where(['nik_wrg' => $w->nik_wrg, 'stat_skt' => 1]);

                $his->update([
                    'tgl_smb' => date('Y-m-d'),
                    'st_skt' => $request->st_skt,
                    'stat_skt' => 0,
                ]);

            });

            $msg = ['success' => 'Data berhasil disimpan'];
        }

        return redirect()->route('kesehatan.edit', $id)->with($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
