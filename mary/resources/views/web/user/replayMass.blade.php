@extends('web.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{_i('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Replay massege')}}</li>
            </ol>
        </div>
    </nav>
<?php
    $user = \App\Models\User::where('id',$massege->from_id)->first();
    $countyname = \Illuminate\Support\Facades\DB::table('nationalies_data')
    ->where('id', $user->resident_country_id)
    ->value('county_name');
    $useractive = \Illuminate\Support\Facades\DB::table('user_activity')
        ->where('user_id',$user->id)
        ->first();
?>

    <div class="my-messages-page common-wrapper">
        <div class="container">
            <div class="message-sent-by-user">
                <div class="single-member-box wide-box">
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
                    <div class="single-member-info d-md-flex justify-content-md-between p-4">
                        <div class="personal-info">
                            <div class="name"><span>{{_i('name')}}</span><a href="{{route('user-details',$user->id)}}">{{$user->username}}</a></div>
                            <div class="age"><span>{{_i('age')}}</span>{{$user->age}}</div>
                            <div class="country"><span>{{_i('country')}}</span>
                                {{--                                 {{$nation}}<br>--}}
                                {{$countyname}}<br>
                                {{--                                <span>{{$cityname}}</span>--}}

                            </div>
                        </div>
                        <div class="account-info">
                            <div class="sent-time">{{_i('massege befor')}}.<strong>{{$massege->created_at->diffForHumans() }}</strong></div>
                            <div class="join-date">{{_i('dateOfRegister')}} : <strong>{{$user->created_at->diffForHumans()}}</strong></div>


                            <div class="online-status d-inline-block">
                                @if($useractive->status == 'online')
                                   <strong>{{_i('online')}}</strong>
                                    @else
                                    <strong>{{_i('offline')}}</strong>

                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php
            $masse = \App\Models\Message::where('id',$massege->id)
            ->orderBy('id','DESC')
                ->get();
            ?>
            @foreach($masse as $mass)


                    <div class="received-message-context notice-box bg-light-pink text-right">
                        <strong>{{$mass->user->username}} </strong>  :{{$mass->message}}
                    </div>
                    <br>
                <?php
                $replaymass = \App\Models\Message::
                where('massege_id',$mass->id)

                    ->orderBy('id','DESC')
                    ->get();
                ?>
                    @foreach($replaymass as $repl)

                        <div class="received-message-context notice-box bg-light text-left">
                            <strong>{{$repl->user->username}} </strong> :{{$repl->message}}
                        </div>
                        <br>
                    @endforeach

                @endforeach


            <div class="black-head-title text-center">{{_i('Do you want replay the massege')}}</div>
            <form action="{{route('replay-mass')}}" method="post" class="simple-theme">
                {{csrf_field()}}
                {{method_field('post')}}
                     <input type="hidden" name="mass_id" value="{{$massege->id}}">
                    <input type="hidden" name="to" value="{{$user->id}}">
                <textarea name="replay" id="" cols="30" rows="10" class="form-control" placeholder="{{_i('message Subject')}}"></textarea>
                <div class="justify-content-md-end d-flex my-2">
                    <input type="submit" class="btn btn-pink" value="{{_i('send')}}">
                </div>
            </form>
        </div>
    </div>

@endsection
