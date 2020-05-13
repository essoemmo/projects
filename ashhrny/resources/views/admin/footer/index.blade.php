@extends('admin.layout.index',[
'title' => _i('All Footer'),
'activePageName' => _i('All Footer'),
] )
@section('content')

    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive text-center">
                <div id="basic-btn_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    {!! $dataTable->table([
                     'class' => "table table-striped table-bordered nowrap text-center"
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
                                <span>{{ _i('Title by language') }}</span>
                            </div>
                            <br>
                            @foreach($langs as $lang)
                                <div class="form-group row">
                                    <label
                                        class=" col-sm-3 col-form-label">{{ _i('Title') }} {{ _i($lang['title']) }} </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control languages_title"
                                               name="{{$lang->locale}}_title" value="{{old($lang->locale."_title")}}"
                                               placeholder="{{_i('title')}} {{_i($lang['title'])}} " required="">
                                    </div>
                                </div>
                            @endforeach

                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Footer URL') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label class=" col-sm-3 col-form-label">{{ _i('Url') }} </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control languages_title" name="url"
                                           placeholder="{{_i('Enter Url')}}" required="" data-parsley-type="url"
                                           data-parsley-maxlength="191">
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
                    <form id="edit_form" class="j-forms" enctype="multipart/form-data" data-parsley-validate=""
                          method="post">
                        {{method_field('put')}}
                        <input type="hidden" id="edit_id" value=""/>
                        @csrf
                        @honeypot {{--prevent form spam--}}
                        {{--                        <input type="hidden" name="_method" value="PATCH" />--}}

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
                                                        class=" col-sm-3 col-form-label">{{ _i('Title') }} {{ _i($lang['title']) }} </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                               class="form-control genre_title_edit {{$lang->locale}}_title"
                                                               name="{{$lang->locale}}_title"
                                                               value="{{old($lang->locale."_title")}}"
                                                               placeholder="{{_i('title')}} {{_i($lang['title'])}}"
                                                               required="">
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="divider-text gap-top-45 gap-bottom-45">
                                                <span>{{ _i('Footer URL') }}</span>
                                            </div>
                                            <br>
                                            <div class="form-group row">
                                                <label class=" col-sm-3 col-form-label">{{ _i('Url') }} </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control footer_url" name="url"
                                                           placeholder="{{_i('Enter Url')}}" required=""
                                                           data-parsley-type="url" data-parsley-maxlength="191">
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
            });

            $(function () {
                $('#add_form').submit(function (e) {
                    e.preventDefault();

                    var form = $("#add_form").serialize();
                    console.log(form);
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: "{{route('footer.store')}}",
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
                            $('.social_icon').val("");

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
                // $(".edit").unbind('click');
                $('body').on('click', '.edit', function (e) {

                    id = $(this).data('id');
                    var url = $(this).data('footer');
                    $('.footer_url').val(url);
                    @foreach($langs as $lang)
                    $('.{{$lang->locale}}_title').empty();
                    var {{$lang->locale}}_title = $(this).data('title-{{$lang->locale}}');
                    $('.{{$lang->locale}}_title').val({{$lang->locale}}_title);
                    @endforeach
                    $("#edit_form").parsley().reset();
                });


                $('#edit_form').submit(function (e) {
                    e.preventDefault();
                    $('#edit_id').val(id);
                    console.log(id);

                    //var form = $( "#edit_form" ).serialize(this);
                    //console.log(form);
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: "{{ aUrl('footer')}}/" + id,
                        method: "POST",
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

