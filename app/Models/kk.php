<?php

namespace App\Models;

use App\Models\bantuan;
use App\Models\warga;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kk extends Model
{
    use HasFactory;

    protected $table = 'kk';
    protected $primaryKey = 'id_kk';

    protected $fillable = ['no_kk', 'id_adm', 'stat_kk'];

    public $timestamps = false;

    public function warga()
    {
        return $this->hasMany(warga::class, 'id_kk', 'id_kk');
    }

    public function bantuan()
    {
        return $this->hasMany(bantuan::class, 'id_kk', 'id_kk');
    }

    public function akun_admin()
    {
        return $this->belongsTo(akun_admin::class, 'id_adm', 'id_adm');
    }

    public function fetch_data($array_columns = null, $column_order = null, $column_dir = null,
        $limit_start = null, $limit_length = null) {
        $select = [
            'k.*', 'a.nm_adm', 'h.val_help AS state',
            DB::raw("COUNT(w.nik_wrg) AS jml"),
        ];

        $where = [];

        $sql = DB::table("$this->table AS k")
            ->join('warga AS w', 'w.id_kk', 'k.id_kk')
            ->join('akun_admin AS a', 'a.id_adm', 'k.id_adm')
            ->join('helper AS h', function ($j) {
                $j->on('h.code_help', 'k.stat_kk')
                    ->where('h.param_help', 'state_default');
            })
            ->select($select)
            ->groupBy('k.id_kk');

        $data['totalData'] = count($sql->where($where)->get());

        $data['totalFiltered'] = count($sql->where($where)->get());

        $columns_order_by = array(
            0 => 'k.no_kk',
            1 => 'jml',
            2 => 'a.nm_adm',
            3 => 'state',
        );

        if (!is_null($array_columns)) {
            $columns_order_by = $array_columns;
        }

        if (!is_null($column_order) && !is_null($column_dir)) {
            $sql->orderBy($columns_order_by[$column_order], $column_dir);
        }

        if (!is_null($limit_start) && !is_null($limit_length)) {
            $sql->offset($limit_start)->limit($limit_length);
        }

        $data['query'] = $sql->where($where)->get();

        return $data;
    }

}
