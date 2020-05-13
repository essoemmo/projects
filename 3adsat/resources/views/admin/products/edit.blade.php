
@extends('admin.layout.index',[
'title' => _i('Edit Product '),
'subtitle' => _i('Edit Product '),
'activePageName' => _i('Edit Product'),
'additionalPageUrl' => url('/admin/panel/products') ,
'additionalPageName' => _i('All'),
] )

@push('css')
<style type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css"></style>
<style type="text/css">
.form-group {
    margin-top: 15px;
}

    #new-row{
        display: none;
    }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">

@endpush
{{--@include('boilerplate::load.icheck')--}}
@section('content')
<form class="form-horizontal" data-parsley-validate=""  action="{{route('products.update', ['id' => $rowData->id]) }}" method="POST" enctype="multipart/form-data" id="editForm" role="form" data-toggle="validator"  >
    @csrf
    {{ method_field('PUT') }}

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("products.index") }}" class="btn btn-default">
                               <i class="ti-list"></i> {{ _i('Products List') }}
                            </a></li>
                        <li class="breadcrumb-item active pull-left"><button type="submit" class="btn btn-primary">
                              <i class="ti-save"></i>  {{_i('save') }}
                            </button></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h5 class="box-title">{{ _i('Edit Product') }}</h5>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item active"><a class="nav-link" href="#tab-general" data-toggle="tab">{{ _i('Basic') }}<i class="fa"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-price" data-toggle="tab">{{ _i('Price') }}<i class="fa"></i></a></li>

                                    <li class="nav-item"><a class="nav-link" href="#tab_links" data-toggle="tab">{{ _i('Description') }}<i class="fa"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-attributes" data-toggle="tab">{{ _i('Attributes') }}<i class="fa"></i></a></li>
                                <!--<li><a href="#tab-options" data-toggle="tab">{{ _i('Options') }}<i class="fa"></i></a></li>-->
                                    <li class="nav-item"><a class="nav-link" href="#tab-discounts" style="display: none" data-toggle="tab">{{ _i('Discounts') }}<i class="fa"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-images" data-toggle="tab">{{ _i('Images') }}<i class="fa"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-colors" data-toggle="tab">{{ _i('Colors') }}<i class="fa"></i></a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_data" data-toggle="tab">{{ _i('Data') }}<i class="fa"></i></a></li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                @include("admin.products.edit.general")

                                @include("admin.products.edit.price")
                                @include("admin.products.edit.links")
                                @include("admin.products.edit.attributes")
                                @include("admin.products.edit.discounts")
                                @include('admin.products.edit.images')
                                @include('admin.products.edit.color')
                                @include('admin.products.edit.data')
                                <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </div>
                        <!-- ./card -->
                    </div>
                    <!-- /.col -->
                </div>
{{--                <div class="box-body">--}}
{{--                    <div class="nav-tabs-custom">--}}
{{--                        <ul class="nav nav-tabs">--}}
{{--                            <li class="active" style="padding: 20px"><a href="#tab-general" data-toggle="tab">{{ _i('Basic') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-price" data-toggle="tab">{{ _i('Price') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-links" data-toggle="tab">{{ _i('Description') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-attributes" data-toggle="tab">{{ _i('Attributes') }}<i class="fa"></i></a></li>--}}
{{--<!----}}{{--                            <li><a href="#tab-options" data-toggle="tab">{{ _i('Options') }}<i class="fa"></i></a></li>--}}{{---->--}}
{{--                            <!--<li><a href="#tab-discounts" style="">{{ _i('Discounts') }}<i class="fa"></i></a></li>-->--}}
{{--                            <li style="padding: 20px"><a href="#tab-images" data-toggle="tab">{{ _i('Images') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-colors" data-toggle="tab">{{ _i('Colors') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-data" data-toggle="tab">{{ _i('Data') }}<i class="fa"></i></a></li>--}}
{{--                        </ul>--}}
{{--                        <div class="tab-content">--}}

{{--                            @include("admin.products.edit.general")--}}

{{--                            @include("admin.products.edit.price")--}}
{{--                            @include("admin.products.edit.links")--}}
{{--                            @include("admin.products.edit.attributes")--}}
{{--                            @include("admin.products.edit.discounts")--}}
{{--                            @include('admin.products.edit.images')--}}
{{--                            @include('admin.products.edit.color')--}}
{{--                            @include('admin.products.edit.data')--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- nav-tabs-custom -->--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</form>
@endsection
{{--@include('boilerplate::load.select2')--}}
{{--@include('boilerplate::load.fileinput')--}}
{{--@include('boilerplate::load.datepicker')--}}
@push('js')
{{--<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>--}}
{{--<script src="{{ asset ('/vendor/bootstrap-validator/validator.js') }}"></script>--}}
{{-- <script src="{{ asset ('/js/admin/products/edit.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
<script>
    $('.selectpicker').selectpicker();
// $('.select2').select2();
// $('.datepicker').datepicker({
//        format: 'yyyy-mm-dd'
//     });

    $('.card .nav-item a').on('click', function(e) {
        var currentAttrValue = $(this).attr('href');
        $('.card ' + currentAttrValue).show().siblings().hide();
        $(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });

    $(function () {
        'use strict';

        $(".attributeGroup").on("change",function(){
            var attributeGroup = $('.attributeGroup option:selected').val();
            console.log(attributeGroup);
            $("#loadingmessage").css("display","block");
            $(".column-data").css("display","none");

            if (this){
                $.ajax({
                    url: '{{url('admin/panel/getAttributes') }}',
                    type:'get',
                    dataType:'html',
                    data:{attributeGroup: attributeGroup},
                    success: function (data) {
                        $("#loadingmessage").css("display","none");
                        $('.column-data').css("display","block").html(data);

                    }
                });
            }else{
                $('.column-data').html('');
            }
        });


    });

$(function(){var radios = $('input[name=product_type]').click(function () {
        var value = radios.filter(':checked').val();
        if(value=="lenses"){
            $("#show_options").show();
            $("#show_lenses").show();
        } else {
            $("#show_options").hide();
            $("#show_lenses").hide();
        }
    });
});

function showShippingCouriers(index ,$value){
    if($value){
        $('.shippingDiv'+index).show();
    } else {
        $('.shippingDiv'+index).hide();
    }
}


var attribute_row = {{count($productAttributes)}};



function addAttribute() {
    html = '<tr id="attribute-row' + attribute_row + '">';
    html += '  <td class="text-left" style="width: 40%;">' +
        '<select class="form-control select2"  id="product_attribute[' + attribute_row + '][attribute_id]" name="product_attribute[' + attribute_row + '][attribute_id]">';
    @foreach($attributes as $item)
        html += '<option value="{{ $item->id }}" {{ ( old("product_attribute[' + attribute_row + '][attribute_id]") == $item->id ? "selected":"") }}>{{ $item->group_name ." > ". $item->name }}</option>';
    @endforeach
        html += ' </select><input type="hidden" name="product_attribute[' + attribute_row + '][product_attribute_id]" value="" />';
    html += '  <td class="text-left">';

    @foreach($languages as $lang)
        html += '<div class="input-group"><span class="input-group-addon"><img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}" /></span><textarea name="product_attribute[' + attribute_row + '][text][{{ $lang->id }}]" rows="5" placeholder="{{ _i('Text') }}" class="form-control"></textarea></div>';

    @endforeach
        html += '  </td>';

    html += '  <td class="text-right"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove ') }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    $('#attribute').append(html);

    attribute_row++;
}

var discount_row = {{count($productDiscounts)}};

function addDiscount() {

    html  = '<tr id="discount-row' + discount_row + '">';
    html += '  <td class="text-right"><input type="number" min="1" step="0.1" name="product_discount[' + discount_row + '][price]" value="" placeholder="{{ _i('Price') }}" class="form-control" />';
    html += '  <td class="text-right"><input type="number" min="1" step="1" name="product_discount[' + discount_row + '][priority]" value="" placeholder="{{ _i('Priority') }}" class="form-control" />';
    html += '<input type="hidden" name="product_discount[' + discount_row + '][product_discount_id]" id="product_discount[' + discount_row + '][product_discount_id]" value=""></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="{{ _i('Date Start') }}" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="ti-calendar"></i></button></span></div></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="{{ _i('Date End') }}" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="ti-calendar"></i></button></span></div></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="ti-minus"></i></button></td>';
    html += '</tr>';

    $('#discount tbody').append(html);

    discount_row++;

    $('.date').datepicker({
       format: 'yyyy-mm-dd'
    });
}

var image_row = {{count($productImages)}};

function addImage() {
    var sort_order = image_row + 2;
    html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left"><input type="file" name="product_image[' + image_row + '][image]" value="" id="product_image[' + image_row + '][image]" accept="image/gif, image/jpeg, image/png"></td>';
    html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="' + sort_order + '" placeholder="{{ _i('Sort Order') }}" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="ti-minus"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    image_row++;
}

function deleteProductAttribute(rowNum, attribute_id, product_id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteProductAttribute') !!}',
        data: { attribute_id: attribute_id , product_id: product_id }
    })
    .done(function(msg) {
        // alert("Data Saved: " + msg);
    });
    $('#attribute-row' + rowNum).remove();
}

function deleteCountryProduct(id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteCountryProduct') !!}',
        data: { id: id }
    })
    .done(function(msg) {
        // alert("Data Saved: " + msg);
    });
    $('.new-row' + id).remove();
}

function deleteProductOption(rowNum, product_option_id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteProductOption') !!}',
        data: { product_option_id: product_option_id }
    })
    .done(function(msg) {
        // alert("Data Saved: " + msg);
    });
    $('#delete-option' + rowNum).tooltip('destroy');
    $('#div-option' + rowNum).remove();
}

function deleteProductOptionValue(rowNum, product_option_value_id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteProductOptionValue') !!}',
        data: { product_option_value_id: product_option_value_id }
    })
    .done(function(msg) {
    });
    $('#delete-option-value' + rowNum).tooltip('destroy');
    $('#option-value-row' + rowNum).remove();
}

function deleteProductDiscount(rowNum, product_discount_id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteProductDiscount') !!}',
        data: { product_discount_id: product_discount_id }
    })
    .done(function(msg) {
        // alert("Data Saved: " + msg);
    });
    $('#discount-row' + rowNum).remove();
}

function deleteProductImage(rowNum, product_image_id) {
    //delete with ajax
    $.ajax({
        method: "POST",
        url: '{!! route('products.deleteProductImage') !!}',
        data: {product_image_id: product_image_id}
    })
        .done(function (msg) {
            // alert("Data Saved: " + msg);
        });
    $('#image-row' + rowNum).remove();
}

function hidePrice(id) {
    // $("#price").css('display', 'none');
    // document.getElementById("price" + id).disabled = "disabled";
}
function initView() {
        // Set Events
        $('input[name="product_type"]').on('click', function(e) {
            if (e.target.id === "product_type_1") {
                $('#lenses_selection').show();
            } else {
                $('#lenses_selection').hide();
            }
        });
    }
    initView();

</script>
@endpush
