
<div class="col-md-3">
    <div class="profile-sidebar border rounded shadow-sm">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic center">
            <img src="{{$user->image != null ? asset('uploads/users/'.$user->id.'/'.$user->image) : asset('masterAdmin/assets/images/user.png')}} "
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
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="{{request()->is('store/myofflineorders') ? 'active' : ''}}">
                    <a href="{{route('myofflineorders' ,app()->getLocale())}}">
                        <i class="fa fa-money"></i>
                        {{_i('Orders awaiting payment')}}
                    </a>
                </li>
                <li class="{{request()->is('store/myorders') ? 'active' : ''}}">
                    <a href="{{route('myorders' ,app()->getLocale())}}">
                        <i class="fa fa-shopping-cart signin-btn"></i>
                        {{_i('my orders')}}
                    </a>
                </li>
                <li class="{{request()->is('store/favorite') ? 'active' : ''}}">
                    <a href="{{route('favorite' ,app()->getLocale())}}">
                        <i class="fa fa-heart signin-btn"></i>
                        {{_i('Favourite')}}
                    </a>
                </li>
                <li class="{{request()->is('store/profile') ? 'active' : ''}}">
                    <a href="{{route('profile' ,app()->getLocale())}}">
                        <i class="fa fa-gear "></i>
                        {{_i('Account Settings')}} </a>
                </li>


            </ul>
        </div>
        <!-- END MENU -->
    </div>
</div>