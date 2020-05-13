@extends('front.layout.index')

@section('content')

    <div class="user-page">
        <div class="container">
            <div class="privacy-policy">

                <div class="section-title">
                    <a href="{{url('blogCat/'.$blogCat['id'])}}" style="color: white;">{{$blogCat->translate(app()->getLocale())->title}}</a>
                </div>
                <div class="bg-gray p-4 ">
                    <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">

                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#blog" aria-expanded="true" aria-controls="blog">
                                            {{$blog->translate(app()->getLocale())->title}}
                                        </button>
                                    </h2>
                                </div>

                                <div id="blog" class="collapse  show " aria-labelledby="headingOne"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        {!! $blog->translate(app()->getLocale())->content !!}
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>


            </div>
        </div>
    </div>






@endsection
