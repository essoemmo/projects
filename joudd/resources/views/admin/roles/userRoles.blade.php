
@extends('admin.layout.layout')

@section('title' , 'Roles')

@section('content')


        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add Role</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{url('/admin/role/create')}}" method="post" >

                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-xs-2 control-label">Role Name : </label>

                        <div class="col-xs-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Role Name" name="name" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus style="max-width: 50%;">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <button type="submit" class="btn btn-info pull-leftt" style="margin-left: 100px;">Add Role</button>
                </div>
                <!-- /.box-footer -->


            </form>



            <div class="box-header with-border" style="padding: 30px 0px 0px 10px;">
                <h3 class="box-title">All Roles</h3>
            </div>

            <div class="form-group" style="padding: 0px 0px 20px 10px;">




                @foreach($user as $userRole)

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" disabled>
                                {{$userRole}}
                        </label>
                    </div>

                @endforeach


            </div>



        </div>








@endsection