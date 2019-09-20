<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'login_id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
