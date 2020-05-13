@push('js')
    <script>
        $(function () {
            'use strict';
            $('.add-to-fav').click(function () {
                var courseId = $(this).data('id');
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
                    data:{courseId: courseId},
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
            $('.media-course').click(function () {
                var mediaId = $(this).data('id');
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
                    data:{mediaId: mediaId},
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