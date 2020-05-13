@extends('front.layout.inner')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url(LaravelGettext::getLocale(),'')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('All Stores')}}</li>
            </ol>
        </div>
    </nav>


    <section class="register-form custom-reg-form  ">
        <div class="container">
            <div class="row">
                @foreach($stores as $store)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mt-4">
                        <section>
                            <div class="extension-preview container_custom text-center">
                                <a href="{{request()->getScheme()}}://{{$store->domain}}.{{request()->getHost()}}/{{LaravelGettext::getLocale()}}/home">
                                    @foreach (\App\Bll\Utility::getlogsfront() as $store_id )
                                        @if($store->id == $store_id->stores_id )
                                            @if($store_id->logo != null)
                                                <img style="width: 50px; height: 50px"
                                                     src="{{ $store_id->logo }}"
                                                     class="img-fluid image"/>
                                            @else
                                                <img style="width: 50px; height: 50px"
                                                     src="{{ asset('front/images/sallatk_logo.png') }}"
                                                     class="img-fluid image"/>
                                            @endif
                                        @endif
                                    @endforeach

                                </a>
                            </div>
                            <div class="extension-name text-center">
                                <h4>
                                    <a style="font-size:30px"
                                       href="{{request()->getScheme()}}://{{$store->domain}}.{{request()->getHost()}}/{{LaravelGettext::getLocale()}}/home">
                                        {!!_i($store->title)!!}
                                    </a>
                                </h4>
                            </div>

                        </section>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
