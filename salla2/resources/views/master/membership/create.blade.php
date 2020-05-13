@extends('master.layout.index',[
'title' => _i('Add Membership'),
'subtitle' => _i('Add Membership'),
'activePageName' => _i('Add Membership'),
'additionalPageUrl' => url('/master/membership') ,
'additionalPageName' => _i('All'),
] )

@section('content')


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Add Membership') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <!-- Blog-card start -->
                <div class="card-block">
                    <form method="POST" action="{{ url('/master/membership/store') }}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                        @csrf

                        <div class="card-body card-block">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Language') }} <span style="color: #F00;">*</span></label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="lang_id" id="language_addform" required="">
                                        <option selected disabled="">{{_i('CHOOSE')}}</option>
                                        @foreach($langs as $lang)
                                            <option value="{{$lang->id}}">{{_i($lang->title)}}</option>
                                        @endforeach
                                    </select>
                                    <small  class="form-text text-muted">{{_i('Please select language to show package categories')}}</small>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 control-label" >{{ _i('Membership Title') }} <span style="color: #F00;">*</span></label>

                                <div class="col-sm-6">
                                    <input  type="text"  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}"  placeholder=" {{_i('Membership Title')}}" required="">
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
                                    <input  type="number" min="1"  class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ old('duration') }}"  placeholder="{{_i('Duration')}}" data-parsley-maxlength="191"
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
                                <label for="price" class="col-sm-2 control-label">{{ _i('Price') }} <span style="color: #F00;"> *</span></label>
                                <div class="col-sm-6">
                                    <input  type="number" min="0" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" placeholder="{{_i('Price')}}" required="" data-parsley-maxlength="191"
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
                                            <input id="is_active" type="checkbox" name="is_active" value="1" >
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 control-label">{{ _i('Description') }}</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control"  name="description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 control-label">{{ _i('Info') }}</label>
                                <div class="col-sm-8">
                                    <textarea id="editor1" class="form-control" name="info"></textarea>
                                    <small  class="form-text text-muted">{{_i('Please insert data row by row')}}</small>
                                </div>
                            </div>


                            <!---------------------------------------------- select membership category -------------------------------------->
                            <div class="card user-card" style="padding:40px;" >

                                <h4> {{_i('Package features')}}</h4>

                                <div class="form-group row ">
                                    <div class="col-sm-6">
                                        <div class="m-b-30">
                                            <select id="get_category" class="form-control waves-effect input input--dropdown js--animations category_addform" name="category_id" required="">
                                                <option selected disabled> {{_i('CHOOSE')}}</option>
                                                {{--                                                @foreach($categories as  $cat)--}}
                                                {{--                                                    <option   value="{{$cat->id}}" > {{$cat->title}} </option>--}}
                                                {{--                                                @endforeach--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <button type="button" class="btn btn-primary btn-outline-primary clone-btn-right clone button_plus" onclick="Add()" title="{{_i('Add Category')}}"  >
                                            <i class="icofont icofont-plus"></i>
                                        </button>
                                        {{--                                        <button type="button" class="btn btn-default btn-outline-default clone-btn-right delete">--}}
                                        {{--                                            <i class="icofont icofont-minus"></i>--}}
                                        {{--                                        </button>--}}
                                    </div>
                                </div>

                                <div class="form-group row get_options"  >

                                    {{--                                    <div class="col-sm-3">--}}
                                    {{--                                        <div class="checkbox-fade fade-in-primary">--}}
                                    {{--                                            <label>--}}
                                    {{--                                                <input id="" type="checkbox" name="groups[]" value="" data-parsley-multiple="groups" required="">--}}
                                    {{--                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                                    {{--                                                ggg--}}
                                    {{--                                            </label>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                </div>

                            </div>
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
            });
        });

        var languageID;
        $('#language_addform').change(function(){
            languageID = $(this).val();
            console.log(languageID);
            if(languageID){
                $.ajax({
                    type:"GET",
                    url:"{{url('master/membership/category/list')}}?lang_id="+languageID,
                    dataType:'json',
                    success:function(res){
                        if(res){

                            $(".section_add").empty();
                            $(".get_options").empty();
                            $("#get_category").empty();
                            $("#get_category").append('<option disabled selected>{{ _i('Choose') }}</option>');
                            $.each(res,function(key,value){
                                $("#get_category").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#get_category").empty();
                        }
                    }
                });
            }else{
                $("#get_category").empty();
            }
        });

        function Add()
        {
            var section_add="section_add";
            var html='';
            html +='<br /> <div class="card user-card" style="padding:40px;" >';
            html +='<div class="form-group row "> <div class="col-sm-6"> <div class="m-b-30">';
            html +='<select  class="form-control  category_addform_plus" name="category_id" >';
            //html +='<div class="list_cat"> </div>';
            //html +='<option selected disabled>{{_i('CHOOSE')}}</option>';
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
                url:"{{url('master/membership/category/list')}}?lang_id="+languageID,
                dataType:'json',
                success:function(res){
                    if(res){

                        //category_addform_plus.closest('user-card').find('list_cat').empty();
                        category_addform_plus.empty();
                        category_addform_plus.append('<option disabled selected>{{ _i('Choose') }}</option>');
                        $.each(res,function(key,value){
                            category_addform_plus.append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }
            });
        };


        //add form
        $('body').on('change','.category_addform',function (e) {
            var categoryID = $(this).val();
            console.log(languageID);
            var category_addform = $(this);
            if(categoryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('master/membership/options/list')}}",
                    data: {
                        category_id: categoryID,
                        lang_id: languageID,
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


        $('body').on('change','.category_addform_plus',function (e) {
            var categoryID = $(this).val();
            console.log(languageID);
            var category_addform_plus = $(this);
            if(categoryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('master/membership/options/list')}}",
                    data: {
                        category_id: categoryID,
                        lang_id: languageID,
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


        function Delete(obj)
        {
            $(obj).closest('.user-card').remove();
        }


    </script>



@endpush





