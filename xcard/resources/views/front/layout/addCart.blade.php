car<script>
    $(function () {
        'use strict';
        $('a.addcart').click(function (e) {
            var product_id = $(this).children('.product_id').val();
            var max_count = $(this).children('.max_count').val();

            $.ajax({
                url:'{{ route('addCart') }}',
                method:'POST',
                DataType:'json',
                type:'post',
                data: {_token: '{{ csrf_token() }}',product_id: product_id},
                success:function (res) {
                    if(res == 'false') {
                        new Noty({
                            type: 'warning',
                            layout: 'topRight',
                            text: "{{ _i('You have reached the order limit') }}",
                            timeout: 3000,
                            killer: true
                        }).show();
                    }
                    $('.shopping-cart-items .simplebar-content').empty();
                    $.each(res[0],function (index,value) {
                        var subTotal = parseInt(value.price) * '{{ getRate(country_code())->rate }}';
                        var price = $.number(subTotal) + ' ' + '{{ currency()->code }}';
                        if(value.quantity >= max_count) {
                            value.quantity = max_count;
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('You have reached the order limit') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        } else {
                            value.quantity = value.quantity;
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('Added to cart successfully') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                        var html = '<li class="clearfix">' +
                            '<img src="'+value.attributes.image+'" alt="item1">' +
                            '<span class="item-name">'+value.name+'</span>' +
                            '<span class="item-price">' + price + '</span>' +
                            '<span class="item-quantity">{{ _i('quantity') }}: '+value.quantity+'</span>' +
                            '</li>';
                        $('.shopping-cart-items .simplebar-content').append(html);

                    });
                    $('#cart .badge').css('display', 'block').text(res[1]);
                    $('.total').css({'display':'inline-block'}).text(res[2]);
                    $('.shopping-cart .shopping-cart-items').next().css({'display':'block'});
                    $('.shopping-cart .shopping-cart-items').next().next().css({'display':'block'});

                }
            })
        });
    })
</script>
