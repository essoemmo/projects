@extends('front.layout.welcome')



@section('content')

<nav aria-label="breadcrumb" class="welcome">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../">{{ _i('Home') }}</a></li>
            <li class="breadcrumb-item"><a href="../../courses">{{ _i('Courses') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $result["title"] ?></li>
        </ol>
    </div>
</nav>

@include('layouts.message')

<section class="register-form common-wrapper ">
<!--<section class="contact-page common-wrapper">-->
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="center">

                    <a href="#" class="btn btn-green "> {{ _i('Payment Details') }}  </a>
                </div>

                <form class="shadow-lg" action="{{url('/course/'.$result["id"].'/pay')}}"  method="POST" data-parsley-validate="" enctype="multipart/form-data" data-parsley-validate="">

                    @csrf

                    <div class="row">
                        <!-- ===================== holder name =====================-->
                        <div class="col-sm-10">
                            <input type="text" class="form-control{{ $errors->has('holder_name') ? ' is-invalid' : '' }} "maxlength="70" data-parsley-maxlength="70"
                                   id="holder_name" name="holder_name"   required="" value="{{old('holder_name')}}" placeholder="{{ _i('Holder Name') }}">
                        </div>

                    </div>
                    <div class="row"><img class="img-responsive pad" id="course_img" hidden style="margin-top: -250px">
                        <!-- ===================== transaction_id =====================-->
                        <div class="col-sm-10">
                            <input id="transaction_id" name="transaction_id" value="{{old('transaction_id')}}" type="number" class="form-control"
                                    placeholder="{{ _i('holder Number') }}">
                        </div>
                        <!-- ===================== file =====================-->
                        <div class="col-sm-10">
                            {{--<input id="transaction_id" name="transaction_id" value="{{old('transaction_id')}}" type="number" class="form-control"--}}
                                   {{--placeholder="رقم الحوالة">--}}
                            <input type='file' onchange="readURL(this);" name="file"/>
                            <img id="blah" src="#" alt="your image" />
                        </div>

                    </div>


                    <!----================ input hidden===================----->
                    <input type="hidden" value="{{$request["coupon_id"]}}" name="coupon_id">
                    <input type="hidden" value="{{$request["coupon_id_2"]}}" name="coupon_id_2">
                    <input type="hidden" value="{{$request["bank_transfer"]}}" name="bank_transfer">
                    <input type="hidden" value="{{$request["transaction_type"]}}" name="transaction_type">



                    <div class="row">
                         <div class="col-sm-8">
                         <div class="text-center my-4">
                             <button type="submit" class="btn btn-brown"> {{ _i('Save') }} </button>
                          </div>
                         </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">

                <div class="">

                    <div class="course-img">
                        <a href="">
              <img data-src="<?= \App\Http\Controllers\Front\WelcomeController::get_img( $result["id"],  $result["img"])?>" alt="" class="img-fluid lazy">

                        </a>
                        <div class="">

                            <h4 class="title mb-3"><?= $result["title"] ?> </h4>
                            <div class=""><i class="fa fa-graduation-cap"></i> <?= $result["first_name"] ?>  <?= $result["last_name"] ?> </div>
                            <div class=""><i class="fa fa-calendar-check-o"></i>  {{ _i('Course Duration') }} : <?= $result["duration"] ?> <?= _i("days") ?></div>
                            <div class=""><i class="fa fa-clock-o"></i>{{ _i('start Data') }}
                                <?= $result["start_date"] ?>
                            </div>
                            <div class=""><i class="fa fa-clock-o"></i> {{ _i('End date') }}
                                <?= $result["end_date"] ?>
                            </div>
                            <div class=""><i class="fa fa-dollar"></i>
                                <?= $result["cost"] ?> ريال سعودي
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                            .attr('src', e.target.result)
                            .width(200)
                            .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection


