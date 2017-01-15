<?php

namespace App\Http\Controllers;

use App\Jobs\ArticleIndexData;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use App\Http\Requests;

/**
 * index() 中先从请求中获取 $tag 值（没有的话为 null )
 * 然后调用刚刚创建的 ArticleIndexData 任务来获取文章数据。
 */
class ArticleController extends Controller
{
    
    public function index(Request $request){

        $tag = $request->get('tag');
        $data = $this->dispatch(new ArticleIndexData($tag));
        $layout = $tag ? Tag::getLayout($tag) : 'mainsite.layouts.homepage';
        //echo Carbon::now();
        return view($layout, $data);
    }

    /**
     * 用于显示文章详情，这里我们使用了渴求式加载获取指定文章标签信息
     */
    public function showPost($slug, Request $request){

        $post = Post::with('tags')->whereSlug($slug)->firstOrFail();
        $tag = $request->get('tag');
        if ($tag) {
            $tag = Tag::whereTag($tag)->firstOrFail();
        }

        return view($post->layout, compact('post', 'tag'));
    }
}
