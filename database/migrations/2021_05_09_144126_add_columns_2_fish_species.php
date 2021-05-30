<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns2FishSpecies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_new')->table('fish_species', function (Blueprint $table) {
            $table->text('character')->nullable()->comment('形態特徵');
            $table->text('character_e')->nullable()->comment('形態特徵英文');
            $table->text('distribution')->nullable()->comment('地理分布');
            $table->text('distribution_e')->nullable()->comment('地理分布英文');
            $table->text('habitat')->nullable()->comment('棲所生態');
            $table->text('habitat_e')->nullable()->comment('棲所生態英文');
            $table->text('utility')->nullable()->comment('漁業利用');
            $table->text('utility_e')->nullable()->comment('漁業利用英文');
            $table->text('economic')->nullable()->comment('經濟性');
            $table->text('is_year')->nullable()->comment('全年皆產');
            $table->text('reference')->nullable()->comment('參考文獻');
            $table->string('ref_short', 255)->nullable()->comment('簡短文獻');
            $table->text('reference_e')->nullable()->comment('參考文獻英文');
            $table->string('holotype_loca', 255)->nullable()->comment('模式種產地');
            $table->string('holotype_loca_e', 255)->nullable()->comment('模式種產地英文');
            $table->integer('maxlength')->nullable()->comment('最大體長');
            $table->string('memo', 255)->nullable()->comment('備註');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_new')->table('fish_species', function (Blueprint $table) {
            $table->dropColumn('character');
            $table->dropColumn('character_e');
            $table->dropColumn('distribution');
            $table->dropColumn('distribution_e');
            $table->dropColumn('habitat');
            $table->dropColumn('habitat_e');
            $table->dropColumn('utility');
            $table->dropColumn('utility_e');
            $table->dropColumn('economic');
            $table->dropColumn('is_year');
            $table->dropColumn('reference');
            $table->dropColumn('ref_short');
            $table->dropColumn('reference_e');
            $table->dropColumn('holotype_loca');
            $table->dropColumn('holotype_loca_e');
            $table->dropColumn('maxlength');
            $table->dropColumn('memo');
        });
    }
}
