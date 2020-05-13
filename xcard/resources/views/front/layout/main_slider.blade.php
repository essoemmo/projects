@if(count($sliders) > 0)
<div class="main-slider mb-5" id="customize_wrapper" dir="ltr">

    <div class="customize" id="customize">

        @foreach($sliders as $slider)
        <div class="slider-wrapper">
            <div class="slider-img">
                <img src="{{asset($slider->image)}}" alt="">
            </div>
            <div class="caption text-center">
                <h4> {{$slider['title']}} </h4>
                <p> {{$slider['description']}} </p>
                <a href="{{$slider['url']}}" class="btn btn-yellow"> {{_i('Click Here')}}</a>
            </div>
        </div>
        @endforeach

    </div>
    <div class="customize-tools">
        <div class="container">
            <ul class="thumbnails" id="customize-thumbnails">

                @foreach($sliders as $slider)
                <li>
                    <img src="{{asset($slider->image)}}" alt="">
                </li>
                @endforeach


            </ul>
        </div>
        <ul class="controls" id="customize-controls">
            <li class="prev">
                <img src="{{asset('front/images/arrow-left.png')}}" alt="">
            </li>
            <li class="next">
                <img src="{{asset('front/images/arrow-right.png')}}" alt="">
            </li>
        </ul>

    </div>
</div>
@endif