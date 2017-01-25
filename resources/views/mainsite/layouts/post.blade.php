@extends('mainsite.layouts.master', [
  'title' => $post->title,
  'meta_description' => $post->meta_description ?: config('website.description'),
])

@section('page-header')
  <header class="intro-header"
          style="background-image: url('{{ page_image($post->page_image) }}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="post-heading">
            <h1>{{ $post->title }}</h1>
            <h2 class="subheading">{{ $post->subtitle }}</h2>
            <span class="meta">
              Posted on {{ $post->published_at->format('F j, Y') }}
              @if ($post->tags->count())
                in
                {!! join(', ', $post->tagLinks()) !!}
              @endif
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>
@stop

@section('content')

  {{-- The Post --}}
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          {!! $post->content !!}
        </div>

<!-- JiaThis Button BEGIN -->
<div class="jiathis_style">
<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt" target="_blank"><img src="http://v2.jiathis.com/code_mini/images/btn/v1/jiathis1.gif" border="0" /></a>
<a class="jiathis_counter_style_margin:3px 0 0 2px"></a>
</div>
<script type="text/javascript" >
var jiathis_config={
  siteNum:5,
  sm:"tsina,weixin,cqq,qzone,fb",
  summary:"",
  boldNum:2,
  shortUrl:false,
  hideMore:false
}
</script>
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->


      </div>
    </div>
  </article>

  {{-- The Pager --}}
  <div class="container">
    <div class="row">
      <ul class="pager">
        @if ($tag && $tag->reverse_direction)
          @if ($post->olderPost($tag))
            <li class="previous">
              <a href="{!! $post->olderPost($tag)->url($tag) !!}">
                <i class="fa fa-long-arrow-left fa-lg"></i>
                Previous {{ $tag->tag }} Post
              </a>
            </li>
          @endif
          @if ($post->newerPost($tag))
            <li class="next">
              <a href="{!! $post->newerPost($tag)->url($tag) !!}">
                Next {{ $tag->tag }} Post
                <i class="fa fa-long-arrow-right"></i>
              </a>
            </li>
          @endif
        @else
          @if ($post->newerPost($tag))
            <li class="previous">
              <a href="{!! $post->newerPost($tag)->url($tag) !!}">
                <i class="fa fa-long-arrow-left fa-lg"></i>
                Next Newer {{ $tag ? $tag->tag : '' }} Post
              </a>
            </li>
          @endif
          @if ($post->olderPost($tag))
            <li class="next">
              <a href="{!! $post->olderPost($tag)->url($tag) !!}">
                Next Older {{ $tag ? $tag->tag : '' }} Post
                <i class="fa fa-long-arrow-right"></i>
              </a>
            </li>
          @endif
        @endif
      </ul>
    </div>

<div class="uyan_frame">
<!--PC和WAP自适应版-->
<div id="SOHUCS" sid="{{ $post->id }}" ></div> 
</div>
<script type="text/javascript"> 
(function(){ 
var appid = 'cysNIQDAN'; 
var conf = 'prod_d22b58326ef639a98599c72b11627f18'; 
var width = window.innerWidth || document.documentElement.clientWidth; 
if (width < 960) { 
window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>'); } else { var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("http://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})}); } })(); </script>


    
  </div>
@stop