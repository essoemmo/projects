
@extends('admin.layout.layout')

@section('title')

    {{_i('Edit Trainer')}}

@endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
             {{_i('Edit Trainer')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/trainer/all')}}"> {{_i('All Trainers')}}</a></li>
            <li ><a href="{{url('/admin/trainer/create')}}"> {{_i('Add Trainer')}}</a></li>
            <li class="active"><a href="{{url('/admin/trainer/'.$trainer->id.'/edit')}}"> {{_i('Edit Trainer')}} {{$trainer->first_name}} {{$trainer->last_name}}</a></li>
        </ol>
    </section>


@endsection

@section('content')


    <div class="box box-info">
        <div class="box-header with-border" style="margin-bottom: 2%;">
            <h3 class="box-title"> {{_i('Trainer Form')}}</h3>
        </div>
        <!-- /.box-header -->


        <form method="POST" action="{{ url('/admin/trainer/'.$trainer->id.'/edit') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
            @csrf

            <div class="box-body">
                <!-- ============================================= First Name ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' First Name :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{$trainer->first_name}}"  placeholder=" First Name" required="">

                        @if ($errors->has('first_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!-- ============================================= Last Name ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Last Name :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{$trainer->last_name}}" placeholder=" Last Name" required="">

                        @if ($errors->has('last_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!-- ============================================= Email ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Email :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$trainer->email}}" placeholder="{{ _i('Email') }}" required="">

                        @if ($errors->has('email'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!-- ============================================= Last Name ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Mobile :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{$trainer->mobile}}" placeholder=" Mobile" required="">

                        @if ($errors->has('mobile'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!-- ============================================= gender ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i(' Gender :')}}</label>

                    <!-- Printing Genders -->
                    <div class="col-xs-6">

                        <input class="form-check-input"  required type="radio"  name="gender" id="optionsRadios1"
                               value="Male"{{$trainer->gender == 'Male'? 'checked' : ''}} >
                        <label  class="form-check-label" for="optionsRadios"> {{_i('Male')}} </label>

                        <input class="form-check-input"  required type="radio"  name="gender" id="optionsRadios2"
                               value="Female"{{$trainer->gender == 'Female'? 'checked' : ''}}>
                        <label  class="form-check-label" for="optionsRadios2"> {{_i('Female')}} </label>

                    </div>
                    @if ($errors->has('is_active'))
                        <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('is_active') }}</strong>
                        </span>
                    @endif

                </div>

                <!-- ============================================= Skills ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Skills :') }}</label>

                    <div class="col-xs-6">

                       <textarea id="name" class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills"   >{{$trainer->skills}}</textarea>

                        @if ($errors->has('skills'))
                            <span class="text-danger invalid-feedback" role="alert">
                                <strong>{{ $errors->first('skills') }}</strong>
                            </span>
                        @endif


                    </div>


                </div>

                <!-- ============================================= Is Active ============================= -->
                <div class="form-group row">

                    <label for="gender" class="col-xs-4 control-label">{{_i(' Is Active :')}}</label>

                    <!-- Printing Genders -->
                    <div class="col-xs-6">

                        <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="1"{{$trainer->is_active == 1 ? 'checked' : ''}} >
                        <label  class="form-check-label" for="type" > {{_i('Active ')}} </label>

                        <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="0"{{$trainer->is_active == 0 ? 'checked' : ''}}>
                        <label  class="form-check-label" for="ype"> {{_i('Not Active ')}} </label>

                    </div>
                    @if ($errors->has('is_active'))
                        <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('is_active') }}</strong>
                        </span>
                    @endif

                </div>

                <!-- ============================================= created_at as hiring date ============================= -->

                <div class="form-group row">

                    <label for="hiring_date" class="col-xs-4 control-label" >{{ _i('Date of hiring :') }}</label>

                    <div class="col-xs-6">
                        <input id="hiring_date" class="form-control{{ $errors->has('created_at') ? ' is-invalid' : '' }}" placeholder="Date of Hiring"  required=""
                               type="date"   data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" name="created_at" value="{{date('Y-m-d', strtotime($trainer->created_at))}}" >

                        @if ($errors->has('created_at'))
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('created_at') }}</strong>
                                                </span>
                        @endif

                    </div>
                </div>


            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                {{--<button type="submit" class="btn btn-default">Cancel</button>--}}
                <button type="submit" class="btn btn-info "> {{ _i(' Save') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>






@endsection






@section('footer')

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })

    </script>



@endsection