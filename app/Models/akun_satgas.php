<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class akun_satgas extends Authenticatable
{
	use HasFactory;

	use Notifiable;

	protected $table = 'akun_satgas';
	protected $primaryKey = 'id_stg';
	
	public $timestamps = false;
}
