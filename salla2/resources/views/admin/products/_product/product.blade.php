
@extends('admin.layout.layout')

@section('title')
    products
@endsection

@section('page_header_name')
    products
@endsection


@section('content')
@push('css2')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endpush
@push('js')
    <script>
        $(function () {
            'use strict'
            var product_type = '';
            $('.product_type').change(function (e) {
                product_type = $(e.target).val();
            });
            $('.save-product').on('click',function () {
                var price = $('.price').val();
                var product_name = $('.product_name').val();
                if (product_type == ''){
                    swal.fire({
                        type: 'error',
                        title: 'تنبيه',
                        text: 'قم باختيار نوع المنتج لتتمكن من حفظ المنتج',
                    });
                }
                if (price != null){

                }


            })
        })
    </script>
    <script>
        $('.selectpicker').selectpicker('refresh');
        function createProduct() {

            var html='';
            var prod_id=-Math.floor((Math.random() * 1000000000) + 1);
            var name="";
            var price="";
            var quantity="";
            var status="";

            var prod_thumb="{{asset('images/placeholder.png')}}";

            var products_div="products_div";
            var category_id = null;
            var category_name = null;

            html+='<div class="col-md-4 col-lg-3">';
            html+='<div class="product-box">';
            html+='<div class="product-img-details">';
            html+='<img src="{{asset('images/placeholder.png')}}" alt="#" class="product-img">';
            html+='<button type="button" class="bt btn-tiffany add-img" data-toggle="modal" data-target="#product-images">اضف صوره</button>';
            html+='</div>';
            html+='<div class="inputs-product-body">';
            html+='<div class="form-group">';
            html+='<span class="addon-tag"><i class="fa fa-tag"></i></span>';
            html+='<select class="selectpicker product_type" data-size="5">';
            html+='<option value="">نوع المنتج</option>';
            @foreach($product_type as $type)
            html+='<option data-subtext="{{$type->description}}" value="{{$type->id}}">{{$type->title}}</option>';
            @endforeach
            html+='</select>';
            html+='<div class="clearfix"></div>';
            html+='</div>';
            html+='<div class="form-group">';
            html+='<span class="addon-tag"><i class="fa fa-tag"></i></span>';
            html+='<input type="text" class="form-control product_name" name="product_name">';
            html+='<div class="clearfix"></div>';
            html+='</div>';
            html+='<div class="form-group row">';
            html+='<div class="col-md-6">';
            html+='<span class="addon-tag"><i class="fa fa-tag"></i></span>';
            html+='<input type="text" class="form-control price" name="price">';
            html+='<div class="clearfix"></div>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<span class="addon-tag"><i class="fa fa-tag"></i></span>';
            html+='<input type="text" class="form-control product_count" name="product_count">';
            html+='<div class="clearfix"></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="form-group row">';
            html+='<div class="category-select">';
            html+='<button class="btn btn-default optional-category"  data-toggle="modal" data-target="#details">select new<i class="fa fa-angle-left"></i></button>';
            html+='</div>';
            html+='<div class="product-desc">';
            html+='<span class="addon-tag"><i class="fa fa-tag"></i></span>';
            html+='<select class="selectpicker multiple" data-size="5" multiple="multiple">';
            @foreach($categories as $category)
            html+='<option value="{{$category->id}}">{{$category->title}}</option>';
            @endforeach
            html+='</select>';
            html+='<button class="btn btn-tiffany add-category" data-toggle="modal" data-target="#category"><i class="fa fa-plus"></i></button>';
            html+='<div class="clearfix"></div>';
            html+='</div>';
            html+='</div>';
            html+='<div class="form-group">';
            html+='<button class="btn btn-tiffany save" type="button">save</button>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';


            $('#'+products_div).prepend(html);

            // $('#'+products_div+' #product_category_'+prod_id).selectpicker();
            $('.selectpicker').selectpicker();

            $('#'+products_div+' #product_type_'+prod_id).on('change',function(e){
                var _product_type = $(this).val();
                var _product_id = $(this).attr('data-product-id');

                $('#product_price_'+_product_id).attr('readOnly' , false);
                $('#product_quantity_'+_product_id).attr('readOnly' , false);
                if ( _product_type == "donating" ){
                    $('#product_price_'+_product_id).attr('readOnly' , true);
                    $('#product_quantity_'+_product_id).attr('readOnly' , true);
                }

            });

            // Refresh select
            $('#'+products_div+' #product_category_'+prod_id).on('show.bs.select', function(e) {
                // if (update_categories_flag == false) return;
                var load_options = $('#'+products_div+' #product_category_'+prod_id).data('load_options');
                if(load_options == 'false' || load_options == false) {

                    var old_val = $('#' + products_div + ' #product_category_' + prod_id).val();
                    $('#' + products_div + ' #product_category_' + prod_id + ' > option').remove();

                    var _options = ''; // '<option value="">التصنيف</option>';


                    for (var i in categories) {
                        var _main_selected = (old_val == categories[i].id) ? 'selected="selected"' : '';
                        _options += '<option value="' + categories[i].id + '" ' + _main_selected + '>' + categories[i].name + '</option>';

                        if (categories[i].sub_categories.length > 0) {
                            for (var n in categories[i].sub_categories) {

                                var _sub_selected = (old_val == categories[i].sub_categories[n].id) ? 'selected="selected"' : '';

                                _options += '<option class="subcategory" value="' + categories[i].sub_categories[n].id + '" ' + _sub_selected + '>&nbsp; — ' + categories[i].sub_categories[n].name + '</option>';
                            }
                        }
                    }

                    $('#' + products_div + ' #product_category_' + prod_id).append(_options);
                    $('#' + products_div + ' #product_category_' + prod_id).selectpicker('refresh');

                    // update_categories_flag = false;
                    $('#' + products_div + ' #product_category_' + prod_id).data('load_options', 'true');
                }
            });


        }
    </script>
@endpush
<div class="content">
    <div class="row btns-row">
        <div class="col-xs-5 main-btn">
            <a class="btn btn-tiffany btn-rounded btn-xlg" id="add-btn" onClick="createProduct()"><i class="fa fa-plus"></i> منتج جديد</a>
        </div>
        <div class="col-xs-7">
            <ul class="nav nav-pills">
                <li class="dropdown"><a href="#" data-toggle='dropdown' class="service"><i class="fa fa-briefcase"></i>خدمات</a>
                <ul class="dropdown-menu">
                    <li class="dropdown"><a data-toggle="dropdown" href="#">test2 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right active">
                            <li class="dropdown-submenu dropdown-submenu-left active"><a href="#">test1</a></li>
                            <li><a href="#">test1</a></li>
                            <li><a href="#">test1</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a data-toggle="dropdown" href="#">test2 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right active">
                            <li class="dropdown-submenu dropdown-submenu-left active"><a href="#">test1</a></li>
                            <li><a href="#">test1</a></li>
                            <li><a href="#">test1</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a data-toggle="dropdown" href="#">test2 <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right active">
                            <li class="dropdown-submenu dropdown-submenu-left active"><a href="#">test1</a></li>
                            <li><a href="#">test1</a></li>
                            <li><a href="#">test1</a></li>
                        </ul>
                    </li>
                    <li><a href="#">test2 <i class="fa fa-angle-down"></i></a></li>
                    <li><a href="#">test2 <i class="fa fa-angle-down"></i></a></li>
                    <li><a href="#">test2 <i class="fa fa-angle-down"></i></a></li>
                </ul>
                </li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="filter"><i class="fa fa-filter"></i>تصفيه</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">test1</a></li>
                        <li><a href="#">test1</a></li>
                        <li><a href="#">test1</a></li>
                        <li><a href="#">test1</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div id="products_div" class="row">
        <div class="col-md-4 col-lg-3">
            <div class="product-box">
                <div class="product-img-details">
                    <img src="{{asset('images/placeholder.png')}}" alt="#" class="product-img">
                    <button type="button" class="bt btn-tiffany add-img" data-toggle="modal" data-target="#product-images">اضف صوره</button>
                </div>
                <div class="inputs-product-body">
                    <div class="form-group">
                        <span class="addon-tag"><i class="fa fa-tag"></i></span>
                        <select class="selectpicker product_type" data-size="5">
                            <option value="">نوع المنتج</option>
                            @foreach($product_type as $type)
                                <option data-subtext="{{$type->description}}" value="{{$type->id}}">{{$type->title}}</option>
                            @endforeach
                        </select>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <span class="addon-tag"><i class="fa fa-tag"></i></span>
                        <input type="text" class="form-control product_name" name="product_name">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <span class="addon-tag"><i class="fa fa-tag"></i></span>
                            <input type="text" class="form-control price" name="price">
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6">
                            <span class="addon-tag"><i class="fa fa-tag"></i></span>
                            <input type="text" class="form-control product_count" name="product_count" >
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="category-select">
                            <button class="btn btn-default optional-category"  data-toggle="modal" data-target="#details">select new<i class="fa fa-angle-left"></i></button>
                        </div>
                        <div class="product-desc">
                            <span class="addon-tag"><i class="fa fa-tag"></i></span>
                            <select class="selectpicker multiple" data-size="5" multiple="multiple">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-tiffany add-category" data-toggle="modal" data-target="#category"><i class="fa fa-plus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-tiffany save save-product">save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@include('admin.products.product.modal.images')
@include('admin.products.product.modal.category',['categories'=>$categories])
@include('admin.products.product.modal.details')

<div class="pace-demo hidden">
    <div class="theme_tail_circle">
        <div class="pace_progress" data-progress-text="60%" data-progress="60"></div>
        <div class="pace_activity"></div>
    </div>
</div>
@endsection
