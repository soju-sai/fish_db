<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FishOrigin;
use App\FishSpecies;

class FishOriginController extends Controller
{
    //
    public function oldToNew(Request $request)
    {
        // Validate the request...

        foreach (FishOrigin::all() as $fish) {
            $worlddist = $fish->worlddist;
            if ($worlddist) {
                $worlddist = str_replace('、', ',', $worlddist);
                $worlddist = str_replace('西太平洋', '18', $worlddist);
                $worlddist = str_replace('印度太平洋區', '3', $worlddist);
                $worlddist = str_replace('中美洲哥斯達黎加至宏都拉斯', '999', $worlddist);
                $fishSpecies = FishSpecies::create([
                    'id' => $fish->id,
                    'worlddist' => $worlddist
                ]);
            } else {
                $fishSpecies = FishSpecies::create([
                    'id' => $fish->id
                ]);
            }
            $fishSpecies->save();
        }
    }
}
