<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['id', 'worlddist', 'ec_type_id'];

    public function fish_species_world_dists()
    {
        // Example: $this->hasMany(Example::class, 'foreign_key', 'local_key');
        return $this->hasMany(FishSpeciesWorldDist::class);
    }

    public function worlddists()
    {
        return $this->belongsToMany(WorldDist::class, 'fish_species_world_dists', 'fish_species_id', 'world_dists_id');
    }

    public function ec_type()
    {
        return $this->belongsTo(EcType::class);
    }

    public function fish_species_tw_dists()
    {
        return $this->hasMany(FishSpeciesTwDist::class);
    }

    public function tw_dists()
    {
        return $this->belongsToMany(TwDist::class, 'fish_species_tw_dists', 'fish_species_id', 'tw_dists_id');
    }
}
