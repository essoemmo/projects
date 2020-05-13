@php
    $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
@endphp
<script>
    $(function () {
        'use strict';
        $('.color').click(function () {
            window.color = $(this).data('id');
        });
        @if ($storeOptions != null)
        @if ($storeOptions->order_accept == 1)
        $('a.addcart').click(function (e) {
            var product_id = $(this).children('.product_id').val();
            var price = $(this).find('#new_price').val();
            var qty = $('.qty').val();
            var formData = {};
            $('select[name="feature_option[]"]').each(function () {
                var feature_id = $(this).children("option:selected").attr('id');
                if (feature_id != undefined) {
                    var option_id = $(this).children("option:selected").val();
                    formData[feature_id] = option_id;
                } else {
                    formData[null] = null;
                }
            });
            var StoreId = {{ request()->id }}
            $.ajax({
                url: "{{route('store_add_cart' ,app()->getLocale())}}",
                DataType: 'json',
                type: 'post',
                data: {product_id: product_id, color: window.color, qty: qty, formData: formData, price: price},
                success: function (res) {
                    // console.log(res);
                    if (res[0] == false) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: res[1],
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                    $('.shopping-cart-items .simplebar-content').empty();
                    $.each(res[0], function (index, value) {
                        var html = '<li class="clearfix">' +
                            '<img src="' + value.options.image + '" alt="item1">' +
                            '<span class="item-name">' + value.name + '</span>' +
                            '<span class="item-name" style="    background: ' + value.options.color + '' +
                            '    display: inline-block;\n' +
                            '    width: 20px;\n' +
                            '    height: 20px;\n' +
                            '    border-radius: 50%;\n' +
                            '    margin-left: 10px;"></span>' +
                            '<div class="d-flex justify-content-between">' +
                            '<span class="item-price">' + value.price + ' ' + value.options.currency + '</span>' +
                            '<span class="item-quantity">{{ _i('Quantity') }}: ' + value.qty + '</span>' +
                            '</div>' +
                            '</li>';
                        $('.shopping-cart-items .simplebar-content').append(html);
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "{{ _i('Item Added Successfully') }}",
                            showConfirmButton: false,
                            timer: 2000
                        })
                    });
                    $('#cart .badge').text(res[1]);
                    $('.total').css({'display': 'inline-block'}).text(res[2]);
                    $('.shopping-cart .shopping-cart-items').next().css({'display': 'block'});
                    $('.shopping-cart .shopping-cart-items').next().next().css({'display': 'block'});

                }
            });
        });
        @else
        $('a.addcart').click(function (e) {
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: '{{ _i('Orders Not Available At this Moment') }}',
                showConfirmButton: false,
                timer: 2000
            });
        });
        @endif
        @endif

    });


</script>

