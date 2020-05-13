<div class="row">
@if($search->count() > 0)
    @foreach($search as $sear)
        <div class="col-lg-2 col-md-3 ">
            <div class="single-member-box">
                <div class="member-pic">
                    <a href="{{route('user-details',$sear->id)}}">
                        @if(empty($sear->phote) && $sear->gender == 'female')
                            <img src='{{asset("web/images/$sear->gender-avatar.png")}}' data-src="{{asset("web/images/$sear->gender-avatar.png")}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">

                        @elseif(empty($sear->phote) && $sear->gender == 'male')
                            <img src="{{asset("web/images/$sear->gender-avatar.png")}}" data-src="{{asset("web/images/$sear->gender-avatar.png")}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        @else
                            <img src="{{asset('uploads/users/'.$sear->phote)}}" data-src="{{asset('uploads/users/'.$sear->phote)}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        @endif
                    </a>                        </div>
                <div class="single-member-info">
                    <div class="name"><span>{{_i('name')}}</span><a href="{{route('user-details',$sear->id)}}">{{$sear->username}}</a></div>
                    <div class="age"><span>{{_i('age')}}</span>{{$sear->age}}</div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $sear->id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');
                    $fav = \Illuminate\Support\Facades\DB::table('user_action')
                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                        ->Where('to_id',$sear->id)
                        ->first();
//                    dd($fav);

                    ?>
                    <div class="country"><span>{{_i('country')}}</span>
                        {{--                                 {{$nation}}<br>--}}
                        {{$countyname}}<br>
                        {{--                                <span>{{$cityname}}</span>--}}

                    </div>
                    <ul class="list-inline single-member-options">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li><a href="" id="comment" data-to="{{$sear->id}}" data-fro="{{\Illuminate\Support\Facades\Auth::check() ? auth()->user()->id : ''}}" title="ارسل رسالة" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope-o"></i></a></li>
                        @else
                            <li><a href="" id="comment" title="{{_i('login first')}}" ><i class="fa fa-envelope-o"></i></a></li>
                        @endif

                        @if(\Illuminate\Support\Facades\Auth::check())

                            @if(!empty($fav) && $fav->action == 'like' && $fav->from_id == auth()->user()->id )
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$sear->id}}" data-id="{{$sear->id}}"  data-to="{{$sear->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart"></i></a></li>
                            @else
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$sear->id}}" data-id="{{$sear->id}}" data-to="{{$sear->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a></li>
                            @endif

                        @else
                            @if(!empty($fav) && $fav->action == 'like')
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$sear->id}}" data-id="{{$sear->id}}"  data-to="{{$sear->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart-o"></i></a></li>
                            @else
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$sear->id}}" data-id="{{$sear->id}}" data-to="{{$sear->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a></li>
                            @endif

                        @endif

                        <li><a href="{{route('user-details',$sear->id)}}" id="eye" data-id="{{$sear->id}}" title="مشاهدة البروفايل"><i class="fa fa-eye"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    @endforeach
</div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                {{$search->appends(request()->query())->links()}}

            </ul>
        </nav>

@else
    <div class="alert alert-danger">
        <h4>{{_i('Sorry dont Found search')}}</h4>
    </div>
    @endif

