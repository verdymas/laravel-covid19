<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class akun_admin extends Authenticatable
{
	use HasFactory;

    use Notifiable;

	protected $table = 'akun_admin';
	protected $primaryKey = 'id_adm';
	
	public $timestamps = false;
}
