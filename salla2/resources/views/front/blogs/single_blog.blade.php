@extends('front.layout.master')
@section('content')

    @push('css')
        <style>

            .article-header h1 {
                font-size: 24px;
                color: #2b2d34;
                font-weight: 900;
                margin-top: 0;
                margin-bottom: 22px;
                line-height: 30px;
                font-family: amazon-ember-bold;
            }
            .blog-tags a {
                transition: all .3s;
                color: #2ac5b0;
            }
            .blog-tags span, .blog-tags a {
                font-size: 14px;
                font-weight: 500;
                display: inline-block;
            }

            .blog-tags span {
                margin-right: 40px;
                color: #b1b3be;
            }

            .article-img img {
                border-radius: 10px;
                width: 100%;
            }
            .article-img {
                margin-top: 30px;
                margin-bottom: 40px;
            }


            .article-content {
                color: #6b6b6b;
                font-size: 18px;
                line-height: 1.7;
                font-weight: 300;
                font-family: amazon-ember;
            }
            .article-content p {
                margin-top: 2rem;
            }
            p {
                display: block;
                margin-block-start: 1em;
                margin-block-end: 1em;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
            }


            .most-read-wrap {
                margin-top: 80px;
                padding-right: 15px;
            }


            .most-read-header h2 {
                font-size: 18px;
                font-weight: 900;
                color: #2ac5b0;
                font-family: amazon-ember-bold;
            }

            .most-read-wrap {
                /*margin-top: 40px;*/
                padding-right: 15px;
            }

            .most-read-item {
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #f2f2f2;
                font-family: amazon-ember;
            }

            .carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
                display: block;
                max-width: 100%;
                height: auto;
            }
            .most-read-item a {
                color: #2b2d34;
                font-size: 16px;
                font-weight: 500;
                display: block;
                line-height: 30px;
                transition: all .3s;
            }
            .most-read-item {
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #f2f2f2;
                font-family: amazon-ember;
            }

            .most-read-item span {
                display: inline-block;
                vertical-align: middle;
                width: calc(100% - 90px);
                margin-right: 20px;
            }
        </style>
    @endpush




    <div class="container">
      

        <div class="row">
            @if($blog != null )

                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="article-header">
                            <h1>{{$blog->title}}</h1>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="blog-tags">
                                        <a href="{{url(LaravelGettext::getLocale().'/blog_cat/'.$blog_cat->id)}}" class="blog-cat" data-wpel-link="internal">{{$blog_cat['title']}}</a>
                                        <span class="blog-time">{{$blog['created']}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="article-img">
                            <img src="{{asset($blog['img_url'])}}" class="img-responsive" />
                        </div>
                        <div class="article-content-wrap">
                            <div class="article-content">
                                <p style="text-align: justify;">
                                    {!! $blog['content'] !!}
                                </p>
                            </div>
                        </div>
                    </div>


                    @if(count($similar_articles) > 0)
                    <div class="col-xs-12 col-sm-4">
                        <div class="sidebar-wrap">
                            <div class="most-read-wrap">
                                <div class="section-header most-read-header">
                                    <h2 class="wow fadeInDown"><span class="gradient-button link--kukuri">{{_i('Similar Articles')}}</span></h2>
                                </div>
                                <div class="most-read-news">

                                    @foreach($similar_articles as $item)
                                    <article class="most-read-item" >
                                        <a href="{{url(LaravelGettext::getLocale().'/blog/'.$item->id)}}" data-wpel-link="internal">
                                            <div class="most-read-item-img">
                                                <img src="{{asset($item['img_url'])}}" class="img-responsive" />
                                            </div>
                                            <span>{{$item->title}}</span>
                                        </a>
                                    </article>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

            @else
                <div class="col-md-12">
                    <div class="alert alert-danger text-center">
                        {{ _i('No Blogs') }}
                    </div>
                </div>
            @endif

        </div>


    </div>

@endsection