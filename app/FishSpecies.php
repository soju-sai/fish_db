<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['id', 'worlddist'];

    public function fish_species_world_dists()
    {
        // Example: $this->hasMany(Example::class, 'foreign_key', 'local_key');
        return $this->hasMany(FishSpeciesWorldDist::class);
    }

    public function worlddists()
    {
        return $this->belongsToMany(WorldDist::class, 'fish_species_world_dists', 'fish_species_id', 'world_dists_id');
    }
}
