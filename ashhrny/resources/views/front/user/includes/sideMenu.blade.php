

<div class="profile-sidebar  shadow-sm navbar-expand-lg ">
    <!-- SIDEBAR USERPIC -->

    <div class="profile-img">
        @if($user->image == null)
            <img data-src="{{ asset('/front/images/user.png') }}" alt="" class="img-fluid lazy">
        @else
            <img data-src="{{ asset($user->image) }}" alt="" class="img-fluid lazy">
        @endif
    </div>
<div class="text-center my-3">
         <a class="btn btn-yellow d-lg-none" data-toggle="collapse" href="#asideNav" role="button" aria-expanded="false" aria-controls="asideNav">
                        <i class="fa fa-hand-pointer-o" aria-hidden="true"></i>
القائمة الجانبية
                    </a>
</div>
    <!-- SIDEBAR MENU -->
<div id="asideNav" class="profile-usermenu collapse navbar-collapse">
        <ul class="nav">
            <li class="{{request()->is(LaravelLocalization::setLocale() . '/notify') ? 'active' : ''}}">
                <a href="{{ route('userNotify') }}">
                    {{ _i('My Notifications') }}
                    <span class="badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                </a>
            </li>
            <li class="{{request()->is(LaravelLocalization::setLocale() . '/profile') ? 'active' : ''}}">
                <a href="{{ route('userProfile') }}">
                    <i class="fa fa-sort-amount-desc"></i>
                    {{ _i('My Profile') }} </a>
            </li>
            @if($user->country_id != null && $user->mobile != null)
                @if(userSetting()->myAccounts_menu == 1 && userSetting()->myAccounts_menu != 0)
                    <li class="{{request()->is(LaravelLocalization::setLocale() . '/accounts') ? 'active' : ''}}">
                        <a href="{{ route('userAccounts') }}">
                            <i class="fa fa-map-pin"></i>
                            {{ _i('My Accounts') }}
                        </a>
                    </li>
                @endif
                    @if($user->user_type != 'famous')
                        @if(userSetting()->famous_ads_menu == 1 && userSetting()->famous_ads_menu != 0)
                            <li class="{{request()->is(LaravelLocalization::setLocale() . '/celebrityAds') ? 'active' : ''}}">
                                <a href="{{ route('celebrityAds') }}">
                                    <i class="fa fa-money"></i>
                                    {{ _i('Advertise with celebrities') }} </a>
                            </li>
                        @endif
                        @if(userSetting()->featuredAd_menu == 1 && userSetting()->featuredAd_menu != 0)
                            <li class="{{request()->is(LaravelLocalization::setLocale() . '/featuredAd') ? 'active' : ''}}">
                                <a href="{{ route('featuredAd') }}">
                                    <i class="fa fa-backward"></i>
                                    {{ _i('Featured ad') }} </a>
                            </li>
                        @endif
                    @else
                        @if(userSetting()->myAds_menu == 1 && userSetting()->myAds_menu != 0)
                            <li class="{{request()->is(LaravelLocalization::setLocale() . '/myAds') ? 'active' : ''}}">
                                <a href="{{ route('myAds') }}">
                                    <i class="fa fa-money"></i>
                                    {{ _i('My Ads') }} </a>
                            </li>
                        @endif
                    @endif
                    @if(userSetting()->AdInOurAccounts_menu == 1 && userSetting()->AdInOurAccounts_menu != 0)
                        <li class="{{request()->is(LaravelLocalization::setLocale() . '/adInOurAccounts') ? 'active' : ''}}">
                            <a href="{{ route('adInOurAccounts') }}">
                                <i class="fa fa-user"></i>
                                {{ _i('Advertise on our accounts') }}</a>
                        </li>
                    @endif
                    @if(userSetting()->myPoints_menu == 1 && userSetting()->myPoints_menu != 0)
                        <li class="{{request()->is(LaravelLocalization::setLocale() . '/myPoints') ? 'active' : ''}}">
                            <a href="{{ route('myPoints') }}">
                                <i class="fa fa-user"></i>
                                {{ _i('My Points') }}</a>
                        </li>
                    @endif
                    @if(userSetting()->ticketOpen_menu == 1 && userSetting()->ticketOpen_menu != 0)
                    <li>
                        <a href="{{ route('openTicket') }}">
                            <i class="fa fa-ticket"></i>
                            {{ _i('Open a ticket') }}</a>
                    </li>
                @endif
            @endif
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fa fa-sign-out"></i>
                    {{ _i('Logout') }}</a>
            </li>
        </ul>
    </div>
    <!-- END MENU -->
</div>

@push('js')


    <script>
        $(function() {
            $('#send_message').submit(function(e) {
                e.preventDefault();

                //var form = $( "#send_message" ).serialize();
                var form_data = $(this).serialize();
               // var message = $("#message").val();
               // var form = $( "form" ).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('send_message')}}",
                    method: "post",
                    data:form_data,
                    //dataType:"json",
                    //data: {message:message},

                    success:function (res) {
                        $('.modal.modal_contact').modal('hide');
                        $("#send_message").parsley().reset();
                        $('.message').val("");

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('success send')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                    }
                })
            });
        });
    </script>

@endpush

@push('css')

    <style>
        .badge {
            margin: 10px;
            padding: 5px 10px;
            border-radius: 50%;
            background: red;
            color: white;
        }
    </style>

@endpush
