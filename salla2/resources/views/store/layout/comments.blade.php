
<section class="review-section common-wrapper">
    <div class="container">
        <div class="section-title">{{_i('comments')}}</div>
        @if($auth_user_comment)
            <div class="current-review">
                {{_i('you now rate this product ')}} <strong><a href="">{{auth()->user()->name}}</a></strong>
            </div>
           
        
            <div class="card">
                <div class="card-body">
                    <p>{{ auth()->user()->name }}</p>
                    {{--<div class="star-ratings-css" style="margin: 0;display: inline-flex">
                                <div class="star-ratings-css-top" style="width: {{$userRating->rating * 20}}%;display:
                    inline-flex"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
            </div>--}}
                    <p>{{$auth_user_comment->comment}}</p>
                </div>
            </div>
          
            @unless($auth_user_comment->published == 1)<span class="color:red">{{_i('Your comment is under review')}}</span>@endunless
        @else
            <span class="no-comment" class="color:red">{{_i('there is no comments yet')}}</span>
        @endif
        {{--@endforeach--}}

        {{-- @else --}}
        {{--  <span class="color:red">{{_i('there is no comments yet')}}</span> --}}
        {{-- @endif --}}




        {{--@if(!existRate(auth()->guard('web')->id(),$product->id) && auth()->check())--}}
        {{--<div class="rating mb-3">

                    @if(!Rate(auth()->id(),$product->id))
                    <form class="rat">
                    <input id="rating5" type="radio" name="rating" value="5">
                    <label for="rating5">5</label>
                    <input id="rating4" type="radio" name="rating" value="4">
                    <label for="rating4">4</label>
                    <input id="rating3" type="radio" name="rating" value="3">
                    <label for="rating3">3</label>
                    <input id="rating2" type="radio" name="rating" value="2" checked>
                    <label for="rating2">2</label>
                    <input id="rating1" type="radio" name="rating" value="1">
                    <label for="rating1">1</label>
                </form>
                    @endif
                </div>--}}

        @if((auth()->user() && !$auth_user_comment) || (!auth()->user()))
            <div class="form-group comment-form">
                @csrf
                <div class="form-row">
                    {{-- Form::open(['class'=>'form-group','route'=>'sendcomment']) --}}
                    <input type="hidden" id="store_id" value="{{\App\Bll\Utility::getStoreId()}}">
                    <input type="hidden" id="products_id" value="{{$product->id}}">

                    <div class="col-md-12">
                        <input type="text" id="comment" class="form-control"
                               placeholder="{{_i('Your Comment here...')}}">
                    </div>
                    <br>
                    {{--@if( \App\Models\rating\userRating::where('user_id',auth()->guard('web')->id())->first()['rating'] != null)
                                    <button class="btn btn-blue send" type="submit">ارسال</button>
                                @else--}}
                    <button class="btn btn-blue send" onclick="sendComment();return false;">{{_i('Send')}}</button>
                    {{--@endif--}}
                </div>
            </div>
        @endif
        <div class="your-review-sync"></div>

        <div class="synccomment" style="margin: 0 10px;padding: 20px 5px;"></div>
        <div class="container">
            {{-- //@dd($product->comments); --}}
            @foreach ($product->comments as $comment)
            @unless($comment->published == 0)
            

                <div class="comment" style="margin: 0 10px;padding: 20px 5px;border-bottom: 1px solid #f1f1f1;"
                     id="r_764558">
                    <div class="comment-header">
                        <img
                                src="https://salla.sa/themes/default/assets/images/avatar_male.png?v=40decd9ee7b47573f0e8b776bc1869b2fa4a05f6"
                                width="50" height="50" alt="">
                        <span class="comment-name">{{ $comment->user->name ?? _i('Visitor')  }}</span>
                        <span class="comment-time" style="float:left">@php \Carbon\Carbon::setLocale('ar'); @endphp
                            {{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="comment-body mr-5">
                        {{ $comment->comment }}
                    </div>
                    @unless($comment->published == 1)<span class="pending-comment" style="color:red;">*
                {{_i('Awaiting store management approval')}}</span>@endunless
                    @unless($comment->reply == null)
                        <div class="reply" style="margin-right:55px">
                            <div class="comment-header">
                                <img
                                        src="https://salla.sa/themes/default/assets/images/avatar_male.png?v=40decd9ee7b47573f0e8b776bc1869b2fa4a05f6"
                                        width="50" height="50" alt="">
                                <span class="comment-name">{{  _i('Site Administration')  }}</span>
                                <span class="comment-time"
                                      style="float:left">@php \Carbon\Carbon::setLocale('ar'); @endphp
                                    {{ $comment->reply->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="comment-body mr-5">
                                {{ $comment->reply->comment }}
                            </div>
                        </div>
                    @endunless
                </div>
                @endunless
                @endforeach
                
        </div>

        {{--@endif--}}
    </div>
</section>

@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>

        window.AuthUser = '{!! auth()->user() !!}'
        window.__auth = function () {
            try {
                return JSON.parse(AuthUser)
            } catch (error) {
                return null
            }
        }

        function sendComment(e) {

            let comment = {
                store_id: $('#store_id').val(),
                products_id: $('#products_id').val(),
                comment: $('#comment').val()
            }


            axios.post('../../sendComment', comment)
                .then((response) => {

                    $('#comment').val("");

                    if (AuthUser) {
                        $('.comment-form').empty();
                        $('.no-comment').empty();
                        $('.your-review-sync').prepend('<span class="color:red">{{_i('Your comment is under review')}}</span>');
                        $('.your-review-sync').prepend('<div class="current-review">{{_i('you now rate this product ')}}<strong><a href="">' + __auth.name + '</a></strong></div><div class="card"><div class="card-body"><p>' + __auth.name + '</p><p>' + response.data.comment + '</p></div></div>');
                    } else {
                        $('.synccomment').css('margin', '0 30px');
                        $('.synccomment').css('border-bottom', '1px solid #f1f1f1');
                        $('.synccomment').append('<div class="comment-header"><img src="https://salla.sa/themes/default/assets/images/avatar_male.png?v=40decd9ee7b47573f0e8b776bc1869b2fa4a05f6" width="50" height="50" alt=""><span class="comment-name">{{_i('Visitor')}}</span><span class="comment-time" style="float:left">{{_i('Now')}}</span></div>');
                        $('.synccomment').append('<div class="comment-body mr-5">' + response.data.comment + '</div>');
                        $('.synccomment').append('<span class="pending-comment" style="color:red;" >* {{_i('Awaiting store management approval')}}</span>')

                    }
                })
                .catch((error) => {
                    console.log(error)
                })
        }



        $(function () {
            'use strict';
            $('input[name="stars"]').click(function () {
                var stars = $(this).val();
                var product = '{{$product->id}}';
                var user = '{{auth()->guard('web')->id()}}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url(app()->getLocale().'/store/rating')}}",
                    type: 'post',
                    dataType: 'json',
                    data: {stars: stars, product: product, user: user},
                    success: function (res) {
                        var html = '<div class="star-ratings-css" style="margin: 0 0 30px;display:inline-flex">\n' +
                            '<div class="star-ratings-css-top" style="width: ' + res.rating * 20 + '%;display:inline-flex"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>\n' +
                            '<div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>\n' +
                            '<br><br></div>';
                        $('#rating').empty();
                        $('#rating').append(html);
                        $('.send').attr('type', 'submit');
                    }
                })
            })
        });
    </script>

@endpush
