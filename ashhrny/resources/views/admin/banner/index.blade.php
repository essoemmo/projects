@extends('admin.layout.index',[
'title' => _i('All Banners'),
'activePageName' => _i('All Banners'),
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

    <!-------- model create ------>
    <div class="modal modal_create" tabindex="-1" role="dialog">
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
                    <form id="add_form" class="j-forms" enctype="multipart/form-data" data-parsley-validate="">

                        @honeypot {{--prevent form spam--}}
                        <div class="content">

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Url') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="url" class="form-control url"
                                           placeholder="{{_i('Enter Banner Url')}}" required="" data-parsley-type="url">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Sort') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" max="125" name="sort"
                                           class="form-control form-control-round"
                                           placeholder="{{_i('Enter Slider Sort')}}">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" name="publish" value="1">
                                        <span class="cr float-right">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                        <span class="mr-4">{{ _i('Publish') }}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Media') }}</span>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Image') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control form-control-round image" name="image"
                                           required="" accept="image/*">
                                </div>
                            </div>

                        </div>
                        <div class="footer">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-outline-primary m-b-0 save_language">{{ _i('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!------------------ model edit -------------------->
    <div class="modal edit_modal" tabindex="-1" role="dialog">
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

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Url') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" id="url" name="url" class="form-control url"
                                           placeholder="{{_i('Enter Banner Url')}}" required="" data-parsley-type="url">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">{{ _i('Sort') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" max="125" id="sort" name="sort"
                                           class="form-control form-control-round"
                                           placeholder="{{_i('Enter Slider Sort')}}">
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

                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Media') }}</span>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ _i('Image') }}</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control form-control-round image_saved" name="image"
                                           accept="image/*">
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




@push('js')
    {!! $dataTable->scripts() !!}

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
                    url: "{{route('banners.store')}}",
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

                var url = $(this).data('url');
                var sort = $(this).data('sort');
                var publish = $(this).data('publish');

                $("#url").val(url);
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
                    url: '{{ aUrl('banners')}}/' + id,
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
