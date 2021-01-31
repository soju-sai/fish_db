<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesTwDist extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['fish_species_id', 'tw_dists_id'];
}
