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
            $table->tinyInteger('ec_type_id')->nullable()->comment('生態類型id');
            $table->integer('depth_top')->nullable()->comment('棲息頂端深度');
            $table->integer('depth_bottom')->nullable()->comment('棲息底端深度');
            $table->timestamps();
        });

        Schema::connection('mysql_new')->create('world_dists', function (Blueprint $table) {
            $table->id();
            $table->string('alias',20);
            $table->string('distribution_c',50);
            $table->string('distribution_e',50);
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
        Schema::connection('mysql_new')->dropIfExists('world_dists');
    }
}
