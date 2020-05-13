@extends('front.layout.index')

@section('content')

    <div class="user-page">
        <div class="container">
            <div class="privacy-policy">


                <div class="section-title">{{$cat->translate(app()->getLocale())->title}}</div>
                <div class="bg-gray p-4 ">
                    <div class="accordion" id="accordionExample">

                        @foreach($blogs as $blog)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">

                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#blog{{$blog->id}}" aria-expanded="true" aria-controls="blog{{$blog->id}}">
{{--                                            <a href="{{url('blog/'.$blog->id)}}">--}}
                                                {{$blog->translate(app()->getLocale())->title}}
{{--                                            </a>--}}

                                        </button>
                                    </h2>
                                </div>

                                <div id="blog{{$blog->id}}" class="collapse @if($loop->first) show @endif" aria-labelledby="headingOne"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        {!! $blog->translate(app()->getLocale())->content !!}
                                    </div>
                                </div>
                            </div>

                        @endforeach


                    </div>

                </div>


            </div>
        </div>
    </div>






@endsection
