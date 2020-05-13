@extends('admin.AdminLayout.index')

@section('title')
    {{_i('edit Shipping Options')}}
@endsection

@section('page_header_name')
    {{_i('edit Shipping Options')}}
@endsection


@section('content')
    @push('js')
        <script>
            $(document).ready(function () {
                'use strict';

                $('.countries').on('change', function () {
                    var country = $('.countries').val();
                    if (this) {
                        $.ajax({
                            url: '{{ url('/adminpanel/getcities') }}',
                            type: 'get',
                            data: {country: country},
                            success(res) {
                                if (res) {
                                    $("#city").empty();
                                    $("#city").append('<option value="">{{ _i('Choose City') }}</option>');
                                    $.each(res, function (key, value) {
                                        $("#city").append('<option value="' + key + '">' + value + '</option>');
                                    });
                                    // $('#city').val([1, 2, 3]).change();
                                    $('.selectpicker').selectpicker('refresh');
                                } else {
                                    $("#city").empty();
                                }
                            }
                        })
                    }
                })
            });

            function setCodCost() {
                var DeliveryCash = $('.DeliveryCash option:selected').val();
                if (DeliveryCash == 0) {
                    $('#cod_cost_div_1').css({'display': 'none'})
                }
                if (DeliveryCash == 1) {
                    $('#cod_cost_div_1').css({'display': 'block'})
                }
                if (DeliveryCash == '') {
                    $('#cod_cost_div_1').css({'display': 'none'})
                }
            }

            $('.shipping_type').on('change', function () {
                var ShippingType = $('.shipping_type option:selected').val();
                if (ShippingType == 'constant') {
                    $('#constant').css({'display': 'block'});
                    $('#weight').css({'display': 'none'});
                }
                if (ShippingType == 'weight') {
                    $('#weight').css({'display': 'block'});
                    $('#constant').css({'display': 'none'});
                }
                if (ShippingType == '') {
                    $('#weight').css({'display': 'none'});
                    $('#constant').css({'display': 'none'});
                }
            });

            $(function () {
                'use strict';
                var country = '{{$shipping_option->country->id}}';
                $.ajax({
                    url: '{{ url('/adminpanel/getcities') }}',
                    type: 'get',
                    data: {country: country},
                    success(res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option value="">{{ _i('Choose City') }}</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value = "' + key + '" > ' + value + '</option>');
                            });
                            <?php $cities = $shipping_option->cities->pluck('id')->toArray(); ?>
                            $("#city").val([{{implode( ",",$cities)}}]).change();
                            $('.selectpicker').selectpicker('refresh');
                        } else {
                            $("#city").empty();
                        }
                    }
                });

            })
        </script>

    @endpush

    @push('css2')
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">

        <style>
            .input-group-addon:first-child, .input-group-addon:last-child {
                border-color: #eee;
            }

            .input-group-addon:first-child {
                border-left: 0;
                border-right: 1px solid #ddd;
            }

            .input-group-addon {
                background: #fff;
            }

            .input-group-addon {
                padding: 7px 12px;
                font-size: 13px;
                font-weight: 400;
                line-height: 1;
                color: #333;
                border: 1px solid #ddd;
            }

            .input-group-addon, .input-group-btn {
                width: 1%;
                white-space: nowrap;
                vertical-align: middle;
            }

            .input-group .form-control, .input-group-addon, .input-group-btn {
                display: table-cell;
            }

            .bootstrap-select .dropdown-toggle .filter-option {
                text-align: right !important;
            }

            .badge, .input-group-addon, .label, .nav-justified > li > a, .pager, .progress-bar {
                text-align: center;
            }

            .input-group {
                position: relative;
                display: table;
                border-collapse: separate;
            }

            .bootstrap-select, .bootstrap-select.form-control:not([class*=col-]) {
                width: 100%;
            }

            .input-group-btn {
                position: relative;
                font-size: 0;
                white-space: nowrap;
            }

            .input-group .form-control, .input-group-addon, .input-group-btn {
                display: table-cell;
            }

            .input-group-addon:last-child {
                border-right: 0;
                border-left: 1px solid #ddd;
            }

            .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
                width: 100%;
            }
        </style>
    @endpush



    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('edit Shipping Options')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('edit Shipping Options')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.AdminLayout.message')
                {!! Form::model($shipping_option,['method'=>'put','url'=>'/adminpanel/shipping_option/'.$shipping_option->id.'/update','data-parsley-validate'=>'']) !!}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::select('company_id',$companies,$shipping_option->company_id,['class'=>'form-control','required'=>'','placeholder'=>_i('Choose a shipping representative')]) !!}
                        </div>
                    </div>
                </div>
                <div id="shipping_details" class="mt-20">
                    <div class="shipping_details_option">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select name="country" id="country" class="form-control countries" required="">
                                        <option value="">{{_i('choose country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}"
                                                    @if($country->id == $shipping_option->country_id) selected @endif>{{$country->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select name="cities[]" id="city" class="selectpicker cities form-control"
                                            required="" multiple></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-money" aria-hidden="false"></i></span>
                                </div>
                                <select class="form-control shipping_type" name="shipping_type" style="width: 100%"
                                        required="">
                                    <option value="">اختر نوع التسعيره</option>
                                    <option value="constant" @if($shipping_option->cost != null) selected @endif>نوع
                                        التسعيرة : ثابتة
                                    </option>
                                    <option value="weight" @if($shipping_option->cost == null) selected @endif>نوع
                                        التسعيرة : حسب الوزن
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="constant"
                             style=" @if($shipping_option->cost == null) display: none; @endif ">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ر.س</span>
                                        </div>
                                        <input type="text" name="cost" id="shipping_company_cost_1"
                                               value="{{$shipping_option->cost}}"
                                               class="form-control required shipping_cost _parseArabicNumbers"
                                               placeholder="تكلفة الشحن" aria-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $Shipping_types = \App\Models\Shipping\Shipping_type::where('shipping_option_id', $shipping_option->id)->first(); ?>
                        <div id="weight" style=" @if($shipping_option->cost != null) display: none; @endif ">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> التكلفة </label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">أول </span>
                                                    <input type="text" name="no_kg" id="no_kg"
                                                           value="{{$Shipping_types['no_kg']}}"
                                                           class="form-control required _parseArabicNumbers right-border"
                                                           placeholder="أول كيلو جرام"
                                                           style="border-right: 1px solid #eee">
                                                    <span class="input-group-addon">KG</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon hidden-xs"><i
                                                            class="sicon-banknote-dollar"></i></span>
                                                    <input type="text" name="cost_no_kg" id="cost_no_kg"
                                                           value="{{$Shipping_types['cost_no_kg']}}"
                                                           class="form-control required _parseArabicNumbers right-border"
                                                           placeholder="تكلفة الشحن"
                                                           style="border-right: 1px solid #eee">
                                                    <span class="input-group-addon">ر.س</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>تكلفة الزيادة</label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon hidden-xs"><i
                                                            class="sicon-banknote-dollar"></i></span>
                                                    <input type="text" name="cost_increase" id="cost_increase"
                                                           value="{{$Shipping_types['cost_increase']}}"
                                                           class="form-control required _parseArabicNumbers right-border"
                                                           placeholder="تكلفة الزيادة"
                                                           style="border-right: 1px solid #eee">
                                                    <span class="input-group-addon">ر.س</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">لكل</span>
                                                    <input type="text" name="kg_increase" id="kg_increase"
                                                           value="{{$Shipping_types['kg_increase']}}"
                                                           class="form-control required _parseArabicNumbers right-border"
                                                           placeholder="التكلفة بالوزن"
                                                           style="border-right: 1px solid #eee">
                                                    <span class="input-group-addon">KG</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" name="delay" id="duration_1" value="{{$shipping_option->delay}}"
                                           class="form-control required shipping_cost"
                                           placeholder="مدة الشحن (مثلا ٣-٥ أيام)" aria-required="true">
                                </div>
                            </div>
                        </div>
                        {{--                    cash_delivery_commission--}}
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-money" aria-hidden="false"></i></span>
                                </div>
                                <select class="DeliveryCash form-control" id="cod_enable_1" style="width: 100%"
                                        onchange="setCodCost()" required="">
                                    <option value="0" selected="selected">الدفع عند الاستلام ؟</option>
                                    <option value="1"
                                            @if($shipping_option->cash_delivery_commission != null) selected @endif>
                                        الدفع عند الاستلام: متوفر
                                    </option>
                                    <option value="0"
                                            @if($shipping_option->cash_delivery_commission == null) selected @endif>
                                        الدفع عند الاستلام: غير متوفر
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="cod_cost_div_1"
                         style=" @if($shipping_option->cash_delivery_commission == null) display:none @endif">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ر.س</span>
                            </div>
                            <input type="text" value="{{$shipping_option->cash_delivery_commission}}" id="cod_cost_1"
                                   name="cash_delivery_commission" class="form-control _parseArabicNumbers"
                                   placeholder="عمولة الدفع عند الاستلام">
                        </div>
                    </div>
                </div>
                <button type="submit" id="save_company_account" class="btn btn-primary btn-save">حفظ</button>
                {{Form::close()}}
            </div>
        </div>
    </div>

    <style>

        .input-group-prepend {
            border: 1px solid #ccc;
            line-height: 35px;
            padding: 1px 15px 0;
            background: #ccc;
            color: #fff;
            border-radius: 0 5px 5px 0;
        }

        .input-group {
            display: flex;
        }

        select {
            font-family: elmessiri-regular;
        }
    </style>



@endsection
