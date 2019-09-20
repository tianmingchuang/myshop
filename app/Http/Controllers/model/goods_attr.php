<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class goods_attr extends Model
{
    protected $table = 'goods_attr';
    protected $primaryKey = 'attr_id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
