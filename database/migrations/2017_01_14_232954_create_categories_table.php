<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->nullable();
            $table->string('name')->unique();
            $table->string('title')->nullable();
            //$table->string('subtitle');
            $table->string('page_image')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('layout')->default('mainsite.layouts.index');
            //$table->boolean('reverse_direction');
            $table->unsignedInteger('view_number')->nullable();
            $table->unsignedTinyInteger('order');
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
        Schema::dropIfExists('categories');
    }
}
