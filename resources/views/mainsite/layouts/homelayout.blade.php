{{-- 网站首页入口 --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{{ $meta_description }}">
  <meta name="keywords" content="FoodForFun,食彩之国,炸酱面,一厨一世界,深夜放毒,意大利大爷,雷蒙德">
  <meta name="author" content="{{ config('website.author') }}">

  <title>{{ $title or config('website.title') }}</title>
  <!-- Favicon and touch icons -->
  <link rel="shortcut icon" href="bitbug_favicon.ico">

  {{-- Styles --}}
  <link href="/assets/css/mainsite.css" rel="stylesheet">
  {{--<link rel="stylesheet" href="http://fonts.useso.com/css?family=Lobster">--}}
  @yield('styles')

  {{-- HTML5 Shim and Respond.js for IE8 support --}}
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
@include('mainsite.partials.homepage-nav')

@yield('page-header')
@yield('content')

@include('mainsite.partials.page-footer')

{{-- Scripts --}}
<script src="/assets/js/components.js"></script>
<script src="/assets/js/homepage.js"></script>
@yield('scripts')

</body>
</html>