@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Store Design')}}
@endsection

@section('page_header_name')
    {{_i('Store Design')}}
@endsection

@section('content')

    @push('css')
        <style>
            .tab-content.mnu__options {
                margin-bottom: 10px!important;
                display: block;
                border: 1px solid #eee;
                border-radius: 10px !important;
                -webkit-box-pack: start;
                -ms-flex-pack: start;
                justify-content: flex-start;
                position: relative;
                padding: 40px!important;
            }

            .mnu__options .fields-cont {
                justify-content: space-between;
                flex-wrap: wrap;
                padding: 20px;
                border-radius: 3px;
                border: 1px solid hsla(0,0%,94%,.8);
                background-color: hsla(0,0%,94%,.2);
            }
            .btn_add_product_menu {
                margin-top: 15px;
                margin-bottom:-10px;
            }

            .tab-content.mnu__options_edit{
                margin-top:10px;
                padding: 20px!important
            }
            .alert-default label{
                color: #212529;
            }


        </style>
    @endpush

    <div class=" user-profile">

        <div class="page-body">

            <!--profile cover end-->
            <div class="row">
                <div class="col-lg-12">
                    <!-- tab header start -->
                    <div class="tab-header ">
                        <ul class="nav nav-tabs md-tabs tab-timeline " role="tablist" id="mytab">
                            <li class="nav-item " style="width: 50%;">
                                <a class="nav-link active " data-toggle="tab" href="#personal" role="tab">
                                    <i class="ti-layout position-left"></i> {{_i('Design control')}}</a>
                                <div class="slide " style="width: 50%;"></div>
                            </li>


                            <li class="nav-item " style="width: 50%;">
                                <a class="nav-link " data-toggle="tab" href="#review" role="tab">
                                    <i class="ti ti-eye position-left"></i> {{_i('Design preview')}}</a>
                                <div class="slide " style="width: 50%;"></div>
                            </li>
                        </ul>
                    </div>
                    <!-- tab header end -->
                    <!-- tab content start -->
                    <div class="tab-content">
                        <!-- tab panel personal start -->
                        <div class="tab-pane active" id="personal" role="tabpanel">
                            <!-- personal card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">{{_i('Designs')}}</h5>
                                    <a href="{{url('adminpanel/salla_store')}}">
                                    <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                        <i class="icofont icofont-money-bag position-left"></i> {{_i('Purchase a design')}}
                                    </button></a>
                                </div>


                                <div class="card-block">
                                    <div class="row">
                                        @foreach($templates as $template)
                                            <div class="col-md-6">

                                                <div class="card card-block-small b-l-success  business-info services">
                                                    <div class="media" >
                                                        <div class="media-left" >
                                                            <a href="#!">
                                                                <img class="img-fluid img-thumbnail" src="{{asset($template['img'])}}" style="height:100px">
                                                            </a>
                                                        </div>
                                                        <div class="media-body" >
                                                            <h4 class="media-heading m-b-15">{{$template['title']}} </h4>
                                                            <form method="POST" action="{{url('adminpanel/design/change')}}" class="template_id" style="display: inline-block;">
                                                                {{method_field('post')}}
                                                                <input type="hidden" name="template_id"  value="{{$template['id']}}">

                                                                <button type="submit" class="btn btn-primary m-r-10 m-b-5 ">{{_i('CHOOSE')}} </button>
                                                            </form>

                                                            @if($template['id'] == $setting_template['template_id'])
                                                            <i class="icofont icofont-check-circled text-primary" data-enable=""></i> <span data-enable="" class="text-primary">{{_i('Enabled')}}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                        @foreach($user_templates as $template)
                                                <div class="col-md-6">
                                                    <div class="card card-block-small b-l-success  business-info services">
                                                        <div class="media" >
                                                            <div class="media-left" >
                                                                <a href="#!">
                                                                    <img class="img-fluid img-thumbnail" src="{{asset($template['img'])}}" style="height:100px">
                                                                </a>
                                                            </div>
                                                            <div class="media-body" >
                                                                <h4 class="media-heading m-b-15">{{$template['title']}} </h4>
                                                                <form method="POST" action="{{url('adminpanel/design/change')}}" class="template_id" style="display: inline-block;">
                                                                    {{method_field('post')}}
                                                                    <input type="hidden" name="template_id"  value="{{$template['id']}}">

                                                                    <button type="submit" class="btn btn-primary m-r-10 m-b-5 ">{{_i('CHOOSE')}} </button>
                                                                </form>

                                                                @if($template['id'] == $setting_template['template_id'])
                                                                    <i class="icofont icofont-check-circled text-primary" data-enable=""></i> <span data-enable="" class="text-primary">{{_i('Enabled')}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                        @endforeach

                                    </div>
                                </div>


                                <!-- end of card-block -->
                            </div>

                            <!-- personal card end-->
                        </div>
                        <!-- tab pane personal end -->

                        <div class="tab-pane" id="review" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">{{_i('Preview')}}</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <?php
                                             $input = route('store.home', app()->getLocale());
                                              $domain = preg_replace('#^https?://#', '', rtrim($input,'/'));
                                            ?>
                                            <iframe src="{{request()->getScheme()}}://{{\App\Bll\Utility::getStoreDomain()}}.{{ $domain }}" height="600"  class="col-md-12"></iframe>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab content end -->
                </div>
            </div>



<!--------------------------------- section 2 => design options ---------------------------------->
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                               <!------  <i class="icofont icofont-brand-target"></i>  --->
                                {{ _i('Design Options') }}  </h5>
                            <div class="card-header-right">
{{--                                <i class="icofont icofont-rounded-down"></i>--}}
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="card-body  ">

                                <form action="{{url('adminpanel/design/save_options')}}" method="POST">
                                    @csrf

                                @if(Auth::guard('store')->user()->hasPermissionTo('Design-Css'))
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Store Color')}}</label>

                                    <div class="col-sm-3 ">
                                        <div class="form-group">
                                            <input type="color" class="" id='btn_color'  name="color"  >
                                            <input type="checkbox"  name="color_default" class="js-single" /> {{_i("Default")}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Store Font')}}</label>
                                    <div class="col-sm-3">
                                        <select class="form-control"  name="font" >
                                            <option value=""  >{{_i('Default Font')}}</option>
                                            <option value="elmessiri-regular.otf" >{{_i('elmessiri')}}</option>
                                            <option value="fontawesome-webfont.ttf" >{{_i('fontawesome')}}</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Store main menu')}}</label>
                                    <div class="col-sm-3">
                                        <select class="form-control"  name="main_menu" id="main_menu" >
                                            <option value="classification_list" {{count($custom_design_list) == 0?"selected":""}}>{{_i('Classifications List')}}</option>
                                            <option value="custom_list" {{count($custom_design_list) > 0?"selected":""}}>{{_i('Custom List')}}</option>
                                        </select>
                                    </div>
                                </div>

                                    <!------
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Home page displays')}}</label>
                                    <div class="col-sm-3">
                                        <select class="form-control"  name="home_page_display" >
{{--                                            <option value="latest_product" {{$design_options['home_page_display']=="latest_product"?"selected":""}}>{{_i('Latest Products')}}</option>--}}
{{--                                            <option value="custom_design" {{$design_options['home_page_display']=="custom_design"?"selected":""}}>{{_i('Custom Design')}}</option>--}}
                                        </select>
                                    </div>
                                </div>
                                    -->



                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Show (all button) on the home page')}}</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" class="js-single " value="1"  name="show_all_button" {{$setting_template['show_all_button']==1?"checked":""}}/>
                                    </div>
                                </div>

                                <!-----
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Navigation path feature')}}</label>
                                    <div class="col-sm-8 ">
{{--                                        <input type="checkbox" class="js-switch" value="1"  name="navigation_path" {{$design_options['navigation_path']==1?"checked":""}} />--}}
                                        </div>
                                    </div>
                                    ---->
                                    <!------
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">{{_i('Display charging indicator')}}</label>
                                    <div class="col-sm-8 ">
                                    {{-- <input type="checkbox" class="js-switch" value="1"  name="display_charge_indicator"  {{$design_options['display_charge_indicator']==1?"checked":""}} />--}}
                                    </div>
                                </div>
                                --->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary save ">{{_i('Save')}}</button>
                                 </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--------------------------------- section 2 => Main menu links ---------------------------------->

            @include('admin.design.custom_list')





        </div>
        <!-- Page-body end -->

    </div>

@endsection


@push('js')

<script>

    $('body').on('submit','.template_id',function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var form =$(this);
        $.ajax({
            url: url,
            method: "post",
            data: new FormData(this),
           // dataType: 'json',
            type: 'POST',
            datatype: 'JSON',
            cache       : false,
            contentType : false,
            processData : false,

            success: function (response) {
                $('[data-enable]').hide()
                $('<i class="icofont icofont-check-circled text-primary" data-enable=""></i> <span data-enable=""  class="text-primary"><?=_i("Enabled")?></span>').insertAfter($(form).find("button"));
                
                var f=$("iframe").first()
                var currSrc = $(f).attr("src");
                $(f).attr("src", currSrc);
                
                Swal.fire({
                    //position: 'top-end',
                    icon: 'success',
                    title: "{{ _i('Modifications saved')}}",
                    showConfirmButton: false,
                    timer: 1000
                });
               


            },

        });

    });


    $('#main_menu').on('change', function () {

        var main_menu = $(this).val();
        var menu = document.getElementById("show_main_menu");
        if(main_menu == "custom_list")
        {
            menu.style.display = "block";
        }else{
            menu.style.display = "none";
        }
    });


 /// custom_list
    function showLinkdiv() {
        var x = document.getElementById("mnu__options");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    $('body').on('change' , '.custom_list' , function(){
        var list_type = $(this).val();
        // selected url type
        if (list_type == "product"){
            $('.section_product').show();
            $('.section_category').hide();
            $('.section_page').hide();
            $('.section_link').hide();
        }
        else if (list_type == "category"){
            $('.section_category').show();
            $('.section_product').hide();
            $('.section_page').hide();
            $('.section_link').hide();
        }
        else if (list_type == "pages"){
            $('.section_page').show();
            $('.section_category').hide();
            $('.section_product').hide();
            $('.section_link').hide();
        }else{
            $('.section_link').show();
            $('.section_page').hide();
            $('.section_category').hide();
            $('.section_product').hide();
        }

    });

    $('body').on('change' , '.product_custom_list' , function(){
        var productId = $(this).val();
        var product_name= $(this).find(':selected').attr('data-product');
       // alert(product_name)
    });



    $('body').on('submit','.save_link',function (e){
        e.preventDefault();
        var link_type = $('.custom_list').val();

        $.ajax({
            url:'{{ url('adminpanel/design/save_menu_link') }}',
            //data: new FormData(this),
            data: new FormData(this),
            type:'POST',
            dataType: 'json',
            contentType: false,
            processData: false,
            success:function (res) {
                if(res) {
                    $('.mnu__options').hide();
                    if(link_type == "product"){
                        var name= $('.product_custom_list').find(':selected').attr('data-product');
                    }else if(link_type == "category"){
                        var name= $('.category_custom_list').find(':selected').attr('data-category');
                    }else if(link_type == "pages"){
                        var name= $('.page_custom_list').find(':selected').attr('data-page');
                    }else if(link_type == "link"){
                        var name= $('.link_custom_list').val();
                    }

                    $('.get_links').append('<div class="form-group row div_delete" style="margin-top:-10px;"> <div class="col-sm-12"><div class="alert alert-default small">' +
                        '<button type="button" class="close btn-icon" data-dismiss="alert" aria-label="Close" style="color: red; float: left">' +
                        '<i class="icofont icofont-ui-delete btn-small " onclick="delFilter('+res.id+')" ></i> </button>' +
                        ' <strong> '+name+' </strong>' +
                        ' </div>  </div>  </div>');
                }
            }
        })

        // $(this).closest("form").submit();
    });

    function delFilter(id) {
        // var rowId = id;
        //console.log(id);
        console.log('here');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ url('adminpanel/design/delete_custom_option') }}",
            data: { rowId: id},
            success: function (res) {
                //alert('here');
                if(res == true)
                $(this).closest('.div_delete').remove();
            }
        });
    }

    $('body').on('click','.deleteRow',function (){
        var rowID = $(this).attr('data-deleteRow');
        delFilter(rowID);
        $(this).parent().parent().parent().parent().remove();
    });


    function showAddLinkdiv() {
        //$(this).closest('.mnu__options_edit').style.display = "block";
        //var x = document.getElementById("mnu__options_edit");
        //var x = $(this).closest('.div_delete.mnu__options_edit');
        $(this).parent().toggleClass('showMenu');
        // console.log(x);
        // if (x.style.display == "none") {
        //     x.style.display = "block";
        //     $('.design_value').css("color", "#5dd5c4");
        // } else {
        //     x.style.display = "none";
        //     $('.design_value').css("color", "#bdc3c7");
        // }
    }


    /// $(this).find(':selected').attr('data-id')

</script>

    <script>

        $('.close').on('click', function () {

            $(this).parent().toggleClass('showMenu');
        });
    </script>
     
@endpush

@push('css')
    <style>
        .showMenu .mnu__options_edit{

            display: block !important;
        }
        .showMenu .design_value{

            color: #5dd5c4 !important;
        }
    </style>
@endpush