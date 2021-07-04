<?php

namespace App\Http\Controllers\Satgas;

use App\Http\Controllers\Controller;
use App\Models\akun_admin;
use Hash;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satgas.account.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $adm = akun_admin::findOrFail($id);
        $msg = $this->save($adm, $request);

        return redirect()->route('stg.account.index')->with($msg);
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

    public function save(akun_admin $adm, Request $request)
    {
        $file = $request->img_adm;
        $img_adm = $adm->id_adm . '-' . time() . rand() . '.' . $file->getClientOriginalExtension();

        if ($adm->img_adm != '' || $adm->img_adm != null) {
            $oldfile = public_path('adminlte/avatar/' . $adm->img_adm);
            unlink($oldfile);
        }

        $path = public_path('adminlte/avatar/');
        $file->move($path, $img_adm);

        $adm->username = $request->username;
        $adm->nm_adm = $request->nm_adm;
        if ($request->password) {
            $adm->password = Hash::make($request->password);
        }
        $adm->img_adm = $img_adm;

        if ($adm->save()) {
            $msg = ['success' => 'Data berhasil diubah'];
        } else {
            $msg = ['failed' => 'Server Error'];
        }

        return $msg;
    }
}
