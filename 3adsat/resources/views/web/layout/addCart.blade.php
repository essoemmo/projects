<script>
    $(function () {
        'use strict';
        $('a.addcart').click(function (e) {
            var product_id = $(this).children('.product_id').val();
            var max_count = $(this).children('.max_count').val();
            var product_type = $(this).children('.product_type').val();
            var rs = $('.rs').val();
            var ls = $('.ls').val();
            var rcyl = $('.rcyl').val();
            var lcyl = $('.lycl').val();
            var ra = $('.ra').val();
            var la = $('.la').val();
            var pd = $('.pd').val();
            var auto_reorder = $('.auto_reorder').val();
            var qty = $('.new_qty').val();
            var pack = $('.old_price').val();
            var price = $('#new_price').val();
            var glasses_lens = $('.glasses_lens').attr('id');
            var color = $('.color_select').next('input[type="radio"]:checked').val();
            $.ajax({
                url:'{{ url('/add-to-cart') }}',
                DataType:'json',
                type:'post',
                data: {product_id: product_id,qty: qty,product_type: product_type,rs: rs,ls: ls,rcyl: rcyl,lcyl: lcyl,ra: ra,la: la,pd: pd,auto_reorder: auto_reorder,price: price,color: color,pack: pack,glasses_lens: glasses_lens},
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
                        if(value.quantity > max_count) {
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('You have reached the order limit') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        } else {
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added to cart successfully') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                        var html = '<li class="clearfix">' +
                            '<img src="../images/products/'+value.attributes.image+'" alt="item1">' +
                            '<span class="item-name">'+value.name+'</span>' +
                            '<span class="item-price">' + value.price + '</span>' +
                            '<span class="item-quantity">{{ _i('quantity') }}: '+value.quantity+'</span>' +
                            '</li>';
                        $('.shopping-cart-items .simplebar-content').append(html);

                    });
                    $('.countItems').text(res[1]);
                    $('.cart-text').empty();
                    $('.total').css({'display':'inline-block'}).text(res[2]);
                    $('.shopping-cart .shopping-cart-items').next().css({'display':'block'});
                    $('.shopping-cart .shopping-cart-items').next().next().css({'display':'block'});

                }
            })
        });
    })
</script>
