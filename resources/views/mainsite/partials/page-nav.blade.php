{{-- Navigation --}}
<nav class="navbar navbar-default navbar-custom navbar-fixed-top" role="navigation">
  <div class="container">
    {{-- Brand and toggle get grouped for better mobile display --}}
    <div class="navbar-header page-scroll">
      <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target="#navbar-main">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{--<div class="col-sm-4 logo">
        <h1><a href="/">{{ config('website.name') }}</a> <span>.</span></h1>
      </div> --}}
      <a class="navbar-brand" href="/">{{ config('website.name') }} <span>.</span></a>
    </div>

    {{-- Collect the nav links, forms, and other content for toggling --}}
    <div class="collapse navbar-collapse" id="navbar-main">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="/">Home</a>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>