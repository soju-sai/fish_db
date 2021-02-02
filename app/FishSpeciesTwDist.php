<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesTwDist extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $table = 'fish_species_tw_dist';
    protected $fillable = ['fish_species_id', 'tw_dist_id'];
}
