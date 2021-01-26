<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFishSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_new')->create('fish_species', function (Blueprint $table) {
            $table->id();
            $table->string('worlddist',50)->nullable();
            $table->timestamps();
        });

        Schema::connection('mysql_new')->create('fish_species_world_dist', function (Blueprint $table) {
            $table->integer('fish_id');
            $table->integer('world_dist_id');
            $table->timestamps();
        });

        Schema::connection('mysql_new')->create('lk_world_dist', function (Blueprint $table) {
            $table->id();
            $table->string('alias',20);
            $table->string('cdescription',50);
            $table->string('edescription',50);
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
        Schema::connection('mysql_new')->dropIfExists('fish_species');
        Schema::connection('mysql_new')->dropIfExists('fish_species_world_dist');
        Schema::connection('mysql_new')->dropIfExists('lk_world_dist');
    }
}
