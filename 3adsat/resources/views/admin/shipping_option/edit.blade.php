@extends('admin.layout.index',[
'title' => _i('Edit Shipping Option'),
'subtitle' => _i('Edit Shipping Option'),
'activePageName' => _i('Edit Shipping Option'),
'additionalPageUrl' => url('/admin/panel/shipping_option') ,
'additionalPageName' => _i('All'),
] )


@section('content')

    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">{{ _i('Edit Shipping Option') }}</h5>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{--                        @include('admin.layouts.message')--}}
                <form role="form" action="{{route('shipping_option.update',$shipping_option->id)}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="card-body">

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="company_id">
                                {{_i('Shipping Company')}} </label>
                            {!! Form::select('company_id',$companies,$shipping_option->company_id,['class'=>'form-control','required'=>'','placeholder'=>_i('Choose Shipping Company')]) !!}
                            @if ($errors->has('company_id'))
                                <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('company_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="country">
                                {{_i('Country')}} </label>
                            <select name="country" id="country" class="form-control countries" required="">
                                <option value="">{{_i('Choose Country')}}</option>
                                @foreach($countries as $country)
                                    <option @if($shipping_option->country_id == $country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('country') }}</strong>
                            </span>
                            @endif
                        </div>

{{--                        @dd(getCities($shipping_option->country_id))--}}

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="city">
                                {{_i('City')}} </label>
                            <select name="cities[]" id="city" class="select2 cities form-control" required="" multiple>
                                @foreach(getCities($shipping_option->country_id) as $city)
                                    <option @if(count($cities_shipping) >0) @foreach($cities_shipping as $city_shipping) @if($city_shipping->city_id == $city->id) selected @endif @endforeach @endif value="{{$city->id}}">{{$city->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cities'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('cities') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="shipping_type">
                                {{_i('Shipping Type')}} </label>
                            <select class="selectpicker shipping_type form-control" name="shipping_type" style="width: 100%" required="">
                                <option value="">{{ _i('Choose Shipping Type') }}</option>
                                <option value="constant">{{ _i('Shipping Type') }} : {{ _i('Fixed') }} </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="cost">
                                {{_i('Shipping Cost')}} </label>
                            <input type="text" name="cost" id="shipping_company_cost_1" value="{{ $shipping_option->cost }}" class="form-control required shipping_cost _parseArabicNumbers" placeholder="{{ _i('Shipping Cost') }}" aria-required="true">
                            @if ($errors->has('cost'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('cost') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="delay">
                                {{_i('Shipping Delay')}} </label>
                            <input type="text" name="delay" id="duration_1" value="{{ $shipping_option->delay }}" class="form-control required shipping_cost" placeholder="{{ _i('Shipping time (e.g. 3-5 days)') }}" aria-required="true">
                            @if ($errors->has('delay'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('delay') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="delay">
                                {{_i('Cash On Delivery')}} </label>
                            <select class="DeliveryCash selectpicker form-control" id="cod_enable_1" style="width: 100%" onchange="setCodCost()" required="">
                                <option value="0" selected="selected">{{ _i('Cash On Delivery ?') }}</option>
                                <option value="1">{{_i('Cash On Delivery') }} :  {{ _i('Available') }}</option>
                                <option value="1">{{_i('Cash On Delivery') }} :  {{ _i('Not Available') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-2 exampleInputEmail1" for="cash_delivery_commission">
                                {{_i('Cash Delivery Commission')}} </label>
                            <input type="text" id="cod_cost_1" name="cash_delivery_commission" value="{{ $shipping_option->cash_delivery_commission }}" class="form-control _parseArabicNumbers" placeholder="{{_i('Cash Delivery Commission')}}">
                            @if ($errors->has('cash_delivery_commission'))
                                <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('cash_delivery_commission') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> {{ _i('save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (left) -->

    </div>


@endsection

@push('js')
    <script>
        $(document).ready(function () {
            {{--var country = '{{$shipping_option->country_id}}';--}}
            {{--var id = '{{$shipping_option->id}}';--}}
            {{--if (country){--}}
            {{--    $.ajax({--}}
            {{--        url:'{{ url('/admin/panel/getShippingOptions') }}',--}}
            {{--        type:'get',--}}
            {{--        data:{country: country,id: id},--}}
            {{--        success(res){--}}
            {{--            if(res){--}}
            {{--                $("#city").empty();--}}
            {{--                $.each(res[0],function(key,value){--}}
            {{--                    $("#city").append('<option value="'+key+'">'+value+'</option>');--}}
            {{--                });--}}

            {{--            }else{--}}
            {{--                $("#city").empty();--}}
            {{--            }--}}
            {{--        }--}}
            {{--    })--}}
            {{--}--}}
            $('.countries').on('change',function () {
                country = $('.countries').val();
                if (this){
                    $.ajax({
                        url:'{{ url('/admin/panel/getcities') }}',
                        type:'get',
                        data:{country: country},
                        success(res){
                            if(res){
                                $("#city").empty();
                                $("#city").append('<option value="">اختر المدينة</option>');
                                $.each(res,function(key,value){
                                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                                });
                                $('#city').val([1,2,3]).change();
                            }else{
                                $("#city").empty();
                            }
                        }
                    })
                }
            })
        });
        function setCodCost(){
            var DeliveryCash = $('.DeliveryCash option:selected').val();
            if (DeliveryCash == 0){
                $('#cod_cost_div_1').css({'display':'none'})
            }
            if (DeliveryCash == 1){
                $('#cod_cost_div_1').css({'display':'block'})
            }
            if (DeliveryCash == ''){
                $('#cod_cost_div_1').css({'display':'none'})
            }
        }
        $('.shipping_type').on('change',function () {
            var ShippingType = $('.shipping_type option:selected').val();
            if (ShippingType == 'constant'){
                $('#constant').css({'display':'block'})
                $('#weight').css({'display':'none'})
            }
            if (ShippingType == 'weight'){
                $('#weight').css({'display':'block'})
                $('#constant').css({'display':'none'})
            }
            if (ShippingType == ''){
                $('#weight').css({'display':'none'})
                $('#constant').css({'display':'none'})
            }
        })

        $(function () {
            'use strict'
            $('.cities').select2({
                placeholder: '{{_i('select cities')}}'
            });
        })
    </script>

@endpush
