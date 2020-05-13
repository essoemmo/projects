@extends('web.layout.master')


@push('css')

    <style>
        div img {
            max-width: -webkit-fill-available;
            max-width: -moz-available;
        }
    </style>

@endpush

@section('content')
    <?php
    function drawProduct($prod,$convert)
    {
    ?>
    <div class="col-lg-4 col-md-6 d-flex ">
        <div class="single-full-product text-center d-flex flex-column">
            <div class="top-floating-icons d-flex justify-content-between">

                @if(\App\Models\Product::findOrFail($prod->id)->isFavorited())
                    <a href="javascript:void(0)" class="add-to-fav product-fav" data-id="{{$prod->id}}">
                        <i class="fa fa-heart"></i>
                    </a>
                @else
                    <a href="javascript:void(0)" class="add-to-fav product-fav" data-id="{{$prod->id}}" >
                        <i class="fa fa-heart-o"></i>
                    </a>
                @endif
                @if(stockStatus($prod->id) != null)
                    <a href="" class="new-product-label"><label class="badge badge-primary">{{ stockStatus($prod->id)->name }}</label></a>
                @else
                    <a href="" class="new-product-label"><label class="badge badge-primary">{{ _i('New') }}</label></a>
                @endif
            </div>

            <?php

            $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
            // you can add different browsers with the same way ..
            if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
                $browser = 'chromium';
            elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
                $browser = 'chrome';
            elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
                $browser = 'safari';
            elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
                $browser = 'opera';
            elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
                $browser = 'msie';
            elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
                $browser = 'mozilla';

            preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);

            ?>

            <div class="product-thumbnail">
                <a href="{{route('productDetailsByName',$prod->name)}}" @if($browser == 'safari') style="display: block !important" @endif>
                    <img src="{{ asset('images/products/'.$prod->main_image) }}" src="{{ asset('images/products/'.$prod->main_image) }}" alt="" class="img-fluid ">
                </a>
            </div>
            <div class="product-available-colors ">
                <ul class="list-inline">

                    <?php

                    $color = \Illuminate\Support\Facades\DB::table('product_colors')
                        ->where('product_id',$prod->id)
                        ->get();
                    foreach($color as $index => $col3){?>
                    <li class="list-inline-item"><a href="" class="color{{$index}}" style="background: {{$col3->color}};"></a>
                    </li>
                    <?php }?>


                </ul>
            </div>
            <h3 class="title"><a href="{{route('productDetailsByName',$prod->name)}}">{{$prod->name}}</a></h3>
            <div class="price-rate-purchase d-flex justify-content-between mt-auto">
                <div class="add-to-cart">
                    <a href="javascript:void(0)" class="">
                        <input type="hidden" class="product_id" value="{{ $prod->id }}" name="product_id">
                        <input type="hidden" class="max_count" value="{{ $prod->quantity }}" name="max_count">
                        <i class="fa fa-shopping-cart"></i>

                        @if(!empty($prod->price()->discount))

                            @if($prod->price() != null)
                                <strike class="price">{{$prod->price()->price}} {{ $convert->code }}</strike>
                            @endif
                            <?php
                            $discou = intval($prod->price()->price) - intval($prod->price()->discount);
                            ?>
                            <span class="price">{{$discou}} {{ $convert->code }}</span>

                        @else
                            @if($prod->price()->price != null)
                                <span class="price">{{$prod->price()->price}} {{ $convert->code }}</span>
                            @endif

                        @endif
                    </a>
                </div>
                <div class="rate">
                    <?php
                    $rating = \Illuminate\Support\Facades\DB::table('ratings')
                        ->where('product_id',$prod->id)
                        ->value('rating');
                    ;

                    ?>
                    <div class="star-ratings-sprite"><span style="width:{{!empty($rating) ?$rating :0}}%"
                                                           class="star-ratings-sprite-rating"></span></div>

                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <br />
                <p class="alert alert-{{ $msg }} text-center"> <b> {{ Session::get($msg) }} </b> </p>
            @endif
        @endforeach
    </div>


    <div class="slider ">
        <!--<div class="container">-->
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($slider as $index =>$slid)
                    <li data-target="#carouselExampleFade" data-slide-to="{{$index}}" class="{{$index == 0 ? 'active':''}}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">

                @foreach($slider as $index =>$slid)
                    <div class="carousel-item {{$index == 0 ? 'active':''}}">
                        <a href="{{ $slid->link }}">
                            <img src="{{asset('uploads/setting/slider/'.$slid->image)}}" class="d-block w-100" alt="...">
                        </a>
                    </div>
                @endforeach


            </div>

            <!--</div>-->
        </div>
    </div>




    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="main-search mt-4 mb-3">
                    <form action="{{route('search')}}" method="get" class="header-search">
                        {{csrf_field()}}
                        {{--                                {{method_field('get')}}--}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select class="form-control" name="category">
                                    <option value="">{{_i(' All categories ')}}</option>
                                    <?php
                                    $category = \App\Models\Category::where('parent_id',null)//->where('language_id',getLang(lang()))
                                    ->get();
                                    ?>
                                    @foreach($category as $cat)
                                        <?php
                                        $categoryname = $cat->hasDescription() //\Illuminate\Support\Facades\DB::table('category_descriptions')
                                        // ->where('category_id',$cat->id)
                                        ->where('language_id',getLang(lang()))
                                            ->get();
                                        ?>
                                        @foreach($categoryname as $na)
                                            <option value="{{$na->category_id}}" {{$na->category_id == request()->category ? 'selected': ''}}>{{$na->name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" class="form-control" name="search" placeholder="{{_i('search')}}" value="{{request()->search}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>



    <div class="wide-ad text-center mt-4">
        <div class="container">
            {{--            <a href=""><img src="{{ url('/') }}/web/images/ad.jpg" alt="" class="img-fluid "></a>--}}

        </div>
    </div>


    <div class="products-wrapper">
        <div class="container">

        <!------
            <div class="filter">
                <div class="row">
                    <div class="col-lg-3 col-6  align-self-center">
                        <div class="types-filter">
                            <select class="wide border-0" id="cat">
                                <option selected>{{_i('All Categories')}}</option>
                                <?php
        $category = \App\Models\Category::where('parent_id',null)
            ->get();
        ?>
        @foreach($category as $cat)
            <?php
            $categoryname = \Illuminate\Support\Facades\DB::table('category_descriptions')
                ->where('category_id',$cat->id)
                ->where('language_id',getLang(lang()))
                ->get();
            ?>
            @foreach($categoryname as $na)
                <a href="{{route('category',$na->category_id)}}" data-value="{{$na->category_id}}" id="cat">
                                            <option value="{{$na->category_id}}">{{$na->name}}</option></a>
                                    @endforeach
        @endforeach
            </select>

        </div>
    </div>
    <div class="col-lg-6 order-lg-2 order-3 align-self-center">
        <ul class="filter-nav list-inline justify-content-center d-md-flex ">
            <li class="list-inline-item active"><a href="">{{_i('Products interest you')}}</a></li>
                            <?php
        $category = \App\Models\Category::where('parent_id',null)->get();
        ?>
        @foreach($category as $cat)
            <?php
            $categoryname = \Illuminate\Support\Facades\DB::table('category_descriptions')
                ->where('category_id',$cat->id)
                ->where('language_id',getLang(lang()))
                ->get();
            ?>
            @foreach($categoryname as $na)
                <li class="list-inline-item"><a href="{{route('category',$na->category_id)}}">{{$na->name}}</a></li>
                                @endforeach
        @endforeach
            </ul>
        </div>
    </div>
</div>
---->

            @foreach($content as $key => $item)
                <?php
                $content_data = App\Models\Content\ContentSectionData::where("section_id",$item->id)->where('lang_id' ,getLang(lang()))->select("content")->get();

                ?>
                <?php
                $products = \App\Models\Product::leftJoin('content_sections_products', 'content_sections_products.product_id', 'products.id')
                    ->leftJoin('product_descriptions', 'product_descriptions.product_id', 'products.id')
                    ->where('content_sections_products.section_id' , $item['id'])
                    ->where('product_descriptions.language_id' ,getLang(lang()))
                    ->select('products.*','product_descriptions.name','product_descriptions.description')
                    ->get()
                ?>
                <div class="section-title">{{ $item->title }}</div>
                @if($key % 2 == 0)
                    <div class="products-wrapper common-wrapper" >




                        @if(count($content_data) > 0)
                            <div class="row">
                                @foreach($content_data as $data)
                                    @if($item->columns == 0)
                                        <div class="col-md-12">{!! $data['content'] !!}</div>
                                    @else
                                        <div class="col-md-{{ 12 / $item->columns }} col-sm-{{ 12 / $item->columns }} img-child">{!! $data['content'] !!}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="row">

                            @foreach($products as  $prod)
                                <?php drawProduct($prod,$convert) ?>
                            @endforeach
                        </div>

                    </div>


                @else




                    @if(count($content_data) > 0)

                        <div class="row">
                            @foreach($content_data as $data)
                                @if($item->columns == 0)
                                    <div class="col-md-12">{!! $data['content'] !!}</div>
                                @else
                                    <div class="col-md-{{ 12 / $item->columns }} col-sm-{{ 12 / $item->columns }} img-child">{!! $data['content'] !!}</div>
                                @endif
                            @endforeach
                        </div>

                    @endif

                    <div class="row">
                        @foreach($products as  $prod)
                            <?php drawProduct($prod,$convert) ?>
                        @endforeach
                    </div>

                @endif
            @endforeach

        </div>
    </div>



    {{--            sa href=""><img src="{{ url('/') }}/web/images/ad.jpg" alt="" class="img-fluid "></a>--}}





    @if(!empty($manufacturers))

        <div class="sponsors common-wrapper">
            <div class="container">
                <div class="sponsors-slider owl-carousel">
                    @foreach($manufacturers as $item)
                        <div class="single-sponsor">
                            <a href="{{ url('/manufacturers/'. $item->id) }}"><img src="{{ asset('images/manufacturers/'.$item->image) }}" alt="{{ $item->name }}" class="owl-"></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


@endsection

@push('js')
    <script>
        $(function () {
            $('body').on('change','#cat',function (e) {
                e.preventDefault();

                var val = $(this).val();

                window.location.href = "/category/"+val;
            })
        });
    </script>

@endpush
