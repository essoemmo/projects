(function ($) {

//Counters
    $(".counter").countimator();

// Phone Input
   /* var input = document.querySelector("#phone-input");
    window.intlTelInput(input, {
        utilsScript: "js/utils.js?18",
        autoPlaceholder:'aggressive',
        initialCountry:"EG"
    });*/

    // wow
    new WOW().init();


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


    $(window).scroll(function () {
        if ($(window).width() > 768) {
            if ($(this).scrollTop() > 250) {
                $(".p-table-main").addClass("fixed");
            } else {
                $(".p-table-main").removeClass("fixed");
            }
        }
    });


    //Function to animate slider captions
    function doAnimations(elems) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd animationend';

        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }

    //Variables on page load
    var $myCarousel = $('#projectsSlider'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

    //Initialize carousel
    $myCarousel.carousel();

    //Animate captions in first slide on page load
    doAnimations($firstAnimatingElems);

    //Pause carousel
    //$myCarousel.carousel('pause');


    //Other slides to be animated on carousel slide event
    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

})(jQuery);





