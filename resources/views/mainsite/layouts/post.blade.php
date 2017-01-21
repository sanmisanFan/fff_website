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
    
<!-- 来必力City版安装代码 -->
<div id="lv-container" data-id="city" data-uid="MTAyMC8yNzQ0OC80MDI2">
  <script type="text/javascript">
   (function(d, s) {
       var j, e = d.getElementsByTagName(s)[0];

       if (typeof LivereTower === 'function') { return; }

       j = d.createElement(s);
       j.src = 'https://cdn-city.livere.com/js/embed.dist.js';
       j.async = true;

       e.parentNode.insertBefore(j, e);
   })(document, 'script');
  </script>
<noscript> 为正常使用来必力评论功能请激活JavaScript</noscript>
</div>
<!-- City版安装代码已完成 -->
    
  </div>
@stop