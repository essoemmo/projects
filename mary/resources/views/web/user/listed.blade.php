@extends('web.layout.index')
@section('content')

    @if($wishlistandBlocked->count() > 0)


        @foreach($wishlistandBlocked as $userlk)
         <?php

         $users = \App\Models\User::where('id',$userlk->to_id)->get();

         ?>
         @foreach($users as $user)


            <div class="card" style="padding: 10px; margin: 33px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="image">
                                @if(empty($user->user->image) &&!isset($user->user->image))
                                    <img src="{{asset('uploads/default.jpg')}}" style="width: 100px"><br>
                                @else
                                    <img src="{{asset('uploads/users/'.$user->image)}}" style="width: 100px"><br>

                                @endif


                                @if(date('d-m-Y', strtotime($user->created_at)) === date('d-m-Y'))
                                    <span class="date">قبل{{date('h:i', strtotime($user->created_at))}}ساعة</span>

                                @else
                                    <span class="date">{{\Carbon\Carbon::parse($user->created_at)->format('Y/ m/d')}}</span>

                                @endif


                            </div>
                        </div>
                        <?php

//                        $usernat = \App\Models\User::select(['nationalty_id'])->where('id', '=', $user->id)->first();

                        $usernat = \App\Models\User::select(['nationalty_id','city_id','age','photo'])->where('id', '=', $user->id)->first();
                        $nation = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('nationalty_id', $usernat->nationalty_id)
                            ->value('name');

                        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('nationalty_id', $usernat->nationalty_id)
                            ->value('county_name');

                        $cityname = \Illuminate\Support\Facades\DB::table('cities_data')
                            ->where('id', $usernat->city_id)
                            ->value('name');
                        $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
                            ->where('nationalty_id', $usernat->nationalty_id)
                            ->value('county_name');

                        ?>
                        <div class="col-md-3">
                            <a href="{{route('user-details',$user->id)}}">الاسم:{{$user->username}}</a><br>

                            العمر:{{$usernat->age}}<br>
                            من:  {{$nation}}<br>
                            مقيم:  {{$countyname}}<br>
                            <span>{{$cityname}}</span>
                        </div>

                        <div class="col-md-8">
                            {!! $user->content !!}
                        </div>
                    </div>
                </div>
            </div>

             @endforeach
        @endforeach
{{--        {{$userlike->appends(request()->query())->links()}}--}}

    @else

        <div class="alert alert-danger">
            <h4>{{_i('Sorry dont Found')}}</h4>
        </div>
    @endif



    @endsection