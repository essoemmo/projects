<script>
    $(function () {
        'use strict';
        $("a.updatecart").on('change', function () {
            var qty = $(this).children('.qty').val();
            var rowId = $(this).children('.qty').attr('id');
            var max_count = $(this).children('.max_count').val();
            if(qty === max_count) {
                new Noty({
                    type: 'warning',
                    layout: 'topRight',
                    text: "{{ _i('You have reached the order limit') }}",
                    timeout: 3000,
                    killer: true
                }).show();
            }
            if(qty < max_count) {
                $.ajax({
                    url: '{{ route('updateCart') }}',
                    method: 'POST',
                    type: 'post',
                    DataType: 'json',
                    data: {_token: '{{ csrf_token() }}',qty: qty, rowId: rowId},
                    success: function (res) {
                        $.each(res[0], function (index, value) {
                            var price = parseInt(value.price) * '{{ getRate(country_code())->rate }}';
                            var subtotal = price * parseInt(value.quantity);
                            $('#subTotal_' + value['id']).text($.number(subtotal) + ' ' + '{{ currency()->code }}');

                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('Added Successfully !') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        });
                        $('#total').text('Total ' + total + ' ' + '{{ currency()->code }}');
                    }
                })
            }
            if(qty > max_count) {
                $.ajax({
                    url: '{{ route('updateCart') }}',
                    method: 'POST',
                    type: 'post',
                    DataType: 'json',
                    data: {_token: '{{ csrf_token() }}',qty: qty, rowId: rowId},
                    success: function (res) {
                        $.each(res[0], function (index, value) {
                            var price = parseInt(value.price) * '{{ getRate(country_code())->rate }}';
                            var subtotal = price * parseInt(value.quantity);
                            $('#subTotal_' + value['id']).text($.number(subtotal) + ' ' + '{{ currency()->code }}');

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added Successfully !') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        });
                        var total = parseInt(res[1]) * '{{ getRate(country_code())->rate }}';
                        $('#total').text('Total ' + $.number(total) + ' ' + '{{ currency()->code }}');
                    }
                })
            }
        })
    });
</script>
