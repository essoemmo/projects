@extends('admin.index')

@section('content')

    <div class="row">

        <div class="col-sm-12 mbl">
         <span class="pull-left">
             <a href="{{route('contentManagement.create')}}" target="_blank" class="btn btn-primary create ">
                 <i class="ti-plus"></i>{{_i('create new content')}}
             </a>
         </span>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5> {{ _i('Content List') }} </h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="form-group row" >
                        <label class="col-sm-1 control-label " for="type_selected"><?=_i('Type')?> </label>
                        <div class="col-sm-4">
                            <select name="type" id="type_selected" class="form-control" >
                                <option selected disabled><?=_i('CHOOSE')?></option>-
                                <option value="home" > <?=_i('Home')?> </option>
                                <option value="footer" > <?=_i('Footer')?> </option>
                            </select>
                        </div>
                    </div>
                    <div class="dt-responsive table-responsive text-center">
                        <table id="content_data"  class="table table-striped table-bordered nowrap text-center">
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
@push('js')
    <script type="text/javascript">
        var table;
        $(function(){
            table = $('#content_data').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                ajax: {
                    url: "{{route('contentManagement.index')}}",
                    data: {
                        "resource": "content_management"
                    }
                },
                columns: [
                    {data: 'id', title: '{{_i('id')}}'},
                    {data: 'title', title: '{{_i('title')}}'},
                    {data: 'columns', title: '{{_i('columns')}}'},
                    {data: 'system_type', title: '{{_i('type')}}'},
                    {data: 'order', title: '{{_i('order')}}'},
                    {
                        data: 'action',
                        title: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                'drawCallback': function () {
                    $('#type_selected').change(type);
                    //$('body').on('change','#type_selected',type);
                    $('.sort_hight').click(sort_hight);
                    $('.sort_bottom').click(sort_bottom);
                }
            });
        });

        function type(){
            var type = $(this).val();
            //console.log(type);
            //$("#content_data").html("");
            table.destroy();
            table = $('#content_data').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('contentManagement.index')}}?type="+type,
                columns: [
                    {data: 'id', title: '{{_i('id')}}'},
                    {data: 'title', title: '{{_i('title')}}'},
                    {data: 'columns', title: '{{_i('columns')}}'},
                    {data: 'system_type', title: '{{_i('type')}}'},
                    {data: 'order', title: '{{_i('order')}}'},
                    {
                        data: 'action',
                        title: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                'drawCallback': function () {
                    $('.sort_hight').click(sort_hight);
                    $('.sort_bottom').click(sort_bottom);
                }
            });
        }

        function sort_hight(){
            var rowId = $(this).data('id');
            //console.log(rowId);
            $.ajax({
                url: '{{url("admin/contentManagement/sort")}}',
                type: 'get',
                dataType: 'json',
                data: {row_sort_hightId: rowId},
                success: function (res) {
                    table.ajax.reload();
                }
            });
        }

        function sort_bottom(){
            var rowId = $(this).data('id');
            //console.log(rowId);
            $.ajax({
                url: '{{url("admin/contentManagement/sort")}}',
                type: 'get',
                dataType: 'json',
                data: {row_sort_bottomId: rowId},
                success:function (res) {
                    table.ajax.reload();
                }
            })
        }
    </script>
@endpush