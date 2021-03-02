<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\warga;
use App\Models\kk;
use function PHPUnit\Framework\returnArgument;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = warga::paginate(5);

        return view('admin.warga.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kk = kk::all();

        return view('admin.warga.create', compact('kk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d = new warga;
        $msg = $this->save($d, $request, 'store');

        return redirect()->route('warga.show', $d->id_wrg)->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = warga::with('kk')->findOrFail($id);

        return view('admin.warga.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kk = kk::all();
        $data = warga::with('kk')->findOrFail($id);

        return view('admin.warga.edit', compact('data', 'kk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $d = warga::findOrFail($id);
        $msg = $this->save($d, $request, 'update');

        return redirect()->route('warga.show', $d->id_wrg)->with($msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function save(warga $d, Request $request, $act)
    {
        $kk = kk::findOrFail($request->id_kk);

        $d->id_kk = $kk->id_kk;
        $d->nm_wrg = $request->nm_wrg;
        $d->tmplhr_wrg = $request->tmplhr_wrg;
        $d->tgllhr_wrg = $request->tgllhr_wrg;
        $d->jk_wrg = $request->jk_wrg;
        $d->almt_wrg = $request->almt_wrg;

        if ($act == 'store') {
            $d->skt_wrg = '';
            $d->statskt_wrg = 0;
        }

        $d->stat_wrg = $request->stat_wrg;
        if ($d->save()) {
            $act == 'store'
                ? $msg = ['success' => 'Data berhasil disimpan']
                : $msg = ['success' => 'Data berhasil diubah'];
        } else {
            $msg = ['failed' => 'Server Error'];
        }

        return $msg;
    }
}
