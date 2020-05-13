@extends('admin.layout.layout')

@section('title')
    {{_i('Show '.$course->title.' Comment')}}
@endsection

@section('box-title' , 'Show '.$course->title.' Comment')

@section('page_header')

    <section class="content-header">
        <h1>
            {{_i('Show '.$course->title.' Comment')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/course_comment/all')}}">{{_i('All Comments')}}</a></li>
            <li class="active"><a href="#">{{_i('Show Comment')}}</a></li>
        </ol>
    </section>

@endsection

@section('content')

    <div class="box box-info">

        <div class="box-body">
            <form  >

                <div class="box-body">
                    <div class="form-group row">
                    </div>

                    <!-----===================================== name ========================---->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="txtUser">
                            {{_i('Name ')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="name" id="txtUser" required="" class="form-control" value="{{$comment->name}}">
                            @if ($errors->has('name'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!-----===================================== email ========================---->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="email">
                            {{_i('E-Mail')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="email" id="email" required="" class="form-control" value="{{$comment->email}}">
                            @if ($errors->has('email'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!----==========================  course==========================--->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="country_id">
                            {{_i('Course')}} </label>
                        <div class="col-xs-6">
                            <input type="text" name="country_id" id="country_id" required="" class="form-control" value="{{$course->title}}">
                            @if ($errors->has('country_id'))
                                <span class="text-danger invalid-feedback">
                                <strong>{{ $errors->first('country_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <!----==========================  nationality==========================--->
                    <div class="form-group row" >

                        <label class="col-xs-2 col-form-label " for="message">
                            {{_i('Message')}} </label>
                        <div class="col-xs-6">
                            <textarea id="message"  class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" required="" >{{$comment->message}}</textarea>
                            @if($errors->has('message'))
                                <span class="text-danger invalid-feedback" role="alert">
                            <strong>{{ $errors->first('message') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                    <div class="pull-right">
                        <a href="{{url('/admin/course_comment/all')}}">
                            <button type="button" class="btn btn-default " >
                                {{_i('Back')}}
                            </button>
                        </a>
                        <a href="{{url('/admin/course_comment/'.$comment->id.'/approve')}}">
                            <button type="button" class="btn btn-info " >
                                {{_i('Approve')}}
                            </button>
                        </a>
                    </div>

                   <div class="pull-left">
                       <a href="{{url('/admin/course_comment/'.$comment->id.'/delete')}}">
                           <button type="button" class="btn btn-danger " >
                               {{_i('Delete')}} <i class="fa fa-trash"></i>
                           </button>
                       </a>
                   </div>

                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>




@endsection

