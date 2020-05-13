

<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> {{_i('Add About')}} </h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="{{url('adminpanel/about/add')}}" method="POST" data-parsley-validate="">

                    @csrf
                    <div class="box-body">
                        <!-- ================================== Title =================================== -->
                        <div class="form-group row" style="width: 100%">

                            <label for="name" class="col-sm-3 col-form-label"> {{_i('Title')}} <span style="color: #F00;">*</span></label>

                            <div class="col-sm-9">
                                <input  type="text" class="form-control" name="title" placeholder="{{_i('About Title')}}"
                                        value="{{old('title')}}" data-parsley-length="[3, 191]" required="">

{{--                                <span class="text-danger invalid-feedback">--}}
{{--                                      <strong>{{$errors->first('title')}}</strong>--}}
{{--                                </span>--}}

                            </div>
                        </div>

                        <!-- ================================== description =================================== -->
                        <div class="form-group row" style="width: 100%">

                            <label for="descrption" class="col-sm-3 col-form-label"> {{_i('Description')}} <span style="color: #F00;">*</span></label>

                            <div class="col-sm-9">
                               <textarea id="descrption" class="form-control" name="descrption" placeholder="{{_i('About description')}}&hellip;"
                                     minlength="20" data-parsley-minlength="20" required="" >{{old('descrption')}}</textarea>
                            </div>

                        </div>

                    </div>
                    <!-- ================================Submit==================================== -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> {{_i('Close')}} </button>
                        <button class="btn btn-info" type="submit" id="s_form_1"> {{_i('Save')}} </button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-------------------- model edit ---------------------->

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> {{_i('Add About')}} </h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" action="{{url('adminpanel/about/update')}}" method="POST" data-parsley-validate="">

                    @csrf
                    <div class="box-body" >
                        <!-- ================================== Title =================================== -->
                        <div class="form-group row  " style="width: 100% ">

                            <label for="title_1" class="col-sm-3 col-form-label"> {{_i('Title')}} <span style="color: #F00;">*</span></label>

                            <div class="col-sm-9">
                                <input  type="text" class="form-control" name="title" placeholder="{{_i('About Title')}}"
                                        value="{{old('title')}}" data-parsley-length="[3, 191]" required="" id="title_1">
                                <input type="hidden" id="id_1" name="id" value="">

{{--                                <span class="text-danger invalid-feedback">--}}
{{--                                      <strong>{{$errors->first('title')}}</strong>--}}
{{--                                </span>--}}

                            </div>
                        </div>

                        <!-- ================================== description =================================== -->
                        <div class="form-group row" style="width: 100%">

                            <label for="descrption_1" class="col-sm-3 col-form-label"> {{_i('Description')}} <span style="color: #F00;">*</span></label>

                            <div class="col-sm-9">
                               <textarea  id="descrption_1" class="form-control" name="descrption" placeholder="{{_i('About description')}}&hellip;"
                                         minlength="20" data-parsley-minlength="20" required="" >{{old('descrption')}}</textarea>
                            </div>

                        </div>

                    </div>
                    <!-- ================================Submit==================================== -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> {{_i('Close')}} </button>
                        <button class="btn btn-info" type="submit" id="s_form_1"> {{_i('Save')}} </button>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!----- end edit model ------------------------>

        <div class="box-header">

            {{--<h3 class="box-title">Data Rolles With Full Features</h3>--}}
        </div>
        <!-- /.box-header -->
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row" style="min-width: 100% !important;">
                <div class="col-sm-12">

                    <div class="dt-buttons" style="float: left;margin-bottom: 20px;margin-top: 20px">
                        <button class="dt-button btn btn-default"  type="button"  data-toggle="modal" data-target="#modal-default2">
                            <span><i class="fa fa-plus"></i> {{_i('create new About ')}} </span>
                        </button>

                    </div>

                    <table id="about-table" class="table table-striped table-bordered nowrap dataTable" role="grid" style="width: 100% ;">
                        <thead>
                        <tr >
                            <th class="sorting" > {{_i('ID')}}</th>
                            <th class="sorting" > {{_i('Title')}}</th>
                            <th class="sorting" > {{_i('Created At')}}</th>
                            <th class="sorting" style="min-width: 130px !important;" > {{_i('Controll')}}</th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->




@push('js')

    <script>


        $(document).ready(
            $("#about-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/adminpanel/about/datatable')}}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    // { data:'delete',name:'delete'}
                ]
            })
        );
        /* initlizing edit form with id and values */
        function edit(id,title,descrption){
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#descrption_1').val(descrption);
        }


    </script>

    @endpush