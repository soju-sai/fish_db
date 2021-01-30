<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FishSpecies;

class FishOriginController extends Controller
{
    // Prove the one has many relationship
    public function testHasManyAssocitate(Request $request)
    {
        $fishes = FishSpecies::find(381005)->fish_species_world_dists;
        foreach ($fishes as $fish) {
            # code...
            echo $fish->world_dists_id . '<br>';
        }
    }

    // Prove the many to many relationship
    public function testManyToManyAssocitate(Request $request)
    {
        $fishes = FishSpecies::find(381005)->worlddists;
        echo '381005 這條魚分布在以下地點：<br>';
        foreach ($fishes as $fish) {
            echo $fish->alias . ' ' . $fish->distribution_c . '<br>';
        }
    }
}
