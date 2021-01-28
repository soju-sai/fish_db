<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesWorldDist extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['fish_species_id', 'world_dists_id'];
}
