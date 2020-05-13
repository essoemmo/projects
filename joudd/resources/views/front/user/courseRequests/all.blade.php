@extends('front.layout.app')


@section('content')

    <!-- ==============================Add Model=============================================-->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{{_i('Add Course Request')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- ================================== Form =================================== -->
                    <form  class="form-horizontal" action="{{url('/user/courseRequest')}}" method="POST" class="form-horizontal"  id="form_1" data-parsley-validate="">
                        @csrf
                        <div class="box-body">
                            <!-- ================================== Title =================================== -->
                            <div class="form-group">

                                <label for="title" class="col-xs-3 control-label" >{{_i('Title')}}:</label>

                                <div class="col-xs-8">
                                    <input id="title" type="text" class="form-control" name="title"  placeholder="{{ _i('Title')}}"  required="">

                                    @if ($errors->has('title'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">

                                <label for="description" class="col-xs-3 control-label" >{{_i('Description')}}:</label>

                                <div class="col-xs-8">
                                    <textarea id="description" type="text" class="form-control" name="description"  placeholder="{{ _i('Description')}}"  required=""></textarea>

                                    @if ($errors->has('description'))
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
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
                </div>
            </div>
        </div>
    </div>
    <!-- ==============================end Add Model=============================================-->

    <!--edit & show Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form class="form-horizontal" action="" method="POST" class="form-horizontal"  id="form_2" data-parsley-validate="">
                    @csrf
                    <div class="box-body">
                        <!-- ================================== Title =================================== -->
                        <div class="form-group">
                            <label for="description" class="col-xs-3 control-label" >{{_i('Description')}}:</label>

                            <div class="col-xs-8">
                                <p id="description"></p>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="response" class="col-xs-3 control-label" >{{_i('Response')}}:</label>

                            <div class="col-xs-8">
                                <p id="response"></p>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ _i('Close')}}</button>
{{--                        <button type="submit" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End edit & show Modal -->
    <form action="" method="POST" class="remove-record-model">
        <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="custom-width-modalLabel">{{ _i('Delete') }}</h4>
                    </div>
                    <div class="modal-body">
                        <h4>{{ _i('are you sure to delete this one?') }}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{ _i('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">{{ _i('Delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- delete Modal -->


    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Courses Requests')}}</li>
            </ol>
        </div>
    </nav>

    <div class="blog common-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default">
                        <i class="fa fa-fw fa-plus-square"></i>
                        {{_i('Add New')}}
                    </button>

                    @if(count($courseRequest) >0 )
                        <table id="courseRequest" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th > {{_i('ID')}}</th>
                                <th > {{_i('Title')}}</th>
                                <th > {{_i('Created')}}</th>
                                <th > {{_i('Controll')}}</th>
                            </tr>
                            </thead>

                                @foreach($courseRequest as $item)
                                <tbody>

                                <tr>
                                    <th class="font-weight-normal" scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-icon waves-effect waves-light btn-success showEdit" data-toggle="modal" data-target="#exampleModalCenter">
                                            <i class="fa fa-eye"></i> {{ _i('Show') }}
                                            <input type="hidden" name="request_id" class="item_id" value="{{$item->id}}" id="{{$item->id}}" >
                                        </button>
                                        <a style="color: #fff;" class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('courseRequest.destroy', $item->id) }}" data-id="{{$item->id}}" data-target="#custom-width-modal">
                                            <i class="fa fa-trash"></i>
                                            {{ _i('Delete') }}
                                        </a>
                                    </td>
                                </tr>

                                </tbody>
                                @endforeach

                        </table>

                    @else
                        <div class="text-center alert-danger alert">
                            {{ _i('No Courses Requests') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
        <!-- /.box-body -->

@endsection

@push('js')

    <script>
        $(function () {
            'use strict';
            $('.showEdit').click(function () {
                var item_id = $(this).children('.item_id').val();
                console.log(item_id);
                $.ajax({
                    url:'{{ route('courseRequestShow') }}',
                    DataType:'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'get',
                    data: {item_id: item_id},
                    success:function (res) {
                        // console.log(res.title);
                        $('#exampleModalCenter').find('#form_2').attr('action','/user/courseRequest/' + res.id + '/update');
                        $('#exampleModalCenter').find('#exampleModalLongTitle').text(res.title);
                        $('#exampleModalCenter').find('#description').text(res.description);
                        if(res.response == null) {
                            $('#exampleModalCenter').find('#response').text('{{ _i('We Are Reviewing Your Request') }}');
                        } else {
                            $('#exampleModalCenter').find('#response').text(res.response)
                        }
                    }
                })
            });
        })
    </script>

    <script>
        $(document).ready(function(){
            // For A Delete Record Popup
            $('.remove-record').click(function() {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = '{{csrf_token()}}';
                $(".remove-record-model").attr("action",url);
                $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
                $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
                $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
            });
            $('.remove-data-from-delete-form').click(function() {
                $('body').find('.remove-record-model').find( "input" ).remove();
            });
            $('.modal').click(function() {
                // $('body').find('.remove-record-model').find( "input" ).remove();
            });
        });
    </script>

@endpush
