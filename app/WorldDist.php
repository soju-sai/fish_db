<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorldDist extends Model
{
    //
    protected $connection = 'mysql_new';
    // protected $table = 'lk_world_dist';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    // protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'alias', 'distribution_c', 'distribution_e'];
}
