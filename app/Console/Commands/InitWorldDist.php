<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\WorldDist;

class InitWorldDist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:worlddist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'initial the record in world_dist table.';

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
        $arrAlias = [
            'C', 'IA', 'IP', 'IpP', 'IwP', 'JA', 'JC', 'JeC', 'JsC', 'JT',
            'P', 'PP', 'T', 'TP', 'TsC', 'TwP', 'WcP', 'WP', 'NP', 'PA',
            'NwP', 'EIW', 'AF', 'CN', 'SEA', 'NA', 'SA', 'JP', 'EA', 'EU',
            'AS', 'AO'
        ];
        $arrDistributionC = [
            '全球', '印度洋至澳洲', '印度至太平洋', '印度至泛太平洋',
            '印度至西太平洋', '日本至澳洲', '日本至中國海', '日本至東中國海', '日本至南中國海',
            '日本至臺灣', '太平洋', '泛太平洋', '臺灣', '太平洋熱帶區', '臺灣至南中國海',
            '西太平洋之熱帶區', '中西太平洋', '西太平洋', '北太平洋', '臺灣至澳洲', '西北太平洋',
            '東印度洋至西太平洋', '非洲', '中國', '東南亞', '北美', '南美', '日本', '東亞大陸',
            '歐亞大陸', '亞洲', '大西洋'
        ];
        $arrDistributionE = [
            'global', 'India Ocean to Australia', 'India Ocean to Pacific Ocean',
            'India Ocean to Pan_Pacific Ocean', 'India Ocean to West Pacific Ocean',
            'Japan to Australia', 'Japan to China Sea', 'Japan to East China Sea',
            'Japan to South China Sea', 'Japan to Taiwan', 'Pacific Ocean',
            'Pan_Pacific Ocean', 'Taiwan', 'Pacific Torrid Zone', 'Taiwan to South China Sea',
            'West Pacific Torrid Zone', 'Middle West Pacific Ocean', 'Australia',
            'North Pacific Ocean', 'Taiwan to Australia', 'North West Pacific Ocean',
            'East India Ocean to West Pacific Ocean', 'Afric', 'China', 'South East Asia',
            'North America', 'South America', 'Japan', 'East Asia Continent', 'Eurasia',
            'Asia', 'Atlantic Ocean'
        ];

        // $worldDist = new WorldDist;
        for ($i=0; $i < 32; $i++) {
            # code...
            $worldDist = WorldDist::create([
                'id' => $i + 1,
                'alias' => $arrAlias[$i],
                'distribution_c' => $arrDistributionC[$i],
                'distribution_e' => $arrDistributionE[$i]
            ]);

            $worldDist->save();
        }

        return 0;
    }
}
