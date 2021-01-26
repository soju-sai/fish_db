<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $table = 'fish_species';
    protected $fillable = ['id', 'worlddist'];
}
