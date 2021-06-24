<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\warga;
use App\Models\kk;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = warga::all();
        $kk = kk::all();

        return view('admin.warga.index')->with(['data' => $data, 'kk' => $kk]);
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

        if (isset($msg['error'])) {
            return redirect()->back()->with($msg)->withInput();
        }

        return redirect()->route('warga.show', $request->nik_wrg)->with($msg);
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

        return redirect()->route('warga.show', $d->nik_wrg)->with($msg);
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
        $jmlWrg = warga::where('id_kk', $request->id_kk)->count();

        if ($jmlWrg === 6) {
            $msg = [
                'error' => 'Jumlah Warga dalam 1 Kartu Keluarga Maksimal 6'
            ];

            return $msg;
        }

        $request->validate([
            'nik_wrg' => ['required', Rule::unique('App\Models\warga')->ignore($d->nik_wrg, 'nik_wrg')],
            'nm_wrg' => 'required',
            'tmplhr_wrg' => 'required',
            'tgllhr_wrg' => 'required',
            'jk_wrg' => 'required',
        ]);

        $kk = kk::findOrFail($request->id_kk);

        $d->id_kk = $kk->id_kk;
        $d->nik_wrg = $request->nik_wrg;
        $d->nm_wrg = $request->nm_wrg;
        $d->tmplhr_wrg = $request->tmplhr_wrg;
        $d->tgllhr_wrg = $request->tgllhr_wrg;
        $d->jk_wrg = $request->jk_wrg;

        $d->stat_wrg = 1;
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
