<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestructurePostsTable extends Migration
{
    /**
     * Run the migrations.
     * subtitle：文章副标题
     * page_image：文章缩略图（封面图）
     * meta_description：文章备注说明
     * is_draft：该文章是否是草稿
     * layout：使用的布局
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //重新修改一下post表
            $table->string('subtitle')->after('title');
            $table->string('page_image')->after('content'); 
            $table->string('meta_description')->after('page_image'); 
            $table->boolean('is_draft')->after('meta_description'); 
            $table->string('layout')->after('is_draft')->default('mainsite.layouts.post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('layout');
            $table->dropColumn('is_draft');
            $table->dropColumn('meta_description');
            $table->dropColumn('page_image');
            $table->dropColumn('subtitle');
        });
    }
}
