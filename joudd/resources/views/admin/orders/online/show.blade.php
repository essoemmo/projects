@extends('admin.layout.layout')

@section('title')
    {{_i('Show Offline Order')}}
@endsection

@section('box-title' )
    {{_i('Show Online Order')}}
@endsection

@section('page_header')
    <section class="content-header">
        <h1>
            {{_i('Show Online Order')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> {{_i('Home')}}</a></li>
            <li ><a href="{{url('/admin/orders/online/all')}}">{{_i('All')}}</a></li>
        </ol>
    </section>
@endsection

@section('content')
<div class="box box-info">


    <div class="row" style="padding:20px;">
        <!--------======================= user info -----===============================----->
        <div class="col-xs-5" style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px; margin: 1.3rem !important; display: block;">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class="fa fa-fw fa-book"></i>{{_i('Applicant Info')}}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('First Name')}}</label>
                        <p class="form-control-static col-xs-8">{{$user["first_name"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Last Name')}}</label>
                        <p class="form-control-static col-xs-8">{{$user["last_name"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Email')}}</label>
                        <p class="form-control-static col-xs-8">{{$user["email"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Mobile')}}</label>
                        <p class="form-control-static col-xs-8">{{$user["mobile"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Is Active')}}</label>
                        <p class="form-control-static col-xs-8">{{($user["is_active"]==1)?'نشط':'غير نشط'}}</p>
                    </div>


                </div>
        </div>

        <!--------======================= transaction info -----===============================----->
        <div class="col-xs-6" style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px; margin: 1.3rem !important; display: block;">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class="fa fa-fw fa-book"></i>{{_i('Transaction Info')}}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Transaction Name')}}</label>
                        <p class="form-control-static col-xs-8">{{$transaction_type["title"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Transaction No')}}</label>
                        <p class="form-control-static col-xs-5">{{$transaction["transaction_no"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Total')}}</label>
                        <p class="form-control-static col-xs-8">{{$transaction["total"]}} {{$currency["title"]}}</p>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Status')}}</label>
                        <p class="form-control-static col-xs-8">
                            @if($transaction["status"] == "pending")
                                {{_i('Pending')}}
                            @elseif($transaction["status"] == "paid")
                                {{_i('Paid')}}
                            @else
                                {{_i('Refused')}}
                            @endif
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Holder Name')}}</label>
                        <p class="form-control-static col-xs-8">{{$transaction["holder_name"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Holder Card Number')}}</label>
                        <p class="form-control-static col-xs-8">{{$transaction["holder_card_number"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Holder CVC')}}</label>
                        <p class="form-control-static col-xs-8">{{$transaction["holder_cvc"]}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Holder Expire Date')}}</label>
                        <p class="form-control-static col-xs-8">{{date('d-m-Y', strtotime($transaction["holder_expire"]))}}</p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{_i('Transaction Time')}}</label>
                        <p class="form-control-static col-xs-8">{{$transaction["created_at"]}}</p>
                    </div>
                </div>
        </div>

        <!--------======================= courses info -----===============================----->
{{--        <div class="clearfix"></div>--}}
        <div class="col-xs-5" style="margin-top:-100px; margin-right: 10px; !important; border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 10px;  display: block;">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class="fa fa-fw fa-book"></i>{{$order_course["type"] . _i(' Info')}}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{$order_course["type"]  . _i(' Name')}}</label>
                        <p class="form-control-static col-xs-8">
                            @if($order_course["type"] == "course")
                                {{course_details($order_course["course_id"])->title}}
                            @else
                                {{media_details($order_course["course_id"])->title}}
                            @endif

                        </p>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-4">{{$order_course["type"]  . _i(' Price')}}</label>
                        <p class="form-control-static col-xs-8">{{$order_course["price"]}}  {{\App\Models\Currency::where('id' , $order_course["currency_id"])->first()->title}}</p>
                    </div>

                    @if($order_course["type"] == "course")
                        <div class="form-group">
                            <label class="control-label col-xs-4">{{_i('Teacher')}}</label>
                            <input type="hidden" value="{{$user_id = course_details($order_course["course_id"])["user_id"]}}">
                            <?php $user = \App\User::where('id' ,$user_id)->first() ;?>
                            <p class="form-control-static col-xs-8">{{$user["first_name"] . " ". $user["last_name"] }}</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4">{{_i('Start Date')}}</label>
                            <p class="form-control-static col-xs-8">{{course_details($order_course["course_id"])->start_date}}</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4">{{_i('End Date')}}</label>
                            <p class="form-control-static col-xs-8">{{course_details($order_course["course_id"])->end_date}}</p>
                        </div>
                    @endif

                    @if($order_course["type"] == "media")
                        <div class="form-group">
                            <label class="control-label col-xs-4">{{_i('Teacher')}}</label>
                            <?php $media_id = $order_course["course_id"]; ?>
                            <?php $course_id = media($media_id)["course_id"] ; ?>
                            <input type="hidden" value="{{$user_id = course_details($course_id)["user_id"]}}">
                            <?php $user = \App\User::where('id' ,$user_id)->first() ;?>
                            <p class="form-control-static col-xs-8">{{$user["first_name"] . " ". $user["last_name"] }}</p>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-4">{{_i('Course Start Date')}}</label>
                            <p class="form-control-static col-xs-8">{{course_details($course_id)["start_date"]}}  </p>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4">{{_i('Course End Date')}}</label>
                            <p class="form-control-static col-xs-8">{{course_details($course_id)["end_date"]}}  </p>
                        </div>

                    @endif


                </div>

        </div>


    </div>

    <div class="box-footer">
        <a href="{{url('admin/orders/online/all')}}">
            <button type="button" class="btn btn-default "> <i class="fa fas fa-arrow-right"></i> {{ _i('Back') }}</button>
        </a>


{{--        <a class="btn btn-danger waves-effect waves-light remove-record" title="{{_i('Delete')}}" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('order.destroy', $transaction["id"]) }}" data-id="{{$transaction["id"]}}" data-target="#custom-width-modal">--}}
{{--            <i class="fa fa-trash"></i>  {{_i('Delete')}} </a>--}}

    </div>

</div>



<form action="" method="POST" class="remove-record-model">
    <input type="hidden" value="online" name="type" >
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i('delete')}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i('are you sure to delete this one ?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i('cancel')}}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{_i('delete')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>

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

