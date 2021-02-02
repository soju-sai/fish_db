<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwDist extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['id', 'alias', 'tw_dist_c', 'tw_dist_e'];
}
