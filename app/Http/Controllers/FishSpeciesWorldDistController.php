<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FishSpecies;
use App\FishSpeciesWorldDist;

class FishSpeciesWorldDistController extends Controller
{
    // 取出id和worlddist_id放到fish_species_world_dist
    public function insertFishDist(Request $request)
    {
        // Validate the request...
        // $fishSpecies = FishSpecies::limit(5)->get();
        // $fishSpecies = new FishSpecies;
        // $fishSpecies = $fishSpecies->get();
        // foreach ($fishSpecies as $fish) {
        //     $worlddist_array = explode(',', $fish->worlddist);
        //     foreach ($worlddist_array as $wa)
        //     {
        //         $fishSpecies->fish_id = $fish->id;
        //         $fishSpecies->world_dist_id = $wa;
        //     }
        //     $fishSpeciesWorldDist->save();
        // }

        FishSpecies::chunk(200, function($fishes) {
            foreach ($fishes as $fish) {
                if ($fish->worlddist) {
                    $worlddist_array = explode(',', $fish->worlddist);
                    foreach ($worlddist_array as $wa)
                    {
                        $fishSpeciesWorldDist = FishSpeciesWorldDist::create([
                            'fish_species_id' => $fish->id,
                            'world_dists_id' => $wa
                        ]);
                        $fishSpeciesWorldDist->save();
                    }
                }
            }
        });

    }
}
