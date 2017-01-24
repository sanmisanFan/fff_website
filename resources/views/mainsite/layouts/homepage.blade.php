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
      <div class="swiper-slide">
        <a href="">
          <img class="hidden-xs" src="/assets/img/zaolian_big.jpg" />
          <img class="visible-xs-inline-block" src="/assets/img/zaolian_small.jpg" />
        </a>
      </div>

      <div class="swiper-slide">
        <a href="">
          <img class="hidden-xs" src="/assets/img/guodong_big.jpg" />
          <img class="visible-xs-inline-block" src="/assets/img/guodong_small.jpg" />
        </a>
      </div>

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
            <img style="background-image: url('{{ page_image($post->page_thumbnail) }}'); height: 356px;" />
            <figcaption>
              <h2><span>{{ $post->title }}</span></h2>
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
