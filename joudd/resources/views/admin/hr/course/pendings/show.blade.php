@extends('admin.layout.layout')

@section('title')

    {{_i('All Applicant Courses Pending')}}

@endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Applicant Courses Pending')}}
            {{--<small>Control panel</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/course/all')}}"> {{_i('All')}}</a></li>
        </ol>
    </section>


@endsection

@section('content')


    <div class="box box-info">
        <div class="box-header with-border">
            {{--<h3 class="box-title"> Course Form</h3>--}}
        </div>
        <!-- /.box-header -->


        <form method="POST" action="{{ url('/admin/course/applicant/pending/'.$pending->id.'/approve') }}" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">
            @csrf
            <div class="box-body">
                <!-- ============================================= Title ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i('Applicant Name :') }}</label>

                    {{--<div class="col-xs-5">--}}
                        <label for="name" class="col-xs-4 control-label" >{{$query->first_name}} {{$query->last_name}}</label>
                        {{--<input type="text" class="form-control--}}{{-- {{ $errors->has('title') ? ' is-invalid' : '' }}--}}{{--" name="title" value="{{$query->first_name}} {{$query->last_name}}" placeholder=" Title" required="">--}}
                        {{--@if ($errors->has('title'))--}}
                            {{--<span class="text-danger invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('title') }}</strong>--}}
                    {{--</span>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                </div>

                <!-- ============================================= course name ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label"> {{_i('Course Name :')}} </label>
                    <label for="name" class="col-xs-4 control-label"> {{$query->title}} </label>
                </div>

                <!-- ============================================= course cost ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i(' Cost :') }} :</label>
                    <label for="name" class="col-xs-4 control-label">{{ ($query->cost) }}</label>
                </div>

                <!-- ============================================= coupon code ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i('Code') }} :</label>
                    <label for="name" class="col-xs-4 control-label">{{ ($query->code) }}</label>
                </div>

                <!-- ============================================= course amount ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Amount')}} :</label>
                    <label for="gender" class="col-xs-4 control-label">{{($amount)}}</label>

                </div>
                <!-- ============================================= course Discount ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Discount :')}}</label>
                    <label for="gender" class="col-xs-4 control-label">{{($query->discount)}}</label>

                </div>
                <!-- ============================================= Is Active ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Status')}} :</label>
                    <label for="gender" class="col-xs-4 control-label">{{($query->is_paid)==1 ? 'Paid': 'Not Paid'}}</label>

                </div>
                <!-- ============================================= Transaction id ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Transaction Id')}} :</label>
                    <label for="gender" class="col-xs-4 control-label">{{($query->transaction_id)}}</label>

                </div>
                <!-- ============================================= Transaction type ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Transaction Type :')}}</label>
                    <label for="gender" class="col-xs-4 control-label">{{($query->transaction_type)}}</label>
                </div>
                <!-- ============================================= Country Name ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Country Name :')}}</label>
                    <label for="gender" class="col-xs-4 control-label">{{($query->country_name)}}</label>
                </div>
                <!-- ============================================= Created ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i('Created Time :')}}</label>
                    <label for="gender" class="col-xs-4 control-label">{{($query->created)}}</label>
                </div>


            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
                <button type="submit" class="btn btn-info "> {{ _i('Approve') }}</button>

                <td>
                    <a href="{{url('/admin/course/applicant/pending/'.$pending->id.'/delete')}}" class="btn btn-danger" >
                        {{_i('Delete')}}
                    </a>

                </td>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>



@endsection



@section('footer')



@endsection
