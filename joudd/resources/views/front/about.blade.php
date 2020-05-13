@extends('front.layout.app')

@section('slider')

<div class="slider ">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
<!--            <li data-target="#carouselExampleFade" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleFade" data-slide-to="1"></li>
            <li data-target="#carouselExampleFade" data-slide-to="2"></li>-->
              <?php
            $index = 0;
            foreach ($gallery as $item) {
                ?>
                <li data-target="#carouselExampleFade" data-slide-to="<?= $index ?>" class="<?= ($index == 0) ? 'active' : '' ?>"></li>
                <?php
                $index++;
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

<nav aria-label="breadcrumb">
    <div class="container">
        <ol class="breadcrumb bg-gray">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ _i('About Us') }}</li>
        </ol>
    </div>
</nav>

<div class="about-us common-wrapper">
    <div class="container">
        <div class="row">

            @foreach($articles as $article)
                <div class="col-md-4">
                <div class="single-about-us-box">
                    <div class="title"> {{$article->title}}</div>
                    <p>
                        {!! $article->content !!}
                    </p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<div class="testimonials common-wrapper">
    <div class="container">
        <div class="section-title text-center">
            {{ _i('Applicants Reviews') }}
        </div>
        <div class="testimonials-slider">

            <div class="single-testimonial">
                <p>كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما
                    قامت
                    مطبعة مجهولة برص مجموعة من الأحرف</p>
            </div>
            <div class="single-testimonial">
                <p>كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما
                    قامت
                    مطبعة مجهولة برص مجموعة من الأحرف</p>
            </div>
            <div class="single-testimonial">
                <p>كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما
                    قامت
                    مطبعة مجهولة برص مجموعة من الأحرف</p>
            </div>
            <div class="single-testimonial">
                <p>كان لوريم إيبسوم ولايزال المعيار للنص الشكلي منذ القرن الخامس عشر عندما
                    قامت
                    مطبعة مجهولة برص مجموعة من الأحرف</p>
            </div>
        </div>
    </div>
</div>

@endsection
