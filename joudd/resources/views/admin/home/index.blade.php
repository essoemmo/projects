

@extends('admin.layout.layout')

@section('title')
    {{_i('index')}}
@endsection

@section('content')


    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$trainers}}</h3>

                        <p>{{_i('Trainers')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{url('/admin/trainer/all')}}" class="small-box-footer">{{_i('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        {{--<h3>53<sup style="font-size: 20px">%</sup></h3>--}}
                        <h3>{{$courses}}</h3>
                        <p>{{_i('Courses')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion-document-text"></i>
                    </div>
                    <a href="{{url('/admin/course/all')}}" class="small-box-footer">{{_i('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
{{--                        <h3>{{$employees}}</h3>--}}

                        <p>{{_i('Employees')}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{url('/admin/employees')}}" class="small-box-footer">{{_i('More info')}} <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->






            <!-- ./col -->
        </div>
        <!-- /.row -->

    </section>




@endsection
@section('footer')



@endsection
