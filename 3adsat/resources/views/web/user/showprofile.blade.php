
<div class="col-md-3">
    <div class="profile-sidebar border rounded shadow-sm" style=" padding: 10px;">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic center">
            <img alt="{{_("user image")}}" src="{{$user->image != null ? asset('uploads/profiles/'.$user->id.'/'.$user->image) : asset('front/images/user-avatar.png')}}"
                 class="img-fluid" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{$user->first_name .' '. $user->last_name}}
            </div>

        </div>
        <!-- END SIDEBAR USER TITLE -->

        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active">
                    <a href="{{url('user_order')}}">
                        <i class="fa fa-home"></i>
                        {{_i('Orders')}} </a>
                </li>

            <!--                <li class="{{request()->is('courses') ? 'active' : ''}}">
                    <a href="{{url('/courses')}}">
                        <i class="fa fa-graduation-cap"></i>
                        {{_i('My Course')}}
                </a>
            </li>-->

                <li class="{{request()->is('profile') ? 'active' : ''}}">
                    <a href="{{route('profile')}}">
                        <i class="fa fa-user"></i>
                        {{_i('Account Settings')}} </a>
                </li>

                {{--                                <li>--}}
                {{--                                    <a href="#" target="_blank">--}}
                {{--                                        <i class="fa fa-paperclip"></i>--}}
                {{--                                        التقارير </a>--}}
                {{--                                </li>--}}


            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>
