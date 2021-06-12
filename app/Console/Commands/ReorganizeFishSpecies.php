<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FishOrigin;
use App\FishSpecies;

class ReorganizeFishSpecies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fishdb:reorganize-species-ectype';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handleFish1to1data()
    {
        // execution timer
        $startTime = microtime(true);

        FishOrigin::chunk(200, function ($fishOrigins) {
            foreach ($fishOrigins as $fishOrigin) {
                $fishSpecies = FishSpecies::create([
                    'id' => $fishOrigin->id,
                    'character' => $fishOrigin->character,
                    'character_e' => $fishOrigin->character_e,
                    'distribution' => $fishOrigin->distribution,
                    'distribution_e' => $fishOrigin->distribution_e,
                    'habitat' => $fishOrigin->habitat,
                    'habitat_e' => $fishOrigin->habitat_e,
                    'utility' => $fishOrigin->utility,
                    'utility_e' => $fishOrigin->utility_e,
                    'economic' => $fishOrigin->economic,
                    'is_year' => $fishOrigin->is_year,
                    'reference' => $fishOrigin->reference,
                    'ref_short' => $fishOrigin->ref_short,
                    'holotype_loca' => $fishOrigin->holotype_loca,
                    'holotype_loca_e' => $fishOrigin->holotype_loca_e,
                    'maxlength' => intval(str_replace("cm", "", $fishOrigin->maxlenth)),
                    'memo' => $fishOrigin->memo
                ]);
                $fishSpecies->save();
            }
        });
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);

        echo 'It takes ' . $executionTime . " seconds to execute the script\n";
        return 0;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handleEctype()
    {
        // execution timer
        $startTime = microtime(true);

        FishOrigin::chunk(200, function ($fishOrigins) {
            foreach ($fishOrigins as $fishOrigin) {
                $ec_type_id = NULL;
                if ($fishOrigin->ectype_primary) {
                    $ec_type_id = 1;
                } else if ($fishOrigin->ectype_secondary) {
                    $ec_type_id = 2;
                } else if ($fishOrigin->ectype_peripheral) {
                    $ec_type_id = 3;
                }

                $fishSpecie = FishSpecies::find($fishOrigin->id);
                $fishSpecie->ec_type_id = $ec_type_id;
                $fishSpecie->save();
            }
        });
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);

        echo 'It takes ' . $executionTime . " seconds to execute the script\n";
        return 0;
    }

    public function handleDepth()
    {
        // execution timer
        $startTime = microtime(true);

        FishOrigin::chunk(200, function ($fishOrigins) {
            foreach ($fishOrigins as $fishOrigin) {
                $fishSpecie = FishSpecies::find($fishOrigin->id);
                $fishSpecie->top_depth = $fishOrigin->depth_upper;
                $depthDown = $fishOrigin->depth_down;
                if (!is_null($depthDown) && !is_numeric($depthDown)) {
                    $depthDown = 99999;
                }
                $fishSpecie->bottom_depth = $depthDown;
                $fishSpecie->save();
            }
        });
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);

        echo 'It takes ' . $executionTime . " seconds to execute the script\n";
        return 0;
    }
}
