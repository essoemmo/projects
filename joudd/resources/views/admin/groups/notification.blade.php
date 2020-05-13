
@extends('admin.layout.layout')

@section('title')
    {{_i('Send Notifications')}}
@endsection

@section('box-title')
    {{_i('Send Notifications')}}
@endsection

@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Send Notifications')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
        </ol>
    </section>

@endsection

@section('content')

    @if ($errors->all())
    <div class="alert  alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> {{_i('Alert!')}}</h4>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach

    </div>
    @endif



    <form   method="POST" action="{{ url('/admin/notification/to/store') }}"  data-parsley-validate="" >

    @csrf

    <div class="box box-info">

        <!-- /.box-header -->
        <div class="box-body">

            <!--=============================== to====================================-->
            <div class="form-group row">

                <label   class="col-xs-2 col-form-label">{{_i('To :')}}</label>

                <div class="col-xs-6">
                    <input class="form-check-input" required type="radio" name="notify_type" id="group_selected" value="group" checked>
                    <label class="form-check-label" for="group_selected"> {{_i('Group')}} </label>


                    <input class="form-check-input" required type="radio" name="notify_type" id="user_selected" value="user">
                    <label class="form-check-label" for="user_selected"> {{_i('Users')}} </label>

                </div>
            </div>


            <div class="form-group row" id="group_section" style="display: none;">
                <label for="gender_selected_type" class="col-xs-2 col-form-label">{{_i('Group')}}</label>
                <div class="col-xs-6">
                    <select class="form-control"  name="group_id"  id="group_required">
                        <option value="" disabled selected>{{_i('Choose')}}</option>
                        @foreach($groups as $group)
                            <option value="{{$group['id']}}">{{$group['title']}}</option>
                        @endforeach

                    </select>
                </div >
            </div>

            <div class="form-group row">
                <label  class="col-xs-2 col-form-label">{{_i('Message')}}</label>
                <div class="col-xs-6">
                   <textarea class="form-control" name="send_message" required=""></textarea>
                </div >
            </div>

            <div class="pull-right">
                <a  >
                    <button type="submit" class="btn btn-success " >{{_i('Save')}}</button>
                </a>
            </div>

        </div>


            <div class="box-footer" id="users_sections" style="display: none;">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="users-table" class="table table-hover text-center" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>  {{_i('ID')}}</th>
                                    <th>  {{_i('First Name')}}</th>
                                    <th>  {{_i('Last Name')}}</th>
                                    <th>  {{_i('Email')}} </th>
                                    <th>  {{_i('Is Added By Admin')}} </th>
                                    <th>  {{_i('Address')}} </th>
                                    <th>{{_i('Is Active ')}} </th>
                                    <th>{{_i('Action')}}</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    <!-- /.box-body -->

</form>

@endsection

@section('footer')

    <script>
        $(document).ready(function(){
            if($("#group_selected").prop("checked", true)){
                $("#group_section").show();
                $("#group_required").prop('required',true);
                //$("#group_section").setAttribute();
            }
            $("#group_selected").click(function(){
                $("#group_selected").prop("checked", true);
                $("#group_section").show();
                $("#users_sections").hide();
                $("#group_required").prop('required',true);
            });
            $("#user_selected").click(function(){
                $("#group_selected").prop("checked", false);
                $("#group_required").prop('required',false);
                $("#group_section").hide();
                $("#users_sections").show();
                $("#user_selected").prop("checked", true);
            });
        });
    </script>

    <script  type="text/javascript">

        var table;
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/notification/to')}}',
                columns: [
                    {data: 'select_users', name: 'select_users'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'website', name: 'website'},
                    {data: 'address', name: 'address'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });


    </script>


@endsection





