
@extends('admin.layout.index',[
'title' => _i('Show Review'),
'subtitle' => _i('Show Review'),
'activePageName' => _i('Show Review'),
'additionalPageUrl' => url('/admin/panel/rating/all') ,
'additionalPageName' => _i('All'),
] )

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

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/panel/rating/all')}}" class="btn btn-default"><i class="ti-arrow-left"></i>{{ _i('Back') }}</a></li>

                            <li class="breadcrumb-item">
                                <a href="{{ url('/admin/panel/rating/approve/').'/'.$user_rate->id.'/'.$user->id }}" class="btn btn-primary">
                                  <i class="icofont icofont-check-circled"></i>  {{ _i('Publish') }}
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                <a href="{{url('admin/panel/rating/'.$user_rate->id.'/delete/'.$user->id)}}" >
                                    <button type="button" class="btn btn-danger">  <i class="fa fa-trash"></i>
                                       <i class="ti-trash"></i> {{ _i('Delete') }}
                                    </button>
                                </a>
                            </li>

                        </ol>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12" style=" background: white;">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h5 class="card-title">{{ _i('Show Review') }}</h5>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <h3 class="box-title"> {{$product_description['name']}} </h3>

                                <div class="row" style="border: 1px solid #0AAACE; border-radius: 8px; padding: 20px; margin-left: 1.5rem !important; display: block;">
                                    <h3 class="box-title"> {{_i('User Information')}} </h3>
                                    <!-- ============================================= Title ============================= -->
                                    <div class=" form-group">

                                        <label for="name" class="col-sm-2 control-label">{{ _i('Name') }}</label>
                                        <label class="col-sm-4 control-label"> {{$user->name}}</label>
                                    </div>

                                    <!-- ============================================= Title ============================= -->
                                    <div class=" form-group">
                                        <label for="name" class="col-sm-2 control-label">{{ _i('Email') }}</label>
                                        <label class="col-sm-4 control-label"> {{$user->email}}</label>

{{--                                        <label for="name" class="col-xs-2 control-label">{{ _i('Country') }}</label>--}}
{{--                                        <label class="col-xs-4 control-label"> {{\App\Models\Countries::where('id' , \App\Hr\Course\Applicant::where('user_id' , $user->id)->first()->country_id)->first()->title}}</label>--}}
                                    </div>
                                    <!-- ============================================= Title ============================= -->
                                    <div class=" form-group">
                                        <label for="name" class="col-sm-2 control-label"></label>
                                        <a class="col-xs-6 control-label" href="{{url('admin/panel/users/'.$user->id.'/edit')}}" target="_blank"> {{_i('Click Here For User Profile')}}</a>
                                    </div>

                                </div>

                            </div>


                        </div>

                        <!---- ====================================  section 2 ================================ --->
                        <div class="box-body" style=" background: white;
                         box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); padding: 20px;">
                            <div class="row" style="border: 1px solid #0AAACE; border-radius: 8px; padding: 20px; margin-left: 1.5rem !important; display: block; background: white;">
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
                                    <label for="name" class="col-sm-2 control-label">{{ _i('Comment') }}</label>
                                    <label class="col-sm-9 control-label"> {{$user_rate->comment}}</label>
                                </div>


                            </div>

                        </div>
                        <!-- /.card -->


                    </div>

                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

@endsection

@push('js')


@endpush
