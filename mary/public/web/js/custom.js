(function ($) {


    //nice select
    $('.nice-select').niceSelect();


    // wow
    new WOW().init();
    // lazy init
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });


    // Go to top
    // Show or hide the sticky footer button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.go-top').fadeIn(200);
        } else {
            $('.go-top').fadeOut(200);
        }
    });

    // Animate the scroll to top
    $('.go-top').click(function (event) {
        event.preventDefault();

        $('html, body').animate({scrollTop: 0}, 300);
    });


    $('.six-members-carousel').owlCarousel({
        rtl: true,
        loop: false,
        margin: 20,
        nav: false,
        lazyLoad: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 4
            },

            900: {
                items: 4
            },
            1024: {
                items: 5,
                dots: false
            },
            1400: {
                items: 6
            },

        }
    });
    $('.successful-stories-carousel').owlCarousel({
        rtl: true,
        loop: false,
        margin: 20,
        nav: false,
        dots: true,
        lazyLoad: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },

            900: {
                items: 2
            },
            1024: {
                items: 3
            },
            1400: {
                items: 4
            },

        }
    });


})(jQuery);





