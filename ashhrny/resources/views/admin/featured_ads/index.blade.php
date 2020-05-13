@extends('admin.layout.index',[
'title' => _i('All Featured Ads'),
'activePageName' => _i('All Featured Ads'),
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
                    <form id="add-form" class="j-forms" data-parsley-validate>
                        @honeypot {{--prevent form spam--}}
                        <div class="content">
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Place & Price') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('Place') }}</label>
                                                        <div class="col-sm-12">
                                                            <select name="place" id="add_place">
                                                                <option disabled selected>{{ _i('Select') }}</option>
                                                                <option value="slider">{{ _i('Slider') }}</option>
                                                                <option
                                                                    value="featured">{{ _i('Featured Users') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('Price') }}</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" id="add_price" name="price"
                                                                   placeholder="{{ _i('Price') }}">
                                                        </div>
                                                    </div>
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
                                            class="btn btn-primary btn-outline-primary m-b-0 save_language">{{ _i('Save') }}</button>
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
                        <input type="hidden" id="edit_id" value=""/>
                        @honeypot {{--prevent form spam--}}
                        <div class="content">
                            <div class="divider-text gap-top-45 gap-bottom-45">
                                <span>{{ _i('Place & Price') }}</span>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('Place') }}</label>
                                                        <div class="col-sm-12">
                                                            <select name="place" id="edit_place">
                                                                <option disabled selected>{{ _i('Select') }}</option>
                                                                <option value="slider">{{ _i('Slider') }}</option>
                                                                <option
                                                                    value="featured">{{ _i('Featured Users') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-form-label">{{ _i('Price') }}</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" id="edit_price" name="price"
                                                                   placeholder="{{ _i('Price') }}">
                                                        </div>
                                                    </div>
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
                $('#add-form').submit(function (e) {
                    e.preventDefault();

                    var form = $("#add-form").serialize();
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: "{{route('featured_ad.store')}}",
                        type: "post",
                        data: new FormData(this),
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,

                        success: function (res) {
                            $('.modal.modal_create').modal('hide');
                            table.ajax.reload();
                            $("#add-form").parsley().reset();
                            $('.add_price').val("");

                            if (res == true) {
                                new Noty({
                                    type: 'success',
                                    layout: 'topRight',
                                    text: "{{ _i('success save')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
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

                    $("#edit_place").val("");
                    $("#edit_price").val("");
                    var place = $(this).data('place');
                    var price = $(this).data('price');
                    $("#edit_place").val(place).change();
                    $("#edit_price").val(price).change();

                    $("#edit_form").parsley().reset();
                });


                $('#form-edit').submit(function (e) {
                    e.preventDefault();
                    $('#edit_id').val(id);
                    // console.log(id);

                    var form = $("#form-edit").serialize(this);
                    var table = $('.dataTable').DataTable();
                    $.ajax({
                        url: '{{ aUrl('featured_ad')}}/' + id,
                        method: "post",
                        data: new FormData(this),
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            $('.modal.edit_modal').modal('hide');
                            table.ajax.reload();
                            $("#form-edit").parsley().reset();

                            if (res == true) {
                                new Noty({
                                    type: 'success',
                                    layout: 'topRight',
                                    text: "{{ _i('success update')}}",
                                    timeout: 2000,
                                    killer: true
                                }).show();
                            }
                        }
                    })
                });

            })
        </script>
    @endpush
@endsection

