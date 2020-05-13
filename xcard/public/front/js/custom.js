(function ($) {
    //Scrollbar
    new SimpleBar(document.getElementById('scrl'));
    // input number incrementing

    if ( $( ".spinner" ).length ) {

        $(".spinner").inputSpinner();

    }
// wow
    new WOW().init();

    //lazyload
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });

// Hide collaps on click
    jQuery('.pay-options .btn').click( function(e) {
        jQuery('.collapse').collapse('hide');
    });

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
    if ( $( "#customize" ).length ) {
        var slider = tns({
            container: '#customize',
            items: 1,
            controlsContainer: '#customize-controls',
            navContainer: '#customize-thumbnails',
            navAsThumbnails: true,
            autoplay: true,
            arrowKeys: true,
            mouseDrag: true,
            autoplayButtonOutput:false

        });
        var small_slider = tns({
            loop: false,
            container: '#customize-thumbnails',
            items: 5,
            // fixedWidth:170,
            mouseDrag: true,
            nav: false,
            controls: false,
            gutter:0,
            //axis: "vertical"
        });
        let _prev = document.querySelector("[data-controls='prev']"),
            _next = document.querySelector("[data-controls='next']");

        _prev.addEventListener( 'click', () => {
            small_slider.goTo('prev');
        } );
        _next.addEventListener( 'click', () => {
            small_slider.goTo('next');
        } );

    }






})(jQuery);





