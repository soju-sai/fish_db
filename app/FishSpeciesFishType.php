<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesFishType extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $table = 'fish_species_fish_type';
    protected $fillable = ['fish_species_id', 'fish_type_id'];
}
