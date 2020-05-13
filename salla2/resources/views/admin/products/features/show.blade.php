@extends('admin.layout.layout')

@section('title')
    {{_i('Show Product Feature')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Show Product Feature')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/features/all')}}">{{_i('All')}}</a></li>
@endsection



@section('content')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has($msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
            @endif
        @endforeach
    </div>


    <form action="" method="POST" class="remove-record-model">
        <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width:55%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="custom-width-modalLabel">{{_i('delete')}}</h4>
                    </div>
                    <div class="modal-body">
                        <h4>{{_i('are you sure to delete this one?')}}</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">cancel</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="box box-info">
        <div class="box-header with-border" >
        </div>
        <!-- /.box-header -->

        <form method="POST" action="" class="form-horizontal"  data-parsley-validate="">
            @csrf

            <div class="box-body">

                <!-- ================ product================ --->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-plus-square"></i> {{_i('Product Details')}}</h3>
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width: 1%;"><button data-toggle="tooltip" title="Store" class="btn btn-info btn-xs"><i class="fa fa-plus-square fa-fw"></i></button></td>
                                <td style="width: 25%;">{{_i('Product Name')}}</td>
                                <td><a href="{{url('adminpanel/product/'.$product->id.'/show')}}" target="_blank">{{$product->title}}</a></td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Date Added" class="btn btn-info btn-xs"><i class="fa fa-dollar fa-fw"></i></button></td>
                                <td>{{_i('Price')}}</td>
                                <td>{{$product->price}}</td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Payment Method" class="btn btn-info btn-xs"><i class="fa fa-dollar fa-fw"></i></button></td>
                                <td> {{_i('Discount')}} </td>
                                <td> {{$product->discount}} <span style="color: #3c8dbc">%</span> </td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-info btn-xs"><i class="fa fa-balance-scale fa-fw"></i></button></td>
                                <td>{{_i('Weight')}}</td>
                                <td>{{$product->weight}}</td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-info btn-xs"><i class="fa  fa-circle-o fa-fw"></i></button></td>
                                <td>{{_i('Net')}}</td>
                                <td>{{$product->net}}</td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-info btn-xs"><i class="fa fa-circle-o fa-fw"></i></button></td>
                                <td>{{_i('Max Count')}}</td>
                                <td>{{$product->max_count}}</td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Shipping Method" class="btn btn-info btn-xs"><i class="fa fa-circle-o fa-fw"></i></button></td>
                                <td>{{_i('SKU')}}</td>
                                <td>{{$product->sku}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ================ feature ================ --->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa  fa-plus-square"></i> {{_i('Feature Details')}}</h3>
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width: 1%;"><button data-toggle="tooltip" title="Store" class="btn btn-info btn-xs"><i class="fa fa-plus-square fa-fw"></i></button></td>
                                <td style="width: 25%;">{{_i('Feature Name')}}</td>
                                <td><a href="https://demo.opencart.com/" target="_blank">{{$feature->title}}</a></td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Date Added" class="btn btn-info btn-xs"><i class="fa fa-calendar fa-fw"></i></button></td>
                                <td>{{_i('Create Time')}}</td>
                                <td>{{date("Y M d ", strtotime($feature->created_at))}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ================ feature options ================ --->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa  fa-plus-square"></i> {{_i('Feature Options')}}</h3>
                        </div>
                        <table class="table">

                            <tbody>
                            <tr>
                                <th style="width: 60%;padding-left: 230px;">{{_i('Option Name')}}</th>
                                <th style="padding-left: 30px;">{{_i('Price')}}</th>
                                <th style="padding-left: 30px;">{{_i('Count')}}</th>
                            </tr>

                            @foreach($feature_options as $option)
                                <tr>
                                    <td style="width: 70%;"> {{$option->title}}</td>
                                    <td >{{$option->price}}</td>
                                    <td>{{$option->count}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ================ store ================ --->
                <div class="col-md-6 pull-left">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa  fa-plus-square"></i> {{_i('Store Details')}}</h3>
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width: 1%;"><button data-toggle="tooltip" title="Store" class="btn btn-info btn-xs"><i class="fa fa-user fa-fw"></i></button></td>
                                <td style="width: 25%;">{{_i('Feature Name')}}</td>
                                <td>{{$store->name}}</td>
                            </tr>
                            <tr>
                                <td><button data-toggle="tooltip" title="Date Added" class="btn btn-info btn-xs"><i class="fa fa-envelope fa-fw"></i></button></td>
                                <td>{{_i('Email')}}</td>
                                <td>{{$store->email}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('/adminpanel/features/all')}}">
                    <button type="button" class="btn btn-default"> <i class="fa fa-arrow-right"></i>{{ _i('Back') }}</button>
                </a>
                {{--                <button type="submit" class="btn btn-danger "><i class="fa fa-trash"></i> {{ _i('Delete') }}</button>--}}

                <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('feature.delete', $product_feature->id) }}" data-id="{{$product_feature->id}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i> delete</a>

            </div>
            <!-- /.box-footer -->

        </form>

    </div>


@endsection

@section('footer')
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
@endsection
