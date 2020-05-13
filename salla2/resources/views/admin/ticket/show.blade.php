@extends('admin.AdminLayout.index')

@section('title')
    show {{$ticket->subject}}
@endsection

@section('page_header_name')
    show {{$ticket->subject}}
@endsection


@section('content')
    @push('js')
        <script>
            $(function () {
                'use strict'
                $('.mark').on('click',function () {
                    var mark = '{{$ticket->status != '1' ? '1' : '3'}}';
                    var ticket = '{{$ticket->id}}';
                    if (this){
                        $.ajax({
                            url:'{{url('/')}}/adminpanel/ticket/completed/complate',
                            dataType:'html',
                            type:'get',
                            data:{mark: mark,ticket: ticket},
                            success:function (data) {
                                if (data == 1){
                                    window.location.href = "{{url('/adminpanel/ticket/completed/index')}}";
                                }else{
                                    window.location.href = "{{url('/adminpanel/ticket')}}";
                                }
                            }
                        })
                    }
                });
            });
        </script>
    @endpush
    @push('css')
        <style>
            .heading-title{
                padding: 20px;
            }
            .header{
                padding: 20px;
            }
            .header li {
                margin-bottom: 5px;
            }
            .text{
                padding: 10px 20px;
                font-size: 16px;
            }
            .text p{
                line-height: 1.4;
            }
            .reply .content{
                resize: none;
            }
        </style>
    @endpush
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>show {{$ticket->subject}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">show {{$ticket->subject}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
    @include('admin.AdminLayout.message')
            <div class="panel panel-default">
                <div class="heading-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 style="margin-top:5px">{{$ticket->subject}}</h4>
                        </div>
                        <div class="col-md-6" style="text-align: left">
                            <ul class="list-inline">
                                <li><a href="#" class="btn btn-success mark">@if($ticket->status != '1')  Mark Complate @else Reopene ticket @endif</a></li>
                                <li><a href="{{route('ticket.edit',$ticket->id)}}" class="btn btn-primary">Edit</a></li>
                                <li><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <div class="header">
                        <div class="panel well well-sm">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>{{$ticket->admin->name}}<strong> : Responsible</strong></li>
                                            <li>{{$ticket->category->name}}<strong> : Category</strong></li>
                                            <li>{{$ticket->created_at->diffForHumans() }}<strong> : created</strong></li>
                                            <li>{{$ticket->updated_at->diffForHumans() }}<strong> : Last Update</strong></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li>{{$ticket->user->name}}<strong> : Owner</strong></li>
                                            <li>{{($ticket->status == 1) ? 'compalete' : (($ticket->status == 2) ? 'pending' : 'bugs') }}<strong> : Status</strong></li>
                                            <li>{{$ticket->priority->name}}<strong> : Status</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="text">
                    <p>
                        {{$ticket->content}}
                    </p>
                </div>
            </div>
            @if(count($comments) > 0)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="comments">
                        <h3>comments</h3>
                        @foreach($comments as $comment)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    @if($comment->res_comment == 2)
                                    {{$comment->user->name}}
                                    @elseif($comment->res_comment == 1)
                                    {{$comment->admin->name}}
                                    @endif
                                </h3>
                            </div>
                            <div class="panel panel-body">
                                {{$comment->content}}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            {!! Form::open(['route'=>'comments.store','class'=>'form-group reply']) !!}
            <div class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <legend>
                            Replay
                        </legend>
                    </fieldset>
                    <div class="form-group">
                        {{Form::hidden('ticket',$ticket->id)}}
                        {{Form::textarea('msgcontent',null,['class'=>'form-control content'])}}
                    </div>
                </div>
            </div>
            {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{$ticket->subject}}</h4>
                </div>
                <div class="modal-body">
                    <p>are you sure to delete this ticket ?!</p>

                </div>
                <div class="modal-footer">
                    <div class="col-md-6 text-left">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-6 text-right">
                        {{Form::open(['method'=>'DELETE','route'=>['ticket.destroy',$ticket->id]])}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                        {{Form::close()}}
                    </div>

                </div>
            </div>
            </div>

        </div>
    </div>


@endsection