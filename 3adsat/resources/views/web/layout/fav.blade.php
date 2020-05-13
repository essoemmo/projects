@push('js')

    <script>
        $(function () {
            'use strict';
            $('.product-fav').click(function () {
                var productId = $(this).data('id');
                // var catId = $('.cat').data('id');
                // console.log(catId);
                console.log($('meta[name="csrf-token"]').attr('content'));
                var that = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{url('/addToFavorite')}}',
                    type:'post',
                    dataType:'json',
                    data:{productId: productId},
                    success:function (res) {
                        if (res === true){
                            that.find('i').removeClass('fa-heart-o').addClass('fa-heart')
                        }
                        if (res === false){
                            that.find('i').removeClass('fa-heart').addClass('fa-heart-o')
                        }
                    }
                })
            });
        })
    </script>



    <script>
        $(function () {
            'use strict';
            $('.cat-course').click(function () {
                var catId = $(this).data('id');
                console.log($('meta[name="csrf-token"]').attr('content'));
                var that = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{url('/addToFavorite')}}',
                    type:'post',
                    dataType:'json',
                    data:{catId: catId},
                    success:function (res) {
                        if (res === true){
                            that.find('i').removeClass('fa-heart-o').addClass('fa-heart')
                        }
                        if (res === false){
                            that.find('i').removeClass('fa-heart').addClass('fa-heart-o')
                        }
                    }
                })
            });
        })
    </script>

    <script>
        $(function () {
            'use strict';
            $('.article-fav').click(function () {
                var articleId = $(this).data('id');
                console.log($('meta[name="csrf-token"]').attr('content'));
                var that = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{url('/addToFavorite')}}',
                    type:'post',
                    dataType:'json',
                    data:{articleId: articleId},
                    success:function (res) {
                        if (res === true){
                            that.find('i').removeClass('fa-heart-o').addClass('fa-heart')
                        }
                        if (res === false){
                            that.find('i').removeClass('fa-heart').addClass('fa-heart-o')
                        }
                    }
                })
            });
        })
    </script>

    <script>
        $(function () {
            'use strict';
            $('.articleCat-fav').click(function () {
                var articleCatId = $(this).data('id');
                console.log($('meta[name="csrf-token"]').attr('content'));
                var that = $(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{url('/addToFavorite')}}',
                    type:'post',
                    dataType:'json',
                    data:{articleCatId: articleCatId},
                    success:function (res) {
                        if (res === true){
                            that.find('i').removeClass('fa-heart-o').addClass('fa-heart')
                        }
                        if (res === false){
                            that.find('i').removeClass('fa-heart').addClass('fa-heart-o')
                        }
                    }
                })
            });
        })
    </script>



@endpush