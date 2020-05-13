@extends('front.layout.app')

@section('content')

    <div class="flash-message text-center">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }}" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
    </div>


    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ _i('Applicant Results') }}</li>
            </ol>
        </div>
    </nav>


    <div class="achievements common-wrapper ">
        <div class="container">

            <div class="row">
                @foreach($competitions as $item)
                    <div class="col-md-6">
                        <div class="single-achievement d-flex align-items-center">
                            <div class="date">
                                <span>{{ date('d',strtotime( $item->start)) }}</span>
                                <span>{{ date('M',strtotime( $item->start)) }}</span>
                                <span>{{ date('Y',strtotime( $item->start)) }}</span>
                            </div>
                            <div class="media ">
                                <img data-src="{{ asset('uploads/courses/' . '/' . $item->type_id. '/' . $item->img) }}" class="align-self-center img-fluid ml-3 lazy" alt="...">
                                <div class="media-body align-self-center">
                                    <h6>
                                        <?php
                                        $top_user = DB::table('user_exams')->where('exam_id', $item->exam_id)->orderBy('score', 'desc')->first();
                                        if ($top_user !== null) {
                                            $user = \App\User::find($top_user->user_id);
                                            ?>
                                    <?= $user->first_name ?>  <?= $user->last_name ?>
                                <?php } ?>
                                        <div class="star-ratings-css small-user-rating d-inline-block">
                                            <div class="star-ratings-css-top" style="width: 0%">
                                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                            <div class="star-ratings-css-bottom">
                                                <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span></div>
                                        </div>
                                    </h6>
                                    <h5 class="mt-0 cat-name">
                                        <a class="cat-name" href="{{ url('user/quiz', $item->exam_id) }}">{{ $item->title }}</a>
                                    </h5>
                                    <p>{!! $item->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item">
                            {{$competitions->links()}}
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endsection
