@extends('front.layout.welcome')
@section('content')
<style>
    .bank_info
    {
        display: none ;
    }
</style>
<nav aria-label="breadcrumb" class="welcome">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../../">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="../../courses">الدورات التدريبية</a></li>
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
                    <a href="#" class="btn btn-green ">اختر طريقة الدفع</a>
                </div>
                <form class="shadow-lg" action="{{url('/course/'.$result["id"].'/pay/next')}}"  method="POST" data-parsley-validate="">

                    @csrf

                    <div class="row">
                        <!-- ===================== Discount Code =====================-->
                        <div class="col-sm-10">
                            <input type="text" class="form-control{{ $errors->has('coupon_id') ? ' is-invalid' : '' }} "
                                   id="coupon_id_1" name="coupon_id"   value="{{old('coupon_id')}}" placeholder=" كود الخصم ">
                            <input type="hidden" name="coupon_id_2" id="coupon_id_2">
                        </div>


                    </div>
                    <div class="row">
                        <!-- ===================== amount =====================-->

                        <label for="coupon_id" class="col-sm-8 control-label"> المبلغ : </label>
                        <div class="col-sm-10">

                            <input id="amount" name="amount" value="{{$result["cost"]}}" type="text" class="form-control" disabled>

                        </div>

                    </div>

                    <!-- ===================== payment method =====================-->
                    <?php $descHtml = ""; ?>
                    <div class="row">
                        <div class="col-sm-10">
                            <select class="form-control{{ $errors->has('bank_transfer') ? ' is-invalid' : '' }}" id="bank" required="" name="bank_transfer" onchange="getInfo(this)">
                                <option value="" selected disabled> حدد طريقة الدفع </option>
                                @foreach($banks  as $bankTransfer)
                                <option name="bank_transfer" value="{{$bankTransfer["id"]}}">{{$bankTransfer["title"]}}</option>
                                <?php $descHtml .= "<div class='bank_info' id='info_" . $bankTransfer["id"] . "'>" . $bankTransfer["description"] . "</div>"; ?>
                                @endforeach
                            </select>
                            <?= $descHtml ?>
                        </div>
                    </div>



                    <div class="row">
                        <!-- ===================== Transaction Id =====================-->

                        {{--<label for="transaction_id" class="col-sm-8 control-label"> رقم الإيصال : </label>--}}
                        {{--<div class="col-sm-8">--}}
                        {{--<input name="transaction_id" class="form-control" required maxlength="40" data-parsley-maxlength="40">                 </div>--}}


                        <!--================== Transaction Type =====================-->
                    <input type="hidden" name="transaction_type" value="bank_transfer">
                    <!-- ===============================Close Form==================================-->

                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="text-center my-4">
                                <button type="submit" class="btn btn-brown">التالي</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">

                <div class="">

                    <div class="course-img">
                        <a href="">
                            <img data-src="<?= \App\Http\Controllers\Front\WelcomeController::get_img($result["id"], $result["img"]) ?>" alt="" class="img-fluid lazy">

                        </a>
                        <div class="">

                            <h4 class="title mb-3"><?= $result["title"] ?> </h4>
                            <div class=""><i class="fa fa-graduation-cap"></i> <?= $result["first_name"] ?>  <?= $result["last_name"] ?> </div>
                            <div class=""><i class="fa fa-calendar-check-o"></i>  مدة الدورة : <?= $result["duration"] ?> <?= _i("days") ?></div>
                            <div class=""><i class="fa fa-clock-o"></i> تبدأ في
                                <?= $result["start_date"] ?>
                            </div>
                            <div class=""><i class="fa fa-clock-o"></i> تنتهي   في
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
<script type="text/javascript">
    var amountSave=0 ;
    $(document).ready(function () {
      amountSave=  parseFloat($("#amount").val());
        $('#coupon_id_1').change(function () {
            $.ajax({

                url: `<?= config("app.api_url") ?>/api/verify_code?discount_code=` + $('#coupon_id_1').val(),
                type: "get",
                headers: {"Authorization": "<?= request()->session()->get("access_token") ?>"},
                success: function (data) {
                    if (data.is_active==0) {
                        $('#coupon_id_1').attr('class', 'form-control');
                       var amount = parseFloat($("#amount").val());
                        
                        var perc = parseFloat(data.discount);
                        // alert(perc);
                        amount = amount * (1 - perc / 100);
                        $("#amount").val(amount);
                        $('#coupon_id_2').val(data.id);
                    } else {
                        $('#coupon_id_1').attr('class', 'form-control alert alert-danger alert-dismissible');
                        $('#coupon_id_1').val('هذا الكود قد استخدم من قبل');
                          $("#amount").val(amountSave);
                        $('#coupon_id_2').val();
                    }
                },
                fail: function () {
                    $('#coupon_id_1').attr('class', 'form-control alert alert-danger alert-dismissible');
                }
            });
        });
    });
    function getInfo(obj)
    {
        $(".bank_info").hide();
        id = ($(obj).val());
        $("#info_" + id).show();
    }
</script>

<script>
    $(document).ready(function () {
        $("#coupon_id_1").change(function () {
            var $code = $(this);
            var count = ($code.data("coupon_id") || 0) + 1;
            $code.data("coupon_id", count);
            if (count == 1)
                $code.prop("disabled", false);
            else if (count == 2)
                $code.prop("disabled", false);
            else {
                $code.prop("disabled", true);
            }
            return true;
        });
    });
</script>

@endsection


