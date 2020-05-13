@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Edit a campaign')}}
@endsection

@section('content')

    @push('css')
        <style>
            .modal-header {
                background-color: #5cd5c4;
                border-color: #5cd5c4;
                color: #fff;
            }
            #message_preview.to ,#message_preview a {
                color: #fff;
                background-color: #5dd5c4;
                text-align: left ;
            }
            #message_preview.message {
                box-sizing: border-box;
                padding: 8px 20px;
                min-width: 200px;
                max-width: 500px;
                min-height: 40px;
                margin: 5px 10px;
                border-radius: 15px;
                position: relative;
                clear: both;
                font-size: 14px;
                word-wrap: break-word;
            }

            #message_preview.to::before {
                content: '';
                border: solid 10px;
                border-color: transparent transparent #5dd5c4;
                position: absolute;
                float: right;
                right: -7px;
                bottom: 2px;
            }
        </style>
    @endpush

    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Edit a campaign')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{url('adminpanel')}}">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <form  action="{{ url('adminpanel/campaign/'.$marketing->id.'/update')}}" method="POST" class="form-horizontal" data-parsley-validate="" >
            @csrf

            <div class="row">
                <!------------------------------------- Offer details ----------------------------->
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-social-telegram"></i> {{ _i('Marketing campaign') }}  </h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-rounded-down"></i>
                            </div>
                        </div>

                        <div class="card-block">

                            <div class="card-body card-block text-center">
                                <!----  name ----->
                                <div class="form-group row ">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <input type="text" id="campaign_name_" class="form-control " name="campaign_name" value="{{$marketing->name}}" placeholder="{{_i('Campaign Name')}}" required="">
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                            <i class="icofont icofont-font"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <!----==========================  message ==========================--->
                                <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <textarea class="form-control campaign-textarea" id="content" name="message"
                                                      placeholder="{{_i('The text of the message')}}">{{$marketing['message']}}</textarea>
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                             <i class="icofont icofont-chat"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <!----==========================  link ==========================--->
                                <div class="form-group row ">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <select class="form-control"  name="link_type" required="" id="link_type">
                                                <option selected disabled>{{_i('Select Link')}}</option>
                                                <option value="store" {{$marketing['type']=="store"?"selected" : ""}}>{{_i('Store Link')}}</option>
                                                <option value="product" {{$marketing['type']=="product"?"selected" : ""}}>{{_i('Product Link')}}</option>
                                                <option value="category" {{$marketing['type']=="category"?"selected" : ""}}>{{_i('Category Link')}}</option>
                                                <option value="offers" {{$marketing['type']=="offers"?"selected" : ""}}>{{_i('Discounts Link')}}</option>
                                            </select>
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                            <i class="icofont icofont-link-alt"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>

                                <input type="hidden" id="link_id" name="link_id" value="" />
                                <input type="hidden" id="link_text" name="link_text" value="" />
                                <!----==========================  items of selected link ==========================--->
                                <!---- url is product ---->
                                <div class="form-group row  url_product" @if($marketing['type']=="product")  style="display: flex" @else style="display: none" @endif>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <select class="form-control "  name="url_item" id="searchbox_product" >
                                                <option selected disabled>{{_i('Select Product')}}</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product['prod_id']}}" {{$marketing['url_item'] == $product['prod_id'] ? "selected" :""}}>{{$product['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <!---- url is category ---->
                                <div class="form-group row  url_category" @if($marketing['type']=="category")  style="display: flex" @else style="display: none" @endif>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <select class="form-control "  name="url_item" id="searchbox_category">
                                                <option selected disabled>{{_i('Select Category')}}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category['id']}}" {{$marketing['url_item'] == $category['id'] ? "selected" :""}}>{{$category['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>

                                <div class="content-divider text-muted">
                                    <span><i class="ti ti-eye"></i> {{_i('Message preview')}}</span>
                                </div>

                                <div class="form-group row " >
                                    <div class="col-sm-1"></div>
                                    <p id="message_preview" class="message to" >


                                    </p>
                                    <div class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>


            <!--------------------------------------- section two => campaign users target --------------------->
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-pie"></i> {{ _i('Target segment') }}  </h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-rounded-down"></i>
                            </div>
                        </div>

                        <div class="card-block">

                            <div class="card-body card-block text-center">
                                <!----  name ----->
                                <div class="form-group row ">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary " id="add_condition"  data-toggle="modal" data-target="#sign-in-modal">
                                            <i class="ti-plus"></i>{{_i('Add Condition')}}
                                        </button>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <!----==========================  all conditions  ==========================--->

                                <div class="form-group row">
                                    @foreach($marketingUserSaved as $item)
{{--                                    <div class="div_delete">--}}
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10 div_delete">
                                        <div class="alert alert-default small">
                                            <button type="button" class="close btn-small" data-dismiss="alert" aria-label="Close" onclick="delFilter({{$item['id']}})">
                                                <i class="icofont icofont-close-line-circled btn-small"></i>
                                            </button>
                                            <strong>{{$item['code']." ".$item['value']}}</strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
{{--                                    </div>--}}
                                    @endforeach
                                </div>


                                <div id="get_filter_users" style="margin-top:-20px;">

                                </div>
                                <!----==========================  button apply all conditions ==========================--->
                                <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input id="apply_all_conditions" type="checkbox" value="1" name="apply_all_conditions" {{$marketing['apply_all_conditions']== 1?"checked":""}}>
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span> {{ _i('All conditions apply') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>

            <!--------------------------------------- section three => Campaign goal --------------------->
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-brand-target"></i> {{ _i('Campaign goal') }}  </h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-rounded-down"></i>
                            </div>
                        </div>
                        <div class="card-block">

                            <div class="card-body card-block text-center">
                                <!----  select goal ----->
                                <div class="form-group row ">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="input-group ">
                                            <select class="form-control campaign_goal"  name="campaign_target" required="">
                                                <option selected disabled>{{_i('Choose Goal')}}</option>
                                                <option value="store" {{$marketing['campaign_target']=="store"?"selected":""}}>{{_i('Buy from the store')}}</option>
                                                <option value="product" {{$marketing['campaign_target']=="product"?"selected":""}}>{{_i('Buy a specific product')}}</option>

                                            </select>
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                            <i class="icofont icofont-flag"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <!----  campaign_target_value ----->
                                <div class="form-group row campaign_goal_product " @if($marketing['campaign_target']=="product") style="display: flex" @else style="display: none"  @endif>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <select class="form-control " name="campaign_target_value">
                                            <option selected disabled>{{_i('Select Product')}}</option>
                                            @foreach($products as $product)
                                                <option value="{{$product['prod_id']}}" {{$marketing['campaign_target_value']==$product['prod_id']?"selected":""}}>{{$product['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--------------------------------------- section four => Campaign scheduling --------------------->
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h5> <i class="icofont icofont-ui-alarm"></i> {{ _i('Campaign scheduling') }}  </h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-rounded-down"></i>
                            </div>
                        </div>

                        <div class="card-block">

                            <div class="card-body card-block text-center">
                                <!----  name ----->
                                <div class="form-group row ">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-10">
                                        <div class="form-radio ">

                                            <div class="radio radio-inline ">
                                                <label>
                                                    <input type="radio" class="publish_type" name="campaign_type_time" value="now"
                                                     {{$marketing['campaign_date'] == null?"checked" :""}}>
                                                    <i class="helper"></i> {{_i('Now')}}
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" class="publish_type" name="campaign_type_time" value="future"
                                                            {{$marketing['campaign_date'] != null?"checked" :""}}>
                                                    <i class="helper"></i> {{_i('Determine the publication time')}}
                                                </label>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                </div>
                                <!----  date & time ----->
                                <div class="form-group row  dateTime" @if($marketing['campaign_date'] != null) style="display: flex" @else style="display: none" @endif>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">

                                        <div class="input-group ">
                                            <input type="time" class="form-control" name="campaign_time" value="{{$marketing['campaign_time']}}">
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                            <i class="icofont icofont-clock-time"></i>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="input-group ">
                                            <input type="date" id="date" name="campaign_date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{$marketing['campaign_date']}}" placeholder="{{_i('campaign date')}}" >
                                            <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                            <i class="icofont icofont-ui-calendar"></i>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            {{--            <div id="draft_value"></div>--}}
            <input type="hidden" id="draft_value" name="is_draft" value="" >
            <div class="row">
                <div class=" col-sm-12 text-center " >
                    <button type="submit"  class="btn btn-primary  btn-round col-sm-3"><i class="icofont icofont-check"></i> {{_i('Create Campaign')}}</button>
                    <button id="draft" type="submit"  class="btn btn-default  btn-round col-sm-3 pull-right "><i class="icofont icofont-ui-folder"></i> {{_i('Save as draft')}}</button>
                </div>

            </div>

        </form>
    </div>



    <!-- Sign in modal start -->
    <div class="modal fade modal_create" id="sign-in-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" >
                    <h5 class="modal-title">{{_i('Campaign Conditions')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="save_filter_row" method="POST">
                    @csrf
                    <div class="modal-body p-b-0">
                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <div class="input-group ">
                                    <select class="form-control " name="marketingUser_code" id="filter_conditions">
                                        <option selected disabled>{{_i('Choose Condition')}}</option>
                                        <option value="gender" id="gender">{{_i('Gender')}}</option>
                                        <option value="country">{{_i(' Country ')}}</option>
                                        <option value="city">{{_i('City')}}</option>
                                        <option value="buy_from_store">{{_i('Buy from Store')}}</option>
                                        <option value="buy_store_more_once">{{_i('Buy from the store more than once')}}</option>
                                        <option value="interest_specific_classification">{{_i('Interested in a specific classification')}}</option>
                                        <option value="buy_specific_product">{{_i('Buy a specific product')}}</option>
                                        <option value="add_product_basket_not_buy">{{_i('Added a product to the basket and did not purchase it')}}</option>
                                        <option value="add_product_to_wishlist">{{_i('Added a product to wishlist')}}</option>
                                        <option value="never_buy_from_store">{{_i('Never buy from the store')}}</option>
                                    </select>
                                    <span class="input-group-addon input-group-addon-small" id="basic-addon5">
                                        <i class="icofont icofont-filter"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row gender_selected" style="display: none;">
                            <div class="col-sm-12">
                                <div class="input-group ">
                                    <select class="form-control " name="marketingUser_gender" >
                                        <option value="male">{{_i('Male')}}</option>
                                        <option value="female">{{_i('Female')}}</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row country_selected" style="display: none;">
                            <div class="col-sm-12">
                                <div class="input-group ">
                                    <select class="form-control " name="marketingUser_country">
                                        @foreach($countries as $country)
                                            <option value="{{$country['id']}}">{{$country['title']}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row city_selected" style="display: none;">
                            <div class="col-sm-12">
                                <div class="input-group ">
                                    <select class="form-control " name="marketingUser_city">
                                        @foreach($cities as $city)
                                            <option value="{{$city['id']}}">{{$city['title']}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row product_selected" style="display: none;">
                            <div class="col-sm-12">
                                <div class="input-group ">
                                    <select class="form-control " name="marketingUser_buy_specific_product">
                                        <option selected disabled>{{_i('Select Product')}}</option>
                                        @foreach($products as $product)
                                            <option value="{{$product['prod_id']}}">{{$product['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row category_selected" style="display: none;">
                            <div class="col-sm-12">
                                <div class="input-group ">
                                    <select class="form-control " name="marketingUser_interest_specific_classification">
                                        <option selected disabled>{{_i('Select Category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category['id']}}">{{$category['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
    <!-- Sign in modal end -->


@endsection


@push('js')

    <script>



        /******************* start message preview section ******************/
        var customers_count = 1634 ;
        var sms_balance = 100 ;
        var _STORE_URL = `{{$domain}}`;
        var tracking_link = `{{$domain}}`;

        ////get saved value
        var link_type = `{{$marketing['type']}}`;
        $('#link_id').val(`{{$marketing['url_item']}}`);
        checkSMSData(link_type);

        $('#content').bind('input propertychange', function () {
            var link_type = $('#link_type').val();
            checkSMSData(link_type)
        });

        $('body').on('change' , '#link_type' , function(){
            var link_type = $(this).val();
            // selected url type
            if (link_type == "product"){
                $('.url_product').show();
                $('.url_category').hide();
            }
            else if (link_type == "category"){
                $('.url_category').show();
                $('.url_product').hide();
            }else{
                $('.url_category').hide();
                $('.url_product').hide();
            }

            checkSMSData(link_type)
        });


        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }


        function checkSMSData(type) {
            var link = null;
            if (type == "product") {
                if ($('#link_id').val()) {
                    link = _STORE_URL + "/store/product/" + $('#link_id').val();
                }
            } else if (type == "category") {
                if ($('#link_id').val()) {
                    link = _STORE_URL + "/store/category/" + $('#link_id').val();
                }
            } else if (type == "offers") {
                link = _STORE_URL + "/store/offer";
            } else if (type == "store") {
                link = _STORE_URL + "/home" ;
            } else {
                link = null;
            }



            var content = $('#content').val();
            var _content = content;

            if (link) {
                content = content + "\n" + "<a  href='" + link + "' target='_blank' > " + link + "</a>";
                _content = _content + "\n" + tracking_link;
            }

            if (content) {
                $(".typing-indicator").hide();
                $('#message_preview').html(nl2br(content));
            } else {
                $('#message_preview').html(null);
                $(".typing-indicator").show();
            }

            //var sms_count = smsCounter(_content);
            var sms_count = _content;

            var required_sms_count = customers_count * sms_count;
            var new_sms_balance = sms_balance - required_sms_count;
            $('#required_sms_count_span').text(required_sms_count);
        }

        $('body').on('change','#searchbox_product',function () {
            var productId = $(this).val();
            $('#link_text').val(productId);
            $('#link_id').val(productId);
            $('.link_type_span').text('');
            checkSMSData('product');
        });

        $('#searchbox_category').on('change', function () {
            $('#link_id').val($(this).val());
            $('.link_type_span').text('');
            checkSMSData('category');
        });

        /******************* end message preview section ******************/

        /******************* start filter section ******************/
        $('body').on('change' , '#filter_conditions' , function() {
            var filter_type = $(this).val();
            if(filter_type == "gender"){
                $('.gender_selected').show();
                $('.category_selected').hide();
                $('.product_selected').hide();
                $('.country_selected').hide();
                $('.city_selected').hide();
            }else if(filter_type == "country"){
                $('.country_selected').show();
                $('.category_selected').hide();
                $('.product_selected').hide();
                $('.gender_selected').hide();
                $('.city_selected').hide();
            }else if(filter_type == "city"){
                $('.city_selected').show();
                $('.category_selected').hide();
                $('.product_selected').hide();
                $('.gender_selected').hide();
                $('.country_selected').hide();
            }else if(filter_type == "buy_specific_product"){
                $('.product_selected').show();
                $('.category_selected').hide();
                $('.gender_selected').hide();
                $('.country_selected').hide();
                $('.city_selected').hide();
            }else if(filter_type == "interest_specific_classification"){
                $('.category_selected').show();
                $('.product_selected').hide();
                $('.gender_selected').hide();
                $('.country_selected').hide();
                $('.city_selected').hide();
            }else{
                $('.category_selected').hide();
                $('.product_selected').hide();
                $('.gender_selected').hide();
                $('.country_selected').hide();
                $('.city_selected').hide();
            };
        });
        $(".save").unbind('click');
        $('body').on('submit','#save_filter_row',function (e){
            e.preventDefault();
            $.ajax({
                url:'{{ url('adminpanel/campaign/store_marketing_users') }}',
                //data: new FormData(this),
                data: new FormData(this),
                type:'POST',
                dataType: 'json',
                contentType: false,
                processData: false,
                success:function (res) {
                    if(res) {
                        // console.log(res);
                        $('.modal.modal_create').modal('hide');
                        $.each(res, function(result ,row){
                            // console.log(result,value.code)
                            if(row.value == null){
                                row.value = "";
                            }
                            $('#get_filter_users').append('<div class="form-group row div_delete"><div class="col-sm-1"></div> <div class="col-sm-10"><div class="alert alert-default small">'+
                                '<button type="button" class="close btn-small" data-dismiss="alert" aria-label="Close">' +
                                '<i class="icofont icofont-close-line-circled btn-small" onclick="delFilter('+row.id+')"></i></button> <strong> '+ row.code +" "+row.value+'</strong>' +
                                ' </div> </div>  <div class="col-sm-1"></div> </div>');
                        });
                    }
                }
            })

            // $(this).closest("form").submit();
        });


        function delFilter(id) {
            $(this).closest('.div_delete').remove();
            // var rowId = id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ url('adminpanel/campaign/delete_marketing_users') }}",
                data: { rowId: id},
                success: function () {

                }
            });
        }

        /******************* end filter section ******************/

        $('body').on('click','#gender',function () {
            $('.gender_selected').show();
        });


        $('body').on('click','#draft',function (e) {
            $('#draft_value').val(1);
            e.preventDefault();
            $(this).closest("form").submit();

            // $('#draft_value').prepend('<input type="hidden" id="draft_value" name="is_draft" value="1" >');
        });




        $('body').on('change' , '.campaign_goal' , function(){
            var campaign_goal = $(this).val();

            if (campaign_goal == "product"){
                $('.campaign_goal_product').show();
            }else{
                $('.campaign_goal_product').hide();
            }
        });

        //dateTime
        $('.publish_type').on("change", function () {
            var publish_type = $(this).val();
            console.log(publish_type);
            //$('.dateTime').show();
            if(publish_type == "future"){
                $('.dateTime').show();
            }else{
                $('.dateTime').hide();
            }
        });



    </script>
@endpush
