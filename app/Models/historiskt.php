<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historiskt extends Model
{
    use HasFactory;

    protected $table = 'historiskt';
    protected $primaryKey = 'id_his';

    protected $fillable = ['nik_wrg', 'tgl_skt', 'tgl_sls', 'tgl_smb', 'st_skt', 'stat_skt'];

    public $timestamps = false;

    public function warga()
    {
        return $this->belongsTo(warga::class, 'nik_wrg', 'nik_wrg');
    }

    public function insert($array)
    {
        return DB::table($this->table)->insertGetId($array);
    }
}
