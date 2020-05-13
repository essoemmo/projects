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
            @if(auth()->user()->can('Feature-Add'))
            <button class="btn btn-primary create" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i>{{_i('create_options')}}</button>
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
                    <form action="{{route('Features.store')}}" method="post" id="addForm">
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
        $(document).ready(function () {
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });



            $('body').on('click','.edit',function (e) {
                e.preventDefault();

                var id = $(this).data('id');
                var name = $(this).data('name');
                var lang = $(this).data('lang');

                var html = `<form action="{{route('edit-Features')}}"  method="post" id="formedit">
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
                            <label>{{_i('title')}}</label>
                          <input type="text" name="title" class="form-control" value="${name}">
                        </div>

                </div>

                </form>`;

                $('#editmodel').empty();
                $('#editmodel').append(html);
                $('#lang_ax').val(lang).change();

            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })
        })
    </script>
@endpush
