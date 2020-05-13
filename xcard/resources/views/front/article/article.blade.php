@extends('front.layout.index')

@section('content')

    <section class="items-section-wrapper">
        <div class="container">
            <div class="section-title">
                <a href="{{url('articleCat/'.$blogCat['id'])}}" style="color: white;">{{$blogCat->translate(app()->getLocale())->title}}</a>
            </div>
            

            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="col-md-4 d-flex ">
                        <div class="  item-img">
                            <img data-src="{{asset($blog['image'])}}" alt="{{_i('Article Image')}}"
                                 class="img-fluid lazy align-self-center">
                        </div>
                    </div>
                    <div class="item-details">
                        <h3 class="title" style="color: white;"> {{$blog->translate(app()->getLocale())->title}} </h3>
                        <p class="description" style="color: white; !important;">
                            {!! $blog->translate(app()->getLocale())->content !!}
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection

