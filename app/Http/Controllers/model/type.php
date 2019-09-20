<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
