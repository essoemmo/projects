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
                    url: '{{ url('/update-cart') }}',
                    type: 'post',
                    DataType: 'json',
                    data: {qty: qty, rowId: rowId},
                    success: function (res) {
                        $.each(res[0], function (index, value) {
                            var subtotal = parseInt(value.price) * parseInt(value.quantity);
                            $('#quantity_' + value['id']).next().text(subtotal);

                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('You have reached the order limit') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        });
                        $('#total').text('Total ' + res[1]);
                    }
                })
            }
            if(qty > max_count) {
                $.ajax({
                    url: '{{ url('/update-cart') }}',
                    type: 'post',
                    DataType: 'json',
                    data: {qty: qty, rowId: rowId},
                    success: function (res) {
                        $.each(res[0], function (index, value) {
                            var subtotal = parseInt(value.price) * parseInt(value.quantity);
                            $('#quantity_' + value['id']).next().text(subtotal);

                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('updated successfully') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        });
                        $('#total').text('Total ' + res[1]);
                    }
                })
            }
        })
    });
</script>
