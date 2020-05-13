@if($latestmember->count() > 0)

    <div class="row">
        <?php $i = 0; ?>
        @foreach($latestmember as $last)


                <div class="col-lg-2 col-md-3 filter {{$last->gender == 'male' ? 'male' : 'female'}}">
            <div class="single-member-box">
                <div class="member-pic">
                    <a href="{{route('user-details',$last->id)}}">
                        @if(empty($last->phote) && $last->gender == 'female')
                            <img src='{{asset("web/images/$last->gender-avatar.png")}}' data-src="{{asset("web/images/$last->gender-avatar.png")}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">

                        @elseif(empty($last->phote) && $last->gender == 'male')
                            <img src="{{asset("web/images/$last->gender-avatar.png")}}" data-src="{{asset("web/images/$last->gender-avatar.png")}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        @else
                            <img src="{{asset('uploads/users/'.$last->phote)}}" data-src="{{asset('uploads/users/'.$last->phote)}}" alt=""
                                 class="img-fluid lazy rounded-circle loaded">
                        @endif
                    </a>
                </div>
                <div class="single-member-info">
                    <div class="name"><span>{{_i('name')}}</span><a href="{{route('user-details',$last->id)}}">{{$last->username}}</a></div>
                    <div class="age"><span>{{_i('age')}}</span>{{$last->age}}</div>
                    <?php
                    $usernat = \App\Models\User::select(['nationalty_id','resident_country_id'])->where('id', '=', $last->id)->first();
                    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                        ->where('id', $usernat->resident_country_id)
                        ->value('county_name');
                    $fav = \Illuminate\Support\Facades\DB::table('user_action')
                        ->where('from_id',\Illuminate\Support\Facades\Auth::id())
                        ->Where('to_id',$last->id)
                        ->first();
                    ?>

                    <div class="country"><span>{{_i('country')}}</span>{{$countyname}} </div>
                    <ul class="list-inline single-member-options">
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="" id="comment" data-to="{{$last->id}}" data-fro="{{\Illuminate\Support\Facades\Auth::check() ? auth()->user()->id : ''}}" title="ارسل رسالة" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-envelope-o"></i></a></li>
                        @else
                            <li><a href="" id="comment" title="{{_i('login first')}}" ><i class="fa fa-envelope-o"></i></a></li>
                        @endif

                        @if(\Illuminate\Support\Facades\Auth::check())

                            @if(!empty($fav) && $fav->action == 'like' && $fav->from_id == auth()->user()->id )
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$last->id}}" data-id="{{$last->id}}"  data-to="{{$last->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart"></i></a></li>
                            @else
                                <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$last->id}}" data-id="{{$last->id}}" data-to="{{$last->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a></li>
                            @endif

                            @else
                                @if(!empty($fav) && $fav->action == 'like')
                                    <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$last->id}}" data-id="{{$last->id}}"  data-to="{{$last->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}" title="اضافه لقائمة الاهتمام"><i class="fa fa-heart-o"></i></a></li>
                                @else
                                    <li><a href="javascript:void(0)"  class="add-to-fav" id="{{'like-'.$last->id}}" data-id="{{$last->id}}" data-to="{{$last->id}}" data-from="{{\Illuminate\Support\Facades\Auth::id() ? \Illuminate\Support\Facades\Auth::id() : ''}}"><i class="fa fa-heart-o"></i></a></li>
                                @endif

                            @endif

                        <li><a href="{{route('user-details',$last->id)}}" id="eye" data-id="{{$last->id}}" title="مشاهدة البروفايل"><i class="fa fa-eye"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
                <?php $i++; ?>
        @endforeach
    </div>


<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

        {{$latestmember->appends(request()->query())->links()}}

       </ul>
</nav>

@else
<div class="alert alert-danger">
    <p>{{_i('Sorry not found!!!')}}</p>
</div>
@endif