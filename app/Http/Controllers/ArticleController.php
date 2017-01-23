<?php

namespace App\Http\Controllers;

use App\Jobs\ArticleIndexData;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use App\Http\Requests;
use App\Services\RssFeed;
use App\Services\SiteMap;

/**
 * index() 中先从请求中获取 $tag 值（没有的话为 null )
 * 然后调用刚刚创建的 ArticleIndexData 任务来获取文章数据。
 */
class ArticleController extends Controller
{
    
    public function index(Request $request){

        $tag = $request->get('tag');
        $category = $request->get('category');
        //$cates = Category::has('posts')->where('parent_id', 0)->get();
        //echo $cates;
        $data = $this->dispatch(new ArticleIndexData($tag, $category));

        if ($tag) {

            $layout = Tag::getLayout($tag);

        }else if ($category) {

            $layout = Category::getLayout($category);

        }else{

            $layout = 'mainsite.layouts.homepage';
        }

        //$layout = $tag ? Tag::getLayout($tag) : 'mainsite.layouts.homepage';
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
        $categories = Category::Has('posts')->where('parent_id', 0)->get();

        return view($post->layout, compact('post', 'tag', 'categories'));
    }

    //Rss订阅
    public function rss(RssFeed $feed){

        $rss = $feed->getRSS();

        return response($rss)
            ->header('Content-type', 'application/rss+xml');
    }

    //Site map
    public function siteMap(SiteMap $siteMap){

        $map = $siteMap->getSiteMap();

        return response($map)
            ->header('Content-type', 'text/xml');
    }
}
