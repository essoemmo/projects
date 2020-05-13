
@extends('master.layout.index',[
'title' => _i('Edit Role'),
'subtitle' => _i('Edit Role'),
'activePageName' => _i('Edit Role'),
'additionalPageUrl' => url('/adminpanel/role/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>

    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">

            <form method="post" action="{{url('/master/role/'.$role->id.'/edit')}}" class="form-horizontal"  id="demo-form" data-parsley-validate="">
                @csrf


                <div class="form-group row" >

                    <label class="col-sm-2 col-form-label"  >
                        {{_i('Language')}} </label>
                    <div class="col-sm-6">
                        <select  class="form-control" name="lang_id" id="selected_lang">
                            <option selected disabled><?= _i('CHOOSE')?></option>
                            @foreach($langs as $lang)
                                <option value="{{$lang->id}}}" >{{_i($lang->title)}}</option>
                            @endforeach
                        </select>
                        <small  class="form-text text-muted">{{_i('Please select language to change Permissions name according to language selected ')}}</small>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{ _i('Role Name') }}</label>

                    <div class="col-sm-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $role->name }}" required="">

                        @if ($errors->has('name'))
                            <span class="text-danger " role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- ========================= guard name ============================= -->
                {{--<div class="form-group row" >--}}

                    {{--<label class="col-sm-2 col-form-label" for="guard_select">--}}
                        {{--{{_i('Role Guard')}} </label>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<select id="guard_select" class="form-control{{ $errors->has('guard_name') ? ' is-invalid' : '' }}" name="guard_name" required="" onchange="get_permissions();">--}}
                            {{--<option disabled selected> {{_i('Choose')}} </option>--}}
                            {{--<option value="{{$guard_admin}}" {{$role->guard_name == $guard_admin ? 'selected' : ''}} > {{_i('Admin')}} </option>--}}
                            {{--<option value="{{$guard_web}}" {{$role->guard_name == $guard_web ? 'selected' : ''}} > {{_i('Web')}} </option>--}}
                            {{--<option value="{{$guard_store}}" {{$role->guard_name == $guard_store ? 'selected' : ''}} > {{_i('Store')}} </option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}


                <div class="form-group row " >
                    <label class="col-sm-2">
                        {{_i('Permissions')}} </label>
                </div>
                <div class="form-group" {{-- style="margin-left: 3%;"--}}>
                    <div id="permissions" class="row">
                        @foreach($permissionNames as $permission)
                            @php
                                $permission_data = \Spatie\Permission\Models\Permission::
                                leftJoin('permission_data','permission_data.permission_id','permissions.id')
                                ->where('permission_data.permission_id', $permission->id)
                                ->where('permission_data.lang_id', getLang(session('MasterLang')))
                                ->first();
                            @endphp

                            <div class="col-sm-3">
                                <div class="checkbox-fade fade-in-primary">
                                    <label for="{{$permission->id}}">
                                        <input id="{{$permission->id}}" type="checkbox" name="permissions[]" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}  data-parsley-multiple="groups" required="">
                                        <span class="cr">
                                   <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                                        {{$permission_data['title']}}
{{--                                        {{$permission['name']}}--}}
                                    </label>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-primary "> {{_i('Save ')}}</button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
        </div>

    </div>

@endsection


@push('js')
    <script  type="text/javascript">

        $('#selected_lang').on('change', function(){
            $("#permissions").empty();
            var langId = $('#selected_lang').val();
            $.ajax({

                url: "{{url('/master/permission/')}}/"+langId+"",
                type: "get",
                success: function (result) {
                    var data = result;
                   // console.log(data.length);
                    var html = "";
                    for (var i = 0; i < data.length; i++)
                    {
                        html += '<div class="col-sm-3"> <div class="checkbox-fade fade-in-primary"><label>' +
                            '<input  id="check'+i+'" type="checkbox" name="permissions[]" value="'+ data[i].id +'"  data-parsley-multiple="groups"  required=""> ' +
                            '<span class="cr"> <i class="cr-icon icofont icofont-ui-check txt-primary"></i> </span> '+data[i].title +
                            '</label> </div> </div>';

                    }
                    $("#permissions").html(html);

                }
            });
        });

    </script>
@endpush