@extends('web.layout.master')

@push('css')
<style>
    select {
        display: block !important;
    }
    .nice-select {
        display: none !important;
    }
</style>
@endpush

@section('content')
<br>
@if (\Session::has('success'))
<div class="text-center alert alert-success">
    <p>{{ \Session::get('success') }}</p>
</div><br />
@endif
@if (\Session::has('failure'))
<div class="text-center alert alert-danger">
    <p>{{ \Session::get('failure') }}</p>
</div><br />
@endif
@if(count(\Cart::getContent()) > 0)
{{ Form::open(array('url' => 'saveallorders','method'=>'post','data-parsley-validate'=>'','files'=>true)) }}
<div class="container">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <!-------- first row -------------------------->
            <div class="form-group row" >
                <label class="col-md-3 col-form-label " for="country">{{_i('Country : ')}} </label>
                <div class="col-md-9">
                    <select class="form-control" id="country" name="country_id">
                        <option value="" selected disabled>{{ _i('select') }}</option>
                        @foreach($countries as $key => $country)
                        <option value="{{$country['id']}}">{{$country['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <label class="col-md-3 col-form-label " for="city">{{_i('City : ')}} </label>
                <div class="col-md-9">
                    <select class="form-control" name="city_id" id="city" required="">
                    </select>

                </div>

                <label class="col-md-3 col-form-label " for="city">{{_i('Address : ')}} </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="address" placeholder="{{_i('address')}}" name="address" required="" value="{{old('address')}}">
                    @if ($errors->has('address'))
                        <strong style="color: red;">{{ $errors->first('address') }}</strong>
                    @endif
                </div>

                <label class="col-md-3 col-form-label " for="city">{{_i('Street : ')}} </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="street" placeholder="{{_i('street')}}" name="street" required="" value="{{old('street')}}">
                    @if ($errors->has('street'))
                    <strong style="color: red;">{{ $errors->first('street') }}</strong>
                    @endif
                </div>

                <label class="col-md-3 col-form-label " for="country">{{_i('Neighborhood : ')}} </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="neighborhood" placeholder="{{_i('neighborhood')}}" name="neighborhood" required="" value="{{old('neighborhood')}}">
                    @if ($errors->has('neighborhood'))
                        <strong style="color: red;">{{ $errors->first('neighborhood') }}</strong>
                    @endif
                </div>

                <label class="col-md-3 col-form-label " for="code">{{_i('Mobile : ')}} </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="code" placeholder="{{_i('Mobile')}}" name="code" required="" value="{{old('Mobile')}}">
                    @if ($errors->has('code'))
                    <strong style="color: red;">{{ $errors->first('code') }}</strong>
                    @endif
                </div>

                <label class="col-md-3 col-form-label " for="payment">{{_i('Payment method : ')}} </label>
                <div class="col-md-9">
                    <select class="form-control"  id="payment" name="payment">
                        <option value="" selected disabled>{{ _i('select') }}</option>
                        @foreach($payments as $payment)
                        <option value="{{$payment->id}}">{{$payment->title}}</option>
                        @endforeach
                    </select>

                </div>

            </div>

            <div class="column-bank row">

            </div>

            <div class="row">
                <input type="hidden" name="user" value="{{ auth()->user()->id }}">

                <input type="hidden" name="ordernumber" value="{{ $number }}">

                @foreach(\Cart::getContent() as $item)
                {{--                        @dd(\Cart::getContent())--}}
                <input type="hidden" name="product[]" value="{{ $item->id }}">
                <input type="hidden" name="count_{{ $item->id }}" value="{{ $item->quantity }}">
                <input type="hidden" name="price_{{ $item->id }}" value="{{ $item->price }}">
                <input type="hidden" name="product_type_{{ $item->id }}" value="{{ $item->attributes->type }}">
                <input class="total_after" type="hidden" name="total" value="{{ \Cart::getTotal() }}">
                @endforeach

            <!--                --><?php //$currency = \App\Models\Settings\Currency::where('lang_id','=',getLang(session('lang')))->where('show','=',1)->value('title');  ?>


            <div class="col-3"></div>
            <div class="col-9">
                <button class="btn btn-primary col-12" type="submit">{{ _i('Next') }}</button>
            </div>
                </div>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-hover table-active">
                    <thead>
                        <tr>
                            <td><strong>{{_i('Product')}}</strong></td>
                            <td class="text-center"><strong>{{_i('Price')}}</strong></td>
                            <td class="text-center"><strong>{{_i('Quantity')}}</strong></td>
                            <td class="text-right"><strong>{{_i('Total')}}</strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- foreach ($order->lineItems as $line) or some such thing here -->

                        @foreach(\Cart::getContent() as $item)
                        <tr>
                            <td>
                                <p><strong>{{ $item->name }}</strong></p>
                                @if($item->attributes->type == 'glasses')
                                <div class="row form-group">
                                    @if($item->attributes->left_size != null)
                                    <div class="col-md-6">
                                        @if($item->attributes->right_size != null)
                                        <p>{{ _i('right size') }}  : {{ $item->attributes->right_size }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->left_size != null)
                                        <p>{{ _i('left size') }} : {{ $item->attributes->left_size }} </p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if($item->attributes->right_size != null)
                                        <p>{{ _i('size') }}  : {{ $item->attributes->right_size }} </p>
                                        @endif
                                    </div>
                                    @endif
                                    @if($item->attributes->left_cylinder != null)
                                    <div class="col-md-6">
                                        @if($item->attributes->right_cylinder != null)
                                        <p>{{ _i('right cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->left_cylinder != null)
                                        <p>{{ _i('left cylinder') }} : {{ $item->attributes->left_cylinder }} </p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if($item->attributes->right_cylinder != null)
                                        <p>{{ _i('cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                        @endif
                                    </div>
                                    @endif
                                    @if($item->attributes->left_axis != null)
                                    <div class="col-md-6">
                                        @if($item->attributes->right_axis)
                                        <p>{{ _i('right axis') }} : {{ $item->attributes->right_axis }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->left_axis)
                                        <p>{{ _i('left axis') }} : {{ $item->attributes->left_axis }} </p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if($item->attributes->right_axis)
                                        <p>{{ _i('axis') }} : {{ $item->attributes->right_axis }} </p>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        @if($item->attributes->lense_type)
                                        <p>{{ _i('Lense Type') }} : {{ $item->attributes->lense_type }} </p>
                                        @endif
                                    </div>
                                        <div class="col-md-6">
                                            @if($item->attributes->pd)
                                                <p>{{ _i('PD Value') }} : {{ $item->attributes->pd }} </p>
                                            @endif
                                        </div>
                                </div>
                                @endif
                                @if($item->attributes->type == 'lenses')
                                <div class="row form-group">
                                    @if($item->attributes->left_size != null)
                                    <div class="col-md-6">
                                        @if($item->attributes->right_size != null)
                                        <p>{{ _i('right size') }}  : {{ $item->attributes->right_size }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->left_size != null)
                                        <p>{{ _i('left size') }} : {{ $item->attributes->left_size }} </p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if($item->attributes->right_size != null)
                                        <p>{{ _i('size') }}  : {{ $item->attributes->right_size }} </p>
                                        @endif
                                    </div>
                                    @endif
                                    @if($item->attributes->left_cylinder != null)
                                    <div class="col-md-6">
                                        @if($item->attributes->right_cylinder != null)
                                        <p>{{ _i('right cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->left_cylinder != null)
                                        <p>{{ _i('left cylinder') }} : {{ $item->attributes->left_cylinder }} </p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if($item->attributes->right_cylinder != null)
                                        <p>{{ _i('cylinder') }} : {{ $item->attributes->right_cylinder }} </p>
                                        @endif
                                    </div>
                                    @endif
                                    @if($item->attributes->left_axis != null)
                                    <div class="col-md-6">
                                        @if($item->attributes->right_axis)
                                        <p>{{ _i('right axis') }} : {{ $item->attributes->right_axis }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->left_axis)
                                        <p>{{ _i('left axis') }} : {{ $item->attributes->left_axis }} </p>
                                        @endif
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if($item->attributes->right_axis)
                                        <p>{{ _i('axis') }} : {{ $item->attributes->right_axis }} </p>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        @if($item->attributes->color)
                                        <p style="display: inline-block">{{ _i('color') }} : {{ $item->attributes->color_name }}</p>
                                        <i class="fa fa-1x fa-circle" style="color: {{ $item->attributes->color->color }};display: inline-block"></i>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->auto_reorder)
                                        <p>{{ _i('auto reorder') }} : {{ $item->attributes->auto_reorder }} </p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if($item->attributes->package)
                                        <p>{{ _i('Pack of') }} : {{ $item->attributes->package }} </p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td class="text-center"><p>{{ $item->price }} {{ $item->attributes->currency }}</p></td>
                            <td class="text-center"><p>{{ $item->quantity }}</p></td>
                            <td class="text-right"><p>{{ $item->price * $item->quantity }} {{ $item->attributes->currency }}</p></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="thick-line"></td>
                            <td class="thick-line"></td>
                            <td class="thick-line text-center"><strong>{{_i('Total')}}</strong></td>
                            <td class="thick-line text-right totalBefore">{{ \Cart::getTotal() }} {{ $item->attributes->currency }}</td>
                        </tr>
                        <tr>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-center"><strong>{{_i('Shipping charges')}}</strong></td>
                            <td class="no-line text-right ship_cost">0 {{ $item->attributes->currency }}</td>
                        </tr>
                        <tr>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-center"><strong>{{_i('Total')}}</strong></td>
                            <td class="no-line text-right overAllTotal">{{ \Cart::getTotal() }} {{ $item->attributes->currency }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
{{ Form::close() }}
@else
<br>
<br>
<br>
<br>
<br>
<h2 class="text-center">{{_i('There are no products in the cart')}}</h2>
<br>
<br>
<br>
<br>
<br>
@endif
@endsection

@push('js')

<script>
    $("#city").append('<option value>{{ _i('select') }}</option>');
    $('#country').change(function(){
    var countryID = $(this).val();
    if (countryID){
    $.ajax({
    type:"GET",
            url:"{{url('get-city-list')}}?country_id=" + countryID,
            dataType:'json',
            success:function(res){
            if (res){
            $("#city").empty();
            $("#city").append('<option>{{ _i('select') }}</option>');
            $.each(res, function(key, value){
            $("#city").append('<option value="' + key + '">' + value + '</option>');
            });
            } else{
            $("#city").empty();
            }
            }
    });
    } else{
    $("#city").empty();
    }
    });
    $(function () {
    'use strict';
    $("#payment,#city,#country").on("change", function(){
    $('.ship_cost').text(0);
    $('.totalBefore').text({{ \Cart::getTotal() }});
    $('.overAllTotal').text({{ \Cart::getTotal() }});
    });
    $("#payment,#city,#country").on("change", function(){
    var payment = $('#payment').val();
    var city = $('#city').val();
    var country = $('#country').val();
    $(".column-bank").css("display", "none");
    if (this){
    $.ajax({
    url: '{{url('getBankDetails')}}',
            type:'get',
            dataType:'html',
            data:{payment: payment, city: city, country: country},
            success: function (data) {
            $('.column-bank').css("display", "flex").html(data);
            }
    });
    } else{
    $('.column-bank').html('');
    }
    });
    });
</script>



@endpush


