<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use DB;

class SehatDataManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id_adm = auth()->guard('satgas')->user()->id_adm;
        $id_wrg = $request->route('kesehatan');

        $data = DB::table('akun_admin AS aa')
        ->join('kk', function($j) use ($id_adm) {
            $j->on('kk.id_adm', 'aa.id_adm')
            ->where('kk.id_adm', $id_adm);
        })
        ->join('warga AS w', function($j) use ($id_wrg) {
            $j->on('w.id_kk', 'kk.id_kk')
            ->where('w.id_wrg', $id_wrg);
        })->count();

        if ($data == 0) {
            abort(403);
        }

        return $next($request);
    }
}
