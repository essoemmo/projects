@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Shipping companies')}}
@endsection

@section('page_header_name')
    {{_i('shipping companies')}}
@endsection

@push('css')
    <style>
        .modal-header {
            background-color: #5cd5c4;
            border-color: #5cd5c4;
            color: #fff;
        }
    </style>
@endpush


@section('content')



    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('shipping companies')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('shipping companies')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->

    <div class="col-xs-5 form-group">
        <a class="btn btn-primary  btn-round col-sm-3 create" id="add-btn" style="color: white;"  data-toggle="modal" data-target="#new_campany">
            <i class="fa fa-plus"></i>{{_i("New shipping company")}}</a>
    </div>

    <div class="page-body">
        <!-- Blog-card start -->


        <div class="row">
            <!------------------------------------- companies ----------------------------->
            <div class="col-sm-4 ">
                <div class="card">


                    <div class="card-block">

                        <div class="card-body card-block text-center">
                            <!----  name ----->
                            <div class="component-image" >
                                <i class="fa fa-gift" style="font-size: 80px; color: #5cd5c4;"></i>
                            </div>
                            <p class="component-desc">
                                <b>{{_i('Free Shipping')}}</b>
                            </p>

                            <div class="form-group row  " style="float:right">
                                <button class="btn btn-tiffany save save-product " type="button" data-toggle="modal" data-target="#free_shipping">
                                    {{_i('Settings')}} <i class="ti ti-settings"></i>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!------- another companies ---->
            @if(count($companies) > 0)
                @foreach($companies as $company)
                    <div class="col-sm-4 ">
                        <div class="card">
                            <div class="card-block">

                                <div class="card-body card-block text-center">
                                    <!----  name ----->
                                    <div class="component-image" >
                                        <img src="{{asset($company['logo'])}}" style="max-width: 150px;">
                                    </div>
                                    <p class="component-desc">
                                        <b>{{$company['title']}}</b>
                                    </p>

                                    <div class="form-group row  " style="float:right">
                                        <button class="btn btn-tiffany save save-product " type="button" data-toggle="modal" data-target="#company_{{$company['id']}}">
                                            {{_i('Settings')}} <i class="ti ti-settings"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!------------------------------- options -------------------->
                    <div class="modal fade modal_create" id="company_{{$company['id']}}" tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" >
                                    <h5 class="modal-title">{{_i('Campaign Conditions')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="save_shipping_company" method="POST" action="{{url('adminpanel/update_shipping_company/'.$company['id'])}}" enctype="multipart/form-data" data-parsley-validate="">
                                    @csrf
                                    <input type="hidden" name="free_shipping" value="0">

                                    <div class="modal-body p-b-0">

                                        <div class="form-group row ">
                                            <div class="col-sm-12">
                                                <div class="input-group ">
                                                    <input class="form-control " name="company_name" value="{{$company['title']}}" placeholder="{{_i('Company Name')}}" required="">
                                                    <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                             <i class="fa fa-industry"></i>
                                        </span>
                                                </div>

                                                <div class="input-group ">
                                                    <input type="file" name="logo"  accept="image/*">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="section_shipping_price_add">

                                            @php
                                                $options = \App\Models\Shipping\Shipping_option::where('store_id',\App\Bll\Utility::getStoreId())
                                                ->where('company_id' ,$company->id)->get();
                                            @endphp

                                            @foreach($options as $option)

                                                <div class="single_shipping_price">
                                                    <div class="form-group row ">
                                                        <div class="col-sm-12">
                                                            <div class="input-group ">
                                                                <select class="form-control country_id" name="country_id[]" >
                                                                    <option selected value="all" {{$option['country_id'] == "null" ? "selected": ""}} >{{_i('All Countries')}}</option>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{$country->id}}" {{$option['country_id'] == $country->id ? "selected": ""}}>{{$country->title}}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                                        <i class="ti ti-map"></i>
                                                                                                               </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- cities--------------------->

                                                    @php
                                                    $city_option = \App\Models\Shipping\Cities_shipping_option::where('shipping_option_id',$option['id'])->first();
                                                    @endphp
                                                    <div class="form-group row ">
                                                        <div class="col-sm-12">
                                                            <div class="input-group ">
                                                                <select class="form-control  city_id"  name="city_id[]" >
                                                                    <option selected value="all" {{$city_option['city_id'] == "null"? "selected":""}} >{{_i('All Cities')}}</option>
                                                                    @foreach($cities as $city)
                                                                        <option value="{{$city->id}}" {{$city_option['city_id'] == $city->id? "selected":""}}>{{$city->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                <i class="ti ti-map-alt"></i>
                                                                                            </span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- pricing type--------------------->
                                                    <div class="form-group row ">
                                                        <div class="col-sm-12">
                                                            <div class="input-group ">
                                                                <select class="form-control  pricing_type"  name="pricing_type[]" >
                                                                    <option  value="fixed" {{$option['cost'] != null ? "selected" : ""}}>{{_i('Pricing Type : Fixed')}}</option>
                                                                    <option  value="by_weight" {{$option['cost'] == null ? "selected" : ""}}>{{_i('Pricing Type : By Weight')}}</option>

                                                                </select>
                                                                <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                <i class="ti ti-wallet"></i>
                                                                                            </span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- shipping cost --------------------->
                                                    <!--------------------------- if Pricing Type : By Weight --------------------->
                                                    <div class="pricing_type_by_weight" style="display: @if($option['cost'] == null) block @else none @endif " >
                                                        @php
                                                        $shipping_type = \App\Models\Shipping\Shipping_type::where('shipping_option_id' , $option->id)
                                                        ->where('store_id' , \App\Bll\Utility::getStoreId())->first()
                                                        @endphp
                                                        @if($shipping_type != null)
                                                            <div class="form-group row ">
                                                                <div class="col-sm-12"><label  > {{_i('Cost')}}</label></div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="no_kg[]" value="{{$shipping_type['no_kg']}}" placeholder="{{_i('The first kilogram')}}">
                                                                        <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                                                                {{_i('first')}}
                                                                                                                                            </span>
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('KG')}}</button>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="cost_no_kg[]" value="{{$shipping_type['cost_no_kg']}}" placeholder="{{_i('Shipping Cost')}}">
                                                                        <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                                                                <i class="ti ti-money"></i>
                                                                                                                                            </span>
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!----------------- Cost of the increase ------------------->
                                                            <div class="form-group row ">
                                                                <div class="col-sm-12"><label  > {{_i('Cost of the increase')}}</label></div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="cost_increase[]" value="{{$shipping_type['cost_increase']}}" placeholder="{{_i('Cost of the increase')}}">
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="kg_increase[]" value="{{$shipping_type['kg_increase']}}" placeholder="{{_i('Cost by weight')}}">
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('KG')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="form-group row ">
                                                                <div class="col-sm-12"><label  > {{_i('Cost')}}</label></div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="no_kg[]"  placeholder="{{_i('The first kilogram')}}">
                                                                        <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                                                                {{_i('first')}}
                                                                                                                                            </span>
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('KG')}}</button>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="cost_no_kg[]" placeholder="{{_i('Shipping Cost')}}">
                                                                        <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                                                                <i class="ti ti-money"></i>
                                                                                                                                            </span>
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!----------------- Cost of the increase ------------------->
                                                            <div class="form-group row ">
                                                                <div class="col-sm-12"><label  > {{_i('Cost of the increase')}}</label></div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="cost_increase[]"  placeholder="{{_i('Cost of the increase')}}">
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="input-group ">
                                                                        <input class="form-control " type="number"  name="kg_increase[]"  placeholder="{{_i('Cost by weight')}}">
                                                                        <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('KG')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <!--------------------------- if Pricing Type : Fixed --------------------->
                                                    <div class="pricing_type_fixed" style="display: @if($option['cost'] == null) none @else block @endif ">
                                                        <div class="form-group row ">
                                                            <div class="col-sm-12">
                                                                <div class="input-group ">
                                                                    <input type="number"  class="form-control " name="cost[]" value="{{$option['cost']}}" placeholder="{{_i('Shipping Cost')}}">
                                                                    <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                <i class="ti ti-money"></i>
                                                                                            </span>
                                                                    <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- shipping time --------------------->
                                                    <div class="form-group row ">
                                                        <div class="col-sm-12">
                                                            <div class="input-group ">
                                                                <input type="number" class="form-control " name="delay[]"  value="{{$option['delay']}}" placeholder="{{_i('Shipping time (For example 3-5 days)')}}">
                                                                <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                <i class="fa fa-clock-o"></i>
                                                                                            </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- Paiement on delivery --------------------->
                                                    <div class="form-group row ">
                                                        <div class="col-sm-12">
                                                            <div class="input-group ">
                                                                <select class="form-control  delivery_method"  name="delivery_method[]"  >
                                                                    <option selected >{{_i('Paiement on delivery ?')}}</option>
                                                                    <option  value="available" {{$option['cash_delivery_commission'] != null ? "selected": ""}}>{{_i('Payment on delivery: Available')}}</option>
                                                                    <option  value="not_available">{{_i('Payment on delivery: Not available')}}</option>

                                                                </select>
                                                                <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                <i class="ti ti-wallet"></i>
                                                                                            </span>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- cash_delivery_commission --------------------->
                                                    <div class="cach_commission" style="display:  @if($option['cash_delivery_commission'] != null) flex @else none @endif ">
                                                        <div class="form-group row ">
                                                            <div class="col-sm-12">
                                                                <div class="input-group ">
                                                                    <input  class="form-control " type="number"  name="cash_delivery_commission[]" value="{{$option['cash_delivery_commission']}}" placeholder="{{_i('Cash delivery commission')}}">
                                                                    <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                                                                                <i class="ti ti-money"></i>
                                                                                            </span>
                                                                    <button type="button" class="btn btn-tiffany btn-sm mr-3 ">{{_i('SR')}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--------------------------- delete shipping price --------------------->
                                                    <div class="form-group row ">
                                                        <div class="col-sm-12">
                                                            <button type="button" class="btn btn-danger "  onclick="delete_shipping_price_section(this , {{$option['id']}})"  ><i class="fa fa-times"></i> {{_i('Delete Condition')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-sm-12">
                                                <button type="button" class="btn btn-primary add_shipping_price" ><i class="fa fa-plus"></i> {{_i('Add Shipping Price')}}</button>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary save ">{{_i('Save')}}</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{_i('Close')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach

            @endif




        </div>






    </div>

    @include('admin.shipping.companies.free_shipping')
    @include('admin.shipping.companies.new_company')


    @push('js')

        <script>
            {{--$('body').on('submit', '.save_shipping_company' , function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    //var data = $(this).serialize();--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ url('adminpanel/save_shipping_company') }}',--}}
            {{--        method: "post",--}}
            {{--        data: $(this).serialize(),--}}
            {{--        success: function (response) {--}}

            {{--        },--}}

            {{--    });--}}

            {{--})--}}
        </script>
    @endpush





@endsection
