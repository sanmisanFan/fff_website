@extends('mainsite.layouts.homelayout')

@section('styles')
<link href="/assets/css/swiper.min.css" rel="stylesheet">
@stop

@section('page-header')

<!-- banner images -->
<header class="focusImgs">
  <a class="focusImgs_prev" href="javascript:;">
    <span class="fa fa-angle-left"></span>
  </a>
  <a class="focusImgs_next" href="javascript:;">
    <span class="fa fa-angle-right"></span>
  </a>
  <div class="swiper-container" id="j_homeslide">
    <div class="swiper-wrapper">
      <div class="swiper-slide intro-header" style="background-image: url('http://ok1dd68iw.bkt.clouddn.com/image/dietary-advice.png'); ">
        <a href="http://foodforfun.me/article/guanyuwangzhanshangxian">
     <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="site-heading">
            <h1>关于网站上线</h1>

            <h2 class="subheading">程序猿相对大家说的话</h2>
          </div>
        </div>
      </div>
    </div>
          {{--<img src="http://ok1dd68iw.bkt.clouddn.com/image/dietary-advice.png" />--}}
        </a>
      </div>

      {{--<div class="swiper-slide">
        <a href="">
          <img class="hidden-xs" src="/assets/img/guodong_big.jpg" />
          <img class="visible-xs-inline-block" src="/assets/img/guodong_small.jpg" />
        </a>
      </div>--}}

      {{--<div class="swiper-slide">
        <a href="">
          <img class="hidden-xs" src="/assets/img/xmas.jpg" />
          <img class="visible-xs-inline-block" src="/assets/img/xmas.jpg" />
        </a>
      </div>--}}

    </div>
  </div>
  {{--<div id="j_homeslideindex" class="focusImgs_index"></div>--}}
</header>
@stop

@section('content')
  <div class="container tile-container">
    <div class="row">

      <div class='full-tile first-layer col-xs-12'>
        <span class="full-title">～最新美味内容～</span>
        <div class="rounded-line"></div>
      </div>
        
        @foreach ($posts as $post)
        <div class='tile col-xs-12 col-sm-6'>
          <div class="tile-box">
          <figure class="effect-julia">
            <img src="{{ page_image($post->page_thumbnail) }}" />
            <figcaption>
              <h2><span>{{ $post->title }}</span></h2>
              <div>
              <p>
                @if ($post->subtitle)
                  {{ $post->subtitle }}
                @endif
              </p>
              <p class="post-meta">
              Posted on {{ $post->published_at->format('F j, Y') }}
              @if ($post->tags->count())
                in
                {!! join(', ', $post->tagLinks()) !!}
              @endif
            </p>
            </div>
              <a href="{{ $post->url($tag) }}">View more</a>
            </figcaption>     
          </figure>
          </div>
        </div>
        @endforeach

      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        {{-- 分页 --}}
        <ul class="pager">

          {{-- Reverse direction --}}
          @if ($reverse_direction)
            @if ($posts->currentPage() > 1)
              <li class="previous">
                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                  <i class="fa fa-long-arrow-left fa-lg"></i>
                  Previous {{ $tag->tag }} Posts
                </a>
              </li>
            @endif
            @if ($posts->hasMorePages())
              <li class="next">
                <a href="{!! $posts->nextPageUrl() !!}">
                  Next {{ $tag->tag }} Posts
                  <i class="fa fa-long-arrow-right"></i>
                </a>
              </li>
            @endif
          @else
            @if ($posts->currentPage() > 1)
              <li class="previous">
                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                  <i class="fa fa-long-arrow-left fa-lg"></i>
                  Newer {{ $tag ? $tag->tag : '' }} Posts
                </a>
              </li>
            @endif
            @if ($posts->hasMorePages())
              <li class="next">
                <a href="{!! $posts->nextPageUrl() !!}">
                  Older {{ $tag ? $tag->tag : '' }} Posts
                  <i class="fa fa-long-arrow-right"></i>
                </a>
              </li>
            @endif
          @endif
        </ul>
      </div>
      
    </div>
  </div>
@stop
