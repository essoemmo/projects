@extends('admin.index')

@section('title')
    {{_i('Edit Role')}}
@endsection

@section('page_header_name')
    {{_i('Edit Role')}}
@endsection

@section('page_url')
    <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li><a href="{{url('/admin/role/all')}}">{{_i('All')}}</a></li>
    <li ><a href="{{url('/admin/role/add')}}">{{_i('Add')}}</a></li>
    <li class="active"><a href="{{url('/admin/role/'.$role->id.'/edit')}}">{{_i('Edit')}}</a></li>
@endsection

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    <div class="box box-info" style="padding-top:2%">
        <div class="box-header">
            {{--<h3 class="box-title">Edit Role {{$role->name}}</h3>--}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form method="post" action="{{url('/admin/role/'.$role->id.'/edit')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">{{ _i('Role Name') }}</label>

                    <div class="col-xs-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}" required="">

                        @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- ========================= guard name ============================= -->
                {{--<div class="form-group row" >--}}

                    {{--<label class="col-xs-2 col-form-label" for="guard_select">--}}
                        {{--{{_i('Role Guard')}} </label>--}}
                    {{--<div class="col-xs-6">--}}
                        {{--<select id="guard_select" class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}" name="guard_name" required="" onchange="get_permissions();">--}}
                            {{--<option disabled selected> {{_i('Choose')}} </option>--}}
                            {{--<option value="{{$guard_admin}}" {{$role->guard_name == $guard_admin ? 'selected' : ''}} > {{_i('Admin')}} </option>--}}
                            {{--<option value="{{$guard_web}}" {{$role->guard_name == $guard_web ? 'selected' : ''}} > {{_i('Web')}} </option>--}}
                            {{--<option value="{{$guard_store}}" {{$role->guard_name == $guard_store ? 'selected' : ''}} > {{_i('Store')}} </option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}




                <div class="form-group row" >
                    <label class="col-md-12 btn btn-success">{{_i('Permissions')}} </label>
                    <br>
                    <br>
                    @foreach($permissionNames as $permission)

                        <div class="col-md-4" style="padding: 10px">

                            <div class="checkbox checkbox-custom">

                                <label for="{{$permission->id}}">
                                    <input class="control-label" id="{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}  data-parsley-multiple="groups">
                                    {{$permission->name}}</label>
                            </div>
                        </div>

                    @endforeach

                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt"> {{_i('Save ')}}</button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>

    </div>

@endsection

@section('footer')
   <!-- <script  type="text/javascript">

        function get_permissions(){

            var guard = $('#guard_select').val();

            $.ajax({

                url: "{{url('/admin/permission/')}}/"+guard+"",
                type: "get",
                success: function (result) {
                    var data = result;
                    console.log(data.length);
                    var html = "";
                    for (var i = 0; i < data.length; i++)
                    {
                        html += '<div class="col-xs-3"> <div class="checkbox checkbox-custom"> '+
                                '<label for="check'+i+'"> '+
                                ' <input class="control-label" id="check'+i+'" type="checkbox" name="groups[]" value="'+data[i].id+'" data-parsley-multiple="groups" required="">'+data[i].desc+
                                '</label> </div> </div>';
                    }
                    $("#permissions").html(html);

                }
            });
        }
    </script> -->
@endsection