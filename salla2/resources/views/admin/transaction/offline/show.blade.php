@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Show Offline Order')}}
@endsection

@section('page_header_name')
    {{_i('Show Offline Order')}}
@endsection


@section('content')

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-border-primary">
                    <div class="card-header">
                        <h5>{{_i('Transaction Info')}} </h5>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Bank Name')}}</label>
                                    <label class=" col-lg-7">{{$bank["title"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Transaction No')}}</label>
                                    <label class=" col-lg-7">{{$transaction["bank_transactions_num"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Total')}}</label>
                                    <label class=" col-lg-7">{{$transaction["total"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Transaction Time')}}</label>
                                    <label class=" col-lg-7">{{$transaction["created_at"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Image')}}</label>
                                    <img style="width: 50px"  src="{{asset($transaction['image'])}}" alt="{{_i('transaction image')}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="task-list-table">
                            <p class="task-due"><strong> {{_i('Status :')}} </strong>
                                @if($transaction["status"] == "pending")
                                    <strong class="label label-warning">{{_i('Pending')}}</strong>
                                @elseif($transaction["status"] == "paid")
                                    <strong class="label label-success">{{_i('Paid')}}</strong>
                                @else
                                    <strong class="label label-danger">{{_i('Refused')}}</strong>
                                @endif
                            </p>
                        </div>
                        <div class="task-board m-2">
                            <a href="{{url('adminpanel/orders/offline/'.$transaction->id.'/accept')}}" class="btn btn-success btn-sm "><i class="icofont icofont-checked m-2"></i>{{_i('Accept')}}</a>
                            <a href="{{url('adminpanel/orders/offline/'.$transaction->id.'/refused')}}" class="btn btn-danger btn-sm "><i class="icofont icofont-close-squared-alt m-2"></i>{{_i('Refused')}}</a>

                        </div>
                        <!-- end of pull-right class -->
                    </div>
                    <!-- end of card-footer -->
                </div>
            </div>
<!----------------------------------------------------------------------->
            <div class="col-lg-6">
                <!-- Invoice list card start -->
                <div class="card card-border-primary">
                    <div class="card-header">
                        <h5>{{_i('User Info')}}</h5>

                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('First Name')}}</label>
                                    <label class=" col-lg-7">{{$user["name"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Last Name')}}</label>
                                    <label class=" col-lg-7">{{$user["lastname"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Email')}}</label>
                                    <label class=" col-lg-7">{{$user["email"]}}</label>
                                </div>
                                <div class="form-group">
                                    <label class=" col-lg-4">{{_i('Phone')}}</label>
                                    <label class=" col-lg-7">{{$user["phone"]}}</label>
                                </div>

                                <div class="form-group">
                                    <label class=" col-lg-4"><strong> {{_i('Order NO')}} </strong></label>
                                    <label class=" col-lg-7"><a href="{{url('adminpanel/orders/'.$transaction["order_id"].'/edit')}}">{{$transaction["order_id"]}}</a></label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="task-list-table">
                            <p class="task-due"><strong> {{_i('Status')}} :  </strong> <strong class="label label-warning">{{($user["is_active"]==1)? _i('Active'): _i('Not Active')}}</strong></p>
                        </div>
                        <div class="task-board m-0">
                            <a href="{{url('adminpanel/user/'.$user['id'].'/edit')}}" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-1"></i></a>
                        </div>
                        <!-- end of pull-right class -->
                    </div>
                    <!-- end of card-footer -->
                </div>
                <!-- Invoice list card end -->
            </div>
<!----------------------------------------------------------------------->



        </div>
    </div>

@endsection