@extends('admin.index')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        <div class="card-body table-responsive">

            {{--<a href="{{route('members.create')}}" class="btn btn-primary "><i class="fa fa-plus"></i>{{_i('create Members')}}</a>--}}

            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-------- model create ------>
    <div class="modal modal_create" tabindex="-1" role="dialog" id="model_create">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="ti-close"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="masages_model" style="display: none">

                    </div>
                    <form id="add_form" class="j-forms" enctype="multipart/form-data" data-parsley-validate="">
                        {{csrf_field()}}
                        {{method_field('post')}}
                        <div class="content">
                            <h4>{{_i('add bank')}}</h4>
                            <br>
                            <div class="form-group">
                                <label>{{_i('language')}}</label>
                                <select name="language" class="form-control">

                                    @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                        <option value="{{$key}}">{{$lang}}</option>
                                    @endforeach
                                </select>

                            </div>

                                <div class="form-group row">
                                    <label class=" col-sm-3 col-form-label">{{ _i('name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control title" name="name" value="{{old("name")}}"  placeholder=" {{_i('name')}}" required="">
                                    </div>
                                </div>

                            <div class="form-group">
                                <label>{{_i('image')}}</label>
                                <input type="file" name="image" class="form-control" onchange="showImg(this)">
                            </div>

                            <div class="form-group" id="url_container">
                                <img src="{{asset('uploads/default-image.png')}}" class="image" alt="Your Photo" width="100%" height="200px">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Bank Number') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="code" placeholder="{{ _i('Bank Number') }}" required>
                                </div>
                            </div>

                        </div>
                        <div class="footer">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-outline-primary m-b-0 save_language">{{ _i('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_i('edit bank')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="edit-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="button" class="btn btn-primary" id="editForm">{{_i('save')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {!! $dataTable->scripts() !!}

    <script>
        $(function () {
            'use strict';
            $('.create').attr('data-toggle','modal').attr('data-target','.modal_create')
        });
        var table = $('.dataTable').DataTable();

        $('body').on('submit','#add_form',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{route('banks.store')}}',
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Added is Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();

                        $('#masages_model').hide();
                        $modal = $('#model_create');
                        $modal.find('form')[0].reset();
                        table.ajax.reload();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });

         $('body').on('click','.edit',function (e) {
             e.preventDefault();

             var id = $(this).data('id');
             var name = $(this).data('name');
             var code = $(this).data('code');
             var image = $(this).data('image');
             var lang = $(this).data('lang');

            var html =`<div class="alert alert-danger" id="masages_model" style="display: none">

                    </div>
                    <form id="edit_form" method="post" class="j-forms" enctype="multipart/form-data" data-parsley-validate="">
                        {{csrf_field()}}
                    {{method_field('put')}}
                <div class="content">
                    <h4>{{_i('add bank')}}</h4>
                            <br>
                            <input type="hidden" name="id" value="${id}" id="bank_id">
                            <div class="form-group">
                                <label>{{_i('language')}}</label>
                                <select name="language" class="form-control" id="lang_ex">

                                    @foreach(\App\Models\Language::pluck('name','id')->all() as $key =>$lang)
                                <option value="{{$key}}">{{$lang}}</option>
                                    @endforeach
                                    </select>

                                 </div>

                <div class="form-group row">
                    <label class=" col-sm-3 col-form-label">{{ _i('name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control title" name="name" value="${name}"  placeholder=" {{_i('name')}}" required="">
                                    </div>
                                </div>

                            <div class="form-group">
                                <label>{{_i('image')}}</label>
                                <input type="file" name="image" class="form-control" onchange="showImg(this)">
                            </div>

                            <div class="form-group" id="url_container">
                                <img src="${image}" class="image" alt="Your Photo" width="100%" height="200px">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Bank Number') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" value="${code}" name="code" placeholder="{{ _i('Bank Number') }}" required>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>`;
             $('#edit-body').empty();
            $('#edit-body').append(html);
            $('#lang_ex').val(lang);


         });
        $('body').on('click','#editForm',function (e) {
            e.preventDefault();
            $('#edit_form').submit();
        })
        $('body').on('submit','#edit_form',function (e) {
            e.preventDefault();
            var id = $('#bank_id').val();
            $.ajax({
                url: "{{url('admin/banks')}}"+"/"+id,
                method: "post",
                data: new FormData(this),
                dataType: 'json',
                cache       : false,
                contentType : false,
                processData : false,

                success: function (response) {
                    console.log(response);
                    if (response.errors){
                        $('#masages_model').empty();
                        $.each(response.errors, function( index, value ) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response == 'SUCCESS'){

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Added is Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        table.ajax.reload();
                        $('#masages_model').hide();
                        // $('#addForm')[0].reset();
                        // $modal = $('#addForm');
                        // $modal.find('form')[0].reset();
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                },

            });

        });



        function showImg(input) {
            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('.image').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        $('body').on('submit','#delform',function (e) {
            e.preventDefault();
            var url = $(this).attr('action');

            // alert(url);

            $.ajax({
                url: url,
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {

                    table.ajax.reload();
                    if (response[0] === 'SUCCESS'){
                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Successfly')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        // table.ajax.reload();
                    }
                    // console.log(response);
                    // window.location.reload();
                }
            });
        })
    </script>
@endpush