<?php

namespace App\Models;

use App\Models\kk;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'nik_wrg';

    protected $fillable = [
        'nm_wrg',
        'tmplhr_wrg',
        'tgllhr_wrg',
        'jk_wrg',
        'almt_wrg',
        'stat_wrg',
        'id_kk',
    ];

    public $timestamps = false;

    public function kk()
    {
        return $this->belongsTo(kk::class, 'id_kk', 'id_kk');
    }

    public function fetch_data($raw = false, $stat_wrg = 1, $select = null, $where_ = null)
    {
        if (!$select) {
            $select = [
                'k.no_kk AS no_kk', 'w.*',
                'hp.val_help AS jk', 'h.id_his',
                DB::raw("COALESCE(h.st_skt, 0) AS st_skt"),
                DB::raw("COALESCE(h.stat_skt, 0) AS stat_skt"), 'he.val_help AS kesehatan',
                DB::raw("TIMESTAMPDIFF(YEAR, tgllhr_wrg, CURDATE()) AS umur_wrg"),
            ];
        }

        $where = [
            'w.stat_wrg' => $stat_wrg,
        ];

        $filter = $where;

        if ($where_) {
            $filter = array_merge($where, $where_);
        }

        $sql = DB::table("$this->table AS w")
            ->join('kk AS k', 'k.id_kk', 'w.id_kk')
            ->leftJoin('helper AS hp', function ($j) {
                $j->on('hp.code_help', 'w.jk_wrg')
                    ->where('hp.param_help', 'JK');
            })
            ->leftJoin('historiskt AS h', 'w.nik_wrg', 'h.nik_wrg')
            ->leftJoin('helper AS he', function ($j) {
                $j->on('he.code_help', DB::raw("COALESCE(h.stat_skt, 0)"))
                    ->where('he.param_help', 'ST_SKT');
            })
            ->select($select)
            ->groupBy('w.nik_wrg');

        if ($raw) {
            return $sql->where($filter);
        }

        $data['totalData'] = $sql->where($where)->count();

        $data['totalFiltered'] = $sql->where($filter)->count();

        $data['query'] = $sql->where($filter)->get();

        return $data;
    }
}
