<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestructureTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
            $table->string('tag')->after('id')->unique();
            $table->string('title')->after('tag');
            $table->string('subtitle')->after('title');
            $table->string('page_image')->after('subtitle');
            $table->string('meta_description')->after('page_image');
            $table->string('layout')->after('meta_description')->default('mainsite.layouts.index');
            $table->boolean('reverse_direction')->after('layout');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
            $table->dropColumn('reverse_direction');
            $table->dropColumn('layout');
            $table->dropColumn('meta_description');
            $table->dropColumn('page_image');
            $table->dropColumn('subtitle');
            $table->dropColumn('title');
            $table->dropColumn('tag');
        });
    }
}
