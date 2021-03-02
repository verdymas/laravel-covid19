<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\akun_satgas;

class SatgasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = akun_satgas::paginate(5);

        return view('admin.satgas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.satgas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d = new akun_satgas;
        $msg = $this->save($d, $request, 'store');

        return redirect()->route('satgas.show', $d->id_stg)->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = akun_satgas::findOrFail($id);

        return view('admin.satgas.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = akun_satgas::findOrFail($id);

        return view('admin.satgas.edit', compact('data'));
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
        $d = akun_satgas::findOrFail($id);
        $msg = $this->save($d, $request, 'update');

        return redirect()->route('satgas.show', $d->id_stg)->with($msg);
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

    private function save(akun_satgas $d, Request $request, $act)
    {
        $d->username = $request->username;
        if ($act == 'store' || $request->ubah_pass == 'on') {
            $d->password = \Hash::make($request->password);
        }
        $d->nm_stg = $request->nm_stg;
        $d->img_stg = '';
        $d->stat_stg = $request->stat_stg;
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
