@if($activeUser->count() > 0)

    <div class="row">

        @foreach($activeUser as $active)

            <?php

            $usernat = \App\Models\User::select(['id','username','nationalty_id','city_id','age','gender','photo','guard','resident_country_id'])
                ->where('id', '=', $active->user_id)
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

            $fav = \Illuminate\Support\Facades\DB::table('user_action')

                ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                ->Where('to_id',$usernat->id)
                ->first();
            ?>
            @if($usernat->guard != 'admin')

                <div class="col-lg-2 col-md-3 filter {{$usernat->gender == 'male' ? 'male' : 'female'}}">
                    <div class="single-member-box">
                        <div class="member-pic">
                            <a href="{{route('user-details',$usernat->id)}}">
                                @if(empty($usernat->phote) && $usernat->gender == 'female')
                                    <img src='{{asset("web/images/$usernat->gender-avatar.png")}}' data-src="{{asset("web/images/$usernat->gender-avatar.png")}}" alt=""
                                         class="img-fluid lazy rounded-circle loaded">

                                @elseif(empty($usernat->phote) && $usernat->gender == 'male')
                                    <img src="{{asset("web/images/$usernat->gender-avatar.png")}}" data-src="{{asset("web/images/$usernat->gender-avatar.png")}}" alt=""
                                         class="img-fluid lazy rounded-circle loaded">
                                @else
                                    <img src="{{asset('uploads/users/'.$usernat->phote)}}" data-src="{{asset('uploads/users/'.$usernat->phote)}}" alt=""
                                         class="img-fluid lazy rounded-circle loaded">
                                @endif
                            </a>
                        </div>
                        {{--                        @if($active->status == 'online')--}}
                        {{--                            <span>متواجد الان<i class="fa fa-heart"></i></span>--}}
                        {{--                        @endif--}}
                        <div class="single-member-info">
                            <div class="name"><span>{{_i('name')}}</span><a href="{{route('user-details',$usernat->id)}}">{{$usernat->username}}</a></div>
                            <div class="age"><span>{{_i('age')}}</span>{{$usernat->age}}</div>
                            <div class="country"><span>{{_i('country')}}</span>
                                {{--                                 {{$nation}}<br>--}}
                                {{$countyname}}<br>
                                {{--                                <span>{{$cityname}}</span>--}}

                            </div>
                            <ul class="list-inline single-member-options">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <li><a href="" id="comment" data-to="{{$usernat->id}}" data-fro="{{\Illuminate\Support\Facades\Auth::check() ? auth()->user()->id : ''}}" title="ارسل رسالة" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope-o"></i></a></li>
                                @else
                                    <li><a href="" id="comment" title="{{_i('login first')}}" ><i class="fa fa-envelope-o"></i></a></li>
                                @endif

                                @if(\Illuminate\Support\Facades\Auth::check())

                                    @if(!empty($fav) && $fav->action == 'like' && $fav->from_id == auth()->user()->id )
                                        <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$usernat->id}}" data-id="{{$usernat->id}}"  data-to="{{$usernat->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart"></i></a></li>
                                    @else
                                        <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$usernat->id}}" data-id="{{$usernat->id}}" data-to="{{$usernat->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a></li>
                                    @endif

                                @else
                                    @if(!empty($fav) && $fav->action == 'like')
                                        <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$usernat->id}}" data-id="{{$usernat->id}}"  data-to="{{$usernat->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart-o"></i></a></li>
                                    @else
                                        <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$usernat->id}}" data-id="{{$usernat->id}}" data-to="{{$usernat->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a></li>
                                    @endif

                                @endif

                                <li><a href="{{route('user-details',$usernat->id)}}" id="eye" data-id="{{$usernat->id}}" title="مشاهدة البروفايل"><i class="fa fa-eye"></i></a></li>
                            </ul>

                        </div>

                    </div>
                </div>
            @endif

        @endforeach
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

            {{$activeUser->appends(request()->query())->links()}}

        </ul>
    </nav>
@else
    <div class="alert alert-danger">
        <h4>{{_i('Sorry dont Found activeuser')}}</h4>
    </div>
@endif

