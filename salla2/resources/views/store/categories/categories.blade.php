@extends('store.layout.master')

@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('store.home',app()->getLocale())}}">{{_i('Home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{_i('Categories')}}</li>
        </ol>
    </div>
</nav>

@if(\App\Bll\Utility::getTemplateCode()=="shade")
 <div class="row">

  @if(count($categories)>0)
                @foreach($categories as $category)
                <div class="col-md-6">
                                <div class="single-box">
                                    <a href="{{ url(app()->getLocale().'/store/category/' . $category->id) }}">
                                        <span class="img-wrapper">
                                        <img src="{{asset('shade/images/demo.jpg')}}" alt="" class="img-fluid">
                                        </span>
                                        <p> {{ $category->title }}</p>
                                        
                                         
                            

                                    </a>
                                </div>
                            </div>
                
                
                
                
                   
                @endforeach
            @else
                <div class="col-lg-12">
                    <div class="alert alert-danger text-center" role="alert">
                        {{_i('No Categories')}}
                    </div>
                </div>
            @endif

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{$categories->links()}}
            </ul>
        </nav>
 </div>
@else
<div class="sections-wrapper products-wrapper common-wrapper">
    <div class="container">

        <div class="row">
           
            @if(count($categories)>0)
            @foreach($categories as $category)
            <div class="col-lg-3  col-md-4 d-flex ">
                <div class="single-section text-center d-flex flex-column">

                    {{--                            <div class="product-thumbnail">--}}
                    {{--                                <a href=""><img data-src="images/product1.jpg" alt="" class="img-fluid lazy"></a>--}}
                    {{--                            </div>--}}

                    <h3 class="title"><a href="{{ url(app()->getLocale().'/store/category/' . $category->id) }}">{{ $category->title }}</a></h3>
                    <a href="{{ url(app()->getLocale().'/store/category/' . $category->id) }}" class="shop-now"> {{_i('Shop now')}} </a>

                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12">
                <div class="alert alert-danger text-center" role="alert">
                    {{_i('No Categories')}}
                </div>
            </div>
            @endif

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{$categories->links()}}
                </ul>
            </nav>
    </div>
</div>
@endif

@endsection
