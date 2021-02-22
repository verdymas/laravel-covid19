<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\warga;
use App\Models\bantuan;

class kk extends Model
{
    use HasFactory;

	protected $table = 'kk';
    protected $primaryKey = 'id_kk';

    protected $fillable = ['no_kk', 'stat_kk'];

	public $timestamps = false;

	public function warga()
	{
		return $this->hasMany(warga::class, 'id_kk', 'id_kk');
	}

	public function bantuan()
	{
		return $this->hasMany(bantuan::class, 'id_kk', 'id_kk');
	}

}
