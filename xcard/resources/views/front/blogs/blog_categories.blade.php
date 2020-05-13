@extends('front.layout.index')

@section('content')

    <div class="user-page">
        <div class="container">
            <div class="privacy-policy">

                <div class="section-title">{{_i('All Blog Categories')}}</div>
                <div class="bg-gray p-4 ">
                    <div class="accordion" id="accordionExample">

                        @foreach($blogCats as $cat)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <a href="{{url('blogCat/'.$cat->id)}}">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#cat{{$cat->id}}" aria-expanded="true" aria-controls="cat{{$cat->id}}">
                                            {{$cat->translate(app()->getLocale())->title}}

                                        </button>
                                    </a>
                                </h2>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>











@endsection
