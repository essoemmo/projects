@extends('admin.layout.layout')

<!-- ==============================Edit Form=============================================-->
@section('edit_form')
<form class="form-horizontal" action="<?= route('update_question') ?>" method="POST" id="form_2" data-parsley-validate="">
    @csrf
    <div class="box-body">
        <!-- =========== type ============== -->
        <input type="hidden" name="type" value="trainer" />
        <!-- =========== id ============== -->
        <input type="hidden" id="id_1" name="id" value="" />
        <!-- =========== Title ============== -->
        <div class="form-group">
            <label for="title_1" class="col-xs-4 control-label">{{ _i("Title") }}:</label>

            <div class="col-xs-6">
                <input id="title_1" type="text" class="form-control" name="title" placeholder="{{ _i('Title') }}"
                       required="" /> @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span> @endif
            </div>
        </div>
        <!-- =========== is_Multi ============== -->
        <div class="checkbox">
            <label for="is_multi" class=""> <input id="is_multi_1" type="checkbox" class="" name="is_multi" />
                {{ _i("Is Multi") }}</label>


            @if ($errors->has('is_multi'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('is_multi') }}</strong>
            </span> @endif

        </div>
        <!-- =========== is_Required ============== -->
        <div class="checkbox">
            <label for="is_required" class="col-xs-3 col-form-label text-md-right"><input id="is_required_1" type="checkbox" class="checkbox" name="is_required" />
                {{ _i("Is Required") }}</label>


            @if ($errors->has('is_required'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('is_required') }}</strong>
            </span> @endif

        </div>
        <!-- =================Submit================ -->
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
            {{ _i("Close") }}
        </button>
        <button class="btn btn-primary" type="submit" id="s_form_2">
            {{ _i("Save") }}
        </button>
    </div>
</form>
@endsection
<!-- ==============================Add Form=============================================-->
@section('add_form')
<form class="form-horizontal" action="<?= route('create_question') ?>" method="POST" id="form_1" data-parsley-validate="">
    @csrf
    <div class="box-body">
        <!-- =========== type ============== -->
        <input type="hidden" name="type" value="trainer" />
        <!-- =========== Title ============== -->
        <div class="form-group">
            <label for="title" class="col-xs-4 control-label">{{ _i("Question Title") }}:</label>

            <div class="col-xs-6">
                <input id="title" type="text" class="form-control" name="title" required="" />
                @if($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span> @endif
            </div>
        </div>
        <!-- =========== is_Multi ============== -->
        <div class="checkbox">
            <label for="is_multi" class=""><input id="is_multi" type="checkbox" class="check-box" name="is_multi" />
                {{ _i("Is Multi") }}</label>
            @if ($errors->has('is_multi'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('is_multi') }}</strong>
            </span> @endif

        </div>
        <!-- =========== is_Required ============== -->
        <div class="checkbox">
            <label for="is_required" class=""><input id="is_required" type="checkbox" class="checkbox" name="is_required" />
                {{ _i("Is Required") }}</label>
                @if ($errors->has('is_required'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('is_required') }}</strong>
                </span> @endif

        </div>
    </div>
    <!-- ================================Submit==================================== -->
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
            {{ _i("Close") }}
        </button>
        <button class="btn btn-primary" type="submit" id="s_form_1">
            {{ _i("Save") }}
        </button>
    </div>
</form>
@endsection
<!-- ==============================Edit Model=============================================-->
@section('edit_model')
<!-- =============================== Model Body ============================================== -->
<div class="modal fade" id="modal-edit" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">{{ _i("Edit Question") }}</h4>
            </div>
            <div class="modal-body">
                @yield('edit_form')
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ==============================Add Model=============================================-->
@section('add_model')
<!-- =============================== Model Body ============================================== -->
<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">{{ _i("Add Question") }}</h4>
            </div>
            <div class="modal-body">
                <!-- ================================== Form =================================== -->
                @yield('add_form')
            </div>
        </div>
    </div>
</div>
@endsection

<!-- ==============================Table Show=============================================-->
@section('show_model')

<button type="button" id="add_prim" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
    <i class="fa fa-fw fa-plus-square"></i>
    {{ _i("Add New") }}
</button>
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">{{ _i("Questions") }}</h3>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-bordered table-striped dataTable text-center" role="grid"
                           aria-describedby="example1_info" id="data_table">
                        <thead>
                            <tr>
                                <th>
                                    {{ _i("ID") }}
                                </th>
                                <th>
                                    {{ _i("Question") }}
                                </th>
                                <th>
                                    {{ _i("Is Multi") }}
                                </th>
                                <th>
                                    {{ _i("Is Required") }}
                                </th>
                                <th>
                                    {{ _i("Action") }}
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    @endsection

    <!-- ==============================Head=============================================-->
    @section('title') {{ _i("Questions") }} @endsection @section('box-title' , 'Questions') @section('page_header')

    <section class="content-header">
        <h1>
            {{ _i("Question") }}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>{{ _i("Home") }}</a>
            </li>
        </ol>
    </section>

    @endsection

    <!-- ==============================Main=============================================-->
    @section('content') @yield('edit_model') @yield('add_model') @yield('show_model') @endsection

    <!-- ==============================footer=============================================-->

    @section('footer')

    <script type="text/javascript">
        $(document).ready(
                $("#data_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("getData_trainer_question")}}',
            columns: [{
                    data: "id"
                }, {
                    data: "title"
                },{
                    data: "is_multi"
                },{
                    data: "is_required"
                }, {
                    data: "action",
                    orderable: false,
                    searchable: false
                }],
            "initComplete": function (settings, json) {
<?php
//open add form if error on add.
if (count($errors) > 0) {
    if (session()->has('error_add')) {
        echo 'document.getElementById("add_prim").click();';
    }
}
?>
<?php
//open edit form if error on add.
if (count($errors) > 0) {
    if (session()->has('error_id')) {
        echo 'document.getElementById("item_id_' . session('error_id') . '").click();';
    }
}
?>

            }
        })
                );
        /* initlizing edit form with id and values */
        function edit(id, title, is_multi, is_required) {
            $("#id_1").val(id);
            $("#title_1").val(title);
            if (is_multi === "1") {
                $("#is_multi_1").attr("checked", "checked");
            } else if (is_multi === "0") {
                $("#is_multi_1").removeAttr("checked");
            }
            if (is_required === "1") {
                $("#is_required_1").attr("checked", "checked");
            } else if (is_required === "0") {
                $("#is_required_1").removeAttr("checked");
            }
        }
    </script>

    @endsection
</div>
