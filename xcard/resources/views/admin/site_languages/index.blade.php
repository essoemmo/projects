@extends('admin.layout.index',[
'title' => _i('All Site Languages'),
'activePageName' => _i('All Site Languages'),
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
                    <form id="form" class="j-forms" data-parsley-validate>
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
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('title') }}</label>
                                                        <div class="col-sm-12">
                                                            {{Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>_i('title'),'required'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('Locale Title') }}</label>
                                                        <div class="col-sm-12">
                                                            {{Form::text('locale_title',null,['class'=>'form-control','id'=>'locale_title','placeholder'=>_i('Locale Title'),'required'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider-text gap-top-45 gap-bottom-45">
                                                <span>{{ _i('Media') }}</span>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ _i('flag') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control form-control-round" name="flag" id="flag">
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
                                    <button type="button" class="btn btn-primary btn-outline-primary m-b-0 save_language">{{ _i('Save') }}</button>
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
                    <form id="form-edit" class="j-forms" data-parsley-validate>
                        {{method_field('put')}}
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
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('title') }}</label>
                                                        <div class="col-sm-12">
                                                            {{Form::text('title',null,['class'=>'form-control title','placeholder'=>_i('title'),'required'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('Locale Title') }}</label>
                                                        <div class="col-sm-12">
                                                            {{Form::text('locale_title',null,['class'=>'form-control locale_title','placeholder'=>_i('Locale Title'),'required'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider-text gap-top-45 gap-bottom-45">
                                                <span>{{ _i('Media') }}</span>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ _i('flag') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control form-control-round flag" name="flag">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ _i('Image') }}</label>
                                                <div class="col-sm-10">
                                                    <img class="image" alt="">
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
            $(function () {
                'use strict'
                $('.create').attr('data-toggle','modal').attr('data-target','.modal_create')
            })
            $(function () {
                'use strict'
                $('body').on('click','.save_language',function (e) {
                    e.preventDefault();

                    var formData = new FormData();
                    formData.append("flag",$('#flag')[0].files[0]);
                    formData.append("title",$("#title").val());
                    formData.append("locale_title",$("#locale_title").val());

                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url:'{{ route('site_languages.store') }}',
                        data:formData,
                        type:'post',
                        dataType: 'json',
                        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                        processData: false, // NEEDED, DON'T OMIT THIS
                        success:function (res) {
                            $('.modal.modal_create').modal('hide');
                            table.ajax.reload();
                        }
                    })
                })

                var id = '';
                $(".edit").unbind('click');
                $('body').on('click','.edit',function (e) {
                    // $('.title').empty();
                    // $('.gettext_title').empty();
                    // $('.flag').empty();
                    var title = $(this).data('title');
                    var locale_title = $(this).data('locale_title');
                    var flag = $(this).data('flag');
                    id = $(this).data('id');
                    $('.title').val(title);
                    $('.locale_title').val(locale_title);
                    $('.image').attr("src",flag);
                });

                $(".save").unbind('click');
                $('body').on('submit','#form-edit',function (e) {
                    e.preventDefault();

                    var title = $(".title").val();
                    var locale_title = $(".locale_title").val();
                    var table = $('.dataTable').DataTable();
                    // console.log(new FormData(this));

                    $.ajax({
                        url: '{{ aUrl('site_languages') }}/' + id,
                        method: "post",
                        data: new FormData(this),
                        dataType: 'json',
                        cache       : false,
                        contentType : false,
                        processData : false,


                        success: function (response) {
                            $('.modal.edit_modal').modal('hide');
                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                            table.ajax.reload();
                            }


                    });

                });
            })
        </script>
    @endpush
@endsection

