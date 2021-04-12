<?php

namespace App\Http\Controllers\Satgas;

use App\Http\Controllers\Controller;
use App\Models\bantuan;
use App\Models\historiskt;
use App\Models\warga;
use DB;
use Illuminate\Http\Request;

class KesehatanController extends Controller
{

    public function __construct()
    {
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
        $select = [
            'w.id_wrg', 'w.nm_wrg', 'hp.val_help AS jk', 'he.val_help AS st_skt', DB::raw("TIMESTAMPDIFF(YEAR, tgllhr_wrg, CURDATE()) AS umur_wrg"),
        ];

        $data = $this->warga->fetch_data(true, 1, $select)->paginate(5);

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
            'w.id_wrg' => $id,
        ];

        $dt['data'] = $this->warga->fetch_data(true, 1, null, $where)->first();

        if ($dt['data']->stat_skt == 1) {
            $dt['his'] = historiskt::find($dt['data']->id_his);
        }

        // return response()->json($his);

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

        if ($request->act == 0) {

            $msg = ['success' => 'Data berhasil disimpan'];

            DB::transaction(function () use ($request, $w) {
                $h_data = [
                    'id_wrg' => $w->id_wrg,
                    'tgl_skt' => date('Y-m-d'),
                    'tgl_sls' => date('Y-m-d', strtotime(date('Y-m-d') . "+14 days")),
                    'st_skt' => 1,
                    'stat_skt' => 1,
                ];

                $h = $this->historiskt->insert($h_data);

                $b_data = [
                    'jml_ban' => $request->bantuan,
                    'tgl_ban' => date('Y-m-d'),
                    'id_kk' => $w->kk->id_kk,
                    'id_his' => $h,
                ];

                $b = $this->bantuan->insert($b_data);
            });

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
