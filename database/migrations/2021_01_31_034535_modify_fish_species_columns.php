<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFishSpeciesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('mysql_new')->table('fish_species', function (Blueprint $table) {
            $table->dropColumn('worlddist');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::connection('mysql_new')->table('fish_species', function (Blueprint $table) {
            $table->string('worlddist',50)->nullable();
        });
    }
}
