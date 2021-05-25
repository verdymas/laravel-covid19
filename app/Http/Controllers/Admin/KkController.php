<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\akun_admin;
use App\Models\kk;
use Illuminate\Http\Request;

class KkController extends Controller
{
    public function __construct()
    {
        $this->kk = new kk;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $requestData = $request;

            $fetch = $this->kk->fetch_data(null, @$requestData['order'][0]['column'], @$requestData['order'][0]['dir'], @$requestData['start'], @$requestData['length']);

            $query = $fetch['query'];

            $data = array();

            foreach ($query as $r) {
                $btnEdit = "<a href='" . route('kartu-keluarga.edit', $r->id_kk) . "' class='btn btn-primary btn-sm' title='Ubah'><i class='fa fa-edit'></i></a>";
                $btnInfo = "<a href='" . route('kartu-keluarga.show', $r->id_kk) . "' class='btn btn-info btn-sm' title='Detail'><i class='fa fa-info'></i></a>";

                $nestedData = array();

                $nestedData[] = $r->no_kk;
                $nestedData[] = $r->jml;
                $nestedData[] = $r->nm_adm;
                $nestedData[] = $r->state;
                $nestedData[] = @$btnEdit . ' ' . @$btnInfo;

                $data[] = $nestedData;
            }

            $res = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($fetch['totalData']),
                "recordsFiltered" => intval($fetch['totalFiltered']),
                "data" => $data,
            );

            return response()->json($res);
        }

        $data = kk::withCount('warga')
            ->with('akun_admin:id_adm,username,nm_adm')
            ->paginate(5);

        $stg = akun_admin::where('roles', 1)->get();

        return view('admin.kk.index')->with(['data' => $data, 'stg' => $stg]);
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

        $kk = kk::all();

        return view('admin.kk.show')->with(['data' => $data, 'kk' => $kk]);
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
        $d->stat_kk = 1;
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
