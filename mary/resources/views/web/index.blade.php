@extends('web.layout.master')
@section('content')
    <div class="slider ">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @if(\App\Models\Slider::where('lang_id',session('language'))->get()->count() > 0 )
                    @foreach(\App\Models\Slider::where('lang_id',session('language'))->get() as $index => $slider)
                        <li data-target="#carouselExampleFade" data-slide-to="{{$index}}" class="{{$index == 0 ? 'active' : ''}}"></li>
                    @endforeach
                @endif
            </ol>
            <div class="carousel-inner">
                @if(\App\Models\Slider::where('lang_id',session('language'))->get()->count() > 0 )

                    @foreach(\App\Models\Slider::where('lang_id',session('language'))->get() as $index => $slider)

                        <div class="carousel-item {{$index == 0 ? 'active' : ''}}">
                            <img src="{{asset('web/images/slider-img.png')}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption">
                                <h2 class="main-title animated fadeInDown">{{$slider->title}}</h2>
                                <p class="animated fadeInDown">{{$slider->desc}}</p>
                                <a href="{{url('login')}}" class="btn btn-grad animated fadeInDown">{{_i('Subscribe')}}</a>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>

    </div>

    <section class="search-for-match pink-bg pink-shape common-wrapper text-center">

{{--@dd( \App\Models\Setting::where('source_id',null)->first())--}}
            <div class="container">
                <div class="section-title">{{settings()->TitleTopSearch}}</div>
                <div class="section-description">
                    {!!settings()->descriptionOnSearch!!}
                </div>

                <form class="form-inline" action="{{route('search')}}" method="get">
                    @csrf
                    <label class="my-1 mr-2">{{_i('search to')}}</label>
                    <select class="nice-select my-1 mr-sm-2 stat" name="gendar">
                        <option value="">{{_i('Chooose')}}...</option>
                        <option value="male">{{_i('Husband')}}</option>
                        <option value="female">{{_i('wife')}}</option>
                    </select>

                    <label class="my-1 mr-2">{{_i('nationalty')}}</label>
                    <select name="nationalty" class="form-control nationalty">
                        <option value="">{{_i('all_Nationalty')}}</option>
                        @foreach($national as $natio)
                            <option value="{{$natio->nationalty_id}}">{{$natio->name}}</option>
                        @endforeach
                    </select>

                    <label>{{_i('country')}}</label>
                    <select name="country" class="form-control country">
                        <option value="">{{_i('all Country')}}</option>

                        @foreach($national as $natio)
                            <option value="{{$natio->id}}">{{$natio->county_name}}</option>
                        @endforeach

                    </select>


                    <label>{{_i('From')}} </label>
                    <select name="from" class="form-control">
                        <option value="">{{_i('DontCare')}}</option>
                        @for($i=18 ; $i<= 90 ;$i++)
                            <option>{{$i}}</option>
                        @endfor
                    </select>
                    <label>{{_i('to')}} </label>
                    <select name="to" class="form-control">
                        <option value="">{{_i('DontCare')}}</option>
                        @for($i=18 ; $i<= 90 ;$i++)
                            <option>{{$i}}</option>
                        @endfor
                    </select>

                    <label>{{_i('status')}} </label>
                    <select name="status" class="form-control status">
                        <option value="">{{_i('status')}}</option>
                    </select>

                    <label>{{_i('order result')}}</label>
                    <select name="order" class="form-control">
                        <option value="lastlogin desc">{{_i('lastlogin desc')}}</option>
                        <option value="postdate desc">{{_i('postdate desc')}}ا</option>
                        <option value="age">{{_i('age')}}</option>
                        <option value="country">{{_i('country')}}</option>
                    </select>

                    <a href="{{route('advanced-search')}}" class="btn btn-grad my-1"><i class="fa fa-search"></i>{{_i('Advanced Search')}}</a>
                    <button type="submit" class="btn btn-grad my-1">{{_i('search')}}</button>
                </form>
            </div>
    </section>

    <section class="active-members common-wrapper text-center extra-pb">
        <div class="container">
            <div class="section-title">{{_i('Active Members')}}</div>
            <div class="section-description">{!! settings()->descrptionactivemember !!}</div>


            <div class="six-members-carousel owl-carousel owl-theme">
                @if($activemember->count() > 0)
                @foreach($activemember as $active)
                    <?php
                        $user = \App\Models\User::where('id',$active->user_id)->first();

                    ?>
                <div class="single-member">

                    <div class="member-pic">
                        <a href="{{route('user-details',$user->id)}}">
                            @if(empty($user->phote) && $user->gender == 'female')
                                <img src='{{asset("web/images/$user->gender-avatar.png")}}' data-src="{{asset("web/images/$user->gender-avatar.png")}}" alt=""
                                     class="img-fluid lazy rounded-circle loaded">

                            @elseif(empty($user->phote) && $user->gender == 'male')
                                <img src="{{asset("web/images/$user->gender-avatar.png")}}" data-src="{{asset("web/images/$user->gender-avatar.png")}}" alt=""
                                     class="img-fluid lazy rounded-circle loaded">
                            @else
                                <img src="{{asset('uploads/users/'.$user->phote)}}" data-src="{{asset('uploads/users/'.$user->phote)}}" alt=""
                                     class="img-fluid lazy rounded-circle loaded">
                            @endif
                        </a>
                    </div>

{{--                    <div class="member-pic">--}}
{{--                        <a href="" ><img data-src="{{asset('web/images/user-pic.jpg')}}" alt=""--}}
{{--                                         class="img-fluid owl-lazy rounded-circle"></a>--}}
{{--                    </div>--}}
                    <div class="name"><span>{{_i('name')}}:</span><a href="{{route('user-details',$user->id)}}">{{$user->username}}</a></div>
                    <div class="age"><span>{{_i('age')}}</span>{{$user->age}}</div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $user->id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');
                    ?>
                    <div class="country">{{$countyname}}</div>
                </div>
                  @endforeach
                    @endif
            </div>
        </div>
    </section>

    <section class="active-members white-bg-hearts white-shape common-wrapper text-center">
        <div class="container">
{{--            <div class="section-title">{{settings()->Titleactivemember2}}</div>--}}
            <div class="section-title">{{_i('BestMember')}}</div>
            <div class="section-description">{!! settings()->descrptionactivemember2 !!}</div>

            <div class="row">
            @if($bestmember->count() > 0)
                @foreach($bestmember as $best)
                    <?php
                    $userbest = \App\Models\User::where('id',$best->user_id)->first();
                    ?>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="single-member">
                        <div class="member-pic">
                            <a href="{{route('user-details',$userbest->id)}}">
                                @if(empty($userbest->phote) && $userbest->gender == 'female')
                                    <img src='{{asset("web/images/$userbest->gender-avatar.png")}}' data-src="{{asset("web/images/$userbest->gender-avatar.png")}}" alt=""
                                         class="img-fluid lazy rounded-circle loaded">

                                @elseif(empty($userbest->phote) && $userbest->gender == 'male')
                                    <img src="{{asset("web/images/$userbest->gender-avatar.png")}}" data-src="{{asset("web/images/$userbest->gender-avatar.png")}}" alt=""
                                         class="img-fluid lazy rounded-circle loaded">
                                @else
                                    <img src="{{asset('uploads/users/'.$userbest->phote)}}" data-src="{{asset('uploads/users/'.$userbest->phote)}}" alt=""
                                         class="img-fluid lazy rounded-circle loaded">
                                @endif
                            </a>
                        </div>
{{--                        <div class="member-pic">--}}
{{--                            <a href="" ><img data-src="{{asset('web/images/user-pic.jpg')}}" alt=""--}}
{{--                                             class="img-fluid lazy rounded-circle"></a>--}}
{{--                        </div>--}}
                        <div class="name"><span>{{_i('name')}}:</span><a href="{{route('user-details',$userbest->id)}}">{{$userbest->username}}</a></div>
                        <div class="age"><span>{{_i('age')}}</span>{{$userbest->age}}</div>
                        <?php
                        $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $userbest->id)->first();
                        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('id', $usernat->resident_country_id)
                            ->value('county_name');
                        ?>
                        <div class="country">{{$countyname}}</div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>


        </div>
    </section>

    <section class="successful-stories common-wrapper">
        <div class="container">
            <div class="section-title">{{_i('successful Story')}}</div>


            <div class="successful-stories-carousel owl-carousel owl-theme">
                @if($stories->count() > 0)
                    @foreach($stories as $story)


                <div class="single-story">
                    <div class="member-pic"><a href="" >
                            @if(empty($story->user->image) &&!isset($story->user->image))
                            <img data-src="{{asset('uploads/default.jpg')}}" alt="" class="img-fluid owl-lazy">
                            @else
                                <img data-src="{{asset('uploads/users/'.$story->image)}}" alt="" class="img-fluid owl-lazy">
                            @endif

                        </a>
                    </div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id'])->where('id', '=', $story->user_id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('nationalty_id', $usernat->nationalty_id)
                        ->value('county_name');

                    ?>

                    <p class="story">{!! $story->content !!}
                    </p>
                    <div class="name">{{$story->user->username}}</div>
                </div>
                    @endforeach
                @endif



            </div>
        </div>
    </section>

        @if(\Illuminate\Support\Facades\Auth::check())
            <section class="active-members white-bg-hearts white-shape common-wrapper text-center">
                <div class="container">
                    {{--            <div class="section-title">{{settings()->Titleactivemember2}}</div>--}}
                    <div class="section-title">{{_i('Favoutite member')}}</div>
                    <div class="section-description"></div>

                    <li class="row">
                        <?php
                        $fav=\Illuminate\Support\Facades\DB::table('user_favourite_options')
                            ->where('user_id',auth()->user()->id)->pluck('option_value_id')->toArray();
                        ?>

                            <?php
                        $search = \Illuminate\Support\Facades\DB::table('user_options')
                                    ->whereIn('option_value_id',$fav)
                                    ->where('user_id','!=',auth()->user()->id)
                                     ->select(['user_options.user_id'])
                                    ->groupBy('user_id')
                                    ->get();

                                ?>
                                @foreach($search as  $best)
                                    <?php
                                    $userbest = \App\Models\User::where('id',$best->user_id)->first()?>


                                            <div class="col-lg-2 col-md-4 col-6">
                                                <div class="single-member">
                                                    <div class="member-pic">
                                                        <a href="{{route('user-details',$userbest->id)}}">
                                                            @if(empty($userbest->phote) && $userbest->gender == 'female')
                                                                <img src='{{asset("web/images/$userbest->gender-avatar.png")}}' data-src="{{asset("web/images/$userbest->gender-avatar.png")}}" alt=""
                                                                     class="img-fluid lazy rounded-circle loaded">

                                                            @elseif(empty($userbest->phote) && $userbest->gender == 'male')
                                                                <img src="{{asset("web/images/$userbest->gender-avatar.png")}}" data-src="{{asset("web/images/$userbest->gender-avatar.png")}}" alt=""
                                                                     class="img-fluid lazy rounded-circle loaded">
                                                            @else
                                                                <img src="{{asset('uploads/users/'.$userbest->phote)}}" data-src="{{asset('uploads/users/'.$userbest->phote)}}" alt=""
                                                                     class="img-fluid lazy rounded-circle loaded">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    {{--                                                                                                    <div class="member-pic">--}}
                                                    {{--                                                                                                        <a href="" ><img data-src="{{asset('web/images/user-pic.jpg')}}" alt=""--}}
                                                    {{--                                                                                                                         class="img-fluid lazy rounded-circle"></a>--}}
                                                    {{--                                                                                                    </div>--}}
                                                    <div class="name"><span>{{_i('name')}}:</span><a href="{{route('user-details',$userbest->id)}}">{{$userbest->username}}</a></div>
                                                    <div class="age"><span>{{_i('age')}}</span>{{$userbest->age}}</div>
                                                    <?php
                                                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $userbest->id)->first();
                                                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                                                        ->where('id', $usernat->resident_country_id)
                                                        ->value('county_name');
                                                    ?>
                                                    <div class="country">{{$countyname}}</div>
                                                </div>
                                            </div>

              
                    @endforeach



                </div>
            </section>

        @endif


@endsection
@push('js')
    <script>
        $(document).ready(function () {

            $('body').on('change','.stat',function () {

                var val = $(this).val();
                $.ajax({
                    url: '{{ route('statue-user') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: {val: val},
                    success: function (response) {
                        // $('.gender').addClass('checked');

                        $('.status').empty();
                        for (var i = 0; i <= response.data.length; i++){
                            $('.status').append('<option value="' + response.data[i].id + '">' + response.data[i].name + '</option>');

                        }
                    }

                });
            })

            // $('.stat').trigger('click');


        });
    </script>

@endpush