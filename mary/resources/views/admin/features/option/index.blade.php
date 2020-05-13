@extends('admin.index')
@section('title', $title)
@section('css')
    <style>
        .account_setting {
            width: 100%;
            background: #ddd;
            text-align: left;
        }
        .account_setting p {
            font-size: 30px;
            font-style: oblique;
        }

    </style>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    {{--    @include('admin.layouts.message')--}}
    <!-- /.box-header -->
        <div class="card-body table-responsive">
            @if(auth()->user()->can('option-add'))
            <button class="btn btn-primary create" data-toggle="modal" data-target="#create" id="opt"><i class="fa fa-plus"></i>{{_i('create_options')}}</button>
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
                    <form action="{{route('store-Option')}}" method="post" id="addForm">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        <div class="form-group">
                            <label>{{(_i('language'))}}</label>
                            <select name="language" class="form-control" id="lang">

                                @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                    <option value="{{$key}}">{{$lang}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label>{{(_i('group'))}}</label>
                            <select name="group" class="form-control group" id="group">

                                {{--                                @foreach(\App\Models\Option_group::pluck('title','id')->all() as $key =>$val)--}}
                                {{--                                    <option value="{{$key}}">{{$val}}</option>--}}
                                {{--                                @endforeach--}}
                            </select>

                        </div>

                        <div class="form-group">
                            <label>{{_i('title')}}</label>
                            <input type="text" name="title" class="form-control" value="">
                            {{--                            <select name="optionsnew" class="form-control" id="options">--}}

                            {{--                            </select>--}}
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="required" class="form-control" value="bool">{{_i('Required')}}
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                        <div class="account_setting">
                            <p>{{_i('options')}}</p>
                        </div>
                        <button class="btn btn-success btn-sm" id="addinput"><i class="fa fa-plus"></i></button>
                        <div class="groupOption">
                            <div class="form-group">
                                <label>{{(_i('option'))}}</label>
                                <input type="text" name="option[]" class="form-control ">
                            </div>
                        </div>


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
        var group;
        $(document).ready(function () {
            $('body').on('change','#lang',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('getlang') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#group').empty();
                        for (var i=0 ; i<= response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#group').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');
                        }
                    }
                });

            });

            $('body').on('click','#opt',function () {
                $('#lang').trigger('change');
            });

            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();


                var id = $(this).data('id');
                var name = $(this).data('name');
                var lang = $(this).data('lang');
                group = $(this).data('group');

                var reuired = $(this).data('reuired') != null ? 'checked' : '' ;
                var option = $(this).data('option');

                var reuired = $(this).data('reuired') == 'bool' ? 'checked' : '' ;
                var optionValue = $(this).data('value');

                $.ajax({
                    url: '{{ route('edit-Option') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        for (var i=0 ; i< response.data.length ; i++){
                            $('.optionVal').append(
                                '<div class="form-group newoption">'+
                                '<span class="close del" data-id="'+response.data[i].id+'">x</span>'+
                                '<input type="text" name="option['+response.data[i].id+']" class="form-control newoption" value="'+response.data[i].title+'">'+
                                '</div>')
                        }

                    }
                });

                var html = `<form action="{{route('update-Option')}}"  method="post" id="formedit">
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
                    <label>{{(_i('group'))}}</label>
                    <select name="group" id="group_ax" class="form-control gr">
{{--                        @foreach(\App\Models\Option_group::pluck('title','id')->all() as $key =>$val)--}}
                        {{--                    <option value="{{$key}}">{{$val}}</option>--}}
                        {{--                        @endforeach--}}
                    </select>

                    </div>
                     <div class="form-group">
                            <label>{{_i('title')}}</label>
                            <input type="text" name="title" class="form-control" value="${name}">

                    </select>
                </div>


            </div>
            <div class="form-group">
            <input type="checkbox" name="required" class="form-control" value="bool" ${reuired}>{{_i('Required')}}
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="account_setting">
                    <p>{{_i('options')}}</p>
                    </div>
                    <button class="btn btn-success btn-sm" id="addinput"><i class="fa fa-plus"></i></button>
                <div class="groupOption">
                    <div class="form-group optionVal">
                    <label>{{(_i('option'))}}</label>

                </div>
                </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);

                $('#lang_ax').val(lang).change();
                $('#group_ax').val(group);

                setTimeout(function() {
                    $('.optionsnew').val(id);

                }, 1500);



            });

            $('body').on('change','#lang_ax',function () {

                var id = $(this).val();

                $.ajax({
                    url: '{{ route('getlang') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#group_ax').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            // console.log(response.data[i].id);
                            $('#group_ax').append('<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>');

                        }
                        console.log(group);
                        $('#group_ax').val(group);
                    }
                });
            });


            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            });

            $('body').on('click','#addinput',function (e) {
                e.preventDefault();
                $('.groupOption').append(`
                   <div class="form-group newoption">
                        <label>{{(_i('option'))}}</label><span class="close">X</span>
                        <input type="text" name="option[]" class="form-control ">
                    </div>`);
                // $('#newinput').submit();
            });

            $('body').on('click','.close',function (e) {
                e.preventDefault();
                $(this).closest('.newoption').remove();

            });

            // delete close int the option

            $('body').on('click','.del',function (e) {
                e.preventDefault();
                var id = $(this).data('id');

                if(confirm("Are you sure")) {
                    $.ajax({
                        url: '{{ route('remove-from-model') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}', id: id},
                        success: function (response) {
                            // window.location.reload();
                        }
                    });
                }
            });
            $('body').on('change','.group',function (e) {
                e.preventDefault();

                var id = $(this).val();
                $.ajax({
                    url: '{{ route('get-Option') }}',
                    method: "get",
                    {{--data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},--}}
                    data: { id: id},
                    success: function (response) {
                        // console.log(response.data[1]['title']);
                        $('#options').empty();
                        for (var i=0 ; i< response.data.length ; i++){
                            $('#options').append(`<option value="${response.data[i].id}">${response.data[i].title}</option>`)
                        }
                    }
                });

            });

            $('.group').trigger('change');
        });
    </script>
@endpush

