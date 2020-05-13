
<div class="col-md-3">
    <div class="profile-sidebar border rounded shadow-sm">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic center">
            <img src="{{$user->image != null ? asset('uploads/profiles/'.$user->id.'/'.$user->image) : asset('web/images/user-avatar.png')}} "
                 class="img-fluid" alt="">
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{$user->name .' '. $user->last_name}}
            </div>
            <div class="profile-usertitle-job">
                {{_i('Normal Member')}}
            </div>
        </div>
        <!-- END SIDEBAR USER TITLE -->

        <!-- SIDEBAR BUTTONS -->
    {{--                        <div class="profile-userbuttons">--}}
    {{--                            <button type="button" class="btn btn-red ">ترقية العضوية</button>--}}
    {{--                        </div>--}}
    <!-- END SIDEBAR BUTTONS -->

        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="{{request()->is('myorders') ? 'active' : ''}}">
                    <a href="{{route('myorders')}}">
                        <i class="fa fa-home"></i>
                        {{_i('Home')}}
                    </a>
                </li>
                <li class="{{request()->is('profile') ? 'active' : ''}}">
                    <a href="{{route('profile')}}">
                        <i class="fa fa-user"></i>
                        {{_i('Account Settings')}} </a>
                </li>


            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>