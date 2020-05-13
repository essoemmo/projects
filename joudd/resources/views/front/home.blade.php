@extends('front.layout.app')

@section('slider')

<div class="slider ">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <!--            <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleFade" data-slide-to="1"></li>
                        <li data-target="#carouselExampleFade" data-slide-to="2"></li>-->
            <?php
            if (count($gallery) > 1) {
                $index = 0;
                foreach ($gallery as $item) {
                    ?>
                    <li data-target="#carouselExampleFade" data-slide-to="<?= $index ?>" class="<?= ($index == 0) ? 'active' : '' ?>"></li>
                    <?php
                    $index++;
                }
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <!--            <div class="carousel-item active">
                            <img src="{{asset('front/images/Header-Image.png')}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption">
                                <div class="head-txt" data-animation="animated fadeInDown">التغيير</div>
                                <div class="small-caption" data-animation="animated fadeInDown">هو نتيجة التعلم الصحيح</div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('front/images/Header-Image.png')}}" class="d-block w-100" alt="...">
                            <div class="carousel-caption">
                                <div class="head-txt" data-animation="animated fadeInDown">سجل الآن</div>
                                <div class="small-caption" data-animation="animated fadeInDown">في أكبر مجموعه كورسات</div>
                            </div>
                        </div>-->
            <?php
            $active = "active";
            foreach ($gallery as $item) {
                $path = ("Gallery/{$item->id}");
                $files = \Illuminate\Support\Facades\Storage::files($path);
                $img = "front/images/demo.jpg";
                if (count($files) > 0)
                    $img = "uploads/" . $files[0];
                else {
                    $path = ("Gallery/{$item->source_id}");
                    $files = \Illuminate\Support\Facades\Storage::files($path);
                    if (count($files) > 0)
                        $img = "uploads/" . $files[0];
                }
                ?>
                <div class="carousel-item <?= $active ?>">
                    <img src="<?= $img ?>" class="d-block w-100" alt="...">

                    <div class="carousel-caption">
                        <div class="head-txt" data-animation="animated fadeInDown">{{$item->title}}</div>
                        <div class="small-caption" data-animation="animated fadeInDown">{{$item->title}}</div>
                    </div>


                </div>
                <?php
                $active = "";
            }
            ?>





        </div>

    </div>
</div>

@endsection

{{--@section("find-course")--}}
{{--    @include("front.layout.search")--}}
{{--@endsection--}}

@section("content")


<div class="popular-courses common-wrapper">
    <div class="container">


        <div class="section-title text-center">
            {{ _i('Common Courses') }}
        </div>

        @if(count($courses) > 0)
        <div class="row">
            <?php foreach ($courses as $course) { ?>
                <div class="col-lg-4 col-md-6 d-flex ">

                    <div class="single-course-wrapper text-center d-flex flex-column">

                        <div class="top-floating-icons d-flex justify-content-between left">
                            {{--                        @dd($course)--}}
                            @if(\App\Hr\Course\Course::findOrFail($course->id)->isFavorited())
                            <a href="javascript:void(0)" class="add-to-fav" data-id="{{$course->id}}" style="margin-right:300px;">
                                <i class="fa fa-heart"></i>
                            </a>
                            @else
                            <a href="javascript:void(0)" class="add-to-fav" data-id="{{$course->id}}" style="margin-right:300px;">
                                <i class="fa fa-heart-o"></i>
                            </a>
                            @endif
                        </div>


                        <div class="course-thumbnail">
                            @if($course->cost == 0)
                            <div class="course-price"> {{ _i('free') }}</div>
                            @else
                            <div class="course-price"> {{ round($course->cost * $convert->rate) }} {{ $convert->code }} </div>
                            @endif
                            {{--                            <span class="offer">10% <span>OFF</span></span>--}}
                            <?php
                            $path = ("courses/{$course->id}");
                            $files = \Illuminate\Support\Facades\Storage::files($path);
                            $img = "front/images/demo.png";
                            if (count($files) > 0)
                                $img = "uploads/" . $files[0];
                            ?>
                            <a href="{{ url('course', $course->id) }}">
                                <img data-src="{{$img}}" alt="" class="img-fluid lazy">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>

                        <h3 class="title"><a href="{{ url('course', $course->id) }}">{{$course->title}}</a></h3>
                        <p class="description"><?= implode(" ", array_slice(explode(" ", strip_tags($course->description), 20), 0, 2)); ?></p>
                        <div class="d-flex justify-content-center">
                            <div class="star-ratings-css">
                                <div class="star-ratings-css-top" style="width: @if(couseRating($course->id) != null){{couseRating($course->id)}}% @else 0% @endif">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                <div class="star-ratings-css-bottom">
                                    <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>

                            </div>
                            <a href="{{ url('course', $course->id) }}" class="btn btn-light btn-more">{{_i('More')}}</a>
                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="text-center">
            <a href="{{ url('courses') }}" class="btn btn-blue-outlined mt-4">  {{_i('See All Courses')}}</a>
        </div>

        @else
        <div class="col-md-12">
            <div class="alert alert-danger text-center">
                {{ _i('No Courses') }}
            </div>
        </div>
        @endif
    </div>
</div>

<div class="courses-categories common-wrapper bg-gray">
    <div class="container">


        <div class="section-title text-center">
            {{_i('Courses Categories')}}
        </div>

        @if(count($categories) > 0)
        <div class="row">
            @foreach($categories as $category)

            @if(App\Hr\Course\Course_co_category::where('co_category_id', $category->id)->count() > 0)

            <div class="col-lg-4 col-md-6 d-flex ">
                <div class="single-category-box text-center d-flex flex-column">

                    <div class="top-floating-icons d-flex justify-content-between left">

                        @if(\App\Front\Category::findOrFail($category->id)->isFavorited())
                        <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}"  style="margin-right:300px;">
                            <i class="fa fa-heart"></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}" style="margin-right:300px;">
                            <i class="fa fa-heart-o"></i>
                        </a>
                        @endif
                    </div>

                    <div class="course-thumbnail">
                        <a href="{{ url('category', $category->id) }}">
                            <img data-src="/front/images/a-clinician-works-with-patients-in-a-health-setting.png" alt=""
                                 class="img-fluid lazy">
                            <i class="fa fa-play"></i>
                        </a>
                        <div class="caption">
                            <h3 class="title"><a href="{{ url('category', $category->id) }}">{{ $category->cat_name }}</a></h3>
                            <div class="courses-counter">{{ $count = App\Hr\Course\Course_co_category::where('co_category_id', $category->id)->count() }} {{_i(' Course ')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            @else

            <div class="col-lg-4 col-md-6 d-flex ">
                <div class="single-category-box text-center d-flex flex-column">

                    <div class="top-floating-icons d-flex justify-content-between left">

                        @if(\App\Front\Category::findOrFail($category->id)->isFavorited())
                        <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}"  style="margin-right:300px;">
                            <i class="fa fa-heart"></i>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="add-to-fav cat-course" data-id="{{$category->id}}" style="margin-right:300px;">
                            <i class="fa fa-heart-o"></i>
                        </a>
                        @endif
                    </div>

                    <div class="course-thumbnail">
                        <a href="{{ url('category/parent', $category->id) }}">
                            <img data-src="/front/images/a-clinician-works-with-patients-in-a-health-setting.png" alt=""
                                 class="img-fluid lazy">
                            <i class="fa fa-play"></i>
                        </a>
                        <div class="caption">
                            <h3 class="title"><a href="{{ url('category/parent', $category->id) }}">{{ $category->cat_name }}</a></h3>
                            <div class="courses-counter">{{ $count = App\Hr\Course\Course_co_category::where('co_category_id', $category->id)->count()}} {{_i(' Course ')}} </div>
                        </div>

                    </div>

                </div>
            </div>
            @endif

            @endforeach

        </div>
        <div class="text-center">
            <a href="{{ url('categories') }}" class="btn btn-blue-outlined"> {{_i('See All Categories')}}</a>
        </div>

        @else
        <div class="col-md-12">
            <div class="alert alert-danger text-center">
                {{ _i('No Categories') }}
            </div>
        </div>
        @endif
    </div>
</div>


<div class="testimonials common-wrapper">
    <div class="container">
        <div class="section-title text-center">
            {{_i('Students Reviews')}}
        </div>
        <div class="testimonials-slider">

            @foreach(\App\Models\rating\userRating::where('approve' , 1)->get() as $rate)
            <div class="single-testimonial">
                <p>
                    {{$rate->comment}}
                </p>
            </div>
            @endforeach

        </div>
    </div>
</div>

<div class="achievements common-wrapper bg-gray">
    <div class="container">
        <div class="section-title text-center">
            {{ _i('Applicants Achievement') }}
        </div>
        <div class="row">
            <div class="col-md-6">
                @foreach($competitions as $item)

                <div class="single-achievement d-flex align-items-center">
                    <div class="date">
                        <span>{{ date('d',strtotime( $item->start)) }}</span>
                        <span>{{ date('M',strtotime( $item->start)) }}</span>
                        <span>{{ date('Y',strtotime( $item->start)) }}</span>
                    </div>
                    <div class="media ">
                        <img data-src="{{ asset('uploads/courses/' . '/' . $item->type_id. '/' . $item->img) }}" class="align-self-center img-fluid ml-3 lazy" alt="...">
                        <div class="media-body align-self-center">
                            <h6>
                                <?php
                                $top_user = DB::table('user_exams')->where('exam_id', $item->exam_id)->orderBy('score', 'desc')->first();
                                if ($top_user !== null) {
                                    $user = \App\User::find($top_user->user_id);
                                    ?>
                                    <?= $user->first_name ?>  <?= $user->last_name ?>
                                <?php } ?>
                                <div class="star-ratings-css small-user-rating d-inline-block">
                                    <div class="star-ratings-css-top" style="width: 0%">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                    <div class="star-ratings-css-bottom">
                                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
                                </div>
                            </h6>
                            <h5 class="mt-0 cat-name">{{ $item->title }}</h5>
                            <p>{!! $item->description !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-6 align-content-stretch">
                <div class="achievements-bg-box ">
                    <div class="context">
                        <i class="fa fa-calendar"></i>
                        <p>{{ _i('Applicants Results In Quizes ') }}</p>
                        <a href="" class="btn btn-outline-white">{{ _i('See all Results') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="course-register common-wrapper">
    <div class="container">
        <div class="section-title text-center">
            <span>{{ _i('Request Course') }}</span>
            {{ _i('Register Now') }}
        </div>
        <div class="row">
            <div class="col-md-6 align-content-md-stretch d-none d-md-flex">
                <div class="register-bg-box "></div>
            </div>
            <div class="col-md-6">
                <div class="course-register-form">
                    <h5>{{ _i('You are just one click away from fulfilling your dream') }}</h5>
                      @include("front.users.student.form")
<!--                    <form action="">
                        <div class="field">
                            <input type="text" class="form-control" name="FirstName" id="FirstName"
                                   placeholder="{{ _i('First Name') }}">
                            <label for="FirstName">{{ _i('First Name') }}</label>
                        </div>
                        <div class="field">
                            <input type="text" class="form-control" name="LastName" id="LastName" placeholder="{{ _i('Last Name') }}">
                            <label for="LastName">{{ _i('Last Name') }}</label>
                        </div>
                        <div class="field">
                            <input type="text" class="form-control" name="Phone" id="Phone" placeholder="000-000-0000">
                            <label for="Phone">{{ _i('Phone Number') }}</label>
                        </div>
                        <div class="field">
                            <input type="text" class="form-control" name="Email" id="Email"
                                   placeholder="example@domain.com">
                            <label for="Email">{{ _i('Email') }}</label>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn register-btn" value="{{ _i('Register Now') }}">
                        </div>
                    </form>-->
                </div>
            </div>

        </div>
    </div>
</div>

<div class="subscribe common-wrapper bg-gray">
    <div class="container">
        <div class="section-title">
            <span> {{_i('Register with us at')}}</span>
            {{_i('Newsletter')}}
            <p>{{_i('To receive all that is new')}} </p>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="{{url('/user/subscribe/newsletters')}}" method="POST" data-parsley-validate="">
                    @csrf

                    <div class="input-group">
                        <input type="email"  name="email" class="form-control" placeholder="{{_i('Your Email')}}" required="" >

                        @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                        @endif

                        <div class="input-group-append">
                            <input class="btn btn-blue" type="submit" value="{{_i('Subscribe')}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
@endsection
