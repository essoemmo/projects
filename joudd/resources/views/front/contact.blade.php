@extends('front.layout.app')

@section('slider')

<div class="slider ">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
<!--            <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleFade" data-slide-to="1"></li>
            <li data-target="#carouselExampleFade" data-slide-to="2"></li>-->
              <?php
            if(count($gallery) >1){
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

@section('content')

    <div class="flash-message text-center">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }}" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
    </div>


    <nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb bg-gray">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ _i('Contact Us') }}</li>
        </ol>
    </div>
</nav>

<div class="contact-us-page common-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-details">
                    <div class="section-title smaller-title"> {{_i('Contact Information')}} </div>
                    <p>

                    </p>

                    <ul class="list-unstyled contact-info-list">
                        <li><i class="fa fa-map-marker"></i> {{ setting()['address'] }}</li>
                        <li><i class="fa fa-phone-square"></i> {{ setting()['phone1'] }}</li>

                        @if(setting()['phone2'] != null)
                            <li><i class="fa fa-phone-square"></i> {{ setting()['phone2'] }}</li>
                        @endif

                        <li><i class="fa fa-envelope-square"></i> {{ setting()['email'] }} </li>
                    </ul>

                    <div class="social blue-social mb-3">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{ setting()['facebook_url'] }}"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="{{ setting()['twitter_url'] }}"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="{{ setting()['youtube_url'] }}"><i class="fa fa-youtube-play"></i></a></li>
                            <li class="list-inline-item"><a href="{{ setting()['instagram_url'] }}"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-us-form ">
                    <div class="wide-title-box ">
                        <div class="title bg-gray"> {{_i('Leave Your Message')}}</div>
                        <div class="wide-box-content-wrapper  reversed-form-color">

                            <form action="{{url('contact')}}" method="post" class="course-register-form" data-parsley-validate="">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="field">
                                            <input type="text" class="form-control" name="name" id="FirstName" required=""
                                                   maxlength="150"	data-parsley-maxlength="150" minlength="3" data-parsley-minlength="3"
                                              placeholder="{{_i('Your Name')}}" value="{{auth()->user() ? auth()->user()->first_name ." ".auth()->user()->last_name : old('name') }}">
                                            <label for="FirstName">{{_i('Name')}} </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field">
                                            <input type="text" class="form-control" name="email" id="Email" required=""
                                                   data-parsley-type="email" maxlength="100" data-parsley-maxlength="100"
                                                   placeholder="example@domain.com" value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                                            <label for="Email"> {{_i('Email')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="field">
                                            <input type="text" class="form-control" name="title" id="LastName"
                                                   maxlength="191" data-parsley-maxlength="191" value="{{old('title')}}"
                                                   placeholder="{{_i('Message Title')}}">
                                            <label for="LastName"> {{_i('Message Title')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="field">
                                            <textarea rows="6" class="form-control" name="message" id="yourmessage" required=""
                                                      placeholder="{{_i('Your Message')}}">{{old('message')}}</textarea>
                                            <label for="yourmessage">{{_i('Message Here')}}</label>
                                        </div>

                                        <div class="text-center">
                                            <input type="submit" class="btn register-btn" value="{{_i('Send')}}">
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="google-maps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13673.308668104753!2d31.36559835!3d31.044990449999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1569325452809!5m2!1sen!2seg"
            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</div>

@endsection
