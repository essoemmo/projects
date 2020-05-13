@extends('admin.AdminLayout.index')
@section('title')
    {{_i('products')}}
@endsection

@section('page_header_name')
    {{_i('products')}}
@endsection


@section('content')
    @push('css')
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <style>

            .product-desc .dropdown-menu {
                position: static !important;
            }

            .dropdown-menu.open {
                left: 70px;
                overflow: visible;
            }

            input {
                padding-right: 30px !important;
            }

            .btn.btn-tiffany {
                cursor: pointer;
            }


            .dropdown-menu.open {
                left: -70px;
                overflow: visible;
                /*left: 0;*/
            }


            .product-desc .dropdown-item {
                display: block;
                width: 100%;
                padding: .25rem 0 .25rem 1.5rem;
                clear: both;
                font-weight: 400;
                color: #212529;
                text-align: right;
                white-space: nowrap;
                background: 0 0;
                border: 0;
            }

            .type .dropdown-item {
                text-align: right;
            }

            .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {
                margin-left: 34px;
            }

            .dropdown-menu {
                z-index: 9999;
            }
        </style>

        <!--<link rel="stylesheet" href="{{asset('css/custom.css')}}">-->
        <link rel="stylesheet" href="{{asset('admin/dropzone.css')}}">

        <style>
            .product-desc .dropdown-item {
                display: block;
                width: 100%;
                padding: .25rem 0 .25rem 1.5rem;
                clear: both;
                font-weight: 400;
                color: #212529;
                text-align: right;
                white-space: nowrap;
                background: 0 0;
                border: 0;
            }

            .type .dropdown-item {
                text-align: right;
            }

            .product-desc .bootstrap-select.show-tick .dropdown-menu li a span.text {
                margin-left: 34px;
            }

            .dropdown-menu {
                z-index: 9999;
            }
        </style>

    @endpush
    <div class="products-lists">

        <div class="content">
            <div class="row btns-row d-flex justify-content-between">
                <div class="col-xs-5 main-btn">
                    <a class="btn btn-tiffany btn-rounded btn-xlg" id="add-btn" onclick="addNewProduct()"><i
                            class="fa fa-plus"></i>{{_i("Add Product")}}</a>
                <!--                            <a class="btn btn-tiffany btn-rounded btn-xlg" href="{{url('/adminpanel/product_type/all')}}"><i
                            class="fa fa-circle-o"></i>{{_i("Types")}}</a>-->
                </div>


                <div class="col-xs-7 ">
                    @include('admin.products.products.includes.filter')
                </div>
                <!--        <FilterProduct></FilterProduct>-->
            </div>

        @include("admin.products.products.partial.product")
        @include("admin.products.products.partial.category")
        @include("admin.products.products.partial.modal")

        <!--        <ProductModel :created_at="created_at" :features="features" :prod="prod" :store="store"></ProductModel>
                <ImageModel ref="imagemodel" @getMainImage="getImage" :prod="prod" :store="store"></ImageModel>-->
        </div>

    </div>

    @php

        $data = \Session::get('data');

    @endphp
@endsection



@push("js")

    <script src="{{ asset('admin/dropzone.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            'use strict'
            $('.product-desc .selectpicker').on('change', function (e) {
                $(this).next().next().addClass('show');
            })
            $('body').click(function () {
                $('.product-desc .selectpicker').next().next().removeClass('show');
            })
        })

        function addNewProduct() {
            html = `<div class="col-md-4 col-sm-3">
        <div class="product-box">
         <form name="frm_product">
            <div class="product-img-details">
                <img  src="{{asset("/images/placeholder.png")}}" alt="#" class="product-img">
                <button  type="button" class="bt btn-tiffany add-img" onclick="getProdImgid(this)"> {{_i("Add Photo")}}</button>
            </div>
            <div class="inputs-product-body">

                    @csrf
            <div class="form-group type">
                <span class="addon-tag"><i class="fa fa-tag"></i></span>
{!! Form::select('types', $product_type,null, ['class' => 'input selectpicker' ,"placeholder" =>_i("Product Type")]) !!}
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <span class="addon-tag"><i class="ti-shopping-cart-full"></i></span>
            <input type="text" class="form-control product_name input" name="product_name" placeholder="{{_i("Product Name")}}" required="" class="input border-danger">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <span class="addon-tag"><i class="ti-money"></i></span>
                            <input type="number" min="1" max="1000000" class="form-control price" name="price" required="" placeholder="{{_i("Price")}}" class="input border-danger">
                            <div class="clearfix"></div>
                        </div>
                        <div class="col">
                            <span class="addon-tag"><i class="ti-tag"></i></span>
                            <input type="number" min="1" max="1000000" class="form-control product_count" name="count" placeholder="{{_i("Count")}}"  required="" class="input border-danger">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="product-desc  col-sm-6 input-group">
                            <span class="addon-tag"><i class="fa fa-tag"></i></span>
<?php
            //$cats = $categories->pluck("title", "id");
            ?>
            {!! Form::select('categories[]', $cats,null, [ "multiple" =>"multiple" , "class" => " selectpicker" ]) !!}
            <button class="btn btn-tiffany add-category input-group-btn" data-toggle="modal" data-target="#category" type="button"><i class="ti-plus"></i></button>
            <div class="clearfix"></div>
        </div>
        <div class="category-select col-sm-6">
            <button class="btn btn-default optional-category" type="button" onclick="getDetails(this)">{{_i("Details")}}<i class="ti-angle-left"></i></button>
                        </div>
                    </div>
                    <div class="form-group " style="float:right">
                        <input type="hidden" name="product_id" value="-1">

                        <button class="btn btn-tiffany save save-product" type="button" onclick="saveProduct(this)">{{_i("Save")}}</button>
                    </div>
                    <div class="clearfix"></div>

            </div></form>
        </div>
    </div>`;
            $("#allProducts_div").prepend(html);
            $("#no-items").hide();
            $('.selectpicker').selectpicker();
        }

        function getDetails(obj) {

            var form = $(obj).closest("form");
            var product_id = form.find("input[name='product_id']").val();
            $('.product_id').val(product_id);

            if (product_id == "-1") {
                Swal.fire({
                    title: "{{_i("Alert")}}",
                    text: "{{_i('Please save product first')}}",
                    icon: 'warning',
                });
                return;
            }


            $("#editdetails").modal("show");
            $("#editdetails").find('.nav-tabs a:first').tab('show');


        }

        function ProductHide(product_id) {
            $("input[name='product_id'][value=" + product_id + "]").closest(".product-box").css('opacity', '0.6');
            ;
        }

        function getProdImgid(obj) {

            var form = $(obj).closest("form");
            var product_id = form.find("input[name='product_id']").val();

            if (product_id == "-1") {
                Swal.fire({
                    title: "{{_i("Alert")}}",
                    text: "{{_i('Please save product first')}}",
                    icon: 'warning',
                });
                return;
            }

            $("#frm_photo").find("input[name='product_id']").val(product_id);

            clearDrop();

            $.get('product/' + product_id + "/img").then(data => {

                for (var i = 0; i < data.length; i++) {

                    item = data[i];

                    if (item.main == 0) {
                        var file = {id: item.id, name: item.tag, type: "image/*"};
                        var url = '{{ url("/") }}' + item.photo;
                        drop[0].dropzone.emit("addedfile", file);
                        drop[0].dropzone.emit("thumbnail", file, url);
                        drop[0].dropzone.emit("complete", file);
                    } else {

                        $("#img_main").attr("src", ".." + item.photo);
                    }
                }
            });
            $("#photoModal").modal("show");


        }

        function clearDrop() {
            $("#dropzonefield").html("");
            //(".dz-preview").remove();
            drop[0].dropzone.destroy();

            initDrop();
        }

        function saveMain(obj) {

            //var formData =new FormData();
            var product_id = $("#frm_photo").find("input[name='product_id']").val();
//console.log(product_id);
            var fd = new FormData();
            var files = $("#product_photo")[0].files[0];
            fd.append('image', files);
            fd.append('product_id', product_id);

            fd.append('_token', '{{csrf_token()}}');
//console.log(fd);
            $.ajax({
                url: 'imageSubmit',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == "ok") {
                        var img = $("form[name='frm_product'] input[name='product_id'][value=" + product_id + "]").parents("form").find(".product-img")
                        $(img).attr("src", ".." + response.data);

                        $("#photoModal").modal("toggle");
                        //   $( $(obj).prev(".product-img")).attr("src","../"+response.data);
                        //  alert($(obj).prev(".product-img").html());
                        // $(".preview img").show(); // Display image element
                    } else {
                        // alert('file not uploaded');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: "{{_i('Photo not uploaded')}}",
                            showConfirmButton: false,
                            timer: 5000
                        })
                    }
                }
            });
        }

        $(function () {
            $('.product-desc .selectpicker').on('change', function (e) {
                $(this).next().next().addClass('show');
            })
            $('body').click(function () {
                $('.product-desc .selectpicker').next().next().removeClass('show');
            })

        });
        Dropzone.autoDiscover = false;
        var drop;

        function initDrop() {

            drop = $('#dropzonefield').dropzone({

                url: "{{url('/adminpanel/product/imagespost')}}",
                paramName: 'file',
                uploadMultiple: true,
                maxFiles: 10,
                maxFilesize: 5,
                dictDefaultMessage: "{{_i('Click here to upload files or drag and drop files here')}}",
                dictRemoveFile: "{{ _i('Delete') }}",
                acceptedFiles: 'image/*',
                autoProcessQueue: true,
                parallelUploads: 1,
                removeType: "server",
                params: {
                    _token: '{{csrf_token()}}',
                    product_id: $("#frm_photo").find("input[name='product_id']").val(),

                },
                addRemoveLinks: true,
                removedfile: function (file) {
                    if (drop[0].dropzone.options.removeType == "server") {
                        console.log(file);
                        $.ajax({
                            dataType: 'json',
                            type: 'POST',

                            url: '{{url('/adminpanel/imagesdel/')}}',
                            data: {
                                file: file.name,
                                _token: '{{csrf_token()}}',
                                id: file.id,
                            },
                        });
                        var fmock;

                        if ((fmock = file.previewElement) != null) {
                            if (fmock.parentNode !== null)
                                return fmock.parentNode.removeChild(file.previewElement);

                        }
                        return void 0;
                        //  return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement):void 0;
                    } else {
                        file.previewElement.remove();
                    }
                },
                success: function (file, response) {
                    file.id = response.id;
                },
            });
        }

        $(document).ready(function () {
            'use strict';
            initDrop();
        });

        function uploadFiles() {

            drop[0].dropzone.processQueue();

        }

        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {

                $('.image').attr('src', e.target.result).width(250).height(250);
            };

            filereader.readAsDataURL(input.files[0]);
        }

        function clearTabs() {
            $("#editdetails").find("[data-card='']").hide();
            $("#editdetails").find("[data-digital='']").hide();
            $("#editdetails").find("[data-donation='']").hide();
            $("#editdetails").find("[data-feature='']").hide();


        }

        function LoadCard() {
            var id = $('.product_id').val();
            $('#card_id').val(id);
            $.ajax({
                url: '{{route('get_card')}}',
                method: "get",
                data: {
                    id: id
                },
                dataType: 'json',
                // cache       : false,
                // contentType : false,
                // processData : false,

                success: function (response) {
                    if (response.status == 'success') {

                        $('#get_new_data').empty();
                        for (var i = 0; i < response.data.length; i++) {
                            // $(html).find("input[name='code[]']").val(${response.data[i].code});
                            $('#get_new_data').append(
                                `
                         <div class="row form-group">
                        <div class="col-md-2">

                            <label>{{_i('Code Details')}}</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="code[]" class="form-control" required="" value="${response.data[i].code}" >
                        </div>
                        <div class="col-md-2">

                            <button class="btn btn-danger btn-sm del_card" >{{_i('delete')}}</button>
                        </div>
                    </div>
`
                            )
                        }

                    } else {
                        $('#get_new_data').empty();
                        $('#append_card').empty();
                        $('#get_new_data').append(
                            ` <div class="row form-group">
                        <div class="col-md-2">

                            <label>{{_i('Code Details')}}</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="code[]" class="form-control" required=""  >
                        </div>
                        <div class="col-md-2">

                            <button class="btn btn-danger btn-sm del_card" >{{_i('delete')}}</button>
                        </div>
                    </div>`
                        )
                    }
                },
            });
        }

        $('body').on('click', '.optional-category', function (e) {
            e.preventDefault();
            clearTabs();
            var id = $('.product_id').val();
            var code = $(this).data("code");
            if (code == "cards") {
                $("#editdetails").find("[data-card='']").show();
                LoadCard();
            } else if (code == "digital_product") {
                $("#editdetails").find("[data-digital='']").show();
                loadDigital();
            } else if (code == "donation") {
                $("#editdetails").find("[data-donation='']").show();
                loadDonation();
            } else {
                $("#editdetails").find("[data-feature='']").show();
            }

            e.preventDefault();
            $.ajax({
                url: '{{ route('get-product-data') }}',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                },
                success: function (response) {
                    // console.log(response);
                    if (response.status == 'success') {

                        $('#delivary').val(response.data.delivary);
                        $('#weight').val(response.data.weight);
                        $('#sku').val(response.data.sku);
                        $('#max_count').val(response.data.max_count);
                        $('#created_at').val(response.data.created_at);
                        $('#price').val(response.data.price);
                        $('#net').val(response.data.net);
                        $('#stock').val(response.data.stock);
                        $('#discount').val(response.data.discount);
                        // alert(response.data.text)
                        CKEDITOR.instances['text'].setData(response.data.text)

                        // window.clipboardData.setData('#text', response.data.text);


                        // CKEDITOR.instances['#text'].setData(response.data.text);

                        // $('#text').val(response.data.text);
                    }
                }
            });
        })
        var count_1 = 0;
        $('body').on('click', '.productFeature', function (e) {
            e.preventDefault();
            var id = $('.product_id').val();
            // console.log(id);
            e.preventDefault();
            $.ajax({
                url: '{{ route('getFeatures') }}',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                },
                success: function (response) {
                    if (response.status == 'success') {
                        $('.add_new_feature').removeAttr('onclick');
                        $('.add_new_feature').attr('onclick', 'myJsFuncEdit();');
                        $('#new_feature').empty();
                        for (var ii = 0; ii < response.data.length; ii++) {
                            $('#new_feature').append(`
                            <div id="new_feature_edit" style="display: none;">
                                <input type="hidden" form="form-features" name="id" class="product_id" value="${response.data[ii].product_id}">
                                    <div class="form-group">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-tag"></i>
                                            </span>
                                            <input disabled type="text" form="form-features" class="form-control feature_title"  placeholder="{{_i('The name of the option (such as color, size, ...)')}}" name="feature_title[]" >
                                            <button type="button" class="btn btn-danger btn-sm mr-3 delete_feature_edit">{{ _i('Delete') }}</button>
                                        </div>
                                    </div>

                                    <div class="form-group row new-option">

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-tag"></i>
                                                </span>
                                                <input disabled type="text" class="form-control feature_option_title" form="form-features" placeholder="{{ _i('Option') }}" name="feature_option[0][t][]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-money"></i>
                                                </span>
                                                <input disabled type="text" class="form-control feature_option_price" form="form-features" placeholder="{{ _i('Additional Price') }}" name="feature_option[0][p][]">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-home"></i>
                                                </span>
                                                <input disabled type="text" form="form-features" class="form-control feature_option_count" placeholder="{{ _i('Available Quantity') }}" name="feature_option[0][c][]">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="new_option_one">

                                    </div>

                                    <button type="button" class="btn btn-tiffany mb-4 add_option"><i class="ti-plus"></i>{{ _i('Add Option') }}</button>

                                    <br>
                            </div>
                            <div id="feature_product">
                            <input type="hidden" form="form-features" name="id" class="product_id" value="${response.data[ii].product_id}">
                            <div class="form-group">
                                <div class="input-group mb-3 mt-3">
                                    <span class="input-group-prepend">
                                        <i class="ti-tag"></i>
                                    </span>
                                    <input type="text" form="form-features" class="form-control" value="${response.data[ii].title}"  placeholder="{{_i('The name of the option (such as color, size, ...)')}}" name="feature_title[]" >
                                            <button type="button" class="btn btn-danger btn-sm mr-3 delete_feature_product">{{ _i('Delete') }}</button>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="option-${response.data[ii].id}">

                                    </div>

                                    <div class="form-group row new-option_edit" style="display: none;">

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-tag"></i>
                                                </span>
                                                <input disabled type="text" class="form-control feature_option_title" form="form-features" placeholder="{{ _i('Option') }}" name="feature_option[${count_1}][t][]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-money"></i>
                                                </span>
                                                <input disabled type="text" class="form-control feature_option_price" form="form-features" placeholder="{{ _i('Additional Price') }}" name="feature_option[${count_1}][p][]">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-home"></i>
                                                </span>
                                                <input disabled type="text" form="form-features" class="form-control feature_option_count" placeholder="{{ _i('Available Quantity') }}" name="feature_option[${count_1}][c][]">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="new_option_one_edit">

                                    </div>

                                    <button type="button" class="btn btn-tiffany mb-4 add_option_edit"><i class="ti-plus"></i>{{ _i('Add Option') }}</button>

                                    <br>
                        `);
                            for (var i = 0; i < response.data[ii].options.length; i++) {
                                $('#option-' + response.data[ii].options[i].feature_id).append(`
                                      <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-tag"></i>
                                                </span>
                                                <input type="text" class="form-control feature_option_title" value="${response.data[ii].options[i].title}" form="form-features" placeholder="{{ _i('Option') }}" name="feature_option[${count_1}][t][]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-money"></i>
                                                </span>
                                                <input type="text" class="form-control feature_option_price" value="${response.data[ii].options[i].price}" form="form-features" placeholder="{{ _i('Additional Price') }}" name="feature_option[${count_1}][p][]">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-home"></i>
                                                </span>
                                                <input type="text" form="form-features" value="${response.data[ii].options[i].count}" class="form-control feature_option_count" placeholder="{{ _i('Available Quantity') }}" name="feature_option[${count_1}][c][]">
                                            </div>
                                        </div>
                            `)
                            }
                            ++count_1;

                        }


                    } else if (response.status == 'error') {
                        $('#new_feature').empty();
                        $('#new_feature').append(`
                        <input type="hidden" form="form-features" name="id" class="product_id" value="${id}">
                                    <div class="form-group">
                                        <div class="input-group mb-3 mt-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-tag"></i>
                                            </span>
                                            <input type="text" form="form-features" class="form-control feature_title"  placeholder="{{_i('The name of the option (such as color, size, ...)')}}" name="feature_title[]" >
                                            <button type="button" class="btn btn-danger btn-sm mr-3 delete_feature">{{ _i('Delete') }}</button>
                                        </div>
                                    </div>

                                    <div class="form-group row new_option">

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-tag"></i>
                                                </span>
                                                <input type="text" class="form-control feature_option_title" form="form-features" placeholder="{{ _i('Option') }}" name="feature_option[0][t][]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-money"></i>
                                                </span>
                                                <input type="text" class="form-control feature_option_price" form="form-features" placeholder="{{ _i('Additional Price') }}" name="feature_option[0][p][]">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-home"></i>
                                                </span>
                                                <input type="text" form="form-features" class="form-control feature_option_count" placeholder="{{ _i('Available Quantity') }}" name="feature_option[0][c][]">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="new_option_one">

                                    </div>

                                    <button type="button" class="btn btn-tiffany mb-4 add_option"><i class="ti-plus"></i>{{ _i('Add Option') }}</button>

                                    <br>
                    `)
                    }
                }
            });
        })


        $('body').on('submit', '#form-details', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{url('/adminpanel/saveProductDetails')}}",
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,

                success: function (response) {
                    // if (response.errors){
                    //     $('#masages_model1').empty();
                    //     $.each(response.errors, function( index, value ) {
                    //         $('#masages_model1').show();
                    //         $('#masages_model1').append(value + "<br>");
                    //     });
                    // }
                    if (response == 'success') {

                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "{{_i('Saved Successfully')}}",
                            showConfirmButton: false,
                            timer: 5000
                        })
                        // table.ajax.reload();
                        // $('#masages_model1').hide();
                        // $modal = $('#create');
                        // $modal.find('form')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        })

        $('body').on('submit', '#form-features', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{url('/adminpanel/savefeatures')}}",
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,

                success: function (response) {
                    if (response == 'success') {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "{{_i('Saved Successfully')}}",
                            showConfirmButton: false,
                            timer: 5000
                        })
                    }
                },

            });

        });
        $(function () {
            CKEDITOR.config.language = "{{ app()->getLocale() }}";

        })

        $('body').on('click', '.delete_feature', function (e) {
            var feature = $(this).closest('.product-features').remove();
        });

        $('body').on('click', '.delete_feature_edit', function (e) {
            var feature = $(this).closest('#new_feature_edit').remove();
        });

        $('body').on('click', '.delete_feature_product', function (e) {
            var feature = $(this).closest('#feature_product').remove();
        });

        var count = 1;

        function myJsFunc() {
            var newInput = $('#new_feature').clone(false);
            $(newInput).find('.feature_option_title').attr('name', `feature_option[${count}][t][]`);
            $(newInput).find('.feature_option_price').attr('name', `feature_option[${count}][p][]`);
            $(newInput).find('.feature_option_count').attr('name', `feature_option[${count}][c][]`);

            $(newInput).find('.feature_title').val('');
            $(newInput).find('.feature_option_title').val('');
            $(newInput).find('.feature_option_price').val('');
            $(newInput).find('.feature_option_count').val('');
            $('.new_feature_one').append(newInput);
            ++count;
        }

        function myJsFuncEdit() {
            var newInput = $('#new_feature_edit').clone(false).removeAttr('style');
            $(newInput).find('.feature_option_title').attr('name', `feature_option[${count_1}][t][]`);
            $(newInput).find('.feature_option_price').attr('name', `feature_option[${count_1}][p][]`);
            $(newInput).find('.feature_option_count').attr('name', `feature_option[${count_1}][c][]`);

            $(newInput).find('.feature_title').removeAttr('disabled', '');
            $(newInput).find('.feature_option_title').removeAttr('disabled', '');
            $(newInput).find('.feature_option_price').removeAttr('disabled', '');
            $(newInput).find('.feature_option_count').removeAttr('disabled', '');
            $('.new_feature_one').append(newInput);
            ++count_1;
        }

        $('body').on('click', '.add_option', function (e) {
            var newInputOption = $(this).prev().prev('.new_option').clone(false);
            $(newInputOption).find('.feature_option_title').val('');
            $(newInputOption).find('.feature_option_price').val('');
            $(newInputOption).find('.feature_option_count').val('');
            $(this).prev('.new_option_one').append(newInputOption);
        });
        $('body').on('click', '.add_option_edit', function (e) {
            var newInputOptionEdit = $(this).prev().prev('.new-option_edit').clone(false).removeAttr('style');
            $(newInputOptionEdit).find('.feature_option_title').removeAttr('disabled', '');
            $(newInputOptionEdit).find('.feature_option_price').removeAttr('disabled', '');
            $(newInputOptionEdit).find('.feature_option_count').removeAttr('disabled', '');
            $(this).prev('.new_option_one_edit').append(newInputOptionEdit);
        });

        @if($data != null)
        @if(count($data) > 0)

        @foreach($data as $item)
        $(function () {
            html = `<div class="col-md-4 col-sm-3">
        <div class="product-box">
         <form name="frm_product">
            <div class="product-img-details">
                <img  src="{{ $item->media_url }}" alt="#" class="product-img">
                <input type="hidden" name="image_url" value="{{ $item->media_url }}">
                <button  type="button" class="bt btn-tiffany add-img" onclick="getProdImgid(this)"> {{_i("Add Photo")}}</button>
            </div>
            <div class="inputs-product-body">

                    @csrf
            <div class="form-group type">
                <span class="addon-tag"><i class="fa fa-tag"></i></span>
{!! Form::select('types', $product_type,null, ['class' => 'input selectpicker' ,"placeholder" =>_i("Product Type")]) !!}
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <span class="addon-tag"><i class="ti-shopping-cart-full"></i></span>
            <input type="text" class="form-control product_name input" name="product_name" placeholder="{{_i("Product Name")}}" required="" class="input border-danger">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <span class="addon-tag"><i class="ti-money"></i></span>
                            <input type="number" min="1" max="1000000" class="form-control price" name="price" required="" placeholder="{{_i("Price")}}" class="input border-danger">
                            <div class="clearfix"></div>
                        </div>
                        <div class="col">
                            <span class="addon-tag"><i class="ti-tag"></i></span>
                            <input type="number" min="1" max="1000000" class="form-control product_count" name="count" placeholder="{{_i("Count")}}"  required="" class="input border-danger">
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="product-desc  col-sm-6 input-group">
                            <span class="addon-tag"><i class="fa fa-tag"></i></span>
<?php
            //$cats = $categories->pluck("title", "id");
            ?>
            {!! Form::select('categories[]', $cats,null, [ "multiple" =>"multiple" , "class" => " selectpicker" ]) !!}
            <button class="btn btn-tiffany add-category input-group-btn" data-toggle="modal" data-target="#category" type="button"><i class="ti-plus"></i></button>
            <div class="clearfix"></div>
        </div>
        <div class="category-select col-sm-6">
            <button class="btn btn-default optional-category" type="button" onclick="getDetails(this)">{{_i("Details")}}<i class="ti-angle-left"></i></button>
                        </div>
                    </div>
                    <div class="form-group " style="float:right">
                        <input type="hidden" name="product_id" value="-1">

                        <button class="btn btn-tiffany save save-product" type="button" onclick="saveProduct(this)">{{_i("Save")}}</button>
                    </div>
                    <div class="clearfix"></div>

            </div></form>
        </div>
    </div>`;
            $("#allProducts_div").prepend(html);
            $("#no-items").hide();
            $('.selectpicker').selectpicker();
        });

        // $(window).on('load', addNewProductInstagram());
        @endforeach


        @endif
        @endif


        $('body').on('submit', '#repeat_pro', function (e) {

            e.preventDefault();

            var id = $('#dublicated-id').val();

            console.log(id);

            $.ajax({
                url: '{{ route('repeatproduct') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                },
                success: function (response) {

                    location.reload();

                },

                error: function( xhr, status, errorThrown ) {

                    console.log( "Error: " + errorThrown );

                    console.log( xhr.statusText );
                },
            });
        });



        $('body').on('click', '.productSeo', function (e) {
            e.preventDefault();
            var id = $('.product_id').val();
            e.preventDefault();
            $.ajax({
                url: '{{ route('getProductSeo') }}',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $('.item_id').val(response.data.itemable_id);
                        $('.meta_title').val(response.data.meta_title);
                        $('.meta_description').val(response.data.meta_description);
                    } else if (response.status == 'error') {
                        $('.item_id').val(id);
                        $('.meta_title').val('');
                        $('.meta_description').val('');
                    }
                }
            });
        });

        $('body').on('submit', '#form-seo', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('seo.storeProduct') }}",
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,

                success: function (response) {
                    if (response == 'success') {

                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "{{_i('Saved Successfully')}}",
                            showConfirmButton: false,
                            timer: 5000
                        })
                    }
                },

            });

        });
    </script>


@endpush
