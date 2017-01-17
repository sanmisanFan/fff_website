<?php

namespace App\Jobs;

use App\Post;
use App\Tag;
use Carbon\Carbon;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleIndexData extends Job
{
    protected $tag;

    /**
     * Create a new job instance.
     *
     * @param string|null $tag
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Execute the job.
     * 如果请求参数中指定了标签，则需要根据该标签来过滤要显示的文章
     * 如果传入标签，那么调用 tagIndexData 方法返回根据标签进行过滤的文章列表，否则调用 normalIndexData 返回正常文章列表
     *
     * @return array
     */
    public function handle()
    {
        if ($this->tag) {
            return $this->tagIndexData($this->tag);
        }

        return $this->normalIndexData();

    }

    /**
     * Return data for normal index page
     *
     * @return array
     */
    protected function normalIndexData(){

        $posts = Post::with('tags')
            ->where('published_at', '<=', Carbon::now())
            ->where('is_draft', 0)
            ->orderBy('published_at', 'desc')
            ->simplePaginate(config('website.posts_per_page'));

        return [
            'title' => config('website.title'),
            'subtitle' => config('website.subtitle'),
            'posts' => $posts,
            'page_image' => config('website.page_image'),
            'meta_description' => config('website.description'),
            'reverse_direction' => false,
            'tag' => null
        ];
    }

    /**
     * Return data for a tag index page
     *
     * @param string $tag
     * @return array
     */
    protected function tagIndexData($tag){

        $tag = Tag::where('tag', $tag)->firstOrFail();
        $reverse_direction = (bool)$tag->reverse_direction;

        $posts = Post::where('published_at', '<=', Carbon::now())
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            })
            ->where('is_draft', 0)
            ->orderBy('published_at', $reverse_direction ? 'asc' : 'desc')
            ->simplePaginate(config('website.posts_per_page'));
        $posts->addQuery('tag', $tag->tag);

        $page_image = $tag->page_image ?: config('website.page_image');

        return [
            'title' => $tag->title,
            'subtitle' => $tag->subtitle,
            'posts' => $posts,
            'page_image' => $page_image,
            'tag' => $tag,
            'reverse_direction' => $reverse_direction,
            'meta_description' => $tag->meta_description ?: config('website.description')
        ];
    }
}

