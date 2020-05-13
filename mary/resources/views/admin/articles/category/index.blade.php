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
        @if(auth()->user()->can('ArticleCategory-Add'))
                <button class="btn btn-primary create"  data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i>{{_i('create new ArticlesCat')}}</button>

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
                'use strict'
                $('.create').attr('data-toggle', 'modal').attr('data-target','#create');
            })
        </script>
    @endpush
    <!-- Button trigger modal -->
    <!-- Modal -->
    {{--    store model--}}
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('create')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('categoryArticle.store')}}" method="post" id="addForm" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('post')}}


                        <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" class="form-control">

                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                    <option value="{{$key}}">{{$lang}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label>{{_i('title')}}</label>
                            <input type="text" name="title" class="form-control">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('published')}}</label>--}}
{{--                            <input type="checkbox" name="published">--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label>{{_i('Image')}}</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <img src="" style="width: 100%; height: 200px" class="image-preview">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="add">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>
    {{--        edit model--}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
        $(document).ready(function () {
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var image = $(this).data('image');
                var lang = $(this).data('lang');
                // var publish = $(this).data('published') === true ? 'checked': '';


                var html = `<form action="{{route('edit-categoryArticle')}}"  method="post" id="formedit" enctype="multipart/form-data">
                    @csrf
                        {{method_field('put')}}
                    <input type="hidden" name="id" value="${id}" class="form-control">
                     <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" class="form-control" id="lang_ax">

                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                    <option value="{{$key}}">{{$lang}}</option>
                                @endforeach
                    </select>

                </div>
              <div class="form-group">
                    <label>{{_i('title')}}</label>
                          <input type="text" name="title" class="form-control" value="${title}">
                        </div>

                    {{--<div class="form-group">--}}
                    {{--        <label>{{_i('published')}}</label>--}}
                    {{--        <input type="checkbox" name="published" ${publish}>--}}
                    {{--    </div>--}}

                            <div class="form-group">
                            <label>{{_i('image')}}</label>
                          <input type="file" name="image" class="form-control image">
                              </div>

                        <div class="form-group">
                          <img src="${image}" class="image-preview" style="height:200px;">
                        </div>


                </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);
                $('#lang_ax').val(lang);

            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })
        })
    </script>
@endpush
