
@extends('admin.layout.index',[
'title' => _i('Add Product '),
'subtitle' => _i('Add Product '),
'activePageName' => _i('Add Product'),
'additionalPageUrl' => url('/admin/panel/products') ,
'additionalPageName' => _i('All'),
] )

@push('css')
<style type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css"></style>
<style type="text/css">
.form-group {
    margin-top: 15px;
}
    .hidden{
        display: none !important;
    }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">

@endpush
{{--@include('boilerplate::load.icheck')--}}
@section('content')
<form class="form-horizontal" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" id="addForm" role="form" data-toggle="validator" data-parsley-validate="">
    @csrf



                        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("products.index") }}" class="btn btn-default">
                              <i class="ti-list"></i>  {{ _i('Products List') }}
                            </a></li>
                        <li class="breadcrumb-item pull-left"><button type="submit" class="btn btn-primary">
                                <i class="ti-save"></i>{{_i('save') }}
                            </button></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
{{--                <div class="box-header">--}}
{{--                    <h5 class="box-title">{{ _i('Add Product') }}</h5>--}}
{{--                </div>--}}

                <div class="row m-b-30">
                    <div class="col-lg-12 col-sm-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">{{ _i('Basic') }}</a>
                                    <li class="nav-item"><a class="nav-link" href="#price" data-toggle="tab">{{ _i('Price') }}</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#links" data-toggle="tab">{{ _i('Description') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">{{ _i('Attributes') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">{{ _i('Images') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#colors" data-toggle="tab">{{ _i('Colors') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#data" data-toggle="tab">{{ _i('Data') }}</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content tabs card-block">

                                    @include("admin.products.create.general")
                                    @include("admin.products.create.price")
                                    @include('admin.products.create.links')
                                    @include('admin.products.create.attributes')
                                    @include('admin.products.create.discounts')
                                    @include('admin.products.create.images')
                                    @include('admin.products.create.color')
                                    @include("admin.products.create.data")
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
{{--                            <!--<li><a href="#tab-options" data-toggle="tab">{{ _i('Options') }}<i class="fa"></i></a></li>-->--}}
{{--                            <li style="padding: 20px"><a href="#tab-discounts" style="display: none" data-toggle="tab">{{ _i('Discounts') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-images" data-toggle="tab">{{ _i('Images') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-colors" data-toggle="tab">{{ _i('Colors') }}<i class="fa"></i></a></li>--}}
{{--                            <li style="padding: 20px"><a href="#tab-data" data-toggle="tab">{{ _i('Data') }}<i class="fa"></i></a></li>--}}
{{--                        </ul>--}}
{{--                        <div class="tab-content">--}}
{{--                            edit by ibrahim el monier--}}

{{--           --}}

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
{{-- <script src="{{ asset ('/js/admin/products/create.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>

<script>
$('.selectpicker').selectpicker();
// $('.select2').select2();
// $('.datepicker').datepicker({
//        format: 'yyyy-mm-dd'
//     });


    $(document).ready(function () {
        $("body").on("change",'.attributeGroup',function(e){
            e.preventDefault();
            // console.log('samer');
            var attributeGroup = $('.attributeGroup option:selected').val();
            // console.log(attributeGroup);
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




$(function(){var radios = $('input[name=product_type]').change(function () {
    var value = radios.filter(':checked').val();
    if(value=="lenses"){$("#show_options").show()} else {$("#show_options").hide()}
    });
});

function showShippingCouriers($value){
    if($value){
        $('.shippingDiv').show();
    } else {
        $('.shippingDiv').hide();
    }
}

// var attribute_row = 0;

{{--function addAttribute() {--}}
{{--    html = '<tr id="attribute-row' + attribute_row + '">';--}}
{{--    html += '  <td class="text-left" style="width: 40%;">' +--}}
{{--        '<select class="form-control select2"  id="product_attribute[' + attribute_row + '][attribute_id]" name="product_attribute[' + attribute_row + '][attribute_id]">';--}}
{{--    @foreach($attributes as $item)--}}
{{--    html += '<option value="{{ $item->id }}" {{ ( old("product_attribute[' + attribute_row + '][attribute_id]") == $item->id ? "selected":"") }}>{{ $item->group_name ." > ". $item->name }}</option>';--}}
{{--    @endforeach--}}
{{--    html += ' </select><input type="hidden" name="product_attribute[' + attribute_row + '][product_attribute_id]" value="" />';--}}

{{--    html += '  <td class="text-left">';--}}

{{--    @foreach($languages as $lang)--}}
{{--    html += '<div class="input-group"><span class="input-group-addon"><img src="{{ asset('images/languages/'.$lang->image) }}" title="{{ $lang->name }}" /></span><textarea name="product_attribute[' + attribute_row + '][text][{{ $lang->id }}]" rows="5" placeholder="{{ _i('Text') }}" class="form-control"></textarea></div>';--}}

{{--    @endforeach--}}
{{--    html += '  </td>';--}}
{{--    html += '  <td class="text-right"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove ') }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';--}}
{{--    html += '</tr>';--}}

{{--    $('#attribute tbody').append(html);--}}
{{--    attribute_row++;--}}
{{--}--}}

var discount_row = 0;

function addDiscount() {
    html  = '<tr id="discount-row' + discount_row + '">';
    html += '  <td class="text-right"><input type="number" min="1" step="0.1" name="product_discount[' + discount_row + '][price]" value="" placeholder="{{ _i('Price') }}" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="number" min="1" step="1" name="product_discount[' + discount_row + '][priority]" value="" placeholder="{{ _i('Priority') }}" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="{{ _i('Date Start') }}" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="{{ _i('Date End') }}" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#discount tbody').append(html);

    $('.date').datepicker({
       format: 'yyyy-mm-dd'
    });

    discount_row++;
}

var image_row = 3;

function addImage() {
    var sort_order = image_row + 1;
    html  = '<tr id="image-row' + image_row + '">';
    html += '  <td class="text-left"><input type="file" name="product_image[' + image_row + '][image]" value="" id="product_image[' + image_row + '][image]" accept="image/gif, image/jpeg, image/png"></td>';
    html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="' + sort_order + '" placeholder="{{ _i('Sort Order') }}" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    image_row++;
}

function hidePrice() {
    // $("#price").css('display', 'none');
    document.getElementById("price").disabled = "disabled";
}

function hidePkgAmount() {
    // $("#price").css('display', 'none');
    document.getElementById("pkgAmount").disabled = "disabled";
    document.getElementById("pkgAmount1").disabled = "disabled";
}

$('.card .nav-item a').on('click', function(e) {
    var currentAttrValue = $(this).attr('href');
    $('.card ' + currentAttrValue).show().siblings().hide();
    $(this).parent('li').addClass('active').siblings().removeClass('active');
    e.preventDefault();
});

</script>
@endpush
