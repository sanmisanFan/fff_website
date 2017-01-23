<hr>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <ul class="list-inline text-center">
        <li>
            <a href="http://weibo.com/FoodForFun" data-toggle="tooltip" data-placement="top" title="关注我们微博" target="_blank">
                <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-weibo fa-stack-1x fa-inverse"></i>
              </span>
            </a>
        </li>
          <li>
            <a href="{{ url('rss') }}" data-toggle="tooltip"
               title="RSS feed">
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
        </ul>
        <p class="copyright">Copyright © {{ config('website.author') }}</p>
        <p class="copyright">互联网ICP备案：<a href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备16046548号-1</a>, <a href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备16046548号-2</a></p>
      </div>
    </div>
  </div>
</footer>