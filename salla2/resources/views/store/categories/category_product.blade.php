@extends('store.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}"> {{_i('Home')}} </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a
                        href="{{url(app()->getLocale().'/store/categories')}}">{{_i('Categories')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Products')}} </li>
            </ol>
        </div>
    </nav>



    <div class="sections-wrapper products-wrapper common-wrapper">
        <div class="container">
            <div class="row">

                @if(count($category_products)>0)
                    @foreach($category_products as $product)
                        @php

                            if($product->currency_code == null) {
                                $currency = \App\Bll\Constants::defaultCurrency;
                            } else {
                                $currency = $product->currency_code;
                            }

                        @endphp

                        @if(\App\Bll\Utility::getTemplateCode()=="shade")
                        @include("store.categories.include.shade")
                        @else
                        @include("store.categories.include.default")
                        @endif
                    @endforeach


                @else

                    <div class="col-lg-12">
                        <div class="alert alert-danger text-center" role="alert">
                            {{_i('No Products')}}
                        </div>
                    </div>
                @endif


            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    {{$category_products->links()}}
                </ul>
            </nav>
        </div>
    </div>


@endsection
