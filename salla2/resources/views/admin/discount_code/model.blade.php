

<!---------- model for edit discount code ---------------------->
<div class="modal fade edit_modal" id="editdetails"  role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{_i('edit discount code')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#couponDetailsEdit" class="nav-link active"
                                                data-toggle="tab">{{_i('Coupon Details')}}</a></li>
                        <li class="nav-item"><a href="#couponIncludeEdit" class="nav-link productFeature"
                                                data-toggle="tab">{{_i('Included in Coupon')}}</a></li>
                    </ul>
                    <form id="form_edit" class="j-forms" data-parsley-validate>
                        @csrf
                        {{method_field('put')}}

                        <div class="tab-content">

                            <!------------- tap  coupon details ------------------>
                            <div class="tab-pane active" id="couponDetailsEdit">
                                <div class="content">
                                    <div class="divider-text gap-top-45 gap-bottom-45">
                                        <span>{{ _i('Discount Code\'s details') }}</span>
                                    </div>
                                    <br>
                                    <div class="alert alert-danger" style="display:none"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-right">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label">{{ _i('title') }}</label>
                                                                <div class="col-sm-10">
                                                                    {{Form::text('title',null,['class'=>'form-control title','form' => 'form_edit','placeholder'=>_i('title')])}}
                                                                </div>
                                                                @if ($errors->has('title'))
                                                                    <span class="text-danger invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label">{{ _i('Code') }}</label>
                                                                <div class="col-sm-10">
                                                                    {{Form::text('code',null,['class'=>'form-control code','form' => 'form_edit','placeholder'=>_i('Code'),'required'])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label">{{ _i('Expire Date') }}</label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group">
                                                                        <input type="date" id="date" name="expire_date" class="form-control expire_date" value="" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" placeholder="{{_i('Expire Date')}}" required="">
                                                                        <span class="input-group-addon" id="basic-addon5">
                                                                    <i class="icofont icofont-calendar"></i>
                                                                </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label">{{ _i('Discount') }}</label>
                                                                <div class="col-sm-10">
                                                                    {{Form::text('discount',null,['class'=>'form-control discount', 'form' => 'form_edit','placeholder'=>_i('Discount'),'required'])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <label class="col-sm-2 col-form-label">{{ _i('Count') }}</label>
                                                                <div class="col-sm-10">
                                                                    {{Form::text('count',null,['class'=>'form-control count', 'form' => 'form_edit','placeholder'=>_i('Count'),'required'])}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="checkbox-fade fade-in-primary" style="display: block !important;">
                                                                <label>
                                                                    <input type="checkbox" name="type" form="form_edit" class="percentage" value="perc">
                                                                    <span class="cr float-left">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                    <span class="">{{ _i('Percentage') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="checkbox-fade fade-in-primary" style="display: block !important;">
                                                                <label>
                                                                    <input type="checkbox" name="type" class="amount" form="form_edit" value="fixed">
                                                                    <span class="cr float-left">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                    <span class="">{{ _i('Amount') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="checkbox-fade fade-in-primary" style="display: block !important;">
                                                                <label>
                                                                    <input type="checkbox" name="type" class="item" form="form_edit" value="item">
                                                                    <span class="cr float-left">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                    <span class="">{{ _i('Item') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!------------- end tap coupon details ------------------>

                            <!------------- tap coupon include ------------------>
                            <div class="tab-pane" id="couponIncludeEdit">
                                <div class="content">
                                    <div class="divider-text gap-top-45 gap-bottom-45">
                                        <span>{{ _i('Included in coupon') }}</span>
                                    </div>
                                    <br>
                                    <div class="alert alert-danger" style="display:none"></div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-right">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label class="col-sm-12 col-form-label">{{ _i('Included Categories') }} :</label>
                                                            <div class="row">
                                                                <select class="col-sm-12 selectpicker type_category"  multiple="multiple" name="type_category[]">
                                                                    <option value="all_category">{{_i('Select All')}}</option>
                                                                    @foreach($categories as $cat)
                                                                        <option data-catId="{{$cat->id}}" value="{{$cat['id']}}">{{$cat['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!------- included products --------->
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label class="col-sm-12 col-form-label">{{ _i('Included Products') }} :</label>
                                                            <div class="row">
                                                                <select class="js-example-basic-multiple col-sm-12 selectpicker type_product" multiple="multiple" name="type_product[]">
                                                                    <option value="all_product">{{_i('Select All')}}</option>
                                                                    @foreach($products as $product)
                                                                        <option value="{{$product['prod_id']}}">{{$product['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!------- included users group --------->
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label class="col-sm-12 col-form-label">{{ _i('Included User Group') }} :</label>
                                                            <div class="row">
                                                                <select class="js-example-basic-multiple col-sm-12 selectpicker type_userGroup" multiple="multiple" name="type_userGroup[]">
                                                                    <option value="all_userGroup">{{_i('Select All')}}</option>
                                                                    @foreach($users as $user)
                                                                        <option value="{{$user['id']}}">{{$user['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!------------- end tap coupon include ------------------>

                        </div>
                    </form>



                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form_edit" class="btn btn-primary btn-outline-primary m-b-0 save">{{ _i('Save') }}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
            </div>
        </div>
    </div>
</div>
<!---------- model for edit discount code end ---------------------->




<!---------- model for create discount code ---------------------->
<div class="modal fade modal_create" id="editdetailsz" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{_i('Add Discount Code')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#couponDetails" class="nav-link active"
                                                data-toggle="tab">{{_i('Coupon Details')}}</a></li>
                        <li class="nav-item"><a href="#couponInclude" class="nav-link productFeature"
                                                data-toggle="tab">{{_i('Included in Coupon')}}</a></li>
                    </ul>
                    <form id="form_create" class="j-forms" data-parsley-validate>
                        @csrf

                    <div class="tab-content">

                        <!------------- tap  coupon details ------------------>
                        <div class="tab-pane active" id="couponDetails">
                            <div class="content">
                                <div class="divider-text gap-top-45 gap-bottom-45">
                                    <span>{{ _i('Discount Code\'s details') }}</span>
                                </div>
                                <br>
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label">{{ _i('title') }}</label>
                                                            <div class="col-sm-10">
                                                                {{Form::text('title',null,['class'=>'form-control','id'=>'title','form' => 'form_create','placeholder'=>_i('title')])}}
                                                            </div>
                                                            @if ($errors->has('title'))
                                                                <span class="text-danger invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label">{{ _i('Code') }}</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="code" placeholder="{{_i('Code')}}" required="">
                                                                    <span class="input-group-addon" id="basic-addon5">
                                                                <i class="icofont icofont-ticket"></i>
                                                            </span>
                                                                </div>
                                                                {{--             {{Form::text('code',null,['class'=>'form-control','id'=>'code','form' => 'form_create','placeholder'=>_i('Code'),'required'])}}--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label">{{ _i('Expire date') }}</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <input type="date" id="date" name="expire_date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" placeholder="{{_i('Expire Date')}}" required="">
                                                                    <span class="input-group-addon" id="basic-addon5">
                                                                <i class="icofont icofont-calendar"></i>
                                                            </span>
                                                                </div>
                                                                {{--                                                        {{Form::text('code',null,['class'=>'form-control','id'=>'code','form' => 'form_create','placeholder'=>_i('Code'),'required'])}}--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label">{{ _i('Discount') }}</label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="discount" placeholder="{{_i('Discount')}}" required="">
                                                                    <span class="input-group-addon" id="basic-addon5">
                                                                <i class="icofont icofont-sale-discount"></i>
                                                            </span>
                                                                </div>
                                                                {{--  {{Form::text('discount',null,['class'=>'form-control','id'=>'discount', 'form' => 'form_create','placeholder'=>_i('Discount'),'required'])}}--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label">{{ _i('Count') }}</label>
                                                            <div class="col-sm-10">
                                                                {{Form::text('count',null,['class'=>'form-control','id'=>'count', 'form' => 'form_create','placeholder'=>_i('Count'),'required'])}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="checkbox-fade fade-in-primary" style="display: block !important;">
                                                            <label>
                                                                <input type="checkbox" name="type" form="form_edit" class="percentage" value="perc">
                                                                <span class="cr float-left">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>

                                                                <span class="">{{ _i('Percentage') }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="checkbox-fade fade-in-primary" style="display: block !important;">
                                                            <label>
                                                                <input type="checkbox" name="type" class="amount" form="form_edit" value="fixed">
                                                                <span class="cr float-left">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                <span class="">{{ _i('Amount') }}</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="checkbox-fade fade-in-primary" style="display: block !important;">
                                                            <label>
                                                                <input type="checkbox" name="type" class="item" form="form_edit" value="item">
                                                                <span class="cr float-left">
                                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                                    </span>
                                                                <span class="">{{ _i('Item') }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------- end tap coupon details ------------------>

                        <!------------- tap coupon include ------------------>
                        <div class="tab-pane" id="couponInclude">
                            <div class="content">
                                <div class="divider-text gap-top-45 gap-bottom-45">
                                    <span>{{ _i('Included in coupon') }}</span>
                                </div>
                                <br>
                                <div class="alert alert-danger" style="display:none"></div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-sm-12 col-form-label">{{ _i('Included Categories') }} :</label>
                                                        <div class="row">
                                                            <select class="col-sm-12 selectpicker" multiple="multiple" name="type_category[]">
                                                                <option value="all_category">{{_i('Select All')}}</option>
                                                                @foreach($categories as $cat)
                                                                    <option value="{{$cat['id']}}">{{$cat['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------- included products --------->
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-sm-12 col-form-label">{{ _i('Included Products') }} :</label>
                                                        <div class="row">
                                                            <select class="js-example-basic-multiple col-sm-12 selectpicker" multiple="multiple" name="type_product[]">
                                                                <option value="all_product">{{_i('Select All')}}</option>
                                                                @foreach($products as $product)
                                                                    <option value="{{$product['prod_id']}}">{{$product['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------- included users group --------->
                                            <div class="col-sm-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-sm-12 col-form-label">{{ _i('Included User Group') }} :</label>
                                                        <div class="row">
                                                            <select class="js-example-basic-multiple col-sm-12 selectpicker" multiple="multiple" name="type_userGroup[]">
                                                                <option value="all_userGroup">{{_i('Select All')}}</option>
                                                                @foreach($users as $user)
                                                                    <option value="{{$user['id']}}">{{$user['title']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!------------- end tap coupon include ------------------>

                    </div>
                    </form>



                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" form="form_create" class="btn btn-primary btn-outline-primary m-b-0 save_language">{{ _i('Save') }}</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
            </div>
        </div>
    </div>
</div>


