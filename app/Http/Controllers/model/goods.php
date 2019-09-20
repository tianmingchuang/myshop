<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class goods extends Model
{
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
