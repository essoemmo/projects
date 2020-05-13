@extends('admin.layout.index',[
'title' => _i('All Open Ticket'),
'activePageName' => _i('All Open Ticket'),
] )
@section('content')


    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {!! $dataTable->table([
                     'class' => "table table-striped table-bordered nowrap dataTable text-center"
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
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Title') }}</span>
                            </div>
                            <br>
                            @foreach($langs as $lang)
                                <div class="form-group row">
                                    <label
                                        class=" col-sm-3 col-form-label">{{ $lang['title'] }} {{ _i('Title') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control languages_title"
                                               name="{{$lang->locale}}_title" value="{{old($lang->locale."_title")}}"
                                               placeholder="{{_i($lang['title'])}} {{_i('title')}}" required="">
                                    </div>
                                </div>
                            @endforeach

                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Description') }}</span>
                            </div>
                            <br>
                            @foreach($langs as $lang)
                                <div class="form-group row">
                                    <label
                                        class=" col-sm-3 col-form-label">{{ $lang['title'] }} {{ _i('Description') }}</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control languages_desc"
                                                  name="{{$lang->locale}}_description"
                                                  placeholder="{{_i($lang['title'])}} {{_i('Description')}}"
                                                  required="">
                                        </textarea>
                                    </div>
                                </div>
                            @endforeach

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

                        <input type="hidden" id="edit_id" value=""/>
                        @csrf
                        @honeypot {{--prevent form spam--}}
                        <input type="hidden" name="_method" value="PATCH"/>

                        <div class="content">
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Title by language') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            @foreach($langs as $lang)
                                                <div class="form-group row">
                                                    <label
                                                        class=" col-sm-3 col-form-label">{{ $lang['title'] }} {{ _i('Title') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                               class="form-control openTicket_title_edit {{$lang->locale}}_title"
                                                               name="{{$lang->locale}}_title"
                                                               value="{{old($lang->locale."_title")}}"
                                                               placeholder="{{_i($lang['title'])}} {{_i('title')}}"
                                                               required="">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Description by language') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            @foreach($langs as $lang)
                                                <div class="form-group row">
                                                    <label
                                                        class=" col-sm-3 col-form-label">{{ $lang['title'] }} {{ _i('Title') }}</label>
                                                    <div class="col-sm-9">
                                                        <textarea
                                                            class="form-control openTicket_desc_edit {{$lang->locale}}_desc"
                                                            name="{{$lang->locale}}_title"
                                                            placeholder="{{_i($lang['title'])}} {{_i('title')}}"
                                                            required="">
                                                        </textarea>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
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

    @push('js')
        {!! $dataTable->scripts() !!}
        <script>
            $(function () {
                'use strict';
                $('.create').attr('data-toggle', 'modal').attr('data-target', '.modal_create')
                $('body').on('click', '.create', function (e) {
                    $('.languages_title').val("");
                    $('.languages_desc').empty();
                });
            });

            $(function () {
                $('#add_form').submit(function (e) {
                    e.preventDefault();

                    var form = $("#add_form").serialize();
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: "{{route('openTicket.store')}}",
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
                            $('.languages_title').val("");
                            $('.languages_desc').empty();

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

            $(function () {
                'use strict';
                var id = '';
                $(".edit").unbind('click');
                $('body').on('click', '.edit', function (e) {
                    id = $(this).data('id');

                    @foreach($langs as $lang)
                    $('.{{$lang->locale}}_title').empty();
                    $('.{{$lang->locale}}_desc').empty();
                    var {{$lang->locale}}_title = $(this).data('title-{{$lang->locale}}');
                    var {{$lang->locale}}_desc = $(this).data('desc-{{$lang->locale}}');

                    $('.{{$lang->locale}}_title').val({{$lang->locale}}_title);
                    $('.{{$lang->locale}}_desc').text({{$lang->locale}}_desc);
                    @endforeach
                    $("#edit_form").parsley().reset();
                });


                $('#edit_form').submit(function (e) {
                    e.preventDefault();
                    $('#edit_id').val(id);
                    var url = "{{ route('openTicket.update', ":id") }}";
                    url = url.replace(':id', id);
                    var form = $("#edit_form").serialize(this);
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: url,
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
@endsection

