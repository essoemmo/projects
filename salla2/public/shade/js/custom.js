(function ($) {

    if ($('#qty_input').length) {

        $('#qty_input').prop('disabled', true);
        $('#plus-btn').click(function () {
            $('#qty_input').val(parseInt($('#qty_input').val()) + 1);
        });
        $('#minus-btn').click(function () {
            $('#qty_input').val(parseInt($('#qty_input').val()) - 1);
            if ($('#qty_input').val() == 0) {
                $('#qty_input').val(1);
            }

        });
    }

    // Phone Input
    if ($("#phone-input").length) {
    var input = document.querySelector("#phone-input");
    window.intlTelInput(input, {
        utilsScript: "js/utils.js?18",
        autoPlaceholder:'aggressive',
        initialCountry:"EG"
    });
    }

})(jQuery);







