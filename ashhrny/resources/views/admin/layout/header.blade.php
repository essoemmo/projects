<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <form action="{{ route('adminSendMessage') }}" method="POST">
        @csrf
        {{method_field('post')}}

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" id="to_id" name="to_id" value="">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">{{ _i('Replay To This Message') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" name="message_id" value="" id="message_id">
                <div class="modal-body mx-3">

                    <div class="md-form">
                        <textarea type="text" id="show_message" class="md-textarea form-control" rows="4"></textarea>
                        <label data-error="wrong" data-success="right" for="form8">
                            {{ _i('Your Message') }}
                            <i class="fa fa-pencil prefix grey-text"></i>
                        </label>
                        <textarea type="text" id="form8" name="message" class="md-textarea form-control" rows="4"
                                  required></textarea>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-unique">{{ _i('Send') }} <i
                            class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<nav class="navbar header-navbar pcoded-header" header-theme="theme4">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="{{ route('home') }}">
                @if(setting() != null)
                    <img class="img-fluid img-responsive" style="width: 130px;height: 32px" src="{{ setting()->logo }}"
                         alt="Theme-Logo"/>
                @else
                    <img class="img-fluid img-responsive" style="width: 130px;height: 32px"
                         src="{{asset('adminPanel/assets/images/logo.png')}}" alt="Theme-Logo"/>
                @endif
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <div>
                <ul class="nav-left">
                    <li>
                        <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                    </li>
                    <!----
                    <li>
                        <a class="main-search morphsearch-search" href="#">
                             <i class="ti-search"></i>
                        </a>
                    </li>
                    ---->
                    <li>
                        <a href="#!" onclick="javascript:toggleFullScreen()">
                            <i class="ti-fullscreen"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="header-notification lng-dropdown">
                        <a href="#" id="dropdown-active-item">
                            <i class="ti-world"></i> {{_i('Language')}}
                        </a>
                        <ul class="show-notification">
                            {{--                            @foreach($languages = \App\Models\SiteLanguage::all() as $lang)--}}
                            {{--                            <li>--}}
                            {{--                                <a href="{{url('/admin/lang/'.$lang['locale'])}}" data-lng="en">--}}
                            {{--                                    <i class="flag-icon flag-icon-gb m-r-5"></i> {{$lang['title']}}--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            {{--                            @endforeach--}}

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>

                    {{--                    <!------------------ messages notification ----------------------->--}}
                    {{--                    @php--}}
                    {{--                    $messages = \App\Models\Message::where('to_id' ,admin()->user()->id)->where('read_at' , null)->get();--}}
                    {{--                    @endphp--}}
                    {{--                    <li class="header-notification">--}}
                    {{--                        <a href="#!">--}}
                    {{--                            <i class="ti-bell"></i>--}}
                    {{--                            <span class="badge">{{$messages->count()}}</span>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="show-notification">--}}
                    {{--                            <li>--}}
                    {{--                                <h6>{{_i('Messages')}}</h6>--}}
                    {{--                                <label class="label label-danger">{{_i('New')}}</label>--}}
                    {{--                            </li>--}}
                    {{--                            @foreach($messages as $message)--}}
                    {{--                            <li>--}}
                    {{--                                <div class="media">--}}
                    {{--                                    <img class="d-flex align-self-center" src="{{asset('adminPanel/assets/images/user.png')}}" alt="Generic placeholder image">--}}
                    {{--                                    <div class="media-body">--}}
                    {{--                                        @php--}}
                    {{--                                        $user = \App\User::findOrFail($message['from_id']);--}}
                    {{--                                        @endphp--}}
                    {{--                                        <a href="" data-toggle="modal" data-target="#modalContactForm" class="get_id">--}}
                    {{--                                            <input type="hidden" name="id_message" id="id_message" value="{{$message['id']}}">--}}
                    {{--                                            <h5 class="notification-user">{{$user['first_name']." ".$user['last_name'] }}</h5>--}}
                    {{--                                            <p class="notification-msg show_message" >--}}
                    {{--                                                {{str_limit($message['message'] , 45)}}--}}
                    {{--                                            </p>--}}
                    {{--                                        </a>--}}
                    {{--                                        <span class="notification-time">{{$message['created_at']}}</span>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </li>--}}
                    {{--                            @endforeach--}}

                    {{--                        </ul>--}}
                    {{--                    </li>--}}
                    {{--                    <!------------------ end messages notification ----------------------->--}}

                    <li class="user-profile header-notification">
                        <a href="#!">
                            <img src="{{asset('adminPanel/assets/images/user.png')}}" alt="User-Profile-Image">
                            <span>{{ admin()->user()->first_name }} {{ admin()->user()->last_name }}</span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="{{aUrl('setting')}}">
                                    <i class="ti-settings"></i> {{ _i('Settings') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{url('admin/profile')}}">
                                    <i class="ti-user"></i> {{ _i('Profile') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ aUrl('logout') }}">
                                    <i class="ti-layout-sidebar-left"></i>
                                    {{ _i('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- search -->
                <div id="morphsearch" class="morphsearch">
                    <form class="morphsearch-form">
                        <input class="morphsearch-input" type="search" placeholder="Search..."/>
                        <button class="morphsearch-submit" type="submit">Search</button>
                    </form>

                    <!-- /morphsearch-content -->
                    <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                </div>
                <!-- search end -->
            </div>
        </div>
    </div>
</nav>

@push('js')

    <script> // for messages

        $(function () {
            $(document).on('click', '.get_id', function (e) {
                var id_message = $(e.currentTarget).children('#id_message').val();
                //console.log(id_message);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url('/admin/read_message/')}}/' + id_message,
                    type: 'get',
                    data: {id_message: id_message},
                    success: function (res) {
                        $("#show_message").val(res.message);
                        $('#to_id').val(res.from_id); // admin send to user that sen message
                    }
                })
            });
        })

    </script>

@endpush
