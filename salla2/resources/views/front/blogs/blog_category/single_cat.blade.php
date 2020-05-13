@extends('front.layout.master')
@section('content')

    @push('css')
        <style>
            .breadcrumb {
                padding: 0;
                margin-bottom: 30px;
                list-style: none;
                background-color: transparent;
                border-radius: 0;
            }
            .breadcrumb h3 {
                color: #2b2d34;
                font-size: 24px;
                font-weight: 900;
                margin-top: 0;
                margin-bottom: 20px;
                font-family: amazon-ember-bold;
            }
            .breadcrumb span {
                color: #2ac5b0;
            }

            .breadcrumb a, .breadcrumb i:not(.icon-search), .breadcrumb  {
                display: inline-block;
                vertical-align: middle;
                color: #888b98;
                font-size: 16px;
                font-weight: 500;
                font-family: amazon-ember;
            }

            .blog-tags {
                margin-top: 20px;
            }

            .blog-tags a {
                transition: all .3s;
                color: #2ac5b0;
            }

            .blog-tags span {
                margin-right: 40px;
                color: #b1b3be;
            }
            .blog-tags span, .blog-tags a {
                font-size: 14px;
                font-weight: 500;
                display: inline-block;
            }

            .blog-title a:hover {
                color: #2ac5b0;
            }
            .blog-title a {
                color: #545865;
                transition: all .3s;
                line-height: 36px;
                display: block;
            }

            .blog-title {
                font-size: 20px;
                font-weight: 700;
                height: auto;
                margin-top: 20px;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box!important;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                font-family: amazon-ember-bold;
            }

            .excerpt {
                font-size: 15px;
                font-weight: 300;
                line-height: 26px;
                color: #888b98;
            }

            .blog-item-img {
                border-radius: 10px;
                overflow: hidden;
            }

            .blog-item-img img {
                /*position: absolute;*/
                min-width: 100%;
                min-height: 100%;
                /*left: 50%;*/
                /*top: 50%;*/
                /*transform: translate(-50%,-50%);*/
            }
        </style>
    @endpush




    <div class="container">
        <div class="breadcrumb">
            <div class="row">

                <div class="col-xs-7 col-xs-pull-5">
                    <h3>{{_i('Blogs')}}</h3>
                    <a href="{{url(LaravelGettext::getLocale(),'')}}" data-wpel-link="internal">{{_i('Home')}}</a>
                    <i>/</i>
                    <span>{{$blog_cat['title']}}</span>
                </div>
            </div>
        </div>

        <div class="row">
            @if(count($blogs) >0 )
                @foreach($blogs as $blog)

                    <div class="col-md-6">
                        <article class="blog-item">
                            <div class="blog-item-img">
                                <a href="{{url(LaravelGettext::getLocale().'/blog/'.$blog->id)}}" data-wpel-link="internal">
                                    <img src="{{asset($blog['img_url'])}}" /></a>
                            </div>
                            <div class="blog-tags">
                                <a href="{{url(LaravelGettext::getLocale().'/blog/'.$blog->id)}}" class="blog-cat" data-wpel-link="internal">{{_i('Created Time')}} :</a>

                                <span class="blog-time">  {{$blog['created']}}</span>
                            </div>
                            <div class="blog-title">
                                <a href="{{url(LaravelGettext::getLocale().'/blog/'.$blog->id)}}" data-wpel-link="internal">{{$blog->title}}</a>
                            </div>
                            <div class="excerpt">{!! str_limit($blog['content'] ,200) !!}</div>

                        </article>
                    </div>

                    <!--- <div class="clearfix"></div> -->
                @endforeach

            @else
                <div class="col-md-12">
                    <div class="alert alert-danger text-center">
                        {{ _i('No Blogs') }}
                    </div>
                </div>
            @endif

        </div>

        <div class="d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item ">
                        {{$blogs->links()}}
                    </li>
                </ul>
            </nav>
        </div>

    </div>



@endsection