@extends('front.layout.index')

@section('content')

    @push('css')

        <style>
            .overlay {
                opacity: 0;
                transition: .3s ease;
                background-color: red;
            }

            .container:hover .overlay {
                opacity: 1;
            }

            .icon {
                color: white;
                font-size: 50px;
                position: absolute;
                top: 59%;
                left: 87%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                text-align: center;
            }
        </style>

    @endpush

    <section class="items-section-wrapper">
        <div class="container">
            <div class="section-title">

                {{ $product->translate(app()->getLocale())->title }}
            </div>
            <div class="single-product">
                <div class="row mb-4">
                    <div class="col-md-3 d-flex align-self-stretch">
                        <div class="single-product-main-img d-md-flex align-self-stretch">
                            <img src="{{ asset($product->main_image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="single-product-order-info d-md-flex justify-content-between bg-gray px-3 align-items-center text-center" >
                            <span>{{ _i('Price') }} : {{ round($product->price * getRate(country_code())->rate) }}  {{ currency()->code }}</span>
                            <a href="javascript:void(0)" class="addcart btn btn-white-outlined rounded-0">
                                <input type="hidden" class="product_id" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" class="max_count" value="{{ $product->quantity }}" name="max_count">
                                <i class="fa fa-shopping-basket"></i>
                                {{ _i('Add To Cart') }}
                            </a>
                            <a href="{{ route('buyNow', $product->id) }}" class="btn btn-yellow">{{ _i('Buy Now') }}</a>

                        </div>

                        <div class="single-product-gallery">
                            <ul class="d-flex mt-3 list-inline justify-content-between">
                                @if($product->video != null)
                                    <li class="list-inline-item">
                                        <a href="{{ $product->video }}" id="video" data-toggle="lightbox" data-gallery="mixedgallery">
                                            <img src="{{ asset($product->main_image) }}" class="img-fluid" alt="">
                                            <div class="overlay">
                                                <span class="icon" title="{{ _i('Video') }}">
                                                    <i class="fa fa-youtube"></i>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                                @if(count($product_files) > 0)
                                    @foreach($product_files as $image)
                                        <li class="list-inline-item">
                                            <a href="{{ asset($image->image) }}"  data-toggle="lightbox" data-gallery="mixedgallery">
                                                <img src="{{ asset($image->image) }}" alt="" class="img-fluid">
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="single-product-information bg-gray p-4">
                        {{ $product->translate(app()->getLocale())->description }}
                        @if(count($product->details) > 0)
                            <hr style="color: #fff">
                            <h3>{{ _i('Game Details') }} : </h3>
                            <ul class="list-unstyled">
                                @foreach($product->details as $item)
                                    <li class="btn btn-default">
                                        <img src="{{ url($item->image) }}" alt="{{ $item->title }}">
                                        <span>{{ $item->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(count($product->languages) > 0)
                            <hr style="color: #fff">
                            <h3>{{ _i('Languages') }} : </h3>
                            <ul class="list-unstyled">
                                @foreach($product->languages as $item)
                                    <li class="btn btn-default" style="background: rgba(0,0,0,0.1)">
                                        <span>{{ $item->translate(app()->getLocale())->title  }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(count($product->genres) > 0)
                            <hr style="color: #fff">
                            <h3>{{ _i('Genre') }} : </h3>
                            <ul class="list-unstyled">
                                @foreach($product->genres as $item)
                                    <li class="btn btn-default" style="background: rgba(0,0,0,0.1)">
                                        <span>{{ $item->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if($product->workOn != null)
                            <hr style="color: #fff">
                            <h3>{{ _i('Works On') }} : </h3>
                            <ul class="list-unstyled">
                                <li class="btn btn-default" style="background: rgba(0,0,0,0.1)">
                                    <span>{{ $product->workOn->title }}</span>
                                </li>
                            </ul>
                        @endif
                        @if($product->release_date != null && $product->developers != null && $product->publishers != null)
                            <hr style="color: #fff">
                            <div style="color: #fff">
                                @if($product->release_date != null)
                                    <div style="display: inline-block" class="ml-5">
                                        <h3 class="_20G_3k">{{ _i('Release date') }} : </h3>
                                        <p class="FpVQmt">{{ $product->release_date }}</p>
                                    </div>
                                @endif
                                @if($product->developers != null)
                                    <div style="display: inline-block" class="ml-5">
                                        <h3 class="_20G_3k">{{ _i('Developers') }}</h3>
                                        <p class="FpVQmt">{{ $product->developers }}</p>
                                    </div>
                                @endif
                                @if($product->publishers != null)
                                    <div style="display: inline-block" class="ml-5">
                                        <h3 class="_20G_3k">{{ _i('Publisher') }}</h3>
                                        <p class="FpVQmt">{{ $product->publishers }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if($product->translate(app()->getLocale())->System_requirements != null)
                            <hr style="color: #fff">
                            <div style="color: #fff;">
                                <h3>{{ _i('System requirements') }} : </h3>
                                <div>
                                    <div>
                                        <button type="button" class="btn btn-default" style="background: rgba(0,0,0,0.1);color: #fff">{{ $product->workOn->title }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4" style="color: #fff;">
                                {!! $product->translate(app()->getLocale())->System_requirements !!}
                            </div>
                        @endif
                    </div>



                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="sidebar-box rate-product">
                            <div class="title">{{ _i('Rate This Product') }}</div>
                            <div class="box-wrapper">
                                <div class="single-chart">
                                    <svg viewBox="0 0 36 36" class="circular-chart orange">
                                        <path class="circle-bg"
                                              d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
                                        />
                                        <path class="circle"
                                              stroke-dasharray="{{number_format($product_rate)}}, 100"
                                              d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831"
                                        />
                                        <text x="18" y="20.35" class="percentage">
                                            @if(number_format($product_rate) <= 100)
                                                {{number_format($product_rate)}}
                                                @else
                                               {{100}}
                                                @endif

                                        </text>
                                    </svg>
                                </div>
                                <p>{{ _i('Rating based on')." " .$product_count. " ". _i('customer reviews') }}</p>

                                <div class="rate-range">
                                    <h6>{{ _i('Rate This Product') }}</h6>
                                    <div class="range-wrapper">
                                        <input type="range" data-product="{{$product->id}}" name="rating" class="custom-range" id="customRange1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--------
{{--                        <div class="sidebar-box advances-search">--}}
{{--                            <div class="title">{{ _i('Advanced Search') }}</div>--}}
{{--                            <div class="box-wrapper">--}}
{{--                                @include('front.layout.advSearch')--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="sidebar-box">--}}
{{--                            <div class="title">{{ _i('Upcoming Games') }}</div>--}}
{{--                            @include('front.layout.ComingProducts')--}}
{{--                        </div>--}}
                        ---->

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection


@push('css')

    <style>
        .list-button {
            background: rgba(0,0,0,0.1);
            margin: 5px;
            font-weight: 700;
            font-size: 1.2rem;
            line-height: 1;
        }
    </style>

@endpush
@push('js')

    <script>
        $(function () {
            $('body').on('change','#customRange1',function (e) {
                e.preventDefault();

               var val = $(this).val();
               var productId = $(this).data('product');
                $.ajax({
                    url: '{{ route('store_product_rate') }}',
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id:productId ,
                        val:val ,
                        },
                    success: function (response) {
                        console.log(response.data.rating);
                        window.location.reload();
                    }
                });

            })
        })
    </script>
    @endpush
