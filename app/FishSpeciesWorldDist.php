<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesWorldDist extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $table = 'fish_species_world_dist';
    protected $fillable = ['fish_id', 'world_dist_id'];
}
