<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaMediaTypeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_new')->create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 255)->nullable()->comment('檔案名稱');
            $table->integer('fish_species_id')->nullable()->comment('魚種id');
            $table->tinyInteger('media_type')->nullable()->comment('媒體類型');
            $table->tinyInteger('is_publish')->nullable()->comment('是否已公開');
            $table->string('author', 255)->nullable()->comment('作者');
            $table->string('author_e', 255)->nullable()->comment('作者英文名');
            $table->date('data_update_date')->nullable()->comment('圖片建立日期');
            $table->string('record_location', 255)->nullable()->comment('紀錄地點');
            $table->integer('top_depth')->nullable()->comment('最高棲息深度');
            $table->integer('bottom_depth')->nullable()->comment('最低棲息深度');
            $table->string('photo_condition', 255)->nullable()->comment('內容描述');
            $table->string('remark', 255)->nullable()->comment('備註');
            $table->string('scientific_names', 255)->nullable()->comment('學名');
            $table->string('identifier', 255)->nullable()->comment('鑑定者');
            $table->date('iden_date')->nullable()->comment('鑑定日期');
            $table->timestamps();
        });

        Schema::connection('mysql_new')->create('media_types', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->string('type_e', 50);
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
        Schema::connection('mysql_new')->dropIfExists('medias');
        Schema::connection('mysql_new')->dropIfExists('media_types');
    }
}
