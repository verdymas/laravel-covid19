<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\kk;

class warga extends Model
{
	use HasFactory;

	protected $table = 'warga';
	protected $primaryKey = 'id_wrg';

	protected $fillable = [
		'nm_wrg',
		'tmplhr_wrg',
		'tgllhr_wrg',
		'jk_wrg',
		'almt_wrg',
		'skt_wrg',
		'statskt_wrg',
		'stat_wrg',
		'id_kk'
	];
	
	public $timestamps = false;

	public function kk()
	{
		return $this->belongsTo(kk::class, 'id_kk', 'id_kk');
	}
}
