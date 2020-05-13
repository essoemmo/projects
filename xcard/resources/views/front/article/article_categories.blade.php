@extends('front.layout.index')

@section('content')

    @push('css')

        <style>
            .pagination a {
                margin: 0 !important;
                border: none !important;
                color: #ffffff;
                background: #F4941C;
            }
            .pagination li.active span {
                background: #282828 !important;
                border-color: #282828 !important;
            }
        </style>

    @endpush

    <section class="items-section-wrapper">
        <div class="container">
            <div class="section-title">
                {{_i('All Blog Categories')}}
            </div>

            <div class="row">
                <div class="col-md-9 order-1 order-md-0">

                    <div class="row">

                        @if($blogCats)
                            @foreach($blogCats as $cat)
                                <div class="col-md-4 d-flex">
                                    <div class="single-item-wrapper small-item">
                                        <div class="item-details  ">
                                            <h3 class="title"><a href="{{url('articleCat/'.$cat->id)}}">{{$cat->translate(app()->getLocale())->title}}</a></h3>
                                            <div class="buy-now"><a href="{{url('articleCat/'.$cat->id)}}" class="btn btn-dark"> {{_i('Show Articles')}}</a></div>

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
                    <div class="justify-content-center d-md-flex">
                        <ul class="pagination" >
                            <li class="page-item quantity "  >
                                {{$blogCats->links()}}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection

