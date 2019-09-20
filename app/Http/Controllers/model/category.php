<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
