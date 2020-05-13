@extends('admin.index')

@section('title')
    {{_i('Add Role')}}
@endsection

@section('page_header_name')
    {{_i('Add Role')}}
@endsection

@section('page_url')
    <li><a href="{{url('/admin')}}" class="btn btn-default"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li><a href="{{url('/admin/role/all')}}" class="btn btn-success">{{_i('All')}}</a></li>
    <li class="active"><a href="{{url('/admin/role/add')}}" class="btn btn-primary">{{_i('Add')}}</a></li>
@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  action="{{url('/admin/role/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">

                @csrf
                <div class="box-body">
                <div class="form-group row">
                </div>

                <div class="form-group row" >

                    <label class="col-xs-2 col-form-label" for="txtUser">
                        {{_i('Role Name')}} </label>
                    <div class="col-xs-6">
                        <input type="text" name="name" id="txtUser" required="" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
{{--                <!-- ========================= guard name ============================= -->--}}
{{--                    <input type="hidden" name="guard_name" value="{{$guard_name}}">--}}
                    <!--- ===================== permissions ==========================--->
                <div class="form-group row ">
                    <label class="col-xs-2 col-form-label">
                        {{_i('Permissions')}} </label>
                </div>
                <div class="form-group row" >

                    @foreach($permissionNames as $permission)

                        <div class="col-md-4" style="padding: 10px">

                            <div class="checkbox checkbox-custom">

                                <label for="{{$permission->id}}">
                                    <input class="control-label" id="{{$permission->id}}" type="checkbox" name="groups[]" value="{{$permission->id}}" data-parsley-multiple="groups">
                                    {{$permission->name}}
                                </label>
                            </div>
                        </div>

                    @endforeach

                </div>

                <div class="form-group row " {{-- style="margin-right: 60%; margin-top: 5%;"--}}>
                    <div class="col-sm-offset-2 col-sm-2">
                        {{--<input type="submit" class="btn btn-default" value="Save">--}}
                        <button type="submit" class="btn btn-info pull-leftt"> {{_i('Add Role')}}</button>
                    </div>
                </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('footer')
{{--    <script  type="text/javascript">--}}

{{--        $('#guard_select').on('change', function(){--}}

{{--            var guard = $('#guard_select').val();--}}

{{--            $.ajax({--}}

{{--                url: "{{url('/admin/permission/')}}/"+guard+"",--}}
{{--                type: "get",--}}
{{--                success: function (result) {--}}
{{--                    var data = result;--}}
{{--                    console.log(data.length);--}}
{{--                    var html = "";--}}
{{--                    for (var i = 0; i < data.length; i++)--}}
{{--                    {--}}
{{--                        html += '<div class="col-xs-3"> <div class="checkbox checkbox-custom"> '+--}}
{{--                                '<label for="check'+i+'"> '+--}}
{{--                                ' <input class="control-label" id="check'+i+'" type="checkbox" name="groups[]" value="'+data[i].id+'" data-parsley-multiple="groups" required="">'+data[i].desc+--}}
{{--                                '</label> </div> </div>';--}}
{{--                    }--}}
{{--                    $("#permissions").html(html);--}}

{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endsection