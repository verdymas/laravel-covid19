<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class helper extends Model
{
    use HasFactory;

    protected $table = 'helper';
    protected $primaryKey = 'id_help';

    protected $fillable = ['param_help', 'code_help', 'val_help'];

    public $timestamps = false;
}
