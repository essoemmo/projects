@extends('admin.layout.layout')
@section('content')

<div class="box box-body box-info ">
    <form action="{{ route('create_discount_code') }}" method="POST" class="form-horizontal" id="form_1" enctype="multipart/form-data" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ======================= Title  ======================= -->
            <div class="form-group row">
                <label for="title" class="col-xs-4 control-label">{{_i('Title')}}</label>
                <div class="col-xs-6">
                    <input type="text" name="title" maxlength="100" data-parsley-maxlength="100" required class="form-control" placeholder="{{ _i('Title')}}">
                    @if($errors->has('title'))
                    <strong>{{$errors->first('title')}}</strong> @endif
                </div>

            </div>
            <!-- ======================= codes_count  ======================= -->
            <div class="form-group row">
                <label for="codes_count" class="col-xs-4 control-label">{{_i('Codes Count')}}</label>
                <div class="col-xs-6">
                    <input type="number" name="codes_count" step="1" maxlength="5" data-parsley-maxlength="5" required class="form-control" placeholder="{{ _i('Codes Count')}}">
                    @if($errors->has('codes_count'))
                    <strong>{{$errors->first('codes_count')}}</strong> @endif
                </div>

            </div>
            <!-- ======================= discount  ======================= -->
            <div class="form-group row">
                <label for="discount" class="col-xs-4 control-label">{{_i('Discount')}}</label>
                <div class="col-xs-6">
                    <input type="number" name="discount" step="0.1" maxlength="5" data-parsley-maxlength="5" required class="form-control" placeholder="{{ _i('Discount')}}">
                    @if($errors->has('discount'))
                    <strong>{{$errors->first('discount')}}</strong> @endif
                </div>
                <span class="text-center text-green">%</span>

            </div>
        </div>
        <!-- ================================Submit==================================== -->
        <div class="col-xs-2">
            <button type="submit" name="action" value="submit" class="btn btn-info">
                {{ _i("Generate") }}
            </button>
        </div>

    </form>
</div>
<div class="box box-body box-info">
    <!-- =========================== Show Discount Codes =========================== -->
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info" id="data_table">
                    <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                                {{ _i("Title") }}
                            </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">
                                {{ _i("Code") }}
                            </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">
                                {{ _i("Discount") }}
                            </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">
                                {{ _i("Date ") }}
                            </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending">
                                {{ _i("Action") }}
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection @section('footer')
<script type="text/javascript">
    $(document).ready(function () {
    $("#data_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("getData_discount_codes")}}',
        columns: [{
                data: 'title'
            }, {
                data: 'code'
            }, {
                data: 'discount'
            }, {
                data: 'created'
            }, {
                data: 'action',
                orderable: false,
                searchable: false
            }]
    }
    );});
</script>
@endsection
