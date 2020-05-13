



@extends('admin.layout.layout')

@section('title')

{{_i('Edit Applicant')}} {{$applicant->user->first_name}} {{$applicant->user->last_name}}

@endsection



@section('header')



@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Applicant')}} {{$applicant->user->first_name}} {{$applicant->user->last_name}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>  {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/course/applicant/all')}}">  {{_i('Applicants')}}</a></li>
            <li class="active"><a href="{{url('/admin/course/applicant/'.$applicant->id.'/edit')}}">  {{_i('Edit Applicant')}} {{$applicant->user->first_name}} {{ $applicant->user->last_name }}</a></li>
        </ol>
    </section>


@endsection

@section('content')


    <div class="box box-info">

        <form method="POST" action="{{ url('/admin/course/applicant/'.$applicant->id.'/edit') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
            @csrf

            <div class="box-body">
                <!-- ============================================= First Name ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' First Name :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{$applicant->user->first_name}}"  placeholder=" First Name" required="">

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
                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{$applicant->user->last_name}}"  placeholder=" Last Name" required="">

                        @if ($errors->has('last_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!--=============================== Personal ID ====================================-->
                <div class="form-group {{ $errors->has('personal_id') ? ' has-error' : '' }}">
                    <label for="name" class="col-xs-4 control-label">{{_i('Personal ID :')}}</label>
                    <div class="col-xs-6">
                        <input type="number" maxlength="20" data-parsley-maxlength="20" required="" name="personal_id"
                               class="form-control" placeholder="{{ _i('Personal ID')}}" value="{{$applicant->personal_id}}">
                        @if($errors->has('personal_id'))
                            <strong>{{$errors->first('personal_id')}}</strong>
                        @endif
                    </div>

                </div>

                <!-- ============================================= Mobile ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Mobile :') }}</label>

                    <div class="col-xs-6">
                        <input  class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{$applicant->user->mobile}}"  placeholder=" Mobile" required="">

                        @if ($errors->has('mobile'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <!-- ============================================= E-mail============================= -->
                <div class="form-group">
                    <label for="email" class="col-xs-4 control-label">{{ _i(' E-Mail:') }}</label>

                    <div class="col-xs-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$applicant->user->email}}" placeholder=" Email" required="">

                        @if ($errors->has('email'))
                            <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('email') }}</strong>
                         </span>
                        @endif
                    </div>
                </div>

                <!-- ======================================== Password ================================-->

                <div class="form-group">
                    <label for="password" class="col-xs-4 control-label">{{ _i('Password :') }}</label>

                    <div class="col-xs-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder=" Password" >

                        @if ($errors->has('password'))
                            <span class="text-danger invalid-feedback" role="alert">
                               <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-xs-4 control-label">{{ _i('Confirm Password :') }}</label>

                    <div class="col-xs-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder=" Confirm Password" >
                    </div>
                </div>


                <!--========================================== Birth date =======================================-->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label"> {{_i(' Birth Date :')}} </label>

                    <div class="col-xs-6">
                        <input type="date" name="dob" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{$applicant->dob}}" required="">
                        @if($errors->has('dob'))
                            <strong>{{$errors->first('dob')}}</strong>
                        @endif
                    </div>
                </div>

                <!-- ============================================= Address ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Address :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$applicant->address}}" placeholder=" Address" required="">

                        @if ($errors->has('address'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>



                <!-- ============================================= Gender============================= -->

                <div class="form-group">

                    <label for="name" class="col-xs-4 control-label" >{{ _i(' Gender :') }}</label>

                    <div class="col-xs-6">

                        <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"  name="gender">

                            <option value="0" {{$applicant->gender == 0 ? 'selected' : ''}} >  {{_i('Male')}} </option>
                            <option value="1" {{$applicant->gender == 1 ? 'selected' : ''}} >  {{_i('Female')}} </option>


                            @if ($errors->has('gender'))
                                <span class="text-danger invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </select>

                    </div>
                </div>

                <!-- ============================================= Is Active ============================= -->
                <div class="form-group row">

                <label for="gender" class="col-xs-4 control-label">{{_i(' Is Active :')}}</label>

                <div class="col-xs-6">

                <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="1"{{$applicant->user->is_active== 1 ? 'checked' : ''}} >
                <label  class="form-check-label" for="type">  {{_i('Active')}} </label>

                <input class="form-check-input"  required type="radio"  name="is_active" id="optionsRadios1" value="0"{{$applicant->user->is_active== 0 ? 'checked' : ''}}>
                <label  class="form-check-label" for="ype">  {{_i('Not Active')}} </label>

                </div>
                @if ($errors->has('is_active'))
                <span class="text-danger invalid-feedback" role="alert">
                <strong>{{ $errors->first('is_active') }}</strong>
                </span>
                @endif

                </div>



            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info "> {{ _i(' Save') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>






@endsection






@section('footer')




@endsection
