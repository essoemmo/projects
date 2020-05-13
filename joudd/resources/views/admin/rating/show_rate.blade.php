@extends('admin.layout.layout')
@section('title')
    {{_i('Show Review')}}
@endsection

@section('header')

@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Show Review')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/rating/all')}}"> {{_i('All Ratings')}}</a></li>
            <li class="active"><a href="#"> {{_i('Show Review')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')


    @push('css')
        <style>
            .star-ratings-css {
                unicode-bidi: bidi-override;
                color: #c5c5c5;
                font-size: 25px;
                height: 25px;
                width: 100px;
                margin: 0 auto;
                position: relative;
                padding: 0;
                text-shadow: 0px 1px 0 #a2a2a2;
            }
            .star-ratings-css-top {
                color: #106E9F;
                padding: 0;
                position: absolute;
                z-index: 1;
                display: block;
                top: 0;
                right: 0;
                overflow: hidden;
            }
            .star-ratings-css-bottom {
                padding: 0;
                display: block;
                z-index: 0;
            }
            .star-ratings-sprite {
                background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                font-size: 0;
                height: 21px;
                line-height: 0;
                overflow: hidden;
                text-indent: -999em;
                width: 110px;
                margin: 0 auto;
            }
            .star-ratings-sprite-rating {
                background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
                background-position: 0 100%;
                float: left;
                height: 21px;
                display: block;
            }

        </style>
    @endpush


    <div class="box box-info">

        <!-- /.box-header -->
        <div class="box-body" >

            <form method="get" action="" class="form-horizontal" id="demo-form" enctype="multipart/form-data" data-parsley-validate="">

                @csrf


              <div class="container" >

                  <h3 class="box-title"> {{$course->title}} </h3>

                  <div class="form-group"> </div>

                  <div class="row" style="border: 1px solid #0AAACE; border-radius: 8px; padding: 20px; margin-left: 1.5rem !important; display: block;">
                      <h3 class="box-title"> {{_i('User Information')}} </h3>
                      <!-- ============================================= Title ============================= -->
                      <div class=" form-group">
                          <label for="name" class="col-xs-2 control-label">{{ _i('First Name') }}</label>
                          <label class="col-xs-4 control-label"> {{$user->first_name}}</label>

                          <label for="name" class="col-xs-2 control-label">{{ _i('Last Name') }}</label>
                          <label class="col-xs-4 control-label"> {{$user->last_name}}</label>
                      </div>

                      <!-- ============================================= Title ============================= -->
                      <div class=" form-group">
                          <label for="name" class="col-xs-2 control-label">{{ _i('Email') }}</label>
                          <label class="col-xs-4 control-label"> {{$user->email}}</label>

                          <label for="name" class="col-xs-2 control-label">{{ _i('Country') }}</label>
                          <label class="col-xs-4 control-label"> {{\App\Models\Countries::where('id' , \App\Hr\Course\Applicant::where('user_id' , $user->id)->first()->country_id)->first()->title}}</label>
                      </div>
                        <!-- ============================================= Title ============================= -->
                      <div class=" form-group">
                          <label for="name" class="col-xs-2 control-label"></label>
                          <a class="col-xs-6 control-label" href="{{route('info_applicant',  ['id'=>$user->id] )}}" target="_blank"> {{_i('Click Here For User Profile')}}</a>
                      </div>

                  </div>
 <!---- ====================================  section 2 ================================ --->

                  <br />

                  <div class="row" style="border: 1px solid #0AAACE; border-radius: 8px; padding: 20px; margin-left: 1.5rem !important; display: block;">
                      <h3 class="box-title"> {{_i('Review')}} </h3>
                      <!-- ============================================= Title ============================= -->
                      <div class=" form-group">
                          <label for="name" class="col-xs-1 control-label">

                              <div class="star-ratings-css">
                                  <div class="star-ratings-css-top" style="width: {{$rate_value}}%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                                  <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                              </div>

                          </label>


                      </div>

                      <!-- ============================================= Title ============================= -->
                      <div class=" form-group">
                          <label for="name" class="col-xs-2 control-label">{{ _i('Comment') }}</label>
                          <label class="col-xs-9 control-label"> {{$user_rate->comment}}</label>
                      </div>


                  </div>

              </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('/admin/rating/approve/').'/'.$user_rate->id.'/'.$user->id }}">
                        <button type="button" class="btn btn-info" >{{_i('Publish')}}</button>
                    </a>
                    <a href="{{url('admin/rating/'.$user_rate->id.'/delete/'.$user->id)}}">
                        <button type="button" class="btn btn-danger" > <i class="fa fa-trash"></i>{{_i('Delete')}}</button>
                    </a>
                </div>
                <!-- /.box-footer -->

            </form>
        </div>






    </div>


@endsection

@push('js')


@endpush
