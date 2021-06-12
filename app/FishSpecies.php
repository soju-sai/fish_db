<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    //
    protected $connection = 'mysql_new';
    protected $fillable = ['id', 'worlddist', 'ec_type_id', 'character', 'character_e',
    'distribution', 'distribution_e', 'habitat', 'habitat_e', 'utility', 'utility_e',
    'economic', 'is_year', 'reference', 'ref_short', 'holotype_loca', 'holotype_loca_e',
    'maxlength', 'memo'];

    public function fish_species_world_dists()
    {
        // Example: $this->hasMany(Example::class, 'foreign_key', 'local_key');
        return $this->hasMany(FishSpeciesWorldDist::class);
    }

    public function world_dists()
    {
        return $this->belongsToMany(WorldDist::class);
    }

    public function ec_type()
    {
        return $this->belongsTo(EcType::class);
    }

    public function tw_dists()
    {
        return $this->belongsToMany(TwDist::class);
    }

    public function fish_types()
    {
        // Example: $this->belongsToMany(FishType::class, 'fish_species_fish_types', 'fish_species_id', 'fish_types_id');
        return $this->belongsToMany(FishType::class);
    }

    public function habitats()
    {
        return $this->belongsToMany(Habitat::class);
    }
}
