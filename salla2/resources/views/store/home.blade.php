@extends('store.layout.master')

@section('content')
@push('css')
<style>
    .single-full-product .add-to-cart a span del {
        color: #919191;
        margin-right: 10px;
        font-size: 13px;
    }

    .button-more{
        border: 1px solid #575858;
        width: 114px;
        height: 27px;
        border-radius: 13px;
        margin-bottom: 10px;
        display: block;
        text-align: center;
        color: #000;
        transition: all 0.5s ease-in-out;
    }

    .button-more:hover{
        background: #000;
        color: #fff;
    }

</style>
<style>
    .box{
        position: relative;
        display: inline-block; /* Make the width of box same as image */
    }
    .box .text{
        position: absolute;
        z-index: 999;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 40%; /* Adjust this value to move the positioned div up and down */
       // text-align: center;
        width: 85%; /* Set the width of the positioned div */
    }
</style>
@endpush


<?php $currancy = \App\Models\Settings\Currency::where('show', 1)->value('title'); ?>
@if (\Session::has('success'))
<div class="text-center alert alert-success">
    <p>{{ \Session::get('success') }}</p>
</div><br/>
@endif
@if (\Session::has('failure'))
<div class="text-center alert alert-danger">
    <p>{{ \Session::get('failure') }}</p>
</div><br/>
@endif


@include("store.home.slider");


<!---------------  strart content sections ----------------------->
@if(count($content) > 0)
<div class="products-wrapper common-wrapper">
    <div class="container">

        @foreach($content as $key => $item)
        @php
        $content_trans = \App\Models\Content_section_title::where('section_id' , $item->id)
        //->where('lang_id' ,\app()->getLocale())
        ->first();
        @endphp

        <?php
        if($content_trans!=null ){
        ?>
        <div class="section-title">
            <figure>
            {{strip_tags($content_trans['title'])}}
            </figure>
        </div>
        <?php } ?>

        {{--                    <div class="section-header d-flex mb-4">--}}
        {{--                        <h2 class="section-title">--}}
        {{--                            <span>{{strip_tags($content_trans['title'])}}</span>--}}
        {{--                        </h2>--}}
        {{--                        @if(\App\Bll\Utility::getSetting()['show_all_button'] == 1)--}}
        {{--                        <div class="section-actions" style="float: left">--}}
        {{--                            <a class="button-more" href="{{route('products_all')}}" >{{_i('Show All')}}</a>--}}
        {{--                        </div>--}}
        {{--                        @endif--}}
        {{--                    </div>--}}

        @if($count = count($item->banners) > 0)
         @foreach($item->banners as $banner)
         <?php
        //dd($banner->Data())
         ?>
        <div class="offer-wrapper ">
    <div class="container box">
        <div class="offer">
            <img src="{{asset('uploads/settings/banners/'.$banner['id'].'/'.$banner['image'])}}"   alt="" class="img-fluid ">
            <div class="text">
            <h5 class="color-purple "><?=$banner->Data()->description;?></h5>
            <a href="{{$banner['link']}}" class="btn-shop color-purple"> {{_i("Go Now")}}</a></div>
        </div>
    </div>
</div> 
         @endforeach
<!--        <div class="wide-ad text-center my-3 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-{{intval(12/$count)}}">
                        @foreach($item->banners as $banner)
                        <a href="{{$banner['link']}}"><img src="{{asset('uploads/settings/banners/'.$banner['id'].'/'.$banner['image'])}}"
                                                           alt="" class="img-fluid "></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>-->
        @endif

        @if(count($item->products) > 0)
        @php
        $products =$item->products;
        @endphp
        
        <div class="row">

                                @include("store.home.product")

            <!-------------------------------------------------start section Banner ------------------------------------------------------------->
        </div>
        
       
        @endif
 <div class="row">
            @php
            $contents = \App\ContentSectionData::where('section_id' , $item->id)
            //->where('lang_id' ,\app()->getLocale())
            ->get();
            @endphp
            @foreach($contents as $data)
            <div class="col-md-@if($item['columns'] > 0) {{12 / $item['columns']}} @else 12  @endif">{!! $data['content'] !!}</div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@else
@include("store.home.products")
@endif
<!---------------- end content sections -------------------------->

<!-------- best companies section ---------------------------->
<div class="carousel-section   ">
    <div class="container">
        <div class="section-title"> <figure>{{_i('The best delivery companies')}}</figure></div>
        <div class="fastest-delivery owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage"
                     style="transform: translate3d(452px, 0px, 0px); transition: all 3s ease 0s; width: 1582px;">
                    @foreach ($shippingcompanies as $comp)
                    <div class="owl-item" style="width: 206px; margin-left: 20px;">
                        <div class="single-brand  text-center d-flex flex-column">
                            <div class="thumbnail">
                                <a href=""><img
                                        src="{{ asset('uploads/settings/shippingCompany/'.$comp->logo) }}"
                                        alt=""></a>
                            </div>
                            <h4>{{ $comp->title }}</h4>
                            <a href="">(+2) 01003329948</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!----- end best companies section --------------------------------->

@endsection
