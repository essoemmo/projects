
@extends('admin.layout.index',[
'title' => _i('Add Shipping Option'),
'subtitle' => _i('Add Shipping Option'),
'activePageName' => _i('Add Shipping Option'),
'additionalPageUrl' => url('/admin/panel/shipping_company') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
{{--                        <li class="breadcrumb-item"><a href="{{url('/admin/panel/transferBank')}}" class="btn btn-default"><i class="ti-list"></i>{{ _i('All Banks') }}</a></li>--}}

                    </ol>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">

            <div class="card-header">
                <h5 >{{ _i('add new Shipping Option') }}</h5>
                <div class="card-header-right">
                    <i class="icofont icofont-rounded-down"></i>
                    <i class="icofont icofont-refresh"></i>
                    <i class="icofont icofont-close-circled"></i>
                </div>

            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('shipping_option.store')}}" method="post" id="fileupload"  enctype="multipart/form-data" data-parsley-validate="">
                {{csrf_field()}}
                {{method_field('post')}}

                <div class="card-body card-block">

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="company_id">
                            {{_i('Shipping Company')}} </label>
                        {!! Form::select('company_id',$companies,null,['class'=>'form-control','required'=>'','placeholder'=>_i('Choose Shipping Company')]) !!}
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
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="city">
                            {{_i('City')}} </label>
                        <select name="cities[]" id="city" class="select2 cities form-control" required="" multiple>

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
                        <input type="text" name="cost" id="shipping_company_cost_1" value="" class="form-control required shipping_cost _parseArabicNumbers" placeholder="{{ _i('Shipping Cost') }}" aria-required="true">
                        @if ($errors->has('cost'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('cost') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="delay">
                            {{_i('Shipping Delay')}} </label>
                        <input type="text" name="delay" id="duration_1" value="" class="form-control required shipping_cost" placeholder="{{ _i('Shipping time (e.g. 3-5 days)') }}" aria-required="true">
                        @if ($errors->has('delay'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('delay') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="delay">
                            {{_i('Cash On Delivery')}} </label>
                        <select class="DeliveryCash selectpicker" id="cod_enable_1" style="width: 100%" onchange="setCodCost()" required="">
                            <option value="0" selected="selected">{{ _i('Cash On Delivery ?') }}</option>
                            <option value="1">{{_i('Cash On Delivery') }} :  {{ _i('Available') }}</option>
                            <option value="1">{{_i('Cash On Delivery') }} :  {{ _i('Not Available') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 exampleInputEmail1" for="cash_delivery_commission">
                            {{_i('Cash Delivery Commission')}} </label>
                        <input type="text" id="cod_cost_1" name="cash_delivery_commission" class="form-control _parseArabicNumbers" placeholder="{{_i('Cash Delivery Commission')}}">
                        @if ($errors->has('cash_delivery_commission'))
                            <span class="text-danger invalid-feedback" role="alert">
                              <strong>{{ $errors->first('cash_delivery_commission') }}</strong>
                            </span>
                        @endif
                    </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i> {{_i('Save')}}</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            'use strict'
            $('.countries').on('change',function () {
                var country = $('.countries').val();
                console.log(country)
                if (this){
                    $.ajax({
                        url:'{{ url('/admin/panel/getcities') }}',
                        type:'get',
                        data:{country: country},
                        success(res){
                            if(res){
                                $("#city").empty();
                                $.each(res,function(key,value){
                                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                                });

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
                $('#constant').css({'display':'block'});
                $('#weight').css({'display':'none'});
            }
            if (ShippingType == 'weight'){
                $('#weight').css({'display':'block'});
                $('#constant').css({'display':'none'});
            }
            if (ShippingType == ''){
                $('#weight').css({'display':'none'});
                $('#constant').css({'display':'none'});
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
