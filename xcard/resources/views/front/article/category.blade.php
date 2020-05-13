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
                {{$cat->translate(app()->getLocale())->title}}
            </div>

            <div class="row">
                <div class="col-md-9 order-1 order-md-0">
                    @if(count($blogs)> 0)
                    <div class="row">
                        @foreach($blogs as $blog)

                            <div class="col-md-4 d-flex">
                                <div class="single-item-wrapper small-item">
                                    <div class="item-img">
                                        <a href="{{url('/article/'.$blog['id'])}}"><img src="{{asset($blog['image'])}}" alt="" class="img-fluid"></a>
                                    </div>
                                    <div class="item-details  ">
                                        <h3 class="title"><a href="{{url('/article/'.$blog['id'])}}">{{$blog->translate(app()->getLocale())->title}}</a></h3>
                                        <p class="description">{!! \Illuminate\Support\Str::limit($blog->translate(\app()->getLocale())->content , 40) !!}</p>
                                        <div class="buy-now"><a href="{{url('/article/'.$blog['id'])}}" class="btn btn-dark"> {{_i('Read More')}}</a></div>

                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    <div class="justify-content-center d-md-flex">
                        <ul class="pagination" >
                            <li class="page-item quantity "  >
                                {{$blogs->links()}}
                            </li>
                        </ul>
                    </div>
                    @else
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center" >
                                {{ _i('No Articles') }}
                            </div>
                        </div>
                    @endif


                </div>
            </div>

        </div>
    </section>

@endsection

