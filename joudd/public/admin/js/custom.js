(function ($) {
    //Scrollbar
    const simpleBar = new SimpleBar(document.getElementById('scrl'));
    simpleBar.recalculate();

    //nice select
    $('select').niceSelect();

// Navbar Megamenu
    $('.droopmenu-navbar').droopmenu({
        dmArrow:false,
         dmToggleSpeed: 100,
        dmShowDelay: 50,dmHideDelay: 50,

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


    $('.sponsors-slider').owlCarousel({
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
// Input number spinner
    $(".spinner").inputSpinner();
    // Flexslider
     if (document.getElementById('carousel')) {


    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 120,
        itemMargin: 20,
        asNavFor: '#slider',
        rtl: true,
        touch: true,
        smoothHeight: true,
    });

    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        rtl: true,
        touch: true,
        smoothHeight: true,
    });
    }


})(jQuery);





