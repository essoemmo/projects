<div class="row">

            @if($stories->count() > 0)
                @foreach($stories as $story)
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','gender','resident_country_id'])->where('id', '=', $story->user_id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');


                    ?>

            <div class="col-md-6">
                <div class="single-member-box wide-box">
                    <div class="member-pic">
                <a href="{{route('user-details',$story->user->id)}}">
                        @if(empty($story->user->phote) && $story->user->gender == 'female')
                            <img src="{{asset("web/images/$usernat->gender-avatar.png")}}" data-src="{{asset("web/images/$usernat->gender-avatar.png")}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">

                        @elseif(empty($story->user->phote) && $story->user->gender == 'male')
                            <img src="{{asset("web/images/$usernat->gender-avatar.png")}}" data-src="{{asset("web/images/$usernat->gender-avatar.png")}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        @else
                            <img src="{{asset('uploads/users/'.$story->user->phote)}}" data-src="{{asset('uploads/users/'.$online->user->phote)}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        @endif
                </a>
{{--                        @if(empty($story->user->image) &&!isset($story->user->image))--}}
{{--                            <img src="{{asset('uploads/default.jpg')}}" data-src="{{asset('uploads/default.jpg')}}" class="img-fluid lazy loaded" ><br>--}}
{{--                        @else--}}
{{--                            <img src="{{asset('uploads/users/'.$story->image)}}" data-src="{{asset('uploads/users/'.$story->image)}}" class="img-fluid lazy loaded"><br>--}}
{{--                        @endif--}}
                    </div>

                    <div class="single-member-info">
                        <div class="name"><span>{{_i('name')}}</span>{{$story->user->username}}</div>
                        <div class="age"><span>{{_i('age')}}</span>{{$story->user->age}}</div>
                        <div class="country"><span>{{_i('country')}}</span>{{$countyname}} </div>

                        <div class="member-story">
                            {!! $story->content !!}
                        </div>
                    </div>

                </div>
            </div>
                @endforeach
                {{$stories->appends(request()->query())->links()}}
            @else

                <div class="alert alert-danger">
                    <h4>{{_i('Sorry dont Found Story')}}</h4>
                </div>
            @endif


        </div>


{{--        <div class="text-center">--}}
{{--            <a href="" class="btn btn-pink">اعرض المزيد</a>--}}
{{--        </div>--}}

{{----}}