<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesHabitat extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $table = 'fish_species_habitat';
    protected $fillable = ['fish_species_id', 'habitat_id'];
}
