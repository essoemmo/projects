@push('css')
    <style>
        .center {
            text-align: center !important;
            margin: auto !important;
        }

        .user-page .profile-userpic img {
            float: none;
            margin: 0 auto;
            width: 50%;
            height: 50%;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .user-page .profile-usertitle {
            text-align: center;
            margin-top: 20px;
        }

        .user-page .profile-usertitle-name {
            color: #5a7391;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 7px;
        }
        .nav {
            display: flex;
            flex-wrap: wrap;
            padding-right: 0;
            margin-bottom: 0;
            list-style: none;
            margin-right:10px;
        }

        .nav ul {
            padding: 0;
            margin: 0;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;


        }

        .user-page .profile-usermenu ul li.active {
            border-bottom: none;
        }

        .user-page .profile-usermenu ul li {
            border-bottom: 1px solid #f0f4f7;
            width: 100%;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        .user .agent .stylesheet. li {
            display: list-item;
            text-align: -webkit-match-parent;
            box-sizing: border-box;
        }
        .nav li a{
            color: #39B9D5;
            text-decoration: none;
        }
        .nav li{
            padding : 5px;
        }



    </style>

@endpush

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
                    <a href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                        {{_i('Home')}} </a>
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