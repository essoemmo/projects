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
            @if(auth()->user()->can('stories-add'))
            <a href="{{route('Stories.create')}}" class="btn btn-primary" ><i class="fa fa-plus"></i>{{_i('create new Stories')}}</a>
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
{{--                    <form action="{{route('Stories.store')}}" method="post" id="addForm">--}}
{{--                        {{csrf_field()}}--}}
{{--                        {{method_field('post')}}--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('language')}}</label>--}}
{{--                            <select name="language" class="form-control">--}}

{{--                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)--}}
{{--                                    <option value="{{$key}}">{{$lang}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('users')}}</label>--}}
{{--                            <select name="user_id" class="form-control">--}}

{{--                                @foreach(\App\Models\User::where('guard','!=','admin')->pluck('username','id')->all() as $key =>$val)--}}
{{--                                    <option value="{{$key}}">{{$val}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('title')}}</label>--}}
{{--                            <input type="text" name="title" class="form-control">--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('content')}}</label>--}}
{{--                            <textarea name="conteent" class="form-control"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label>{{_i('published')}}</label>--}}
{{--                            <input type="checkbox" name="publish" class="form-control ckeditor">--}}

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
    {{--view Models--}}
    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('show')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewmodel">

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


            //Edit model
            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var published = $(this).data('publish') === true? 'checked' : '';
                var content = $(this).data('content');
                var user = $(this).data('user');
                var lang = $(this).data('lang');




                var html = `<form action="{{url('admin/Stories/update')}}"  method="post" id="formedit">
                    @csrf
                        {{method_field('put')}}
                    <input type="hidden" name="id" value="${id}" class="form-control">
                         <div class="form-group">
                            <label>{{_i('language')}}</label>
                            <select name="language" id="lang_ax" class="form-control">
                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)

                    <option value="{{$key}}" >{{$lang}}</option>
                                    @endforeach
                    </select>

                         <div class="form-group">
                            <label>{{_i('users')}}</label>
                            <select name="user_id" id="user_ax" class="form-control">

                                @foreach(\App\Models\User::where('guard','!=','admin')->pluck('username','id')->all() as $key =>$val)
                    <option value="{{$key}}">{{$val}}</option>
                                @endforeach
                    </select>
                </div>

                  <div class="form-group">
                    <label>{{_i('title')}}</label>
                  <input type="text" name="title" class="form-control" value="${title}">
                        </div>

             <div class="form-group">
                            <label>{{_i('content')}}</label>
                      <textarea name="conteent" class="form-control ckeditor">${content}</textarea>

                        </div>


                        <div class="form-group">
                            <label>{{_i('published')}}</label>
                            <input type="checkbox" name="publish" class="form-control" ${published}>

                        </div>
                </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);
                $('#lang_ax').val(lang).change();
                $('#user_ax').val(user).change();

            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            });


            // view model
            $('body').on('click','.view',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var title = $(this).data('title');
                var published = $(this).data('publish') === true ? 'published' : 'unpublished';
                var content = $(this).data('content');
                var user = $(this).data('user');
                var lang = $(this).data('lang');
                var create = $(this).data('create');




                var html = `
      <div class="card-body header">

                          <div class="pull-left" style="float: left;">
<h3 style="float: left">View Store : ${title}</h3>

                              <h5>${title}</h5>
                              <span>${create}</span>
                              <h4>${user}</h4>
                          </div>
                        <span class=>${published}</span>
                    </div>
                    <div class="content">
                        <textarea class="form-control">${content}</textarea>
                    </div>`;

                $('#viewmodel').empty();
                $('#viewmodel').append(html);
            });

        })
    </script>
@endpush
