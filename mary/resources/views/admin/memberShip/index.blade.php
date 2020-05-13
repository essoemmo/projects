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
            @if(auth()->user()->can('Membership-Add'))
            <button class="btn btn-primary create" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i>{{_i('create new memberShip')}}</button>
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
                    <div class="alert aler-danger" id="masages_model1" style="display: none;" >
                    </div>
                    <form method="post" id="addForm" data-parsley-validate="">
                        {{csrf_field()}}
                        {{method_field('post')}}

                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach(\App\Models\Language::get() as $index => $lang)
                                            <li class="nav-item">
                                                <a class="nav-link {{$index == 0 ? 'active' : ''}}" data-toggle="pill" href="#{{$lang->code}}" role="tab" aria-controls="{{$lang->code}}" aria-selected="true">{{$lang->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach(\App\Models\Language::get() as $index => $lang)
                                        <div class="tab-pane {{$index == 0 ?'active':''}}" id="{{$lang->code}}" role="tabpanel" aria-labelledby="{{$lang->code}}">
                                            <div class="form-group">
                                                <label>{{_i('name')}}</label>
                                                <input type="text" name="{{$lang->code}}_name" class="form-control" data-parsley-required="true">
                                            </div>
                                        </div>
                                            @endforeach


                                    </div>
                                </div>
                                <!-- /.card -->
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
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{_('edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-danger" style="display:none" id="masages_model"></div>
                <div class="modal-body" id="editmodel">
                    <form action="{{route('edit-membership')}}"  method="post" id="formedit" data-parsley-validate="">
                        @csrf
                        {{method_field('put')}}
                        <input type="hidden" name="id" id="member_id" value="" class="form-control">

                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach(\App\Models\Language::get() as $index => $lang)
                                            <li class="nav-item">
                                                <a class="nav-link {{$index == 0 ? 'active' : ''}}" data-toggle="pill" href="#{{$lang->code}}_edit" role="tab" aria-selected="true">{{$lang->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach(\App\Models\Language::get() as $index => $lang)
                                            <div class="tab-pane {{$index == 0 ?'active':''}}" id="{{$lang->code}}_edit" role="tabpanel">
                                                <div class="form-group">
                                                    <label>{{_i('name')}}</label>
                                                    <input type="text" name="{{$lang->code}}_name" id="lang_{{$lang->id}}" class="form-control {{$lang->code}}-name" data-parsley-required="true">
                                                    <input type="hidden" name="lang_id[]" id="lang_id_{{$lang->id}}" class="form-control {{$lang->code}}-name" data-parsley-required="true">
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>


                    </form>
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
            var table = $('.dataTable').DataTable();
            $('body').on('click','#add',function (e) {
                e.preventDefault();
                $('#addForm').submit();
            });

            $('body').on('submit','#addForm',function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('memberships.store')}}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        if (response.errors){
                            $('#masages_model1').empty();
                            $.each(response.errors, function( index, value ) {
                                $('#masages_model1').show();
                                $('#masages_model1').append(value + "<br>");
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
                            $('#masages_model1').hide();
                            $modal = $('#create');
                            $modal.find('form')[0].reset();
                        }
                        // table.ajax.reload();
                        // window.location.reload();
                    },

                });

            });

            $('body').on('click','.edit',function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    $('#member_id').val(id);
                    // alert(id);
                $.ajax({
                    url: "{{url('admin/memberships/')}}"+'/'+id+'/edit',
                    method: "get",
                    data: id,
                    success: function (response) {
                        $.each( response.data, function( key, value ) {
                         $('#lang_'+key).val(value);
                         $('#lang_id_'+key).val(key);
                        });

                    }

                });

                    var name = $(this).data('name');
                    var cost = $(this).data('cost');
                    var years = $(this).data('years');
                    var lang = $(this).data('lang');
                    //
                    // $('#editmodel').empty();
                    // $('#editmodel').append(html);
                    // $('#lang_ax').val(lang).change();

                    // $('.name').val(name);

            });

            $('body').on('click','#editform',function (e) {
                e.preventDefault();
                $('#formedit').submit();
            })

            $('body').on('submit','#formedit',function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
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
                            table.ajax.reload();
                            $('#masages_model').hide();
                            // $modal = $('#create');
                            // $modal.find('form')[0].reset();
                        }
                        // table.ajax.reload();
                        // window.location.reload();
                    },

                });

            });

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

        })
    </script>
@endpush
