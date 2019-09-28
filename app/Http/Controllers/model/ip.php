<?php

namespace App\Http\Controllers\model;

use Illuminate\Database\Eloquent\Model;

class ip extends Model
{
    protected $table = 'ip';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $connection = 'app';
    protected $guarded = [];
}
