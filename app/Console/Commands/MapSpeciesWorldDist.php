<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FishOrigin;
use App\FishSpeciesWorldDist;

class MapSpeciesWorldDist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fishdb:map-species-worlddist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Map relationship between species and worlddist, and insert data to species-worlddists table';

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
    public function handle()
    {
        foreach (FishOrigin::all() as $fish) {
            $worlddist = $fish->worlddist;
            if ($worlddist) {
                // 對資料內容做處理，將頓號改成逗號，文字改成相對應的索引鍵
                $worlddist = str_replace('、', ',', $worlddist);
                $worlddist = str_replace('西太平洋', '18', $worlddist);
                $worlddist = str_replace('印度太平洋區', '3', $worlddist);
                $worlddist = str_replace('中美洲哥斯達黎加至宏都拉斯', '99999', $worlddist);

                // 以逗號分隔索引鍵字串，讓各索引鍵成為單獨一筆資料
                $worlddist_array = explode(',', $worlddist);
                foreach ($worlddist_array as $wa)
                {
                    $fishSpeciesWorldDist = FishSpeciesWorldDist::create([
                        'fish_species_id' => $fish->id,
                        'world_dist_id' => $wa
                    ]);
                    $fishSpeciesWorldDist->save();
                }
            }
        }

        return 'successed';
    }
}
