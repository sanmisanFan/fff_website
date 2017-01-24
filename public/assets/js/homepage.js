// Navigation Scripts to Show Header on Scroll-Up
jQuery(document).ready(function($) {
    var MQL = 1170;

//homepage navigation slide-in effect
    if ($(window).width() > MQL) {
        var headerHeight = $('.navbar-mainsite').height();
        $(window).on('scroll', {
            previousTop: 0
        },
        function() {
            var currentTop = $(window).scrollTop();

            //if user is scrolling up
            if (currentTop < this.previousTop) {
                if (currentTop > 0 && $('.navbar-mainsite').hasClass('is-fixed')) {
                    $('.navbar-mainsite').addClass('is-visible');
                } else {
                    $('.navbar-mainsite').removeClass('is-visible is-fixed');
                }
            //if scrolling down...
            } else {
                $('.navbar-mainsite').removeClass('is-visible');
                if (currentTop > headerHeight && !$('.navbar-mainsite').hasClass('is-fixed')) {
                    $('.navbar-mainsite').addClass('is-fixed');
                }
            }
            this.previousTop = currentTop;
        });
    }

    var mySwiper = new Swiper ('.swiper-container', {
        //direction: 'vertical',
        //loop: true,
        //autoplay: 3000,
    
        // 如果需要分页器
        //pagination: '.swiper-pagination',
    
        // 如果需要前进后退按钮
        //nextButton: '.focusImgs_next',
        //prevButton: '.focusImgs_prev',
    
        // 如果需要滚动条
        //scrollbar: '.swiper-scrollbar',
    })   

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});