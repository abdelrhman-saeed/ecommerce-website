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
        Schema::create('notebooks', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string('name');
            $table->enum('notebook_type', [
                'notebook', 'todo', 'planner'
            ]);

            $table->decimal('price', 6, 2);
            $table->tinyInteger('discount')->default(0);
            $table->smallInteger('quantity')->default(0);

            $table->string('page_type')->nullable();
            $table->smallInteger('page_count')->nullable();
            $table->smallInteger('page_weight')->nullable();

            $table->string('manufacturing_type')->nullable();
            $table->string('cover_type')->nullable();
            $table->string('size')->nullable();

            $table->smallInteger('width')->nullable();
            $table->smallInteger('height')->nullable();

            $table->string('main_picture');
            $table->string('details')->nullable();

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
        Schema::dropIfExists('notebooks');
    }
};
