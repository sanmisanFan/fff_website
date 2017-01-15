<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'tag', 'title', 'subtitle', 'page_image', 'meta_description', 'reverse_direction'
    ];

    /**
     * 定义文章与标签之间多对多关联关系
     *
     * @return BelongsToMany
     */
    public function posts(){

        return $this->belongsToMany(Post::class, 'tag_posts', 'tag_id', 'post_id');
    }

    /**
    * Return the index layout to use for a tag
    *
    * @param string $tag
    * @param string $default
    * @return string
    */
    public static function getLayout($tag, $default = 'mainsite.layouts.index'){

        $layout = static::whereTag($tag)->pluck('layout')->first();

        return $layout ?: $default;
    }

}
