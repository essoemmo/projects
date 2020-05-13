@extends('front.layout.app')

@section("content")
    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{url('/article_cat/'.$category->id)}}">{{$category->title}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$article->title}} </li>
            </ol>
        </div>
    </nav>




    <div class="single-course-page pt-5">
    <div class="container">


        <div class="row">
           
            <div class="col-lg-12 ">
                 <div class="single-course-wrapper  ">
                    <div class="course-thumbnail article-thumb">

                        <img data-src="{{asset('uploads/articles/'.$article->id.'/'.$article->img_url)}}" alt="{{_i('Article Image')}}"
                             class="img-fluid lazy align-self-center">

                    </div>

                </div>
                <div class="single-course-meta">
                    <h3 class="title"><a href=""> {{$article->title}} </a></h3>
                    <p class="description">

                       {!! $article->content !!}
                    </p>



                </div>
            </div>

        </div>



    </div>


    <div class="courses-you-may-need bg-gray common-wrapper">
        <div class="container">
            <div class="section-title smaller-title">
                  {{_i('Similar Articles')}}
            </div>

            <div class="row">

                @if(count($articles) > 0)
                      @foreach($articles as $article)
                            <div class="col-md-6">
                                <div class="single-achievement d-flex align-items-center">
                                    <div class="date">
                                        <span>{{date('d' , strtotime($article->created))}}</span>
                                        <span>{{date('M' , strtotime($article->created))}}</span>
                                        <span>{{date('Y' , strtotime($article->created))}}</span>

                                    </div>
                                    <div class="media ">

                                        <a href="{{ url('article', $article->id) }}">
                                            @if($article->img_url != null)
                                                <img data-src="{{ asset('uploads/articles/' . $article->id . '/' . $article->img_url) }}" src="{{ asset('uploads/articles/' . $article->id . '/' . $article->img_url)}}" alt="{{_i('Article Image')}}"  >
                                            @else
                                                <img data-src="{{asset('front/images/no-img40x40.jpg')}}"  src="{{asset('front/images/no-img40x40.jpg')}}" class="align-self-center img-fluid ml-3 lazy" alt="...">
                                            @endif
                                        </a>

                                        <div class="media-body align-self-center">

                                            <a href="{{ url('article', $article->id) }}">
                                                <h5 class="mt-0 cat-name">{{$article->title}}  </h5>
                                            </a>

                                            <p> {!! str_limit($article->content , 150) !!} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  @endforeach

                @else
                    <div class="col-md-12">
                        <div class="alert alert-danger text-center">
                            {{ _i('No Articles') }}
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection



