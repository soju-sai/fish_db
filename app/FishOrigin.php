<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishOrigin extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'fish2001';
    protected $fillable = ['id', 'worlddist'];
}
