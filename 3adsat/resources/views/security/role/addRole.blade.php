@extends('admin.layout.index',[
'title' => _i('Add Role'),
'activePageName' => _i('Add Role'),
'additionalPageUrl' => url('/admin/panel/role/all') ,
'additionalPageName' => _i('All'),
] )

@section('content')

    <form  action="{{url('/admin/panel/role/add')}}" method="post" class="form-horizontal"  id="demo-form" data-parsley-validate="">
        @csrf

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/admin/panel/role/all')}}" class="btn btn-default">{{ _i('All Roles') }}</a></li>
                            <li class="breadcrumb-item active">
                                <a >
                                    <button type="submit" class="btn btn-primary"> <i class="ti-save"></i>
                                        {{ _i('Save') }}
                                    </button>
                                </a>
                            </li>
                        </ol>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="row">
            <div class="col-sm-12">

                <div class="card card-info">
                    <div class="card-header">
                        <h5 >{{ _i('Add Role') }}</h5>
                        <div class="card-header-right">
                            <i class="icofont icofont-rounded-down"></i>
                            <i class="icofont icofont-refresh"></i>
                            <i class="icofont icofont-close-circled"></i>
                        </div>

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body card-block">
                        <div class="form-group row" >

                            <label class="col-sm-2 control-label" for="txtUser">
                                {{_i('Role Name')}} </label>
                            <div class="col-sm-5">
                                <input type="text" name="name" id="txtUser" required="" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="text-danger invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                    <!--- ===================== permissions ==========================--->
                        <div class="form-group row ">
                            <label class="col-sm-2 control-label">
                                {{_i('Permissions')}} </label>
                        </div>
                        <div class="form-group row" >

                            @foreach($permissionNames as $permission)

                                <div class="col-sm-4 ">

                                    <div class="checkbox-fade fade-in-primary"  style="padding: 10px;  margin-right:10px; !important;" >
                                        <label for="{{$permission->id}}">
                                            <input type="checkbox" id="{{$permission->id}}"  name="groups[]" value="{{$permission->id}}" data-parsley-multiple="groups">
                                            <span class="cr">
                                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>

                                                </span>
                                            {{$permission->name}}
                                        </label>
                                    </div>

                                </div>

                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>

@endsection

