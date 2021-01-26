<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $table = 'fish_species';
    protected $fillable = ['id', 'worlddist'];

    public function fish_species_world_dists()
    {
        // Example: $this->hasMany(Example::class, 'foreign_key', 'local_key');
        return $this->hasMany(FishSpeciesWorldDist::class, 'fish_id');
    }

    public function lk_worlddists()
    {
        return $this->belongsToMany(LkWorldDist::class, 'fish_species_world_dist', 'fish_id', 'world_dist_id');
    }
}
