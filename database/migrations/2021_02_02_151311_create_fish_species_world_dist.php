<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishSpeciesWorldDist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_new')->create('fish_species_world_dist', function (Blueprint $table) {
            $table->integer('fish_species_id');
            $table->integer('world_dist_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_new')->dropIfExists('fish_species_world_dist');
    }
}
