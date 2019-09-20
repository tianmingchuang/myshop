<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class shangpin extends Model
{
    protected $table = 'shangpin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $connection = 'app';
}
