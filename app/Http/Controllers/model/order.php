<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
