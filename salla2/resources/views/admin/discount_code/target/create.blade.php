@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Create Special Offer')}}
@endsection

@section('content')

    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Create Special Offer')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{url('adminpanel')}}">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
{{--                <li class="breadcrumb-item"><a href="#!">{{_i('Create Discount Code Target')}}</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <form  action="{{ url('adminpanel/settings/offer/store')}}" method="post" class="form-horizontal" data-parsley-validate="" >
            @csrf

        <div class="row">
            <!------------------------------------- Offer details ----------------------------->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> {{ _i('Offer Details') }} </h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                        </div>
                    </div>

                    <div class="card-block">

                        <div class="card-body card-block">
                            <!---- offer name ----->
                            <div class="form-group row">
{{--                                <label for="title" class="col-sm-2 control-label" >{{ _i('Offer Name') }} </label>--}}
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="offer_name" placeholder="{{_i('Offer Name')}}" required="">
                                        <span class="input-group-addon" id="basic-addon5">
                                            <i class="icofont icofont-ticket"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <!----==========================  end date ==========================--->
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="date" id="date" name="expire_date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" placeholder="{{_i('Expire Date')}}" >
                                        <span class="input-group-addon" id="basic-addon5">
                                             <i class="icofont icofont-calendar"></i>
                                        </span>

                                    </div>
                                    <small  class="form-text text-muted" style="margin-top:-15px;">{{_i('Please select expire date offer')}}</small>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!------------------------------------- If the customer bought ----------------------------->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> {{ _i('If the client buy') }} </h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                        </div>
                    </div>

                    <div class="card-block">

                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control" name="discount_code_item_type" id="discount_code_item_type" required="">
                                            <option selected disabled>{{_i('Select the option')}}</option>
                                            <option value="product">{{_i('Selected products')}}</option>
                                            <option value="category">{{_i('Selected categories')}}</option>
                                        </select>
                                        <span class="input-group-addon" id="basic-addon5">
                                            <i class="icofont icofont-jersey"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <select class="form-control" name="items_count" required="">
                                            <option selected disabled>{{_i('Quantity ')}}</option>
                                            @for($i = 1 ; $i <= 100 ; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <span class="input-group-addon" id="basic-addon5">
                                            <i class="icofont icofont-basket"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <!----==========================  show selected div ==========================--->

                            <div id="items_category" style="display: none">

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select class="form-control selectpicker" multiple="multiple" name="buyCategories[]">
                                                <option selected disabled>{{_i('Select categories')}}</option>
                                                <option value="all_category" >{{_i('All Categories')}}</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="items_product" style="display: none">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select class="form-control selectpicker" multiple="multiple" name="buyProducts[]">
                                                <option selected disabled>{{_i('Select Products')}}</option>
                                                <option value="all_product" >{{_i('All Products')}}</option>
                                            @foreach($products as $product)
                                                    <option value="{{$product->prod_id}}">{{$product->title}}</option>
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

            <!------------------------------------- Obtains ----------------------------->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> {{ _i('Obtains') }} </h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                        </div>
                    </div>

                    <div class="card-block">

                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control" name="discount_type" id="discount_type"  required="">
                                            <option selected disabled>{{_i('Discount Type')}}</option>
                                            <option value="perc" class="discount_type_perc">{{_i('Discount by Percentage')}}</option>
                                            <option value="item" class="discount_type_item">{{_i('Free Product')}}</option>
                                        </select>
                                        <span class="input-group-addon" id="basic-addon5">
                                            <i class="icofont icofont-navigation-menu"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-4 discount">
                                    <div class="input-group ">
                                        <input type="number" class="form-control " name="discount" max="100" min="1" placeholder="{{_i('discount percentage')}}">
                                        <span class="input-group-addon" id="basic-addon5">
                                            <i class="icofont icofont-sale-discount"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select class="form-control " name="model_type" id="model_type">
                                            <option selected disabled>{{_i('Select the option')}}</option>
                                            <option value="products">{{_i('Selected products')}}</option>
                                            <option value="category">{{_i('Selected categories')}}</option>
                                        </select>
                                        <span class="input-group-addon" id="basic-addon5">
                                            <i class="icofont icofont-jersey"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div id="section_category" style="display: none">

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select class="form-control selectpicker" multiple="multiple" name="optainCategories[]">
                                                <option selected disabled>{{_i('Select categories')}}</option>
                                            @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="section_product" style="display: none">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <select class="form-control selectpicker" multiple="multiple" name="optainProducts[]">
                                                <option selected disabled>{{_i('Select Products')}}</option>
                                            @foreach($products as $product)
                                                    <option value="{{$product->prod_id}}">{{$product->title}}</option>
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

        <div class="row">

            <div class=" col-sm-12 text-center " >
                <button type="submit"  class="btn btn-primary  btn-round col-sm-10">{{_i('Save')}}</button>
            </div>

        </div>

        </form>
    </div>




@endsection


@push('js')
<script>


    //section 2 => if client buy
    $('body').on('change' , '#discount_code_item_type' , function(){ // if selected option change
        var discountItemType = $(this).val();
        console.log($(this).val());

        if (discountItemType == "product"){
            $('#items_category').hide();
            $('#items_product').show();
        }
        else{
            $('#items_category').show();
            $('#items_product').hide();
        }
    });


    // section 3 => optains
    $("#discount_type").val("perc"); // put option selected

    $('body').on('change' , '#discount_type' , function(){ // if selected option change
        var discountType = $(this).val();
        //console.log($(this).val());

        if (discountType == "perc")
            $('.discount').css('display','block');
        else
            $('.discount').css('display','none');
    });

    //show_sections
    $('body').on('change' , '#model_type' , function(){
        var modelType = $(this).val();

        if (modelType == "products"){
             $('#section_category').hide();
            $('#section_product').show();
        }
        else{
            $('#section_category').show();
            $('#section_product').hide();
        }
    });







    $('body').on('change' , '#mod_type' , function(){ // if selected option change
        var modelType = $(this).val();
        //console.log($(this).val());
        //var html ='';
        if (modelType == "products"){
            //$('#section_product').css('display','block');
            //$('#section_product').show();

            var html ='';
            html +='<div class="form-group row"> <div class="col-sm-10"> <div class="input-group">';
            html +='<select class="form-control " id="show_product" multiple="multiple" name="optainProducts[]">';
            html +='<option selected disabled>{{_i('Select Products')}}</option>';
            @foreach($products as $product)
                html +='<option value="{{$product->prod_id}}">{{$product->title}}</option>';
            @endforeach
                html +='</select> </div> </div> </div>';
            $('#section_product').prepend(html);
            $('#show_product').addClass("selectpicker");
            $('#show_product').selectpicker('refresh');
            $('#section_category').css('display','none');
            //('#section_category').hide();
        }
        else{
            $('#section_category').css('display','block');
            // $('#section_category').show();

            var html_cat ='';
            html_cat +='<div class="form-group row"> <div class="col-sm-10"> <div class="input-group">';
            html_cat +='<select class="form-control " id="show_category" multiple="multiple" name="optainCategories[]">';
            html_cat +='<option selected disabled>{{_i('Select categories')}}</option>';
            @foreach($categories as $cat)
                html_cat +='<option value="{{$cat->id}}">{{$cat->title}}</option>';
            @endforeach
                html_cat +='</select> </div> </div> </div>';
            $('#section_category').prepend(html_cat);
            $('#show_category').addClass("selectpicker");
            $('#show_category').selectpicker('refresh');
            // $('#section_product').css('display','none');
            $('#section_product').hide();

        }
    });

    //show_sections
    $('body').on('change' , '#mod_type' , function(){

        var modelType = $(this).val();

        if (modelType == "products"){

            // $('#section_category').empty();
            $('#section_product').prepend('<div class="form-group row"> <div class="col-sm-10"> <div class="input-group">'+
                '<select class="form-control " id="show_product" multiple="multiple" name="optainProducts[]">'+
                '<option selected disabled>{{_i('Select Products')}}</option>'
                    @foreach($products as $product)
                +'<option value="{{$product->prod_id}}">{{$product->title}}</option>'+
                    @endforeach
                        '</select> </div> </div> </div>');
            //$('#show_product').addClass("selectpicker");
            //$('#show_product').selectpicker('refresh');
        }
        else{
            // $('#section_product').empty();
            $('#section_category').prepend('<div class="form-group row"> <div class="col-sm-10"> <div class="input-group">'+
                '<select class="form-control " id="show_category" multiple="multiple" name="optainCategories[]">'+
                '<option selected disabled>{{_i('Select categories')}}</option>'
                    @foreach($categories as $cat)
                +'<option value="{{$cat->id}}">{{$cat->title}}</option>'+
                    @endforeach
                        '</select> </div> </div> </div>');
            //$('#show_category').addClass("selectpicker");
            // $('#show_category').selectpicker('refresh');
        }


    });

</script>
@endpush
