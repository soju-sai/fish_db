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
}
