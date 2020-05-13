@push('css')

    <link href="{{asset('custom/parsley.css')}}" rel="stylesheet">

@endpush

<header>
    <div class="top-header">

        <div class="container">

            <div class="row">
                <div class="col-md-4 align-self-center">
                    <div class="logo">
                        <a href="{{url('/')}}"><img @if(!empty(setting())) data-src="{{ asset('uploads/settings/site_settings/' . setting()->logo) }}" @else data-src="front/images/logo.png" @endif alt="" class="img-fluid lazy"></a>
                    </div>
                </div>
                <div class="col-md-8 align-self-center">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}">{{ _i('Home') }} <span class="sr-only">(current)</span></a>
                                </li>

                                <!--<li class="nav-item">
                                    <a class="nav-link" href="{{ url('about') }}">من نحن</a>
                                </li>-->

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ _i('News') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        @if(\App\Models\Article\Artcl_category::where('published' , 1)->where('lang_id', getLang(session('lang')))->get()->count() > 0 )
                                        @foreach(\App\Models\Article\Artcl_category::where('published' , 1)->where('lang_id', getLang(session('lang')))->limit(6)->get() as $art_cat)
                                            <a class="dropdown-item" href="{{ url('article_cat/'.$art_cat->id) }}">{{ $art_cat->title }}</a>
                                        @endforeach
                                            <a class="dropdown-item" href="{{ url('article_categories') }}">{{ _i('All Categories') }}</a>
                                        @else
                                            <a class="dropdown-item" href="#">{{ _i('No Articles') }}</a>
                                        @endif

                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ _i('Courses') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @if(count($categories_nav = \App\Hr\Course\Co_category::where('lang_id' , getLang(session('lang')))->where("parent_id",null)->limit(6)->get() ) > 0 )
                                            @foreach($categories_nav as $category)
                                                <a class="dropdown-item" href="{{$category->parent_id == null ? url('category/parent', $category->id): url('category', $category->id) }}">{{ $category->cat_name }}</a>
                                            @endforeach
                                                <a class="dropdown-item" href="{{ url('categories') }}">{{ _i('All Categories') }}</a>
                                        @else
                                            <a class="dropdown-item" href="#">{{ _i('No Data') }}</a>
                                        @endif

                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('competitions') }}"> {{_i('Competitions')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('contact') }}"> {{_i('Contact Us')}}</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav mr-auto">
                                @if(auth()->check())
                                    @if(auth()->user()->type == 'admin')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('user/login') }}">{{ _i('Login') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('choose') }}">{{ _i('Register') }}</a>
                                        </li>
                                    @else
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                                <i class="fa fa-comments"></i>
                                                <span class="badge badge-danger navbar-badge"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left" id="messages">

                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url("profile")}}"><i class="fa fa-user"></i></a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="usernavdropdown" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="usernavdropdown">
                                                @if(auth()->id() != null)
                                                    @if(auth()->user()->type == 'applicant')
                                                        <a class="dropdown-item" href="{{ url('user/courseRequest') }}">{{ _i('Course Requests') }}</a>
                                                        <a class="dropdown-item" href="{{ url('user/myBills') }}">{{ _i('my bills') }}</a>
                                                        <a class="dropdown-item" href="{{ url('user/my_courses') }}">{{ _i('My Courses') }}</a>
                                                        <a class="dropdown-item" href="{{ url('favorite') }}">{{ _i('My Favourites') }}</a>
                                                        <a class="dropdown-item" href="{{ url('profile') }}">{{ _i(' Profile') }}</a>

                                                    @elseif(auth()->user()->type == 'trainer')

                                                        <a class="dropdown-item" href="{{ url('user/myBills') }}">{{ _i('my bills') }}</a>
                                                        <a class="dropdown-item" href="{{url('/user/course/create')}}">{{ _i('New Course') }}</a>
                                                        <a class="dropdown-item" href="{{url('/user/created')}}">{{ _i('My Courses') }}</a>
                                                        <a class="dropdown-item" href="{{url('/user/pending')}}">{{ _i('My Pending Courses') }}</a>
                                                        <a class="dropdown-item" href="{{url('/user/course_exam/all')}}">{{ _i('All Exams') }}</a>
                                                        <a class="dropdown-item" href="{{ url('profile') }}">{{ _i(' Profile') }}</a>
                                                    @endif
                                                @endif
                                                <a class="dropdown-item" href="{{ url('user/logout') }}">{{ _i('logout') }}</a>
                                            </div>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('user/login') }}">{{ _i('Login') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('choose') }}">{{ _i('Register') }}</a>
                                    </li>
                                @endif
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#"  role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-language"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="usernavdropdown">
                                            @foreach(\App\Models\Language::all() as $language)
                                                <a class="dropdown-item" href="{{url('/lang')}}/{{Config::get('laravel-gettext.supported-locales')[$language->id - 1]}}">  {{_i($language->title)}}</a>
{{--                                                <a class="dropdown-item" href="{{url('/lang')}}/{{Config::get('laravel-gettext.supported-locales')[1]}}">  {{_i('Arabic')}}</a>--}}
{{--                                                <a class="dropdown-item" href="{{url('/lang')}}/{{Config::get('laravel-gettext.supported-locales')[0]}}">  {{_i('English')}}</a>--}}
                                            @endforeach
                                        </div>
                                    </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                        <i class="fa fa-globe"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                                        <li class="nav-item">
                                            <ul class="list-unstyled" id="countries">

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

        </div>

    </div>
</header>

<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <form action="{{ url('/user/send_message') }}" method="POST" data-parsley-validate>
        @csrf
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
                        <label data-error="wrong" data-success="right" for="form8">
                            {{ _i('Your Message') }}
                            <i class="fa fa-pencil prefix grey-text"></i>
                        </label>
                        <textarea type="text" id="form8" name="message" class="md-textarea form-control" rows="4" required  data-parsley-minlength="5" data-parsley-maxlength="500" data-parsley-minlength-message="Come on! You need to enter at least a 5 character comment.." data-parsley-validation-threshold="10"></textarea>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-unique">{{ _i('Send') }} <i class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('js')
    <script>
        $(function(){
            $.ajax({
                url:"{{route('web.countries')}}",
                success:(res)=>{
                    if(res == null) return false;
                    $('#countries').html('');
                    res.forEach(country => {
                        $('#countries').append(`<li><form action="{{url('change_countries')}}" method="get">
                    <input type="hidden" name="setCountries" value="${country.id}"/>
                    <button type="submit" style="background-color: transparent !important" class="btn btn-block">${country['title']}</button></form></li>`);
                    });
                },
                error:(err)=>{
                    console.log(err);
                }
            });
        });
    </script>


    <script>
        $(function(){
            $.ajax({
                url:"{{ url('user/allMessages') }}",
                success:(res)=>{
                    // console.log(res);
                    if(res == null) return false;
                    $('#messages').html('');
                    $('.badge').text(res[1]);
                    if(res[0] == null) return false;
                    res[0].forEach(message => {
                        if(message.image == null) {
                            message.image = "<?= asset('front/images/user-avatar.png')?>";
                        }
                        else
                        {
                               message.image = '{{asset("uploads/applicants/")}}/${message.from_id}/'+message.image;
                        }
                        if(message.message_id == null) {
                            $('#message_id').val(message.id);
                        } else {
                            $('#message_id').val(message.message_id);
                        }
                        $('#to_id').val(message.from_id);
                        $('#messages').append(`
                            <a href="" class="dropdown-item get_id" data-toggle="modal" data-target="#modalContactForm">
                                <input type="hidden" name="id_message" id="id_message" value="${message.id}">
                                <div class="media">

                                   <img src="${message.image}" width="50px" height="50px"  class="img-fluid rounded-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            ${message.first_name} ${message.last_name}
    <!--                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>-->
                                        </h3>
                                        <p class="text-sm">${message.message}</p>
    <!--                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i></p>-->
                                        <div class="dropdown-divider"></div>
    {{--                                   <a href="{{ url('/user/userMessages', auth()->id()) }}" class="dropdown-item dropdown-footer">{{ _i('See All Messages') }}</a>--}}
                                    </div>
                                </div>
                            </a>
                    `);
                    });
                },
                error:(err)=>{
                    console.log(err);
                }
            });
        });

        $(function () {
            $(document).on('click', '.get_id',function (e) {
                var id_message = $(e.currentTarget).children('#id_message').val();
                console.log(id_message);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ url('/user/read_only') }}',
                    type: 'post',
                    data: {id_message: id_message},
                })
            });
        })
    </script>

    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('custom/parsley.min.js')}}"></script>

@endpush

