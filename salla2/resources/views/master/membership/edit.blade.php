@extends('master.layout.index',[
'title' => _i('Edit Membership'),
'subtitle' => _i('Edit Membership'),
'activePageName' => _i('Edit Membership'),
'additionalPageUrl' => url('/master/membership') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Edit Membership') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
                    <form method="POST" action="{{ url('/master/membership/'.$membership->id.'/update') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                        @csrf

                        <div class="card-body card-block">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="lang_id" id="language_addform">
                                        <option selected disabled="">{{_i('CHOOSE')}}</option>
                                        @foreach($langs as $lang)
                                            <option value="{{$lang->id}}" {{$membership->lang_id == $lang->id ? "selected" : ""}}>{{_i($lang->title)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Membership Title') }} <span style="color: #F00;">*</span></label>

                                <div class="col-sm-6">
                                    <input  type="text"  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{$membership->title}}"  placeholder=" {{_i('Membership Title')}}" required="">
                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration" class="col-sm-2 control-label" >{{ _i('Duration ') }} <span style="color: #F00;">*</span></label>

                                <div class="col-sm-6">
                                    <input  type="number" min="1"  class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{$membership->duration}}"  placeholder="{{_i('Duration')}}" data-parsley-maxlength="191"
                                            data-parsley-min="1">
                                    @if ($errors->has('duration'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('duration') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-lg-3 col-sm-12 info">
                                    <span style="color: #13866f !important"><b>{{_i('Month')}}</b></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 control-label">{{ _i('Price') }} <span style="color: #F00;">*</span></label>
                                <div class="col-sm-6">
                                    <input  type="number" min="0" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $membership->price}}" placeholder="{{_i('Price')}}" required="" data-parsley-maxlength="191"
                                            data-parsley-min="0">

                                    @if ($errors->has('price'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="is_active" class="col-sm-2 control-label">{{ _i('Is Active') }}</label>

                                <div class="col-sm-3">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input id="is_active" type="checkbox" name="is_active" value="1"  {{$membership->is_active == 1 ? "checked" : ""}}>
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 control-label">{{ _i('Description') }}</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control"  name="description">{{ $membership->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 control-label">{{ _i('Info') }}</label>
                                <div class="col-sm-8">
                                    <textarea id="editor1" class="form-control" name="info">{{ $membership->info}}</textarea>
                                    <small  class="form-text text-muted">{{_i('Please insert data row by row')}}</small>
                                </div>
                            </div>

                            <!---------------------------------------------- saved membership category  -------------------------------------->

                            @foreach($membership_options_cat as $option_category)
                            <div class="card user-card div_delete" style="padding:40px;" >
                                @if($loop->first)<h4> {{_i('Package features')}}</h4> @endif

                                <div class="form-group row ">
                                    <div class="col-sm-6">
                                        <div class="m-b-30">
                                            <select class="form-control get_category category_addform" name="category_id" >
                                                <option selected disabled> {{_i('CHOOSE')}}</option>
                                                @foreach($categories as  $cat)
                                                    <option value="{{$cat->id}}" {{$cat->id==$option_category->cat_id?"selected":""}}> {{$cat->title}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-12">
                                        @if($loop->first)
                                        <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone button_plus" onclick="Add()" title="{{_i('Add Category')}}"  >
                                            <i class="icofont icofont-plus"></i>
                                        </button>
                                        @endif

                                        @if(!$loop->first)
                                                <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone button_plus" onclick="Add()" title="{{_i('Add Category')}}"  >
                                                    <i class="icofont icofont-plus"></i>
                                                </button> <span > </span>
                                        <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete_cat" data-id="{{$option_category->cat_id}}" data-membership_id="{{$membership->id}}"
                                                title="{{_i('Delete Category')}}">
                                            <i class="icofont icofont-minus"></i>
                                        </button>
                                        @endif
                                    </div>

                                </div>

                                <!------ options associated with membership category ----->
                                    @php
                                        $membership_cat_options = \App\Models\Membership\MembershipOptionsMaster::LeftJoin('membership_options_data','membership_options_master.id','membership_options_data.option_id')
                                                //->where('membership_options_data.lang_id', getLang(session('MasterLang')))
                                                ->where('membership_options_data.lang_id', $membership->lang_id)
                                                ->select('membership_options_master.id as id','membership_options_data.title as title')
                                                ->where('membership_options_master.category_id' ,$option_category->cat_id)->get();
                                    @endphp

                                    <div class="form-group row old_options">
                                        @foreach($membership_cat_options as $cat_option)
                                            <div class="col-sm-3">
                                                <div class="checkbox-fade fade-in-primary">
                                                    <label>
                                                        <input id="{{$cat_option->id}}" type="checkbox" name="options[]" value="{{$cat_option->id}}"
                                                               data-parsley-multiple="groups" required=""
                                                        @foreach($membership_options as $option)@if($option->id == $cat_option->id) checked  @else  @endif @endforeach>
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        {{$cat_option->title}}
                                                    </label>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                <div class="form-group row get_options"  >


                                </div>

                            </div>
                                <br />
                        @endforeach
                        <!---------------------------------------------- end saved membership category  -------------------------------------->


                            <!---------------------------------------------- select membership category -------------------------------------->
{{--                            <br />--}}
{{--                            <div class="card user-card" style="padding:40px;" >--}}

{{--                                <h4> {{_i('Package features')}}</h4>--}}

{{--                                <div class="form-group row ">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="m-b-30">--}}
{{--                                            <select class="form-control waves-effect input input--dropdown js--animations category_addform" name="category_id" >--}}
{{--                                                <option selected disabled> {{_i('CHOOSE')}}</option>--}}
{{--                                                @foreach($categories as  $cat)--}}
{{--                                                    <option   value="{{$cat->id}}" > {{$cat->title}} </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-3 col-md-12">--}}
{{--                                        <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone button_plus" onclick="Add()" title="{{_i('Add Category')}}"  >--}}
{{--                                            <i class="icofont icofont-plus"></i>--}}
{{--                                        </button>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row old_options">--}}
{{--                                    @foreach($membership_options as $option)--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox-fade fade-in-primary">--}}
{{--                                                <label>--}}
{{--                                                    <input id="{{$option->id}}" type="checkbox" name="options[]" value="{{$option->id}}" {{$option->id == $option->id ?"checked":""}}--}}
{{--                                                    data-parsley-multiple="groups" required="">--}}
{{--                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
{{--                                                    {{$option->title}}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}

{{--                                <div class="form-group row get_options"  >--}}

{{--                                </div>--}}

{{--                            </div>--}}
                            <!----------------------------------------- options plus --------------------------------->
                            <div class="section_add" >
                                <br />


                            </div>
                            <!----------------------------------------- options plus end --------------------------------->

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button class="btn btn-primary col-sm-6">{{_i('Save')}}</button>

                            <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone button_plus" onclick="Add()" title="{{_i('Add Category')}}"  >
                                <i class="icofont icofont-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-footer -->

                    </form>

                </div>


            </div>
        </div>

    </div>

@endsection



@push('js')

    <script>
        $(function () {
            CKEDITOR.replace('editor1', {
                extraPlugins: 'colorbutton,colordialog',
                filebrowserUploadUrl: "{{asset('masterAdmin/bower_components/ckeditor/ck_upload_master.php')}}",
                filebrowserUploadMethod: 'form'
            });
        });

        var langID = `{{$membership->lang_id }}`;
        var languageID;

        $('#language_addform').change(function(){
            languageID = $(this).val();
            console.log(languageID);
            if(languageID == langID ){
                window.location.reload();
            }else{
                $.ajax({
                    type:"GET",
                    url:"{{url('master/membership/category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){



                            $(".category_addform").empty();
                            $(".old_options").empty();
                            $(".get_options").empty();
                            $(".section_add").empty();
                            $(".get_category").empty();
                            $(".get_category").append('<option disabled selected>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $(".get_category").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $(".get_category").empty();
                        }
                    }
                });
            }

        });

        if(languageID != null){
            lang = languageID;
        }else{
            lang = langID;
        }


        function Add()
        {
            var section_add="section_add";
            var html='';
            html +='<br /> <div class="card user-card" style="padding:40px;" >';
            html +='<div class="form-group row "> <div class="col-sm-6"> <div class="m-b-30">';
            html +='<select class="form-control  category_addform_plus" name="category_id" >';
           // html +='<option selected disabled>{{_i('CHOOSE')}}</option>';
{{--            @foreach($categories as  $cat)--}}
{{--                html +='<option value="{{$cat->id}}">{{$cat->title}}</option>';--}}
{{--            @endforeach--}}
                html +='</select>';
            html +='</div> </div>';
            html +='<div class="col-lg-3 col-md-12">';
            html +='<button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone button_plus" onclick="Add()" title="{{_i('Add Category')}}">' +
                '  <i class="icofont icofont-plus"></i>' +
                '  </button> <span> </span>';
            html +='<button type="button" class="btn btn-default btn-outline-default clone-btn-right delete" onclick="Delete(this)" title="{{_i('Delete Category')}}"><i class="icofont icofont-minus"></i></button>';
            html +='</div></div>';
            html +='<div class="form-group row get_options" ></div>';
            html +='</div>';
            $('.'+section_add).prepend(html);
            var category_addform_plus = $('.category_addform_plus');
            // console.log(category_addform_plus);

            $.ajax({
                type:"GET",
                url:"{{url('master/membership/category/list')}}?lang_id="+lang,
                dataType:'json',
                success:function(res){
                    if(res){

                        category_addform_plus.empty();
                        category_addform_plus.append('<option disabled selected>{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            category_addform_plus.append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }
            });


        };

        $('body').on('change','.category_addform_plus',function (e) {
            var categoryID = $(this).val();

            var category_addform_plus = $(this);
            if(categoryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('master/membership/options/list')}}",
                    data: {
                        category_id: categoryID,
                        lang_id: lang,
                    },
                    dataType:'json',
                    success:function(res){
                        if(res){
                            category_addform_plus.closest('.user-card').find('.get_options').empty();
                            $.each(res,function(key,value){
                                // console.log(category_addform_plus.closest('.user-card').find('.get_options'));
                                //$(".user-card").find('.get_options').append(
                                category_addform_plus.closest('.user-card').find('.get_options').append(
                                    ' <div class="col-sm-3"> ' +
                                    ' <div class="checkbox-fade fade-in-primary"> ' +
                                    '<label> <input id="'+key+'" type="checkbox" name="options[]" value="'+key+'" data-parsley-multiple="groups" required=""> '+
                                    '<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>'+value+'</label>'+
                                    '</div>'+
                                    '</div>');
                            });

                        }else{
                            category_addform_plus.closest('.user-card').find('.get_options').empty();
                        }
                    }
                });
            }
        });
        //add form

        $('body').on('change','.category_addform',function (e) {
            if(languageID != null){
                lang = languageID;
            }else{
                lang = langID;
            }

            var categoryID = $(this).val();
            var category_addform = $(this);
            category_addform.closest('.user-card').find('.old_options').remove();
            if(categoryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('master/membership/options/list')}}",
                    data: {
                        category_id: categoryID,
                        lang_id: lang,
                    },
                    dataType:'json',
                    success:function(res){
                        if(res){
                            category_addform.closest('.user-card').find('.get_options').empty();
                            $.each(res,function(key,value){
                                // console.log(category_addform.closest('.user-card').find('.get_options'));
                                //$(".user-card").find('.get_options').append(
                                category_addform.closest('.user-card').find('.get_options').append(
                                    ' <div class="col-sm-3"> ' +
                                    ' <div class="checkbox-fade fade-in-primary"> ' +
                                    '<label> <input id="'+key+'" type="checkbox" name="options[]" value="'+key+'" data-parsley-multiple="groups" required=""> '+
                                    '<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>'+value+'</label>'+
                                    '</div>'+
                                    '</div>');
                            });

                        }else{
                            category_addform.closest('.user-card').find('.get_options').empty();
                        }
                    }
                });
            }
        });


        function Delete(obj)
        {
            $(obj).closest('.user-card').remove();
        }


        $('body').on('click','.delete_cat',function () {
            $(this).closest('.div_delete').remove();
            var cat_id = $(this).data('id');
            var membership_id = $(this).data('membership_id');
            console.log(cat_id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('catDelete')}}",
                method: "POST",
                data: {
                    catId: cat_id,
                    membershipId: membership_id,
                },

                success:function(response){
                    $(this).closest('.div_delete').remove();
                    new Noty({
                        type: 'error',
                        layout: 'topRight',
                        text: "{{ _i('Deleted Successfully')}}",
                        timeout: 2000,
                        killer: true
                    }).show();

                }
            });
        })

    </script>



@endpush





