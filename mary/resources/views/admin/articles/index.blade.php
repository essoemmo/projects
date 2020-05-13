@extends('admin.index')
@section('title', $title)
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    {{--    @include('admin.layouts.message')--}}
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            @if(auth()->user()->can('Article-Add'))
            <a href="{{route('articles.create')}}" class="btn btn-primary " ><i class="fa fa-plus"></i>{{_i('create new Articles')}}</a>
            @endif
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
        <script>
            $(function () {
                'use strict';
                $('.create').attr('data-toggle', 'modal').attr('data-target','#create');
            })
        </script>
    @endpush
    <!-- Button trigger modal -->
    <!-- Modal -->
    {{--    store model--}}
{{--    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">{{_i('create')}}</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form action="{{route('articles.store')}}" method="post" id="addForm" enctype="multipart/form-data">--}}
{{--                        {{csrf_field()}}--}}
{{--                        {{method_field('post')}}--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('title')}}</label>--}}
{{--                            <input type="text" name="title" class="form-control">--}}
{{--                        </div>--}}

{{--                        <div class="form-group row" >--}}

{{--                            <label class="col-xs-2 col-form-label " for="date">--}}
{{--                                {{_i('Date')}} </label>--}}
{{--                            <div class="col-xs-6">--}}
{{--                                <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="{{old('created')}}">--}}

{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('published')}}</label>--}}
{{--                            <input type="checkbox" name="published">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('Category')}}</label>--}}
{{--                            <select class="form-control select2" style="width: 100%;" name="category">--}}
{{--                                @foreach(\App\Models\Artcl_category::get() as $category)--}}
{{--                                    <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('Image')}}</label>--}}
{{--                            <input type="file" name="image" class="form-control image">--}}
{{--                        </div>--}}

{{--                        <img src="" style="width: 100%; height: 200px" class="image-preview">--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('content')}}</label>--}}
{{--                            <textarea  name="conteent" class="form-control ckeditor"></textarea>--}}
{{--                        </div>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>--}}
{{--                    <button type="button" class="btn btn-primary" id="add">{{_i('save')}}</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    {{--        edit model--}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editmodel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="editform">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        var categoryId;
        $(document).ready(function () {
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var img = $(this).data('img');
                var publish = $(this).data('published') === true ? 'checked': '';
              categoryId = $(this).data('category');
                // var created = $(this).data('created')?
                var title = $(this).data('title');
                var content = $(this).data('content');
                var lang = $(this).data('lang');

                var regex = /(<([^>]+)>)/ig
                    ,   body = content
                    ,   result = body.replace(regex, "");

                // alert(created);
                var html = `<form action="{{route('edit-articles')}}"  method="post" id="formedit" enctype="multipart/form-data">
                    @csrf
                        {{method_field('put')}}
                    <input type="hidden" name="id" value="${id}" class="form-control">
                     <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" id="lang_ax" class="form-control">
                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)

                    <option value="{{$key}}">{{$lang}}</option>

                                    @endforeach
                    </select>
              <div class="form-group">
                            <label>{{_i('title')}}</label>
                            <input type="text" name="title" class="form-control" value="${title}">
                        </div>

                        {{--<div class="form-group row" >--}}

                        {{--    <label class="col-xs-2 col-form-label " for="date">--}}
                        {{--        {{_i('Date')}} </label>--}}
                        {{--    <div class="col-xs-6">--}}
                        {{--        <input type="date" id="date" name="created" required="" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" value="${created}" selected>--}}

                        {{--    </div>--}}
                        {{--</div>--}}

                    <div class="form-group">
                        <label>{{_i('published')}}</label>
                            <input type="checkbox" name="published"  ${publish}>
                        </div>

                        <div class="form-group">
                            <label>{{_i('Category')}}</label>
                            <select class="form-control Art_Country" style="width: 100%;" name="category" id="category">
{{--                                @foreach(\App\Models\Artcl_category::get() as $category)--}}
{{--                    <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                                @endforeach--}}
                    </select>
                </div>

                <div class="form-group">
                    <label>{{_i('Image')}}</label>
                        <input type="file" name="image" class="form-control image">
                        </div>

                        <img src="${img}" style="width: 100%; height: 200px" class="image-preview">

                        <div class="form-group">
                            <label>{{_i('content')}}</label>
                            <textarea  name="conteent" class="form-control ckeditor">${result}</textarea>
                        </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);


                $('.Art_Country').val(categoryId).change();
                $('#lang_ax').val(lang);
                // $('#date').val(created);
                $('#lang_ax').trigger('change');

            });
            $('body').on('change','#lang_ax',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('getlangarticl') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#category').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#category').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');

                        }
                        // $('#group_ax').val(group);
                    }
                });
            });




            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })
        })
    </script>
@endpush
