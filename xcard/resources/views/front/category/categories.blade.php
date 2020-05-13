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
               {{_i('Categories')}}
            </div>



 <!--------------
                    <div class="showing-results-and-sorting d-md-flex justify-content-md-between text-center mb-3">
                        <div class="sorting">
{{--                            {{ _i('Sort By') }}--}}
{{--                            <select name="sort_by" class="form-control rounded-0 sortBy">--}}
{{--                                <option disabled selected>{{ _i('Select') }}</option>--}}
{{--                                <option value="ASC">{{ _i('Newest') }}</option>--}}
{{--                                <option value="DESC">{{ _i('Oldest') }}</option>--}}
{{--                                <option value="price_desc">{{ _i('Lowest Price') }}</option>--}}
{{--                            </select>--}}
                        </div>
                        <div class="showing-results">
                            {{ _i('Number Of Results Found') }} :
                            <span> {{ count($categories) }} {{ _i('Results') }}</span>
                        </div>
                    </div>

-------------------------->
                    <div class="row">

                    @if($categories)
                            @foreach($categories as $cat)

                            @if(\App\Models\Category::where('parent_id', $cat['id'])->count() > 0)

                                <div class="col-md-3 d-flex">
                                    <div class="single-item-wrapper small-item">
{{--                                        <div class="item-img">--}}
{{--                                            <a href=""><img src="{{asset('front/images/maxresdefault.png')}}" alt="" class="img-fluid"></a>--}}
{{--                                        </div>--}}
                                        <div class="item-details  ">
                                            <h3 class="title"><a href="{{url('/parent_cat/'.$cat['id'])}}">{{$cat->translate(\app()->getLocale())->title}}</a></h3>
                                            <p class="description">{{\Illuminate\Support\Str::limit($cat->translate(\app()->getLocale())->description , 20)}}</p>
                                            <div class="buy-now"><a href="{{url('/parent_cat/'.$cat['id'])}}" class="btn btn-dark"> {{_i('Show Details')}}</a></div>

                                        </div>
                                    </div>
                                </div>

                            @else
                            <!----------------------------------------- if category is parent ------------------------------------------------------------>
                                <div class="col-md-3 d-flex">
                                    <div class="single-item-wrapper small-item">
{{--                                        <div class="item-img">--}}
{{--                                            <a href=""><img src="{{asset('front/images/maxresdefault.png')}}" alt="" class="img-fluid"></a>--}}
{{--                                        </div>--}}
                                        <div class="item-details  ">
                                            <h3 class="title"><a href="{{url('/category/'.$cat['id'])}}">{{$cat->translate(\app()->getLocale())->title}}</a></h3>
                                            <p class="description">{{\Illuminate\Support\Str::limit($cat->translate(\app()->getLocale())->description , 20)}}</p>
                                            <div class="buy-now"><a href="{{url('/category/'.$cat['id'])}}" class="btn btn-dark"> {{_i('Show Details')}}</a></div>

                                        </div>
                                    </div>
                                </div>

                            @endif

                        @endforeach

                    @else
                            <div class="col-md-12">
                                <div class="alert alert-danger text-center">
                                    {{ _i('No Categories') }}
                                </div>
                            </div>
                    @endif

                    </div>
                    <div class="justify-content-center d-md-flex">
                            <ul class="pagination" >
                                <li class="page-item quantity "  >
                                      {{$categories->links()}}
                                </li>
                            </ul>
                    </div>



                <!---------
{{--                <div class="col-md-3 order-0 order-md-1">--}}
{{--                    <div class="sidebar">--}}
{{--                        <div class="sidebar-box advances-search">--}}
{{--                            <div class="title">{{ _i('Advanced Search') }}</div>--}}
{{--                            <div class="box-wrapper">--}}
{{--                                @include('front.layout.advSearch')--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="sidebar-box">--}}
{{--                            <div class="title">{{_i('Coming Games')}}</div>--}}

{{--                            @include('front.layout.ComingProducts')--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                -------->

            </div>


    </section>

@endsection

