@php

    $currency = \App\Bll\Constants::defaultCurrency;

@endphp

<script>
    $(function () {
        var fields = $('.feature :input').change(calculate);

        function calculate() {
            var price = 0;
            var result = 0;
            var result_discount = 0;
            var product_price = parseInt($('#product_price').val());
            var product_price_discount = Number($('#product_price_discount').val());
            fields.each(function () {
                price += +$(this).children('option:selected').data('price');
            });
            result = price + product_price;
            if (!isNaN(product_price_discount)) {
                result_discount = price + product_price_discount;
            }
            $('#price').text(result + ' ' + '{{ $currency }}');
            if (!isNaN(product_price_discount)) {
                $('#price_discount').text(result_discount + ' ' + '{{ $currency }}');
                $('#new_price').val(result_discount);
            } else {
                $('#new_price').val(result);
            }
        }
    });

    $('select[name="feature_option[]"]').change(function (e) {
        var option_id = $(this).children("option:selected").val();
        var feature_id = $(this).children("option:selected").attr('id');
        $.ajax({
            url: "{{ route('checkFeaturesOption' ,app()->getLocale()) }}",
            type: 'get',
            dataType: 'json',
            data: {
                option_id: option_id,
                feature_id: feature_id
            },
            success: function (res) {
                if (res == false) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: "{{ _i('Out Of Stock For This Option') }}",
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            }
        })

    });
</script>
