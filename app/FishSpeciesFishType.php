<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpeciesFishType extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['fish_species_id', 'fish_types_id'];
}
