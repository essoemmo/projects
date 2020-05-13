@extends('front.layout.index')

@section('content')

@include('front.layout.main_slider')

@foreach($content as $key => $item)

<section class="upcoming">
    <div class="container">
        <div style="display: none;!important;">
            <?= $content_trans = \App\Models\ContentSectionTranslation::where('content_section_id' , $item->id)->where('locale' ,\app()->getLocale())->first() ?>
        </div>

        <div class="section-title">
            {{strip_tags($content_trans['title'])}}
        </div>
        <div class="row">

            @if(count($item->products) > 0)
                @foreach($item->products as  $product)
                <div class="col-md-3 d-flex">
                    <div class="single-item-wrapper small-item">
                        <div class="item-img">
                            <a href="{{url('/product/'.$product['id'])}}"><img src="{{asset($product['main_image'])}}" alt="{{_i('Product Image')}}" class="img-fluid"></a>
                        </div>

                        <div class="item-details  ">
                            <h3 class="title"><a href="{{url('/product/'.$product['id'])}}">{{$product->translate(\app()->getLocale())->title}}</a></h3>
                            <p class="description">{{\Illuminate\Support\Str::limit($product->translate(\app()->getLocale())->description),20}}</p>
                            <div class="price">{{_i('from')}} {{ round($product->price * getRate(country_code())->rate) }}  {{ currency()->code }} </div>
                            <div class="buy-now">
                                <a href="javascript:void(0)" class="addcart btn btn-dark">
                                    <input type="hidden" class="product_id" value="{{ $product->id }}" name="product_id">
                                    <input type="hidden" class="max_count" value="{{ $product->quantity }}" name="max_count">
                                    {{_i('Buy Now')}}</a>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach

            @else
                @php
                    $contents = \App\Models\ContentSectionTranslation::where('content_section_id' , $item->id)->where('locale' ,\app()->getLocale())->get();
                @endphp

                <div class="row">
                    @foreach($contents as $data)
                        <div class="col-md-{{$item['columns'] / 12}}">{!! $data['content'] !!}</div>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="justify-content-end d-md-flex">
            <a href="{{url('/products')}}" class="btn btn-yellow w-25 my-3"> {{_i('Browse more')}}</a>
        </div>
    </div>
</section>

@endforeach



<section class="games-sections">
    <div class="container">
        <div class="section-title">
            {{_i('Categories')}}
        </div>
        <div class="row">

            @foreach($categories as $cat)
            <div class="col-md-3">
                <div class="single-section-wrapper">
                    <i class="fa fa-gamepad"></i>
                    <div class="item-details">
                        <h4 class="title">
                            <a href="@if(\App\Models\Category::where('parent_id', $cat['id'])->count() > 0)
                            {{url('/parent_cat/'.$cat['id'])}}
                            @else
                            {{url('/category/'.$cat['id'])}}
                            @endif">
                                {{$cat->translate(\app()->getLocale())->title}}
                            </a>
                        </h4>
                        <div class="quantity">{{\App\Models\ProductCategory::where('category_id', $cat['id'])->count()}}</div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="justify-content-end d-md-flex">
            <a href="{{url('/categories')}}" class="btn btn-yellow w-25">{{_i('Browse more')}}</a>
        </div>
    </div>
</section>

<section class="newsletter text-center mt-5">
    <div class="container">
        <h6>{{_i('Newsletter')}}</h6>
        <p>{{_i('Subscribe To receive the latest offers')}} </p>
        <form class="form-inline justify-content-center"  action="{{ route('newsLetter') }}" method="POST" data-parsley-validate="">
            @csrf

            <div class="wrapper">
                <input type="email"  name="email" class="form-control rounded-0 border-0" placeholder="{{_i('Your Email')}}" required="" >

                @if ($errors->has('email'))
                    <strong>{{ $errors->first('email') }}</strong>
                @endif
                <button type="submit" class="btn btn-dark my-1 ">{{_i('Subscribe Now')}}</button>
            </div>
        </form>
    </div>
</section>

@endsection
