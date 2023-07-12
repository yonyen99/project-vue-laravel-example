<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('media_type');
            $table->timestamps();

        });

        Schema::create('media_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('media_id')->unsigned();
            $table->text('file_url');
            $table->text('file_name');
            $table->string('file_type');
            $table->string('size');
            $table->timestamps();
        });

        Schema::table('media_files', function (Blueprint $table) {
            $table->foreign('media_id')
                ->references('id')
                ->on('medias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_files', function (Blueprint $table) {
            $table->dropForeign('media_files_media_id_foreign');
        });
        Schema::dropIfExists('media_files');
        Schema::dropIfExists('medias');
    }
};
