@extends('admin.layout.index',[
'title' => _i('All Genres'),
'activePageName' => _i('All Genres'),
] )
@section('content')
    <div class="alert alert-danger message" style="display: none">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>


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
    <div class="modal modal_create" tabindex="-1" role="dialog" >
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
                    <form id="add_form" class="j-forms" data-parsley-validate="">
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
                                                <label class=" col-sm-3 col-form-label">{{ $lang['title'] }} {{ _i('Title') }}</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control genre_title" name="{{$lang->locale}}_title" value="{{old($lang->locale."_title")}}"  placeholder="{{_i($lang['title'])}} {{_i('title')}}" required="">
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
                                    <button type="submit" class="btn btn-primary btn-outline-primary m-b-0 save_language">{{ _i('Save') }}</button>
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
                    <form id="edit_form" class="j-forms" data-parsley-validate="">
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
                                                    <label class=" col-sm-3 col-form-label">{{ $lang['title'] }} {{ _i('Title') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control genre_title_edit {{$lang->locale}}_title" name="{{$lang->locale}}_title" value="{{old($lang->locale."_title")}}"  placeholder="{{_i($lang['title'])}} {{_i('title')}}" required="">
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
                'use strict';
                $('.create').attr('data-toggle','modal').attr('data-target','.modal_create')
            });

            $(function() {
                $('#add_form').submit(function(e) {
                    e.preventDefault();

                    //var form = $(this).serializeArray();
                   // fields = $( ":input" ).serializeArray();
                    var form = $( "#add_form" ).serialize();
                    //console.log(form);
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: "{{route('genres.store')}}",
                        type: "post",
                        data:form,
                        success:function (res) {
                            $('.modal.modal_create').modal('hide');
                            table.ajax.reload();
                            $("#add_form").parsley().reset();
                            $('.genre_title').val("");

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
                $('body').on('click','.edit',function (e) {
                    id = $(this).data('id');
                   // var title = $(this).data('title');
                    //$('.title').val(title);

                    @foreach($langs as $lang)
                    $('.{{$lang->locale}}_title').empty();
                    var {{$lang->locale}}_title = $(this).data('title-{{$lang->locale}}');

                    $('.{{$lang->locale}}_title').val({{$lang->locale}}_title);
                    @endforeach
                });


                $('#edit_form').submit(function(e) {
                    e.preventDefault();
                    console.log(id);

                    var form = $( "form" ).serialize();
                    //console.log(form);
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url:'{{ aUrl('genres') }}/' + id,
                        method: "put",
                        //type: "post",
                        data:form,
                        error: function(res) {
                          //  $('.message').show();
                        },
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

