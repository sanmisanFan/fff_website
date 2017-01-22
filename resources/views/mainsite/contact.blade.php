@extends('mainsite.layouts.master', ['meta_description' => '联系我们'])

@section('page-header')
  <header class="intro-header"
          style="background-image: url('{{ config('website.contact_image') }}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="site-heading">
            <h1>联系我们</h1>
            <hr class="small">
            <h2 class="subheading">
              大家有什么问题欢迎发送email给我们，或者直接微博私信留言～<br/><br/>谢谢大家！
            </h2>
          </div>
        </div>
      </div>
    </div>
  </header>
@stop

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        @include('mainsite.partials.errors')
        @include('mainsite.partials.success')
        <p>
          <strong>FoodFurFun</strong>始终是一个开放的大家庭，随时欢迎你联系我们或者提出意见 ：）
        </p>
        <p>也欢迎前往<a href="http://space.bilibili.com/2276820/#!/index" target="_blank">FoodForFun的哔哩哔哩主页</a>看看我们目前的节目~</p>
        <p>或者关注我们的微博，并且留言：<a href="http://weibo.com/FoodForFun" data-toggle="tooltip" data-placement="top" title="关注我们微博" target="_blank"><i class="fa fa-weibo"></i></a></p><hr/>  

        <form action="/contact" method="post">
          <input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="row control-group">
            <div class="form-group col-xs-12">
              <label for="name">您的名字</label>
              <input type="text" class="form-control" id="name" name="name"
                     value="{{ old('name') }}">
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-xs-12">
              <label for="email">Email地址</label>
              <input type="email" class="form-control" id="email" name="email"
                     value="{{ old('email') }}">
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-xs-12 controls">
              <label for="phone">电话号码</label>
              <input type="tel" class="form-control" id="phone" name="phone"
                     value="{{ old('phone') }}">
            </div>
          </div>
          <div class="row control-group">
            <div class="form-group col-xs-12 controls">
              <label for="message">传达给我们的信息</label>
              <textarea rows="5" class="form-control" id="message"
                        name="message">{{ old('message') }}</textarea>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="form-group col-xs-12">
              <button type="submit" class="btn btn-default">发送</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection