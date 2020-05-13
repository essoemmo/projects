{{--@dd('asd')--}}
@extends('admin.layout.layout')

@section('title')
    {{_i('Show Product')}}
@endsection

@section('header')

@endsection

@section('page_header_name')
    {{_i('Show Product')}}
@endsection

@section('page_url')
    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
    <li ><a href="{{url('/adminpanel/product/all')}}">{{_i('All')}}</a></li>
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
                        <h4 class="modal-title" id="custom-width-modalLabel">delete</h4>
                    </div>
                    <div class="modal-body">
                        <h4>are you sure to delete this one?</h4>
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

                <!----------------------------------  store  --------------------------------------------->
                <div class="form-group row ">
                    <label for="user_id" class="col-xs-2 control-label">{{ _i('Store Name') }}</label>
                    <label>{{$store->name}}</label>
                </div>
                <!----------------------------------  category  --------------------------------------------->
                <div class="form-group row ">
                    <label for="user_id" class="col-xs-2 control-label">{{ _i('Category Name') }}</label>
                    <label>{{$category->title}}</label>
                </div>
                <!----------------------------------  product type  --------------------------------------------->
                <div class="form-group row ">
                    <label for="user_id" class="col-xs-2 control-label">{{ _i('Product Type') }}</label>
                    <label>{{$product_type->title}}</label>
                </div>
                <!----------------------------------  price   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Price')}} </label>
                    <label>{{$product->price}}</label>
                </div>
                <!----------------------------------  serial number   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Serial Number')}} </label>
                    <label>{{$product->sku}}</label>
                </div>
                <!----------------------------------  weight   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Weight')}} </label>
                    <label>{{$product->weight}}</label>
                </div>
                <!----------------------------------  max count   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Max Count')}} </label>
                    <label>{{$product->max_count}}</label>
                </div>
                <!----------------------------------  stock   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Stock')}} </label>
                    <label>{{$product->stock}}</label>
                </div>
                <!----------------------------------  discount   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Discount')}} </label>
                    <label>{{$product->discount}}</label>
                </div>
                <!----------------------------------  net   ---------------------------------->
                <div class="form-group row">
                    <label for="cost" class="col-xs-2 control-label">{{_i('Net')}} </label>
                    <label>{{$product->net}}</label>
                </div>

                <!----------------------------------  created ---------------------------------- -->
                <div class="form-group row {{ $errors->has('created') ? ' has-error' : '' }}">
                    <label for="created" class="col-xs-2 control-label">{{_i('Create Date')}}</label>
                    <label>{{date("Y M d ", strtotime($product->created_at))}}</label>

                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('/adminpanel/product/all')}}">
                    <button type="button" class="btn btn-default"> <i class="fa fa-arrow-right"></i>{{ _i('Back') }}</button>
                </a>
{{--                <button type="submit" class="btn btn-danger "><i class="fa fa-trash"></i> {{ _i('Delete') }}</button>--}}

                <a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('product.destroy', $product->id) }}" data-id="{{$product->id}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i> delete</a>

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
