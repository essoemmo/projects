
 <!------------------------------------------------------------------ if no custom design options ------------------------>
    <div class="row " id="show_main_menu" style="display: @if(count($custom_design_list) > 0) flex @else none @endif">
        <div class="col-sm-12 ">
            <div class="card">
                <div class="card-header">
                    <h5>{{ _i('Main menu links') }}  </h5>
                    <div class="card-header-right">
                    </div>
                </div>
                <div class="card-block">
                    <div class="card-body  ">

                        <div class="form-group row " >
                            <div class="col-sm-2" >
                                <button type="button" class="btn btn-primary btn-sm  btn-rounded " id="add_link"  onclick="showLinkdiv()" >
                                    <i class="ti-plus"></i>{{_i('Add Link')}}
                                </button>
                            </div>
                        </div>

                        <div class="tab-content mnu__options" id="mnu__options"  style="display: none">

                            <form  class="save_link" method="POST">
                                @csrf

                                <input type="hidden" name="option_type" value="custom_list" >

                                <div class="form-group row " >
                                    <label class="col-sm-2 control-label">{{_i('Link Type')}}</label>
                                    <div class="col-sm-10">
                                        <select class="form-control custom_list"  name="code_list" >
                                            <option value="product">{{_i('Product')}}</option>
                                            <option value="category">{{_i('Classification')}}</option>
                                            <option value="pages">{{_i('Introductory page')}}</option>
                                            <option value="link">{{_i('External link')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <!---------------------- section product ------------------------------>
                                <div class="fields-cont section_product">
                                    <div class="form-group row " >
                                        <label class="col-sm-2 ">{{_i('Select Product')}}</label>
                                        <div class="col-sm-5">
                                            <select class="form-control product_custom_list"  name="code_list_product"  >
                                                <option disabled selected>{{_i('Select Product')}}</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product['prod_id']}}" data-product="{{$product['title']}}">{{$product['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                        <div class="col-sm-2">
                                            <input type="checkbox" class="js-switch "  value="1"  name="separate_window" />
                                        </div>

                                        <div class="col-sm-2" >
                                            <button type="submit" class="btn btn-primary btn-sm  btn-rounded btn_add_product_menu " id="btn_add_product_menu"
                                            >{{_i('Add')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <!--------------------- section category --------------------------------->
                                <div class="fields-cont section_category" style="display: none">
                                    <div class="form-group row " >
                                        <label class="col-sm-2 ">{{_i('Select Category')}}</label>
                                        <div class="col-sm-5">
                                            <select class="form-control category_custom_list"  name="code_list_category"  >
                                                <option disabled selected>{{_i('Select Category')}}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category['id']}}" data-category="{{$category['title']}}">{{$category['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                        <div class="col-sm-2">
                                            <input type="checkbox" class="js-switch "    value="1"  name="separate_window" />
                                        </div>

                                        <div class="col-sm-2" >
                                            <button type="submit" class="btn btn-primary btn-sm  btn-rounded btn_add_product_menu" id="btn_add_product_menu"
                                            >{{_i('Add')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <!--------------------- section pages --------------------------------->
                                <div class="fields-cont section_page" style="display: none">
                                    <div class="form-group row " >
                                        <label class="col-sm-2 ">{{_i('Select Page')}}</label>
                                        <div class="col-sm-5">
                                            <select class="form-control page_custom_list"  name="code_list_pages"  >
                                                <option disabled selected>{{_i('Select Page')}}</option>
                                                @foreach($pages as $page)
                                                    <option value="{{$page['id']}}" data-page="{{$page['title']}}">{{$page['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                        <div class="col-sm-2">
                                            <input type="checkbox" class="js-switch "   value="1"  name="separate_window"  />
                                        </div>

                                        <div class="col-sm-2" >
                                            <button type="submit" class="btn btn-primary btn-sm  btn-rounded btn_add_product_menu" id="btn_add_product_menu"
                                            >{{_i('Add')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <!--------------------- section link --------------------------------->
                                <div class="fields-cont section_link" style="display: none">
                                    <div class="form-group row " >
                                        <label class="col-sm-2 ">{{_i('Link Name')}}</label>
                                        <div class="col-sm-4">
                                            <input class="form-control link_custom_list"  placeholder="{{_i(' Enter Link Name')}}"  name="title_link">
                                        </div>
                                        <label class="col-sm-1 ">{{_i('Link')}}</label>
                                        <div class="col-sm-5">
                                            <input class="form-control"  placeholder="http://example.com" name="code_list_link">
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                        <div class="col-sm-3">
                                            <input type="checkbox" class="js-switch " value="1"  name="separate_window" />
                                        </div>

                                        <div class="col-sm-2" >
                                            <button type="submit" class="btn btn-primary btn-sm  btn-rounded " id="btn_add_product_menu"
                                            >{{_i('Add')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    @if(count($custom_design_list) > 0)
                        <!--------------------------------- get menu links saved ---------------------------------->
                            <div class="get_links" id="get_links">

                                @foreach($custom_design_list as $customRow)
{{--                                    @dd(\App\Bll\Utility::getProduct($customRow['value'])->title)--}}
                                <div class="form-group row div_delete" @if(!$loop->first) style="margin-top:-40px;" @endif>
                                    <div class="col-sm-12">
                                        <div class="alert alert-default small">
                                            <button type="button" class="close btn-icon"  aria-label="Close" style="color: red; float: left">
                                                <i class="icofont icofont-curved-left" onclick="showAddLinkdiv(this)" style="color: silver; padding: 0 10px; " ></i>
                                                <i class="icofont icofont-ui-delete btn-small deleteRow " data-deleteRow="{{$customRow->id}}"  ></i>
                                            </button>

                                            <strong class="design_value">
                                                @if($customRow['code'] == "product")
                                                     {{ \App\Bll\Utility::getProduct($customRow['value'])->title }}
                                                @elseif($customRow['code'] == "category")
                                                    {{ \App\Bll\Utility::getCategory($customRow['value'])->title }}
                                                @elseif($customRow['code'] == "pages")
                                                {{ \App\Bll\Utility::getPage($customRow['value'])->title }}
                                                @elseif($customRow['code'] == "link")
                                                    {{$customRow['title']}}
                                                @endif
                                            </strong>
                                            <div class="tab-content mnu__options mnu__options_edit" id="mnu__options_edit"  style="display: none;"  >

                                                <form  class="save_link" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="option_type" value="custom_list" >

                                                    <div class="form-group row " >
                                                        <label class="col-sm-2 control-label">{{_i('Link Type')}}</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control custom_list"  name="code_list" >
                                                                <option value="product" @if($customRow['code'] == "product") selected @endif>{{_i('Product')}}</option>
                                                                <option value="category" @if($customRow['code'] == "category") selected @endif>{{_i('Classification')}}</option>
                                                                <option value="pages" @if($customRow['code'] == "pages") selected @endif>{{_i('Introductory page')}}</option>
                                                                <option value="link" @if($customRow['code'] == "link") selected @endif>{{_i('External link')}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!---------------------- section product ------------------------------>
                                                    <div class="fields-cont section_product" style="display: @if($customRow['code'] == "product") flex @else none @endif" >
                                                        <div class="form-group row " >
                                                            <label class="col-sm-2 ">{{_i('Select Product')}}</label>
                                                            <div class="col-sm-5">
                                                                <select class="form-control product_custom_list"  name="code_list_product"  >
                                                                    <option disabled selected>{{_i('Select Product')}}</option>
                                                                    @foreach($products as $product)
                                                                        <option value="{{$product['prod_id']}}" @if($product['prod_id'] == $customRow['value']) selected @endif>{{$product['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                                            <div class="col-sm-2">
                                                                <input type="checkbox" class="js-switch "  value="1"  name="separate_window"
                                                                @if($customRow['integer_value'] == 1) checked @endif/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--------------------- section category --------------------------------->
                                                    <div class="fields-cont section_category" style="display: @if($customRow['code'] == "category") flex @else none @endif">
                                                        <div class="form-group row " >
                                                            <label class="col-sm-2 ">{{_i('Select Category')}}</label>
                                                            <div class="col-sm-5">
                                                                <select class="form-control category_custom_list"  name="code_list_category"  >
                                                                    <option disabled selected>{{_i('Select Category')}}</option>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category['id']}}" @if($category['id'] == $customRow['value']) selected @endif>{{$category['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                                            <div class="col-sm-2">
                                                                <input type="checkbox" class="js-switch "    value="1"  name="separate_window"  @if($customRow['integer_value'] == 1) checked @endif/>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--------------------- section pages --------------------------------->
                                                    <div class="fields-cont section_page" style="display: @if($customRow['code'] == "pages") flex @else none @endif">

                                                        <div class="form-group row col-sm-12 " >
                                                            <label class="col-sm-2 ">{{_i('Select Page')}}</label>
                                                            <div class="col-sm-4">
                                                                <select class="form-control page_custom_list"  name="code_list_pages"  >
                                                                    <option disabled selected>{{_i('Select Page')}}</option>
                                                                    @foreach($pages as $page)
                                                                        <option value="{{$page['id']}}" @if($page['id'] == $customRow['value']) selected @endif>{{$page['title']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label class="col-sm-4 ">{{_i('Open in a separate window')}}</label>
                                                            <div class="col-sm-2">
                                                                <input type="checkbox" class="js-switch "   value="1"  name="separate_window" @if($customRow['integer_value'] == 1) checked @endif />
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--------------------- section link --------------------------------->
                                                    <div class="fields-cont section_link" style="display: @if($customRow['code'] == "link") block @else none @endif">
                                                        <div class="form-group row " >
                                                            <label class="col-sm-2 ">{{_i('Link Name')}}</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control link_custom_list" value="{{$customRow['title']}}"  placeholder="{{_i(' Enter Link Name')}}"  name="title_link">
                                                            </div>
                                                            <label class="col-sm-1 ">{{_i('Link')}}</label>
                                                            <div class="col-sm-5">
                                                                <input class="form-control"  value="{{$customRow['value']}}" placeholder="http://example.com" name="code_list_link">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row ">
                                                            <label class="col-sm-3 ">{{_i('Open in a separate window')}}</label>
                                                            <div class="col-sm-3">
                                                                <input type="checkbox" class="js-switch " value="1"  name="separate_window" @if($customRow['integer_value'] == 1) checked @endif />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>


                                        </div>

                                    </div>
                                </div>
                                @endforeach

                            </div>

                    @else
                        <!--------------------------------- add menu links if not links found ---------------------------------->
                            <div class="get_links" id="get_links">

                            </div>
                    @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
