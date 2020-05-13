@extends('front.layout.master')
@section('content')

{{--    @push('css')--}}
{{--        <style>--}}
{{--            .breadcrumb {--}}
{{--                padding: 0;--}}
{{--                margin-bottom: 30px;--}}
{{--                list-style: none;--}}
{{--                background-color: transparent;--}}
{{--                border-radius: 0;--}}
{{--            }--}}
{{--            .breadcrumb h3 {--}}
{{--                color: #2b2d34;--}}
{{--                font-size: 24px;--}}
{{--                font-weight: 900;--}}
{{--                margin-top: 0;--}}
{{--                margin-bottom: 20px;--}}
{{--                font-family: amazon-ember-bold;--}}
{{--            }--}}
{{--            .breadcrumb span {--}}
{{--                color: #2ac5b0;--}}
{{--            }--}}

{{--            .breadcrumb a, .breadcrumb i:not(.icon-search), .breadcrumb  {--}}
{{--                display: inline-block;--}}
{{--                vertical-align: middle;--}}
{{--                color: #888b98;--}}
{{--                font-size: 16px;--}}
{{--                font-weight: 500;--}}
{{--                font-family: amazon-ember;--}}
{{--            }--}}

{{--            .blog-tags {--}}
{{--                margin-top: 20px;--}}
{{--            }--}}

{{--            .blog-tags a {--}}
{{--                transition: all .3s;--}}
{{--                color: #2ac5b0;--}}
{{--            }--}}

{{--            .blog-tags span {--}}
{{--                margin-right: 40px;--}}
{{--                color: #b1b3be;--}}
{{--            }--}}
{{--            .blog-tags span, .blog-tags a {--}}
{{--                font-size: 14px;--}}
{{--                font-weight: 500;--}}
{{--                display: inline-block;--}}
{{--            }--}}

{{--            .blog-title a:hover {--}}
{{--                color: #2ac5b0;--}}
{{--            }--}}
{{--            .blog-title a {--}}
{{--                color: #545865;--}}
{{--                transition: all .3s;--}}
{{--                line-height: 36px;--}}
{{--                display: block;--}}
{{--            }--}}

{{--            .blog-title {--}}
{{--                font-size: 20px;--}}
{{--                font-weight: 700;--}}
{{--                height: auto;--}}
{{--                margin-top: 20px;--}}
{{--                overflow: hidden;--}}
{{--                text-overflow: ellipsis;--}}
{{--                display: -webkit-box!important;--}}
{{--                -webkit-line-clamp: 2;--}}
{{--                -webkit-box-orient: vertical;--}}
{{--                font-family: amazon-ember-bold;--}}
{{--            }--}}

{{--            .excerpt {--}}
{{--                font-size: 15px;--}}
{{--                font-weight: 300;--}}
{{--                line-height: 26px;--}}
{{--                color: #888b98;--}}
{{--            }--}}

{{--            .blog-item-img {--}}
{{--                border-radius: 10px;--}}
{{--                overflow: hidden;--}}
{{--            }--}}
{{--        </style>--}}
{{--    @endpush--}}


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
        <div class="col-xs-12 col-sm-8">
            <div class="article-header">
                <h1>5 متاجر إلكترونية سعودية نجحت من خلال منصة سلة للتجارة الإلكترونية</h1>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="blog-tags">
                            <a href="https://salla.sa/site/category/%d8%a7%d9%84%d8%aa%d8%ac%d8%a7%d8%b1%d8%a9-%d8%a7%d9%84%d8%a5%d9%84%d9%83%d8%aa%d8%b1%d9%88%d9%86%d9%8a%d8%a9/" class="blog-cat" data-wpel-link="internal">التجارة الإلكترونية</a> <span class="blog-time">13 فبراير 2020</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="article-img">
                <img src="https://salla.sa/site/wp-content/uploads/2020/02/blogthum1-2.png" class="img-responsive" />
            </div>
            <div class="article-content-wrap">
                <div class="article-content">
                    <p style="text-align: justify;">مؤخرًا حققت متاجر لى مدى شيوع ثقافة كترونية في المملكة.


                    </p>


                </div>


            </div>
        </div>

        <div class="col-xs-12 col-sm-4">
            <div class="sidebar-wrap">
                <div class="most-read-wrap">
                    <div class="section-header most-read-header">
                        <h2 class="wow fadeInDown"><span class="gradient-button link--kukuri">الأكثر قراءة</span></h2>
                    </div>
                    <div class="most-read-news">
                        <article class="most-read-item" >
                            <a href="https://salla.sa/site/%d8%a7%d9%84%d8%af%d9%84%d9%8a%d9%84-%d8%a7%d9%84%d9%85%d8%ae%d8%aa%d8%b5%d8%b1-%d9%84%d9%81%d8%aa%d8%ad-%d8%b3%d8%ac%d9%84-%d8%aa%d8%ac%d8%a7%d8%b1%d9%8a-%d8%a5%d9%84%d9%83%d8%aa%d8%b1%d9%88%d9%86/" data-wpel-link="internal"><div class="most-read-item-img"><img src="https://salla.sa/site/wp-content/uploads/2019/09/blogthum4-1-150x150.png" class="img-responsive" /></div><span>الدليل المختصر لفتح سجل تجاري إلكتروني سعودي في 180 ثانية</span></a>
                        </article>
                        <article class="most-read-item">
                            <a href="https://salla.sa/site/3-%d8%b7%d8%b1%d9%82-%d9%84%d9%85%d8%b6%d8%a7%d8%b9%d9%81%d8%a9-%d9%85%d8%a8%d9%8a%d8%b9%d8%a7%d8%aa%d9%83-%d9%81%d9%8a-2020/" data-wpel-link="internal"><div class="most-read-item-img"><img src="https://salla.sa/site/wp-content/uploads/2019/12/image.jpeg-150x150.jpg" class="img-responsive" /></div><span>3 طرق لمضاعفة مبيعاتك في 2020</span></a>
                        </article>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection