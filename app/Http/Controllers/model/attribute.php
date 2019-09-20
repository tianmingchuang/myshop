<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
    protected $table = 'attribute';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
