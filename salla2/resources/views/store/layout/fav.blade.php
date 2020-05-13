@push('js')
    <script>

        $(function () {

            $('body').on('click', '.add-to-fav', function () {

                var productId = $(this).data('id');
                var that = $(this);

                $.ajax({
                    url: "{{route('addfavorite' ,app()->getLocale())}}",
                    type: 'post',
                    dataType: 'json',
                    data: {productId: productId},
                    success: function (res) {
                        if (res === true) {
                            that.find('span').empty('');
                            that.find('span').text('Remove from favorites');
                            that.find('i').removeClass('fa-heart-o').addClass('fa-heart')

                        }
                        if (res === false) {
                            that.find('span').empty('');
                            that.find('span').text('add favorites');
                            that.find('i').removeClass('fa-heart').addClass('fa-heart-o')
                        }
                    }
                })
            });
        })
    </script>


@endpush
