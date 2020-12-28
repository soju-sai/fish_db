<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fishnew extends Model
{
    protected $table = 'fishnews';
    protected $primaryKey = 'pno';
    public $timestamps = false;
}
