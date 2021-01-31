<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FishSpecies;

class FishSpeciesController extends Controller
{
    // Prove the one has many relationship
    public function testHasManyAssocitate(Request $request)
    {
        $id = 381005;
        $fishes = FishSpecies::find(381005)->fish_species_world_dists;
        echo 'Fish ID: ' . $id . '<br>';
        foreach ($fishes as $fish) {
            # code...
            echo $fish->world_dists_id . '<br>';
        }
    }

    // Generate a visible result between these two tables: fish_species and ec_types
    public function testHasOneEctype(Request $request)
    {
        $id = 395484;
        $fish = FishSpecies::find($id)->ec_type;
        echo 'Fish ID: ' . $id . '<br>';
        echo '的生態類型為： ' . $fish->ec_type;
    }

    // Prove the many to many relationship
    public function testManyToManyAssocitate(Request $request)
    {
        $id = 381005;
        $fishes = FishSpecies::find($id)->worlddists;
        echo $id . ' 這條魚分布在以下地點：<br>';
        foreach ($fishes as $fish) {
            echo $fish->alias . ' ' . $fish->distribution_c . '<br>';
        }
    }

    // Show depth data
    public function testDepth(Request $request)
    {
        $id = 380709;
        $fishes = FishSpecies::find($id);
        echo $id . ' 這條魚<br>';
        echo '棲息頂端深度：' . $fishes->depth_top . ' m <br>';
        echo '棲息底端深度：' . $fishes->depth_bottom . ' m';
    }

    // Prove the many to many tw_dists
    public function testManyToManyTwDist(Request $request)
    {
        $id = 380712;
        $fishes = FishSpecies::find($id)->tw_dists;
        echo $id . ' 這條魚分布在以下地點：<br>';
        foreach ($fishes as $fish) {
            echo $fish->tw_dist_c . ',' . '<br>';
        }
    }
}
