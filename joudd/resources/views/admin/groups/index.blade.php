@extends('admin.layout.layout')



<!-- ==============================Edit Form=============================================-->
@section('jobtype_edit_form')
{{--    <form  class="form-horizontal" action="{{url('/admin/groups/update')}}"  method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">--}}
{{--        @csrf--}}
{{--        <div class="box-body">--}}


{{--            <!-- ================================== Title =================================== -->--}}
{{--            <div class="form-group ">--}}

{{--                <label for="title_1" class="col-xs-2 col-form-label " >{{_i('Group Name')}}</label>--}}

{{--                <div class="col-xs-10">--}}
{{--                    <input type="hidden" id="id_1" name="id" value="">--}}
{{--                    <input id="title_1" type="text" class="form-control" name="title" required="">--}}

{{--                    @if ($errors->has('title'))--}}
{{--                        <span class="text-danger invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $errors->first('title') }}</strong>--}}
{{--                </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- ================================== description =================================== -->--}}
{{--            <div class="form-group ">--}}

{{--                <label for="description_1" class="col-xs-2 col-form-label " >{{_i('Description')}}</label>--}}

{{--                <div class="col-xs-10">--}}

{{--                    <textarea id="description_1"  class="form-control" name="description"></textarea>--}}
{{--                    @if ($errors->has('description'))--}}
{{--                        <span class="text-danger invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('description') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- ================================== users =================================== -->--}}
{{--            <div class="form-group " >--}}
{{--                <label class="col-xs-2 col-form-label " for="get_country">--}}
{{--                    {{_i('Users')}} </label>--}}
{{--                <div class="col-xs-10">--}}
{{--                    <select multiple required="" id="users_selected" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="users_id[]" >--}}
{{--                        <option disabled> {{_i('Choose')}}</option>--}}
{{--                        @foreach($users as $user)--}}
{{--                            <option value="{{$user->id}}" @foreach(users_group(1) as $item) {{$item->user_id == $user->id ? 'selected' : '' }} @endforeach> {{$user['first_name'].' '.$user['last_name']}}  </option>--}}
{{--                        @endforeach--}}

{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--        </div>--}}
{{--        <!-- ================================Submit==================================== -->--}}
{{--        <div class="modal-footer">--}}
{{--            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ _i('Close')}}</button>--}}
{{--            <button  class="btn btn-info" type="submit" id="s_form_2">{{ _i('Save')}}</button>--}}
{{--        </div>--}}
{{--    </form>--}}
@endsection
<!-- ==============================Add Form=============================================-->
@section('job_type_form')
    <form  class="form-horizontal" action="{{url('/admin/groups/add')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
        @csrf
        <div class="box-body">

            <!-- ================================== Title =================================== -->
            <div class="form-group ">

                <label for="name" class="col-xs-2 col-form-label " >{{_i('Group Name')}}</label>

                <div class="col-xs-10">
                    <input id="name" type="text" class="form-control" name="title"  placeholder="{{ _i('Group Name')}}"  required="">

                    @if ($errors->has('title'))
                        <span class="text-danger invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <!-- ================================== description =================================== -->
            <div class="form-group ">

                <label for="description" class="col-xs-2 col-form-label " >{{_i('Description')}}</label>

                <div class="col-xs-10">
                    <textarea id="description"  class="form-control" name="description"   ></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

            </div>

            <!-- ================================== users =================================== -->
            <div class="form-group " >
                <label class="col-xs-2 col-form-label " for="get_country">
                    {{_i('Users')}} </label>
                <div class="col-xs-10">
                    <select multiple required="" class="form-control select2 select2-hidden-accessible" style="width:100%" aria-hidden="true" name="users_id[]" >
                        <option disabled> {{_i('Choose')}}</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" > {{$user['first_name'].' '.$user['last_name']}} </option>
{{--                            <option value="{{$country->id}}" @foreach($course_country as $item) {{$item->country_id == $country->id ? 'selected' : '' }} @endforeach> {{_i($country->title)}} </option>--}}
                        @endforeach

                    </select>
                    @if ($errors->has('country_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country_id') }}</strong>
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
                    <h4 class="modal-title">{{_i('Edit Group')}}</h4>
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
                    <h4 class="modal-title">{{_i('Add Group')}}</h4>
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
        <i class="fa fa-fw fa-plus-square"></i>
        {{_i('Add New')}} </button>
    <div class="box box-info box-body">

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover text-center" id="group_table">
                <thead><tr>
                    <th class="sorting" >{{ _i('ID')}}</th>
                    <th class="sorting" >{{ _i('Group Name')}}</th>
                    <th class="sorting" >{{ _i('created_at')}}</th>
                    <th class="sorting" >{{ _i('Action')}}</th>
                </tr>
                </thead></table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection


<!-- ==============================Head=============================================-->
@section('title')

    {{_i('Group Name')}}

@endsection


@section('box-title')
    {{_i('Group Name')}}
@endsection


@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Groups')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>{{_i('Home')}}</a></li>
        </ol>
    </section>


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
            $("#group_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('/admin/groups/all')}}',
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            }));

        /* initlizing edit form with id and values */
        function edit(id,title,description){
            console.log(id);
            $('#id_1').val(id);
            $('#title_1').val(title);
            $('#description_1').val(description);

        }

    </script>

@endsection

