@extends('admin.layout.index',[
'title' => _i('All Featured Members'),
'activePageName' => _i('All Featured Members'),
] )
@section('content')
    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {!! $dataTable->table([
                     'class' => "table table-striped table-bordered nowrap dataTable"
                     ],true) !!}
                </div>
            </div>

        </div>
    </div>

    <!------------------ model edit -------------------->
    <div class="modal edit_modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" class="j-forms" enctype="multipart/form-data" data-parsley-validate="">
                        {{method_field('put')}}
                        <input type="hidden" id="edit_id" value=""/>
                        @csrf
                        @honeypot {{--prevent form spam--}}
                        <input type="hidden" name="_method" value="PATCH"/>

                        <div class="content">
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Advertisement Details') }}</span>
                            </div>

                            <div class="form-group row ">
                                <label class="col-sm-2 control-label">{{ _i('User') }}</label>
                                <div class="col-sm-10">
                                    <select class="js-example-basic-single select2" name="user_id" id="user_id">
                                        <optgroup label="{{_i('Select User')}}">
                                            @foreach($users as $user)
                                                <option
                                                    value="{{$user->id}}">{{$user['first_name'] ." ". $user['last_name']}}</option>
                                            @endforeach
                                        </optgroup>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Place') }}</label>
                                <div class="col-sm-10">
                                    <select class="form-control " name="featured_type">
                                        <option value="slider"> {{_i('Slider')}}</option>
                                        <option value="featured"> {{_i('Featured Members')}}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Duration') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" id="duration" name="duration"
                                           class="form-control form-control-round"
                                           placeholder="{{_i('Enter Duration')}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Price') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" id="price" name="price" class="form-control form-control-round"
                                           placeholder="{{_i('Enter Price')}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Total') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" id="total" name="total" class="form-control form-control-round"
                                           placeholder="{{_i('Enter Total')}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('From') }}</label>
                                <div class=" col-sm-10">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control"/>
                                        <span class="input-group-addon bg-default">
                                            <span class="icofont icofont-ui-calendar"></span>
                                         </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('To') }}</label>
                                <div class=" col-sm-10">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control"/>
                                        <span class="input-group-addon bg-default">
                                            <span class="icofont icofont-ui-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input id="published_check" type="checkbox" name="publish" value="1">
                                        <span class="cr float-right">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span class="mr-4">{{ _i('Publish') }}</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="footer">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-outline-primary m-b-0 save">{{ _i('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}">

@endpush


@push('js')
    {!! $dataTable->scripts() !!}
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css"
          href="{{asset('adminPanel/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}">
    <!--------------------------- this code used to make select2 work with model -------------------->
    @push('js')
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single:not(.normal)').each(function () {
                    $(this).select2({
                        dropdownParent: $(this).parent().parent()
                    });
                });
            });
        </script>
    @endpush

    <script>
        $(function () {
            'use strict';
            $('.create').attr('data-toggle', 'modal').attr('data-target', '.modal_create')
        });
        // create form
        $(function () {
            $('#add_form').submit(function (e) {
                e.preventDefault();

                var form = $("#add_form").serialize();
                //console.log(form);
                var table = $('.dataTable').DataTable();
                $.ajax({
                    url: "{{route('featured_users.store')}}",
                    type: "post",
                    //data:form,
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (res) {
                        $('.modal.modal_create').modal('hide');
                        table.ajax.reload();
                        $("#add_form").parsley().reset();
                        $('.url').val("");
                        $('.image').val("");

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('success save')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                    }
                })
            });
        });

        /* ------------------------ edit form ----------------------- */
        $(function () {
            'use strict';
            var id = '';
            $(".edit").unbind('click');
            $('body').on('click', '.edit', function (e) {
                id = $(this).data('id');

                var user_id = $(this).data('user');
                var sort = $(this).data('sort');
                var publish = $(this).data('publish');

                $("#user_id").val(user_id).change();
                $("#sort").val(sort);
                if (publish == 1) {
                    $("#published_check").prop("checked", true);
                }

                $("#edit_form").parsley().reset();
            });


            $('#edit_form').submit(function (e) {
                e.preventDefault();
                $('#edit_id').val(id);
                // console.log(id);

                var form = $("#edit_form").serialize(this);
                console.log(form);
                var table = $('.dataTable').DataTable();
                $.ajax({
                    url: '{{ aUrl('featured_users')}}/' + id,
                    method: "post",
                    //data: form,
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        $('.modal.edit_modal').modal('hide');
                        table.ajax.reload();
                        $("#edit_form").parsley().reset();

                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('success update')}}",
                            timeout: 2000,
                            killer: true
                        }).show();
                    }
                })
            });

        })

    </script>


@endpush
