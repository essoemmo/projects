@extends('admin.layout.layout') @section('title')  {{_i('Add Applicant')}} @endsection
@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Applicant')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>  {{_i('Home')}}</a></li>
            <li><a href="{{url('/admin/course/applicant/all')}}">  {{_i('Applicants')}}</a></li>
            <li class="active"><a href="{{url('/admin/course/applicant/create')}}">  {{_i('Add Applicant')}}</a></li>
        </ol>
    </section>


@endsection

@section('content')



    <div class="box box-info">

        <div class="box-header">


        </div>
        <!-- /.box-header -->


        <form method="POST" action="{{route('create_applicant')}}" class="form-horizontal" id="demo-form" data-parsley-validate="">
            @csrf

            <div class="box-body">
                <!-- ============================================= First Name ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i(' First Name :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" required maxlength="40" data-parsley-maxlength="40" name="first_name" value="{{old('first_name')}}" placeholder="{{_i('First Name')}}"> @if ($errors->has('first_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span> @endif
                    </div>
                </div>

                <!-- ============================================= Last Name ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i(' Last Name :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" maxlength="40" data-parsley-maxlength="40" name="last_name" value="{{old('last_name')}}" placeholder="{{_i('Last Name')}}" > @if ($errors->has('last_name'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <!--=============================== Personal ID ====================================-->
                <div class="form-group {{ $errors->has('personal_id') ? ' has-error' : '' }}">
                    <label for="name" class="col-xs-4 control-label">{{_i('Personal ID :')}}</label>
                    <div class="col-xs-6">
                        <input type="number" maxlength="20" data-parsley-maxlength="20" required="" name="personal_id"
                               class="form-control" placeholder="{{ _i('Personal ID')}}" value="{{old('personal_id')}}">
                        @if($errors->has('personal_id'))
                            <strong>{{$errors->first('personal_id')}}</strong>
                        @endif
                    </div>

                </div>
                <!-- ============================================= Mobile ============================= -->

                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i(' Mobile :') }}</label>

                    <div class="col-xs-6">
                        <input class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" maxlength="15" data-parsley-maxlength="15" value="{{old('mobile')}}" placeholder="{{_i('Phone')}}" required=""> @if ($errors->has('mobile'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span> @endif
                    </div>
                </div>

                <!-- ============================================= E-mail============================= -->
                <div class="form-group">
                    <label for="email" class="col-xs-4 control-label">{{ _i(' E-Mail:') }}</label>

                    <div class="col-xs-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" maxlength="40" data-parsley-maxlength="40" name="email" value="{{ old('email') }}" placeholder="{{_i('Email')}}" required=""> @if ($errors->has('email'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span> @endif
                    </div>
                </div>

                <!-- ======================================== Password ================================-->

                <div class="form-group">
                    <label for="password" class="col-xs-4 control-label">{{ _i('Password :') }}</label>

                    <div class="col-xs-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" maxlength="40" data-parsley-maxlength="40" name="password" placeholder="{{_i('Password')}}" required=""> @if ($errors->has('password'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span> @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-xs-4 control-label">{{ _i('Confirm Password :') }}</label>

                    <div class="col-xs-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="40" data-parsley-maxlength="40" placeholder="{{_i('Confirm Password')}}" required="">
                    </div>
                </div>


                <!--========================================== Birth date =======================================-->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label"> {{_i(' Birth Date :')}} </label>

                    <div class="col-xs-6">
                        <input type="date" name="dob" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" required="" value="{{old('dob')}}">
                        @if($errors->has('dob'))
                            <strong>{{$errors->first('dob')}}</strong>
                        @endif
                    </div>
                </div>

                <!-- ============================================= Address ============================= -->
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">{{ _i(' Address :') }}</label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" maxlength="40" data-parsley-maxlength="40" name="address" value="{{old('address')}}" placeholder="{{_i('Address')}}" > @if ($errors->has('address'))
                            <span class="text-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span> @endif
                    </div>
                </div>



                <!-- ============================================= Gender============================= -->

                <div class="form-group">

                    <label for="name" class="col-xs-4 control-label">{{ _i(' Gender :') }}</label>

                    <div class="col-xs-6">

                        <select class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender"  >

                            <option value="0" {{old('gender') == 0 ? 'selected' : ''}}>  {{_i('Male')}} </option>
                            <option value="1" {{old('gender') == 1 ? 'selected' : ''}}>  {{_i('Female')}} </option>


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

                        <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios1" value="1" {{old('is_active')==1?'checked':''}}>
                        <label class="form-check-label" for="type">  {{_i('Active')}} </label>

                        <input class="form-check-input" required type="radio" name="is_active" id="optionsRadios1" value="0" {{old('is_active')==0?'checked':''}}>
                        <label class="form-check-label" for="ype">  {{_i('Not Active')}} </label>

                    </div>
                    @if ($errors->has('is_active'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('is_active') }}</strong>
                </span> @endif

                </div>



            </div>
            <div class="box-body">
                <!-- ===================== Course ID  =====================-->
                <div class="form-group">

                    <label for="course_id" class="col-xs-4 control-label">{{_i('Course')}} :</label>

                    <div class="col-xs-6">
                        <select id="course_id_1" required class="form-control" name="course_id">
                            <option value>{{_i('Choose')}}</option>
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}" {{old('course_id')== $course->id ?'selected':''}}>{{$course->title}}</option>
                            @endforeach
                        </select> @if ($errors->has('course_id'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('course_id') }}</strong>
                    </span> @endif
                    </div>
                </div>
                <!-- ===================== Cost ===================== -->
                <div class="form-group">
                    <label for="cost" class="col-xs-4 control-label">{{_i('Cost')}} :</label>
                    <div class="col-xs-6">
                        <label id='cost_1' name="cost" class="col-xs-4 control-label text-green" >0</label>
                        @if($errors->has('cost'))
                            <strong>{{$errors->first('cost')}}</strong>
                        @endif
                    </div>
                </div>
                <!-- ===================== Discount Code =====================-->
                <div class="form-group">
                    <label for="coupon_id" class="col-xs-4 control-label">{{_i('Coupon ID')}} :</label>
                    <div class="col-xs-6">
                        <input id="coupon_id_1" class="form-control" maxlength="40" data-parsley-maxlength="40" >
                        <input id="coupon_id_2" type="hidden" name="coupon_id"> @if($errors->has('coupon_id'))
                            <strong>{{$errors->first('coupon_id')}}</strong> @endif
                    </div>
                </div>
                <!-- ===================== Transaction Id =====================-->
                <div class="form-group">
                    <label for="transaction_id" class="col-xs-4 control-label">{{_i('Transaction ID')}} :</label>
                    <div class="col-xs-6">
                        <input name="transaction_id" class="form-control" required maxlength="40" data-parsley-maxlength="40" value="{{old('transaction_id')}}">
                        @if($errors->has('transaction_id'))
                            <strong>{{$errors->first('transaction_id')}}</strong>
                        @endif
                    </div>
                </div>
                <!--================== Transaction Type =====================-->
                <input type="hidden" name="transaction_type" value="bank_transfer">
                <!-- ===============================Close Form==================================-->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info "> {{ _i('Save') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>






@endsection
@section('footer')
    <script>
        $(document).ready(()=>{

            $('#course_id_1').change(function() {
                $.getJSON(`{{route("get_course")}}?id=${$('#course_id_1').val()}`).done(function(data) {
                    $('#cost_1').text(data.cost);
                }).fail(function() {
                    $('#cost_1').text('Error');
                });
            });
        $('#coupon_id_1').change(function() {
            $.getJSON(`{{route("get_discount_code")}}?discount_code=${$('#coupon_id_1').val()}`).done(function(data) {
                if (!data.is_active) {
                    $('#coupon_id_1').attr('class', 'form-control');
                    $('#coupon_id_2').val(data.id);
                } else {
                    $('#coupon_id_1').attr('class', 'form-control alert alert-danger alert-dismissible');
                    $('#coupon_id_1').val('هذا الكود قد استخدم من قبل');

                }

            }).fail(function(data) {
                $('#coupon_id_1').attr('class', 'form-control alert alert-danger alert-dismissible');
            });
        });
        });

    </script>
@endsection
