<?php

namespace App\Http\Controllers;

use App\FishSpecies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FishSpeciesController extends Controller
{
    // Prove the one has many relationship of Worlddist
    public function testHasManySpeciesWorlddist(Request $request)
    {
        $id = 381005;
        $fishes = FishSpecies::find(381005)->fish_species_world_dists;
        echo 'Fish ID: ' . $id . '<br>';
        foreach ($fishes as $fish) {
            # code...
            echo $fish->world_dist_id . '<br>';
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

    // Prove the many to many relationship of species and world_dists
    public function testManyToManyWorldDist(Request $request)
    {
        $id = 381005;
        $fishes = FishSpecies::find($id)->world_dists;
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
        echo '頂端棲息深度：' . $fishes->top_depth . ' m <br>';
        echo '底端棲息深度：' . $fishes->bottom_depth . ' m';
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

    // Prove the many to many fish_types
    public function testManyToManyFishType(Request $request)
    {
        $id = 380756;
        $fishes = FishSpecies::find($id)->fish_types;
        echo $id . ' 這條魚的種類為：<br>';
        foreach ($fishes as $fish) {
            echo $fish->fish_type_c . ',' . '<br>';
        }
    }

    // Prove the many to many fish_types
    public function testManyToManyHabitat(Request $request)
    {
        $id = 380756;
        $fishes = FishSpecies::find($id)->habitats;
        echo $id . ' 這條魚的棲地分布於：<br>';
        foreach ($fishes as $fish) {
            echo $fish->habitat_c . ',' . '<br>';
        }
    }

    public function exportDetailCsv(Request $request)
    {
        // execution timer
        $startTime = microtime(true);

        $fileName = 'fish_detail.csv';

        $fishSpeciesColumn = FishSpecies::select('id', 'character', 'character_e', 'distribution', 'distribution_e',
        'habitat', 'habitat_e', 'utility', 'utility_e', 'economic', 'is_year', 'reference', 'ref_short', 'reference_e', 'holotype_loca', 'holotype_loca_e', 'maxlength', 'top_depth', 'bottom_depth',
        'memo')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename= $fileName"
        );

        $file = fopen('php://output', 'w');

        $csvColumns = array(
            'id', 'character', 'character_e', 'distribution', 'distribution_e', 'worlddist',
            'tw_dists', 'habitat', 'habitat_e', 'habitat(h1-h10)', 'utility', 'utility_e', 'economic',
            'fishtype(i1-i3)', 'is_year', 'reference', 'ref_short', 'reference_e', 'holotype_loca', 'holotype_loca_e', 'maxlenth', 'depth_upper', 'depth_down', 'ectype_primary｜ectype_secondary｜ectype_peripheral', 'memo'
        );
        fputcsv($file, $csvColumns);

        $callback = function() use($fishSpeciesColumn, $file, $startTime) {
            foreach ($fishSpeciesColumn as $key => $value) {
                $id = $value['id'];
                $row = $habitat_c = $habitat_e = $fish_type_c = $fish_type_e = $tw_dist_c = $distribution_c = $ec_type = [];
                $row[] = $id;
                $row[] = $value['character'];
                $row[] = $value['character_e'];
                $row[] = $value['distribution'];
                $row[] = $value['distribution_e'];

                // ------- start -------
                $fishes = FishSpecies::find($id)->world_dists;
                foreach ($fishes as $fish) {
                    $distribution_c[] = $fish->distribution_c;
                }
                $row[] = implode($distribution_c, '|');
                // ------- end -------

                // ------- start -------
                $fishes = FishSpecies::find($id)->tw_dists;

                foreach ($fishes as $fish) {
                    $tw_dist_c[] = $fish->tw_dist_c;
                }
                $row[] = implode($tw_dist_c, '|');
                // ------- end -------

                $row[] = $value['habitat'];
                $row[] = $value['habitat_e'];

                // ------- start -------
                $fishes = FishSpecies::find($id)->habitats;

                foreach ($fishes as $fish) {
                    $habitat_c[] = $fish->habitat_c;
                }
                $row[] = implode($habitat_c, '|');
                // ------- end -------

                $row[] = $value['utility'];
                $row[] = $value['utility_e'];
                $row[] = intval($value['economic']) == 1 ? '經濟性' : '';

                // ------- start -------
                $fishes = FishSpecies::find($id)->fish_types;

                foreach ($fishes as $fish) {
                    $fish_type_c[] = $fish->fish_type_c;
                }
                $row[] = implode($fish_type_c, '|');
                // ------- end -------

                $row[] = $value['is_year'];
                $row[] = $value['reference'];
                $row[] = $value['ref_short'];
                $row[] = $value['reference_e'];
                $row[] = $value['holotype_loca'];
                $row[] = $value['holotype_loca_e'];
                $row[] = $value['maxlength']. ' cm';
                $row[] = $value['top_depth'];
                $row[] = $value['bottom_depth'];

                // ------- start -------
                $ec_type = '';
                $ecTypeModel = FishSpecies::find($id)->ec_type;
                if ($ecTypeModel) {
                    $ec_type = $ecTypeModel->ec_type;
                }
                $row[] = $ec_type;
                // ------- end -------

                $row[] = $value['memo'];

                fputcsv($file, $row);
            }

            fclose($file);

            $endTime = microtime(true);
            $executionTime = ($endTime - $startTime);

            Log::Debug('It takes ' . $executionTime . " seconds to execute the script\n");
        };

        return response()->streamDownload($callback, $fileName, $headers);
    }

    public function exportCsv(Request $request)
    {
        // execution timer
        $startTime = microtime(true);

        $fileName = 'fish_species.csv';

        // $ids = FishSpecies::select('id')->limit(100)->get();
        $ids = FishSpecies::select('id')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename= $fileName"
        );

        $file = fopen('php://output', 'w');
        $columns = array('id', 'habitat_c', 'habitat_e', 'fish_type_c', 'fish_type_e', 'tw_dist_c', 'distribution_c', 'ec_type');
        fputcsv($file, $columns);

        $callback = function() use($ids, $file, $startTime) {
            foreach ($ids as $key => $value) {
                $id = $value['id'];
                $row = $habitat_c = $habitat_e = $fish_type_c = $fish_type_e = $tw_dist_c = $distribution_c = $ec_type = [];
                $row[] = $id;

                // ------- start -------
                $fishes = FishSpecies::find($id)->habitats;

                foreach ($fishes as $fish) {
                    $habitat_c[] = $fish->habitat_c;
                    $habitat_e[] = $fish->habitat_e;
                }
                $row[] = implode($habitat_c, ',');
                $row[] = implode($habitat_e, ',');
                // ------- end -------

                // ------- start -------
                $fishes = FishSpecies::find($id)->fish_types;

                foreach ($fishes as $fish) {
                    $fish_type_c[] = $fish->fish_type_c;
                    $fish_type_e[] = $fish->fish_type_e;
                }
                $row[] = implode($fish_type_c, ',');
                $row[] = implode($fish_type_e, ',');
                // ------- end -------

                // ------- start -------
                $fishes = FishSpecies::find($id)->tw_dists;

                foreach ($fishes as $fish) {
                    $tw_dist_c[] = $fish->tw_dist_c;
                }
                $row[] = implode($tw_dist_c, ',');
                // ------- end -------

                // ------- start -------
                $fishes = FishSpecies::find($id)->world_dists;
                foreach ($fishes as $fish) {
                    $distribution_c[] = $fish->distribution_c;
                }
                $row[] = implode($distribution_c, ',');
                // ------- end -------

                // ------- start -------
                $ec_type = '';
                $ecTypeModel = FishSpecies::find($id)->ec_type;
                if ($ecTypeModel) {
                    $ec_type = $ecTypeModel->ec_type;
                }
                $row[] = $ec_type;
                // ------- end -------

                fputcsv($file, $row);
            }

            fclose($file);

            $endTime = microtime(true);
            $executionTime = ($endTime - $startTime);

            Log::Debug('It takes ' . $executionTime . " seconds to execute the script\n");
        };

        return response()->streamDownload($callback, $fileName, $headers);
    }
}
