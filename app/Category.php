<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelTree, AdminBuilder;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id', 'title', 'subtitle', 'page_image', 'meta_description', 'reverse_direction', 'order'
    ];

    /**
     * 定义文章与标签之间多对多关联关系
     *
     * @return BelongsToMany
     */
    public function posts(){

        return $this->belongsToMany(Post::class, 'post_category_pivot', 'category_id', 'post_id');
    }

    /**
    * Return the index layout to use for a category
    *
    * @param string $category
    * @param string $default
    * @return string
    */
    public static function getLayout($category, $default = 'mainsite.layouts.index'){

        $layout = static::whereCategory($category)->pluck('layout')->first();

        return $layout ?: $default;
    }
}
