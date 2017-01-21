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
  <div class="container-fluid tile-container">
    <div class="row">
      <div class='full-tile column col-xs-12'>
        <span class="full-title">～最新美味内容～</span>
        <div class="rounded-line"></div>
      </div>

      <div class='tile-grid'>

        <div class='tile column col-xs-6 col-sm-4 col-md-3'>
          <div class="tile-box">
            <figure class="effect-dexter">
            <img src="/assets/img/19.jpg" alt="img19"/>
            <figcaption>
              <h2>Strange <span>Dexter</span></h2>
              <p>Dexter had his own strange way. You could watch him training ants.</p>
              <a href="#">View more</a>
            </figcaption>     
          </figure>
          </div>
        </div>

        <div class='tile column col-xs-6 col-sm-4 col-md-3'>
          <div class="tile-box">
            <figure class="effect-dexter">
            <img src="/assets/img/19.jpg" alt="img19"/>
            <figcaption>
              <h2>Strange <span>Dexter</span></h2>
              <p>Dexter had his own strange way. You could watch him training ants.</p>
              <a href="#">View more</a>
            </figcaption>     
          </figure>
          </div>
        </div>

        <div class='tile column col-xs-6 col-sm-4 col-md-3'>
          <div class="tile-box">
            <figure class="effect-dexter">
            <img src="/assets/img/19.jpg" alt="img19"/>
            <figcaption>
              <h2>Strange <span>Dexter</span></h2>
              <p>Dexter had his own strange way. You could watch him training ants.</p>
              <a href="#">View more</a>
            </figcaption>     
          </figure>
          </div>
        </div>

        <div class='tile column col-xs-6 col-sm-4 col-md-3'>
          <div class="tile-box">
            <figure class="effect-dexter">
            <img src="/assets/img/19.jpg" alt="img19"/>
            <figcaption>
              <h2>Strange <span>Dexter</span></h2>
              <p>Dexter had his own strange way. You could watch him training ants.</p>
              <a href="#">View more</a>
            </figcaption>     
          </figure>
          </div>
        </div>


      </div>

    </div>
  </div>
@stop
