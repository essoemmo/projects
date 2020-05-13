(function ($) {

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();


    //Scrollbar
    const simpleBar = new SimpleBar(document.getElementById('scrl'));
    simpleBar.recalculate();

    //nice select
    $('.nice-select').niceSelect();

// Navbar Megamenu
    $('.droopmenu-navbar').droopmenu({
        dmArrow: false,
        dmToggleSpeed: 100,
        dmAnimDelay: 10,
        dmShowDelay: 50,
        dmHideDelay: 50,
        dmToggleSpeed: 100,
        dmAnimationEffect: 'dmslidedown'

    });
    // wow
    new WOW().init();
    // lazy init
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });

    //shopping cart
    $(document).click(function () {
        var $item = $(".shopping-cart");
        if ($item.hasClass("active")) {
            $item.removeClass("active");
        }
    });

    $('.shopping-cart').each(function () {
        var delay = $(this).index() * 50 + 'ms';
        $(this).css({
            '-webkit-transition-delay': delay,
            '-moz-transition-delay': delay,
            '-o-transition-delay': delay,
            'transition-delay': delay
        });
    });
    $('#cart').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".shopping-cart").toggleClass("active");
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

    //Function to animate slider captions
    function doAnimations(elems) {
        //Cache the animationend event in a variable
        var animEndEv = "webkitAnimationEnd animationend";

        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data("animation");
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }

    //Variables on page load
    var $myCarousel = $("#carouselExampleFade"),
        $firstAnimatingElems = $myCarousel
            .find(".carousel-item:first")
            .find("[data-animation ^= 'animated']");

    //Initialize carousel
    $myCarousel.carousel();

    //Animate captions in first slide on page load
    doAnimations($firstAnimatingElems);

    //Other slides to be animated on carousel slide event
    $myCarousel.on("slide.bs.carousel", function (e) {
        var $animatingElems = $(e.relatedTarget).find(
            "[data-animation ^= 'animated']"
        );
        doAnimations($animatingElems);
    });

    $('.categories-carousel.owl-carousel').owlCarousel({
        rtl: true,
        loop: false,
        margin: 20,
        nav: false,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplaySpeed: 3000,
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
                items: 5
            },
            1400: {
                items: 6
            },

        }
    });
    $('.products-carousel.owl-carousel').owlCarousel({
        rtl: true,
        loop: false,
        margin: 20,
        nav: true,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplaySpeed: 3000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },

            900: {
                items: 2,

            },
            1024: {
                items: 3,

            },
            1400: {
                items: 3,

            },

        }
    });

// Product Slider
    if ($('#vertical').length) {
        $('#vertical').lightSlider({
            gallery: true,
            item: 1,
            vertical: true,
            verticalHeight: 295,
            vThumbWidth: 70,
            thumbItem: 5,
            thumbMargin: 4,
            slideMargin: 0,
            responsive: [

                {
                    breakpoint: 480,
                    settings: {
                        verticalHeight: 250,
                        thumbItem: 4,
                    }
                }
            ]
        });
    }


})(jQuery);





