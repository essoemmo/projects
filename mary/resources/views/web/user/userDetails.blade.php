@extends('web.layout.master')

@section('content')
    <?php
//    $usernat = \App\Models\User::select(['nationalty_id','city_id','age','photo'])->where('id', '=', $user->id)->first();
    $usernat = \App\Models\User::select(['id','username','nationalty_id','city_id','age','gender','photo','guard','resident_country_id'])
        ->where('id', '=', $user->id)
        ->first();
    $nation = \Illuminate\Support\Facades\DB::table('nationalies_data')
        ->where('nationalty_id', $usernat->nationalty_id)
        ->value('name');

    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
        ->where('id', $usernat->resident_country_id)
        ->value('county_name');

    $cityname = \Illuminate\Support\Facades\DB::table('cities_data')
        ->where('id', $usernat->city_id)
        ->value('name');

    $option = \App\Models\Option::get();

    $val = \Illuminate\Support\Facades\DB::table('user_options')
        ->where('user_id',$user->id)
        ->join('users','user_options.user_id','=','users.id')
        ->join('option_values','user_options.option_value_id','=','option_values.id')
        ->get();

    $status = \Illuminate\Support\Facades\DB::table('material_status')
        ->where('id',$user->material_status_id)->value('name');

    $fav = \Illuminate\Support\Facades\DB::table('user_action')
//                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
        ->orWhere('to_id',$user->id)
        ->first();

    ?>
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="#">الاعضاء</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$user->username}}</li>
            </ol>
        </div>
    </nav>

    <div class="single-user-profile-page common-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-1 order-md-0">
                    <div class="user-info">
                        <ul class="list-unstyled">
                            @if(date('d-m-Y', strtotime($user->created_at)) === date('d-m-Y'))

                                <p class="date">مسجل منذ{{date('h:i', strtotime($user->created_at))}}
                                    واحدث تواجد لة   {{\Carbon\Carbon::parse($user->useractiv[0]->created)->diffForHumans()}}

                                </p>

                            @else
                                <p class="date">مسجل منذ{{\Carbon\Carbon::parse($user->created_at)->format('Y/ m/d')}}

                                    واحدث تواجد لة   {{\Carbon\Carbon::parse($user->useractiv[0]->created)->diffForHumans()}}

                                </p>

                            @endif
                            <li><strong>{{_i('ID')}}</strong>{{$user->id}}</li>
                            <li><strong>{{_i('username')}}</strong>{{$user->username}}</li>
                            <li><strong>{{_i('nationalty')}}</strong> {{$nation}} </li>
                            <li><strong>{{_i('country')}}</strong> {{$countyname}} </li>
                            <li><strong>{{_i('city')}}</strong>{{$cityname}} </li>
                            <li><strong>{{_i('age')}}</strong> {{$user->age}}</li>
{{--                            <li><strong>الديانه</strong> مسلم</li>--}}
                            <li><strong>{{_i('state')}}</strong>{{$status}}</li>
                                @foreach($val as $va)
                                    <?php $option = \App\Models\Option::where('id',$va->option_id)->get() ?>
                                    @foreach($option as $op)
                                            <li><strong>{{$op->title}}</strong>{{$va->title}}</li>
                                    @endforeach
                                @endforeach

                                <li><strong>{{_i('About the partener')}}</strong>{!! $user->partener_info !!}</li>
                                <li><strong>{{_i('About me')}}</strong>{!! $user->about_me !!}</li>

                        </ul>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::check())

                        @if(request()->id == auth()->user()->id)

                        @else

                            @if(!empty($fav) && $fav->action == 'like')
                                <a href="javascript:void(0)" class="btn btn-orange add-to-fav" data-to="{{$user->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart"></i>اضف الى قائمة المعجب بهم</a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-orange add-to-fav" data-to="{{$user->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i>اضف الى قائمة غير معجب بهم</a>
                            @endif

                                <a href="" class="btn btn-pink" id="showmass"> {{$user->username}}ارسل رسالة للعضو</a>
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="block" data-to="{{$user->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"> اضف الى قائمة التجاهل الي {{$user->username}}</a>

                                <form action="{{route('send-messageUser')}}" method="post" style="display: none;margin-top: 27px;" id="mass">
                                    {{csrf_field()}}
                                    {{method_field('post')}}
                                    <input type="hidden" name="to" value="{{$user->id}}">
                                    <input type="hidden" name="from" value="{{auth()->user()->id}}">
                                    <div class="massege">
                                        <textarea class="form-control" name="messge"></textarea>
                                    </div>

                                    <input type="submit" class="btn btn-info btn-sm" value="send">
                                </form>
                            @endif

                        @else
                        <a href="javascript:void(0)" class="btn btn-orange add-to-fav" data-to="" data-from=""><i class="fa fa-heart-o"></i>اضف الى قائمة غير معجب بهم</a>
                        <a href="" class="btn btn-pink disabled"> {{$user->username}}ارسل رسالة للعضو</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" id="block" data-to="" data-from=""> اضف الى قائمة التجاهل الي {{$user->username}}</a>
                        <form action="{{route('send-messageUser')}}" method="post" style="margin-top: 27px;" id="mass">
                            {{csrf_field()}}
                            {{method_field('post')}}
                            <input type="hidden" name="to" value="">
                            <input type="hidden" name="from" value="">
                            <div class="massege">
                                <textarea class="form-control" name="messge" disabled></textarea>
                            </div>

                            <input type="submit" class="btn btn-info btn-sm" value="send" disabled>
                        </form>
                    @endif
                </div>

                <div class="col-md-4 order-0 order-md-1 mb-2">
                    <div class="user-profile">
                        @if(empty($user->phote) && $user->gender == 'female')
                            <img src="{{asset('uploads/default.jpg')}}" data-src="{{asset('uploads/default.jpg')}}" alt=""
                                 class="img-fluid lazy rounded-circle card-img img-thumbnail shadow">

                        @elseif(empty($user->phote) && $user->gender == 'male')
                            <img src="{{asset('uploads/images.jpg')}}" data-src="{{asset('uploads/images.jpg')}}" alt=""
                                 class="img-fluid lazy rounded-circle card-img img-thumbnail shadow">
                        @else
                            <img src="{{asset('uploads/users/'.$user->phote)}}" data-src="{{asset('uploads/users/'.$last->user->phote)}}" alt=""
                                 class="img-fluid lazy rounded-circle card-img img-thumbnail shadow">
                        @endif
{{--                        <img data-src="images/profile-pic.jpg" alt="" class="img-fluid lazy card-img img-thumbnail shadow">--}}
                    </div>
                </div>


            </div>
        </div>
    </div>
    <br>
    <br>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click','.add-to-fav',function (e) {
                e.preventDefault();


                var f = $(this).data('from');
                var t = $(this).data('to');

            if (f.length <= 0){
                new Noty({
                    type: 'warning',
                    layout: 'topRight',
                    text: "{{_i('You should login in the web to send the like')}}",
                    timeout: 2000,
                    killer: true
                }).show();

            }else{
                $.ajax({
                    url: '{{ route('add-heart') }}',
                    method: "post",
                    data: {_token: '{{ csrf_token() }}',
                        f:f,
                        t:t,


                    },
                    success: function (response) {
                        if (response === "true"){
                           $('.add-to-fav i').attr('class','fa fa-heart');
                        }else{
                            $('.add-to-fav i').attr('class','fa fa-heart-o');

                        }
                    }
                });
            }


            });


            $('body').on('click','#block',function (e) {
                e.preventDefault();

                var f = $(this).data('from');
                var t = $(this).data('to');

                if (f.length <= 0){
                    new Noty({
                        type: 'warning',
                        layout: 'topRight',
                        text: "{{_i('You should login in the web to send the blocked')}}",
                        timeout: 2000,
                        killer: true
                    }).show();

                }else{
                    $.ajax({
                        url: '{{ route('add-block') }}',
                        method: "post",
                        data: {_token: '{{ csrf_token() }}',
                            f:f,
                            t:t,

                        },
                        success: function (response) {
                            if (response === "true"){
                                $('.add-to-fav i').attr('class','fa fa-heart-o');
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "{{_i('Done the user is blocked')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }else{
                                new Noty({
                                    type: 'warning',
                                    layout: 'topRight',
                                    text: "{{_i('Done the user is disliked')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
                        }
                    });
                }
            })

            $('body').on('click','#showmass',function (e) {
                e.preventDefault();

                $('#mass').fadeToggle(500);
            })
        })
    </script>
    @endpush