<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Pinyin;

class Post extends Model
{
    protected $table = 'posts';
    protected $dates = ['published_at'];

    protected $fillable = [
        'title', 'subtitle', 'content', 'page_image', 'meta_description','layout', 'is_draft', 'published_at',
    ];

    /**
     * The many-to-many relationship between posts and tags.
     *
     * @return BelongsToMany
     */
    public function tags(){

        return $this->belongsToMany(Tag::class, 'tag_posts', 'post_id', 'tag_id');
    }

    /**
     * The many-to-many relationship between posts and categories.
     *
     * @return BelongsToMany
     */
    public function categories(){

        return $this->belongsToMany(Category::class, 'post_category_pivot', 'post_id', 'category_id');
    }

    /**
     * Set the title attribute and automatically the slug
     *
     * @param string $value
     */
    public function setTitleAttribute($value){

        $this -> attributes['title'] = $value;
        //echo Pinyin::getPinyin("早上好");
        if(! $this -> exists){
            $translatedValue = Pinyin::getPinyin($value);
            $this->setUniqueSlug($translatedValue, '');
        }
    }

    /**
     * Recursive routine to set a unique slug
     *
     * @param string $title
     * @param mixed $extra
     */
    protected function setUniqueSlug($title, $extra){

        $slug = str_slug($title.'-'.$extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }


    /**
    * Return URL to post
    * mainsite.layouts.index 视图会使用 url() 方法链接到指定文章详情页
    *
    * @param Tag $tag
    * @return string
    */
    public function url(Tag $tag = null){

        $url = url('article/'.$this->slug);
        if ($tag) {
            $url .= '?tag='.urlencode($tag->tag);
        }

        return $url;
    }

    /**
    * Return array of tag links
    * 方法返回一个链接数组，每个链接都会指向首页并带上标签参数
    *
    * @param string $base
    * @return array
    */
    public function tagLinks($base = '/article?tag=%TAG%'){

        $tags = $this->tags()->pluck('tag');
        $return = [];
        foreach ($tags as $tag) {
            $url = str_replace('%TAG%', urlencode($tag), $base);
            $return[] = '<a href="'.$url.'">'.e($tag).'</a>';
        }
        return $return;
    }

    /**
    * Return next post after this one or null
    * 返回下一篇文章链接，如果没有的话返回 null
    *
    * @param Tag $tag
    * @return Post
    */
    public function newerPost(Tag $tag = null){

        $query =
            static::where('published_at', '>', $this->published_at)
                    ->where('published_at', '<=', Carbon::now())
                    ->where('is_draft', 0)
                    ->orderBy('published_at', 'asc');

        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }

        return $query->first();
    }

    /**
    * Return older post before this one or null
    * 方法返回前一篇文章链接，如果没有返回 null
    *
    * @param Tag $tag
    * @return Post
    */
    public function olderPost(Tag $tag = null){

        $query =
            static::where('published_at', '<', $this->published_at)
                ->where('is_draft', 0)
                ->orderBy('published_at', 'desc');
        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }

        return $query->first();
    }
}
