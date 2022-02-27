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
        Schema::create('notebook_pictures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->smallInteger('notebook_id')->unsigned();
            $table->foreign('notebook_id')->references('id')->on('notebooks');
            $table->string('picture_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notebook_pictures');
    }
};
