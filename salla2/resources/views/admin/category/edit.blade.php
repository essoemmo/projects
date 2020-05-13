@extends('admin.AdminLayout.index')

@section('title')
    {{_i('EditCategory')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Edit Category')}}
@endsection

@section('page_url')
    <li ><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/category/all')}}">{{_i('All')}}</a></li>
    <li ><a href="{{url('/adminpanel/category/create')}}">{{_i('Add')}}</a></li>
    <li class="active"><a href="#">{{_i('Edit')}}</a></li>
@endsection

@section('content')

    <div class="box box-info">
        <div class="box-header with-border" {{-- style="margin-bottom: 2%;"--}}>
            {{--<h3 class="box-title"> {{_i('User Form')}}</h3>--}}
        </div>
        <!-- /.box-header -->

        <form method="POST" action="{{ url('/adminpanel/category/'.$category->id.'/update') }}" class="form-horizontal"  data-parsley-validate="">
            @csrf

            <div class="box-body">

                <div style="background-color: #f2f2f2; padding: 20px;">

                    <div class="form-group row {{ $errors->has('category') ? ' has-error' : '' }}">
                        <div class="input-group input-group-lg col-xs-10" style="border: 3px solid #dbdbdb;">
                            <input type="text" class="form-control" id="category1" name="category[1]" value="{{$category->title}}" required="">
                            <input type="hidden" id="sub_count1" name="sub_count1" value="{{$count}}">
                        <span class="input-group-addon">
                            <i class="fa fa-sort-up"></i>
                        </span>
                        <span class="input-group-addon">
                            <i class="fa fa-sort-desc"> </i>
                        </span>
                        </div>
                        @if ($errors->has('category'))
                            <span class="text-danger invalid-feedback">
                            <strong>{{ $errors->first('category')}}</strong>
                        </span>
                        @endif
                        {{--<button type="button" class="btn-lg btn-danger"><i class="fa fa-minus-circle"></i></button>--}}
                    </div>

                    @foreach($sub_categories as $sub_category)
                        <div class="form-group row" style="padding-right: 10px;">
                            <div class="input-group  col-xs-8 {{ $errors->has('sub_category') ? ' has-error' : '' }}" style="border: 2px solid #e2e2e2;">
                                <input type="text" class="form-control" id="sub_category1_1" name="sub_category[1][{{$sub_category->number}}]" value="{{$sub_category->title}}" required="">
                                <input type="hidden" name="sub_category_id[1][{{$sub_category->number}}]" value="{{$sub_category->id}}" >

                        <span class="input-group-addon">
                            <i class="fa fa-sort-up"></i>
                        </span>
                        <span class="input-group-addon">
                            <i class="fa fa-sort-desc"> </i>
                        </span>
                            </div>
                            @if ($errors->has('sub_category'))
                                <span class="text-danger invalid-feedback">
                            <strong>{{ $errors->first('sub_category')}}</strong>
                        </span>
                            @endif
                            <a href="{{url('/adminpanel/sub_category/'.$sub_category->id.'/delete')}}">
                                <button type="button" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                            </a>
                        </div>
                    @endforeach

                    <div id="subCategory1">

                    </div>

                    <button type="button" class="btn btn-info" onclick="addSubCategory(1);">{{_i('Add a subcategory')}}</button>

                </div>

                <div id="category">

                </div>

               <!-- <div>
                    <br>
                    <button class="btn btn-info " type="button" onclick="addCategory();">{{_i('Add a major Category')}}</button>
                </div> -->

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info "> {{ _i('Save') }}</button>
            </div>
            <!-- /.box-footer -->

        </form>

    </div>


@endsection

@section('footer')
    <script>

        var category_row = 2;

        function addCategory() {

            var sort_order = parseInt(category_row) + 1;

            html = '<br> <div style="background-color: #f2f2f2; padding: 20px;" id="category_row'+ category_row  + '" <?php $errors->has('category') ? ' has-error' : '' ;?> > '+
                    '<div class="form-group row"> <div class="input-group input-group-lg col-xs-10" style="border: 3px solid #dbdbdb;">' +
                    '<input required="" type="text" class="form-control" id="category'+category_row+'" name="category['+category_row+']"><span class="input-group-addon"><i class="fa fa-sort-up"></i> </span>'+
                    '<span class="input-group-addon"> <i class="fa fa-sort-desc"> </i> </span>'+
                    ' </div>'+
                    '<?php if($errors->has('category')){ echo ' <span class="text-danger invalid-feedback"> <strong>'. $errors->first('category').' </strong></span>'; } ?> '+
                    '<button type="button" onclick="$(this).parent().parent().remove();" title="{{ _i('Remove') }}" class="btn-lg btn-danger"><i class="fa fa-minus-circle"></i></button> '+
                    '</div> ' +
                    '<div class="form-group row" style="padding-right: 10px;"> <div class="input-group  col-xs-8" style="border: 2px solid #e2e2e2;" <?php $errors->has('sub_category') ? ' has-error' : '' ;?> >'+
                    '<input required="" type="text" class="form-control"  id="sub_category'+category_row+'_1" name="sub_category['+category_row+'][1]"> <span class="input-group-addon"><i class="fa fa-sort-up"></i> </span>'+
                    '<span class="input-group-addon"> <i class="fa fa-sort-desc"> </i> </span>'+
                    '</div> </div> <div id="subCategory'+ category_row +'"> </div> ' +
                    '<input type="hidden" id="sub_count'+category_row+'"  name="sub_count'+category_row+'" value="1"> '+
                    '<?php if($errors->has('sub_category')){ echo ' <span class="text-danger invalid-feedback"> <strong>'. $errors->first('sub_category').' </strong></span>'; } ?> '+
                    '<button type="button" class="btn btn-info" onclick="addSubCategory('+category_row+');" >{{_i('Add a subcategory')}}</button>' +
                    '</div>';

            $("#category").append(html);
            category_row ++;
        }



        function addSubCategory(category_row) {
            var sub_row = $('#sub_count'+category_row).val();
            sub_row ++;

            var sort_order = parseInt(sub_row) + 1;

            html = '<div class="form-group row" style="padding-right: 10px;" id="sub_category_row'+category_row+'_'+sub_row+'"> '+
                    '<div class="input-group col-xs-8" style="border: 2px solid #e2e2e2;" <?php $errors->has('sub_category') ? ' has-error' : '' ;?> >' +
                    '<input required="" type="text" class="form-control" id="sub_category'+category_row+'_'+sub_row+'" name="sub_category['+category_row+']['+sub_row+'] ">' +
                    '<span class="input-group-addon"><i class="fa fa-sort-up"></i> </span>'+
                    '<span class="input-group-addon"> <i class="fa fa-sort-desc"> </i> </span>'+
                    '</div>'+
                    '<?php if($errors->has('sub_category')){ echo ' <span class="text-danger invalid-feedback"> <strong>'. $errors->first('sub_category').' </strong></span>'; } ?> '+
                    '<button type="button" onclick="$(this).parent().remove();" title="{{ _i('Remove') }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> '+
                    '</div>';

            $("#subCategory"+category_row).append(html);
            $('#sub_count'+category_row).val(sub_row);
        }



    </script>
@endsection
