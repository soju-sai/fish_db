<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FishSpeciesTwDist;
use App\FishOrigin;

class MapMany2ManyRelation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fish:map-many2many';

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
    public function handleFishSpeciesTwDists()
    {
        // execution timer
        $startTime = microtime(true);

        $fishOrigins = FishOrigin::select('id','e','w','s','ws','n','en','es','p','h','o','g','ts','ns')
            ->chunk(200, function ($fishOrigins) {
                foreach ($fishOrigins as $fishOrigin) {
                    $twDistArr = $fishOrigin->toArray(); // 只取得這些欄位的值，並轉換成陣列
                    $twDistArr = array_values($twDistArr); // 只取得欄位的值，用來判斷
                    // var_dump($twDistArr);
                    for ($i=1; $i < count($twDistArr); $i++) {
                        if ($twDistArr[$i]) {
                            // echo strval($key+1);
                            $fishSpeciesTwDist = FishSpeciesTwDist::create([
                                'fish_species_id' => $twDistArr[0],
                                'tw_dists_id' => $i
                            ]);
                            $fishSpeciesTwDist->save();
                        }
                    }
                }
            });

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime);

        echo 'It takes ' . $executionTime . " seconds to execute the script\n";
        return 0;
    }
}
