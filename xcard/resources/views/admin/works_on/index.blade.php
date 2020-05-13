@extends('admin.layout.index',[
'title' => _i('All Works On'),
'activePageName' => _i('All Works On'),
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

    <!------------------  create model --------------->
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
                    <form id="add_form" class="j-forms" data-parsley-validate="" >
                        <div class="content">
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Works On details') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">{{ _i('title') }}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="title" placeholder="{{_i('title')}}" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="divider-text gap-top-45 gap-bottom-45">
                                                <span>{{ _i('Media') }}</span>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ _i('Icon') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control form-control-round" name="icon" id="icon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-outline-primary m-b-0 save_worksOn">{{ _i('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


    {{--    edit--}}


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
                        <div class="content">
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('language\'s details') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">{{ _i('title') }}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="edit_title" class="form-control title" name="title" placeholder="{{_i('title')}}" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="divider-text gap-top-45 gap-bottom-45">
                                                <span>{{ _i('Media') }}</span>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ _i('Icon') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="file" id="edit_icon" class="form-control form-control-round work_icon" name="icon">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-outline-primary m-b-0 save">{{ _i('Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
        <script>

            $(function() {
                $('#add_form').submit(function(e) {
                    e.preventDefault();

                    var formData = new FormData();
                    formData.append("icon",$('#icon')[0].files[0]);
                    formData.append("title",$("#title").val());

                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: "{{route('works_on.store')}}",
                        type: "post",
                        data:formData,
                        dataType: 'json',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function (res) {
                            $('.modal.modal_create').modal('hide');
                            table.ajax.reload();
                            reset();
                        }
                    })
                });
            });

            $(function () {
                'use strict';
                $('.create').attr('data-toggle','modal').attr('data-target','.modal_create')
            });
            function reset() {
                document.getElementById('add_form').reset();
                $("#add_form").parsley().reset();
                $('#title').empty();
                $('#icon').empty();
            };

            $(function () {
                'use strict';
                var id = '';
                $(".edit").unbind('click');
                $('body').on('click','.edit',function (e) {
                    var title = $(this).data('title');
                    var icon = $(this).data('icon');
                    id = $(this).data('id');
                    $('.title').val(title);
                    $('.work_icon').val(icon);
                    $("#edit_form").parsley().reset();
                });

                $('#edit_form').submit(function(e) {
                    e.preventDefault();
                    console.log(id);

                    var formData = new FormData();
                    formData.append("icon",$('#edit_icon')[0].files[0]);
                    formData.append("title",$("#edit_title").val());

                    var table = $('.dataTable').DataTable();
                    $.ajax({


                        url:'{{ aUrl('work/update')}}/' + id,
                        method: "post",
                        data:formData,
                        dataType: 'json',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS

                        // data: new FormData(this),
                        // dataType: 'json',
                        // cache       : false,
                        // contentType : false,
                        // processData : false,

                        success:function (res) {
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
@endsection

