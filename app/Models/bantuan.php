<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan';
    protected $primaryKey = 'id_ban';

    public $timestamps = false;

    public function kk()
    {
        return $this->belongsTo(kk::class, 'id_kk', 'id_kk');
    }

    public function his()
    {
        return $this->hasOne(historiskt::class, 'id_his', 'id_his');
    }

    public function insert($array)
    {
        return DB::table($this->table)->insertGetId($array);
    }
}
