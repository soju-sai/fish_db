<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEctypesHabitatsFishtypeDepthTwdistTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ec_type init data
        Schema::connection('mysql_new')->create('ec_types', function (Blueprint $table) {
            $table->id();
            $table->string('ec_type',50)->comment('生態類型');
            $table->timestamps();
        });
        $ec_types = [
            [
                'ec_type' => '初級淡水魚'
            ],
            [
                'ec_type' => '次級淡水魚'
            ],
            [
                'ec_type' => '周緣性淡水魚'
            ]
            ];
        DB::connection('mysql_new')->table('ec_types')->insert($ec_types);

        // habitats init data
        Schema::connection('mysql_new')->create('habitats', function (Blueprint $table) {
            $table->id();
            $table->string('habitat_c',50)->comment('棲地');
            $table->string('habitat_e',50)->comment('棲地英文');
            $table->timestamps();
        });
        $habitats = [
            [
                'habitat_c' => '大洋',
                'habitat_e' => 'Ocean'
            ],
            [
                'habitat_c' => '深海',
                'habitat_e' => 'Deep Sea'
            ],
            [
                'habitat_c' => '礁區',
                'habitat_e' => 'Coral'
            ],
            [
                'habitat_c' => '砂泥底',
                'habitat_e' => 'Benthos'
            ],
            [
                'habitat_c' => '河口',
                'habitat_e' => 'Estuary'
            ],
            [
                'habitat_c' => '淡水',
                'habitat_e' => 'Fresh Water'
            ],
            [
                'habitat_c' => '近海沿岸',
                'habitat_e' => 'Coastal'
            ],
            [
                'habitat_c' => '潟湖',
                'habitat_e' => 'Lagoon'
            ],
            [
                'habitat_c' => '礁沙',
                'habitat_e' => 'Coral&Sand'
            ],
            [
                'habitat_c' => '潮池',
                'habitat_e' => ''
            ]
            ];

        DB::connection('mysql_new')->table('habitats')->insert($habitats);

        // fish_types init data
        Schema::connection('mysql_new')->create('fish_types', function (Blueprint $table) {
            $table->id();
            $table->string('fish_type_c',50)->comment('種類');
            $table->string('fish_type_e',50)->comment('種類英文');
            $table->timestamps();
        });
        $fish_types = [
            [
                'fish_type_c' => '食用魚類',
                'fish_type_e' => 'Edible Fish'
            ],
            [
                'fish_type_c' => '觀賞魚類',
                'fish_type_e' => 'Economic Fish'
            ],
            [
                'fish_type_c' => '有毒魚類',
                'fish_type_e' => 'Poisonous Fish'
            ]
            ];
        DB::connection('mysql_new')->table('fish_types')->insert($fish_types);

        // tw_dists init data
        Schema::connection('mysql_new')->create('tw_dists', function (Blueprint $table) {
            $table->id();
            $table->string('alias', 20)->comment('識別子');
            $table->string('tw_dist_c',50)->comment('中文台灣分布地');
            $table->string('tw_dist_e',50)->comment('英文台灣分布地');
            $table->timestamps();
        });
        $tw_dists = [
            [
                'alias' => 'e',
                'tw_dist_c' => '東部',
                'tw_dist_e' => 'East'
            ],
            [
                'alias' => 'w',
                'tw_dist_c' => '西部',
                'tw_dist_e' => 'West'
            ],
            [
                'alias' => 's',
                'tw_dist_c' => '南部',
                'tw_dist_e' => 'South'
            ],
            [
                'alias' => 'ws',
                'tw_dist_c' => '西南部',
                'tw_dist_e' => 'South West'
            ],
            [
                'alias' => 'n',
                'tw_dist_c' => '北部',
                'tw_dist_e' => 'North'
            ],
            [
                'alias' => 'en',
                'tw_dist_c' => '東北部',
                'tw_dist_e' => 'North East'
            ],
            [
                'alias' => 'es',
                'tw_dist_c' => '東南部',
                'tw_dist_e' => 'South East'
            ],
            [
                'alias' => 'p',
                'tw_dist_c' => '澎湖',
                'tw_dist_e' => 'PonFu'
            ],
            [
                'alias' => 'h',
                'tw_dist_c' => '小琉球',
                'tw_dist_e' => 'ShaoLiuChew'
            ],
            [
                'alias' => 'o',
                'tw_dist_c' => '蘭嶼',
                'tw_dist_e' => 'LanI Is.'
            ],
            [
                'alias' => 'g',
                'tw_dist_c' => '綠島',
                'tw_dist_e' => 'Greeb IS.'
            ],
            [
                'alias' => 'ts',
                'tw_dist_c' => '東沙',
                'tw_dist_e' => 'Tung Sa IS.'
            ],
            [
                'alias' => 'ns',
                'tw_dist_c' => '南沙',
                'tw_dist_e' => 'Nan Sa IS.'
            ],
            [
                'alias' => 'km',
                'tw_dist_c' => '金門',
                'tw_dist_e' => 'Kinmen'
            ],
            [
                'alias' => 'mt',
                'tw_dist_c' => '馬祖',
                'tw_dist_e' => 'Matsu'
            ],
            [
                'alias' => 'pf_semiiland',
                'tw_dist_c' => '恆春半島',
                'tw_dist_e' => 'Semiiland'
            ],
            ];
        DB::connection('mysql_new')->table('tw_dists')->insert($tw_dists);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_new')->dropIfExists('ec_types');
        Schema::connection('mysql_new')->dropIfExists('habitats');
        Schema::connection('mysql_new')->dropIfExists('fish_types');
        Schema::connection('mysql_new')->dropIfExists('tw_dists');
    }
}
