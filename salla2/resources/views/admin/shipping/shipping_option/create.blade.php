@extends('admin.AdminLayout.index')

@section('title')
    {{_i('create Shipping Options')}}
@endsection

@section('page_header_name')
    {{_i('create Shipping Options')}}
@endsection


@section('content')
    @push('js')
        <script>
            $(document).ready(function () {
                'use strict'
                $('.countries').on('change', function () {
                    var country = $('.countries').val();

                    if (this) {
                        $.ajax({
                            url: '../getcities',
                            type: 'get',
                            data: {country: country},
                            success(res) {
                                console.log(res);
                                if (res) {
                                    $("#city").empty();
                                    $.each(res, function (key, value) {
                                        $("#city").append('<option value="' + key + '">' + value + '</option>');
                                    });
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
                    $('#constant').css({'display': 'block'})
                    $('#weight').css({'display': 'none'})
                }
                if (ShippingType == 'weight') {
                    $('#weight').css({'display': 'block'})
                    $('#constant').css({'display': 'none'})
                }
                if (ShippingType == '') {
                    $('#weight').css({'display': 'none'})
                    $('#constant').css({'display': 'none'})
                }
            })
            $(function () {
                'use strict'
                $('.cities').selectpicker({
                    placeholder: '{{_i('select cities')}}'
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
            <h4>{{_i('create Shipping Options')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('create Shipping Options')}}</a>
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
                {!! Form::open(['method'=>'post','url'=>'/adminpanel/shipping_option/store','data-parsley-validate'=>'']) !!}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::select('company_id',$companies,null,['class'=>'form-control','required'=>'','placeholder'=>_i('Choose a shipping representative')]) !!}
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
                                            <option value="{{$country->country_id}}">{{$country->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select name="cities[]" id="city" class="selectpicker cities form-control"
                                            required=""
                                            multiple></select>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-money" aria-hidden="false"></i></span>
                            </div>
                            <select class="form-control shipping_type" name="shipping_type" style="width: 100%"
                                    required="">
                                <option value="">اختر نوع التسعيره</option>
                                <option value="constant">نوع التسعيرة : ثابتة</option>
                                <option value="weight">نوع التسعيرة : حسب الوزن</option>
                            </select>
                        </div>
                        <div class="row" id="constant" style="display: none;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ر.س</span>
                                        </div>
                                        <input type="text" name="cost" id="shipping_company_cost_1" value=""
                                               class="form-control required shipping_cost _parseArabicNumbers"
                                               placeholder="تكلفة الشحن" aria-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="weight" style="display: none;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> التكلفة </label>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">أول </span>
                                                    <input type="text" name="no_kg" id="no_kg" value="0"
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
                                                    <input type="text" name="cost_no_kg" id="cost_no_kg" value=""
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
                                                    <input type="text" name="cost_increase" id="cost_increase" value="0"
                                                           class="form-control required _parseArabicNumbers right-border"
                                                           placeholder="تكلفة الزيادة"
                                                           style="border-right: 1px solid #eee">
                                                    <span class="input-group-addon">ر.س</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">لكل</span>
                                                    <input type="text" name="kg_increase" id="kg_increase" value="0"
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
                                    <input type="text" name="delay" id="duration_1" value=""
                                           class="form-control required shipping_cost"
                                           placeholder="مدة الشحن (مثلا ٣-٥ أيام)" aria-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-money" aria-hidden="false"></i></span>
                                </div>
                                <select class="DeliveryCash form-control" id="cod_enable_1" style="width: 100%"
                                        onchange="setCodCost()" required="">
                                    <option value="0" selected="selected">الدفع عند الاستلام ؟</option>
                                    <option value="1">الدفع عند الاستلام: متوفر</option>
                                    <option value="0">الدفع عند الاستلام: غير متوفر</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="cod_cost_div_1" style="display:none">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">ر.س</span>
                            </div>
                            <input type="text" id="cod_cost_1" name="cash_delivery_commission"
                                   class="form-control _parseArabicNumbers" placeholder="عمولة الدفع عند الاستلام">
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
