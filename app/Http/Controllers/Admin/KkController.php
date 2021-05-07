<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\kk;
use App\Models\akun_admin;

class KkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = kk::withCount('warga')
        ->with('akun_admin:id_adm,username,nm_adm')
        ->paginate(5);

        return view('admin.kk.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stg = akun_admin::where('roles', 1)->get();

        return view('admin.kk.create')->with(['stg' => $stg]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d = new kk;
        $msg = $this->save($d, $request, 'store');

        return redirect()->route('kartu-keluarga.show', $d->id_kk)->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = kk::with('warga')
        ->with('akun_admin:id_adm,username,nm_adm')
        ->findOrFail($id);

        return view('admin.kk.show')->with(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kk::with('akun_admin:id_adm,username,nm_adm')->findOrFail($id);
        $stg = akun_admin::where('roles', 1)->get();

        return view('admin.kk.edit')->with(['data' => $data, 'stg' => $stg]);
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
        $d = kk::findOrFail($id);
        $msg = $this->save($d, $request, 'update');

        return redirect()->route('kartu-keluarga.show', $d->id_kk)->with($msg);
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

    private function save(kk $d, Request $request, $act)
    {
        $d->no_kk = $request->no_kk;
        $d->stat_kk = $request->stat_kk;
        $d->id_adm = $request->id_adm;
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
