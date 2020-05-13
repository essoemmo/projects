

@extends('admin.layout.layout')

@section('title')
{{_i('News Letters')}}
@endsection
        <!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-fw fa-plus-square"></i>
        {{_i('Export')}}
    </button>

    <form  class="form-horizontal" action=""  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group">

                <label for="email" class="col-md-4 col-form-label text-md-right" >{{_i('Email :')}}</label>

                <div class="col-md-6">
                    <input type="hidden" id="id_1" name="id" value="">
                    <input id="title_1" type="email" class="form-control" name="email" required="" data-parsley-type="email">

                    @if ($errors->has('email'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <!-- ================================Submit==================================== -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
            <button  class="btn btn-info" type="submit" id="s_form_2">{{ _i('Save')}}</button>
        </div>
    </form>
    @endsection
            <!-- ==============================Add Form=============================================-->
@section('job_type_form')
    <form  class="form-horizontal" action="{{url('/admin/newsletters/add')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">
            <!-- ================================== Title =================================== -->
            <div class="form-group">

                <label for="email" class="col-md-4 col-form-label text-md-right" >{{_i('Email :')}}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email"  placeholder="{{ _i('Email')}}"  required="" data-parsley-type="email">

                    @if ($errors->has('email'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <!-- ================================Submit==================================== -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>
            <button  class="btn btn-info" type="submit" id="s_form_1">{{ _i('Save')}}</button>
        </div>
    </form>
    @endsection
            <!-- ==============================Edit Model=============================================-->
    @section('jobtype_edit_model')
            <!-- =============================== Model Body ============================================== -->
    <div class="modal fade" id="modal-edit" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Edit Subscriber')}}</h4>
                </div>
                <div class="modal-body">
                    @yield('jobtype_edit_form')
                </div>
            </div>
        </div>
    </div>
    @endsection
            <!-- ==============================Add Model=============================================-->
    @section('jobtype_add_edit_model')
            <!-- =============================== Model Body ============================================== -->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i('Add Subscriber')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    @yield('job_type_form')
                </div>
            </div>
        </div>
    </div>
    @endsection

            <!-- ==============================Table Show=============================================-->
@section('jobtype_show_model')
   <a href="{{url('/admin/newsletters/export')}}"> <button type="button" class="btn btn-primary" >
            <i class="fa fa-fw  fa-download"></i>
            {{_i('Export')}}
        </button></a>


    <div class="box box-info box-body">

        <!-- /.box-header -->
        
            <table class="table table-hover text-center" id="newletters_table">
                <thead><tr>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 30px;">{{ _i('ID')}}</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 80px;">{{ _i(' Email')}}</th>
                   
                </tr>
                </thead></table>
      
        <!-- /.box-body -->
    </div>
    @endsection


            <!-- ==============================Head=============================================-->





@section('page_url')
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
   
    <li class="active"><a href="{{url('/adminpanel/newsletters/all')}}">{{_i('All')}}</a></li>

    @endsection



            <!-- ==============================Main=============================================-->
    @section('content')
    @yield('jobtype_edit_model')
    @yield('jobtype_add_edit_model')
    @yield('jobtype_show_model')

    @endsection

            <!-- ==============================footer=============================================-->

@section('footer')
    <script  type="text/javascript">

        /* Data table display*/
        $(document).ready(
                $("#newletters_table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{url('/admin/newsletters/get_datatable')}}',
                    columns: [
                        {data: 'id'},
                        {data: 'email'},
                       // {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                }));

        /* initlizing edit form with id and values */
        function edit(id,email){
            console.log(id);
            $('#id_1').val(id);
            $('#title_1').val(email);
            $('#form_2').attr('action',id+'/edit');
        }

    </script>

@endsection

