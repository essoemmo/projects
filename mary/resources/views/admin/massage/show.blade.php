@extends('admin.index')
@section('title', $title)
@section('css')
    <style>
        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        /* Darker chat container */
        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        /* Clear floats */
        .container::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style images */
        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        /* Style the right image */
        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }

        /* Style time text */
        .time-right {
            float: right;
            color: #aaa;
        }

        /* Style time text */
        .time-left {
            float: left;
            color: #999;
        }
    </style>

    @endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    {{--    @include('admin.layouts.message')--}}
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            <?php
            $massege = \App\Models\Message::where('id',$id)->first();

            ?>

                <div class="container">
                    <p>{{$massege->message}}</p>
{{--                    <span class="time-right">{{($massege->created_at->diffForHumans() ? $massege->created_at->diffForHumans() : '')}}</span>--}}
                </div>

            @foreach(\App\Models\Message::where('massege_id',$massege->id)->get() as $mass)
                <div class="container darker pull-left">
                    <p style="text-align: left">{{$mass->message}}</p>
                    {{--                    <span class="time-right">{{($massege->created_at->diffForHumans() ? $massege->created_at->diffForHumans() : '')}}</span>--}}
                </div>
                @endforeach

        </div>
        <!-- /.box-body -->
    </div>




@endsection

