(function ($) {

// wow
    new WOW().init();

    //lazyload
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


    // main top slider

    if ($(".top-slider").length) {
        $('.top-slider').slick({
            // autoplay: true,
            // autoplaySpeed: 2000,
            lazyLoad: 'ondemand',
            dots: false,
            rtl: true,
            nextArrow: '<button type="button" class="slick-next">التالي</button>',
            prevArrow: '<button type="button" class="slick-prev">السابق</button>',
            // centerPadding: '0',
            infinite: true,
            //  speed: 300,
            // centerMode: true,
            slidesToShow: 6,
            // slidesToScroll: 2
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 3,

                    }
                },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 490,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false,

                    }
                }

            ]
        });

    }
    if ($(".vip-member-slider").length) {
        $('.vip-member-slider').slick({
            dots: true,
            lazyLoad: 'ondemand',
            rtl: true,
            nextArrow: '<button type="button" class="slick-next">التالي</button>',
            prevArrow: '<button type="button" class="slick-prev">السابق</button>',
            slidesToShow: 5,
            slidesToScroll: 5,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 3,

                    }
                },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 490,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false,

                    }
                }

            ]
        });

    }
    if ($(".ads-slider").length) {
        $('.ads-slider').slick({
            dots: true,
            lazyLoad: 'ondemand',
            rtl: true,
            nextArrow: '<button type="button" class="slick-next">التالي</button>',
            prevArrow: '<button type="button" class="slick-prev">السابق</button>',
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [

                {
                    breakpoint: 490,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false,

                    }
                }

            ]
        });

    }
// Hide collaps on click
    jQuery('.pay-options .btn').click(function (e) {
        jQuery('.collapse').collapse('hide');
    });

    // counter
    if ($('.counter').length) {
        $(".counter").countimator();
    }
})(jQuery);





