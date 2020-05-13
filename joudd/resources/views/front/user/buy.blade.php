@extends('front.layout.app')

@section('content')
    @push('css')
        <style>
            .center {
                text-align: center !important;
                margin: auto !important;
            }

            .user-page .profile-userpic img {
                float: none;
                margin: 0 auto;
                width: 50%;
                height: 50%;
                -webkit-border-radius: 50% !important;
                -moz-border-radius: 50% !important;
                border-radius: 50% !important;
            }

            .img-fluid {
                max-width: 100%;
                height: auto;
            }

            img {
                vertical-align: middle;
                border-style: none;
            }

            .user-page .profile-usertitle {
                text-align: center;
                margin-top: 20px;
            }

            .user-page .profile-usertitle-name {
                color: #5a7391;
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 7px;
            }
            .nav {
                display: flex;
                flex-wrap: wrap;
                padding-right: 0;
                margin-bottom: 0;
                list-style: none;
                margin-right:10px;
            }

            .nav ul {
                padding: 0;
                margin: 0;
                margin-block-start: 1em;
                margin-block-end: 1em;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
                padding-inline-start: 40px;


            }

            .user-page .profile-usermenu ul li.active {
                border-bottom: none;
            }

            .user-page .profile-usermenu ul li {
                border-bottom: 1px solid #f0f4f7;
                width: 100%;
            }
            *, *::before, *::after {
                box-sizing: border-box;
            }
            .user .agent .stylesheet. li {
                display: list-item;
                text-align: -webkit-match-parent;
                box-sizing: border-box;
            }
            .nav li a{
                color: #39B9D5;
                text-decoration: none;
            }
            .nav li{
                padding : 5px;
            }

            .item label{
                color: #5a7391;
                font-size: 15px;
                font-weight: 600;
            }


        </style>

    @endpush


    <nav aria-label="breadcrumb" class="welcome">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{ _i('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Buy')}}</li>
            </ol>
        </div>
    </nav>


    <div class="flash-message messageCustom">
        @foreach (['danger', 'warning', 'success', 'info' ] as $msg)
            @if(Session::has($msg))
                <br />
                <h6 class="alert alert-{{ $msg }} text-center" > <b>   {{ Session::get($msg) }} </b></h6>
            @endif
        @endforeach
        @if(Session::has('flash_message'))
            <br />
            <h6 class="alert alert-info text-center" > <b>   {{ Session::get('flash_message') }} </b></h6>
        @endif
    </div>



    <div class="user-page common-wrapper" >
        <div class="container">
            <div class="row profile ">

                <div class="col-md-4">
                    <div class="profile-sidebar border rounded shadow-sm" style=" padding: 10px;">

                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name" >
                                    <span style="font-weight: bold; font-size:20px;"> {{_i('Course Information')}} </span>
                                </div>
                            </div>


                        <div class="form-group col-xs-4 item">
                            <label for="name" class=" col-xs-2  control-label text-right"  style="margin-left: 200px;">{{$title}} </label>
                            <label for="name" class=" col-xs-2  control-label text-left"  >{{ $type .' '._i(' title') }} </label>
                        </div>

                        <div class="form-group col-xs-4 item">
                            <label for="name" class=" col-xs-2  control-label text-right"  style="margin-left: 200px;">{{round($price) ." ". $currency}} </label>
                            <label for="name" class=" col-xs-2  control-label text-left"  >{{_i(' Price') }} </label>
                        </div>


                        <div class="form-group col-xs-4 item">
                            <label for="name" class=" col-xs-2  control-label text-right" style="margin-left: 150px;"> {{$instructor["first_name"] ." ".$instructor["last_name"]}}</label>
                            <label for="name" class=" col-xs-2  control-label text-left"  >{{ _i('Instructor') }} </label>
                        </div>

                        <div class="form-group col-xs-4 item">
                            <label for="name" class=" col-xs-2  control-label text-right" style="margin-left: 200px;"> {{$course->start_date}}</label>
                            <label for="name" class=" col-xs-2  control-label text-left"   >{{ _i('Start') }} </label>
                        </div>

                        <div class="form-group col-xs-4 item">
                            <label for="name" class=" col-xs-2  control-label text-right" style="margin-left: 200px;"> {{$course->end_date}}</label>
                            <label for="name" class=" col-xs-2  control-label text-left"   >{{ _i('To') }} </label>
                        </div>



                    </div>


                </div>



                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <h5 class="card-header">{{_i('Payment')}} , {{$user->first_name .' '. $user->last_name}}</h5>
                        <div class="card-body">

                                <div class="row" style="border: 1px solid rgba(193,193,193,0.36); border-radius: 8px; padding: 20px; margin: 1.3rem !important; display: block;">

                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_offline"  data-toggle="tab" >
                                                    <button type="button" class="btn  btn-blue btn-lg " >{{_i('Offline')}}</button>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab_online"  data-toggle="tab" >
                                                    <button type="button" class="btn  btn-blue btn-lg " >{{_i('Online')}}</button>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <!--- ========================================  offline section   =========================================== ----->
                                        <div class="tab-pane active" id="tab_offline">
                                            <form class=""  action="{{url('/user/payment/offline')}}" method="post" data-parsley-validate=""   enctype="multipart/form-data">
                                            @csrf

                                                <input type="hidden" name="item_id" value="{{$data["item_id"]}}">
                                                <input type="hidden" name="item_type" value="{{$data["type"]}}">
                                                <input type="hidden" name="item_title" value="{{$data["title"]}}">
                                                <input type="hidden" name="item_currency" value="{{$data["currency"]}}">
                                                <input type="hidden" name="item_price" value="{{$data["price"]}}">
                                                <input type="hidden" name="item_net_price" value="{{$data["net_price"]}}">

                                            <!-- ============================================= bank ============================= -->
                                            <div class="form-group">
                                                <label for="name" class="col-xs-2 control-label"> {{_i('Bank')}} <span style="color: #ff3960;">*</span></label>

                                                <div class="col-xs-5">
                                                    <select class="form-control" name="bank_id" id="bank_id"  required="">
                                                        <option selected disabled>{{_i('Choose Bank')}}</option>
                                                        @foreach($banks as $bank)
                                                            <option value="{{$bank->id}}"  > {{$bank->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('bank_id'))
                                                    <strong style="color: #db1b4c;">{{ $errors->first('bank_id') }}</strong>
                                                @endif

                                            </div>

                                            <!-- ============================================= description ============================= -->
                                            <div class="form-group">

                                                <label for="name" class="col-xs-2 control-label"> {{_i('Description')}} </label>
                                                <div class="col-xs-8">
                                                <textarea id="bank_description" class="textarea form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="bank_description"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                          placeholder="{{_i('select Bank to show description')}}"></textarea>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-xs-2 control-label"> {{_i('Transaction')}} <span style="color: #ff3960;">*</span></label>

                                                <div class="col-xs-5">
                                                    <input type="text" class="form-control" name="transaction_no"  placeholder="{{_i('Transaction number')}}" value="{{old('transaction_no')}}"
                                                           required=""  data-parsley-maxlength="191">

                                                </div>
                                                @if ($errors->has('transaction_no'))
                                                    <strong style="color: #db1b4c;">{{ $errors->first('transaction_no') }}</strong>
                                                @endif
                                            </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info ">{{_i('Pay')}}</button>
                                                </div>
                                            </form>
                                        </div>

                                        <!--- ========================================  online section   =========================================== ----->
                                        <div class="tab-pane " id="tab_online">
                                            <form class=""  action="{{url('/user/payment/online')}}" method="post" data-parsley-validate=""   enctype="multipart/form-data">
                                                @csrf


                                                <input type="hidden" name="item_id" value="{{$data["item_id"]}}">
                                                <input type="hidden" name="item_type" value="{{$data["type"]}}">
                                                <input type="hidden" name="item_title" value="{{$data["title"]}}">
                                                <input type="hidden" name="item_currency" value="{{$data["currency"]}}">
                                                <input type="hidden" name="item_price" value="{{$data["price"]}}">
                                                <input type="hidden" name="item_net_price" value="{{$data["net_price"]}}">

                                            <div class="form-group">

                                                <div class="col-xs-5 center">

                                                    @foreach($transactions as $transaction)
                                                    <div class=" radio " >
                                                        <input class="form-check-input"  type="radio" name="transaction_type_id" id="optionsRadios{{$transaction->id}}" value="{{$transaction->id}}"
                                                               data-parsley-multiple="groups" required="">
                                                        <label class="form-check-label" for="optionsRadios{{$transaction->id}}"> {{$transaction->title}} </label>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                            <!-- ============================================= Card Holder Name ============================= -->
                                            <div class="form-group">
                                                <label for="name" class="col-xs-2 control-label">{{ _i('Card Holder Name') }}<span style="color: #ff3960;">*</span></label>

                                                <div class="col-xs-5">
                                                    <input type="text" class="form-control" name="holder_name"  placeholder="{{_i('Name of holder person')}}"
                                                           data-parsley-maxlength="191"  required="" value="{{old('holder_name')}}" >

                                                </div>
                                                @if ($errors->has('holder_name'))
                                                    <strong style="color: #db1b4c;">{{ $errors->first('holder_name') }}</strong>
                                                @endif
                                            </div>
                                            <!-- ============================================= Card Number  ============================= -->
                                            <div class="form-group">
                                                <label for="name" class="col-xs-2 control-label">{{ _i('Card Number') }}</label>

                                                <div class="col-xs-5">
                                                    <input type="number" class="form-control" name="holder_card_number"  placeholder="{{_i('Number of Holder Card')}}"
                                                           data-parsley-maxlength="191" value="{{old('holder_card_number')}}">

                                                </div>
                                            </div>

                                                <!-- ============================================= Card CVC  ============================= -->
                                            <div class="form-group">
                                                <label for="name" class="col-xs-2 control-label">{{ _i('CVC') }}</label>

                                                <div class="col-xs-5">
                                                    <input type="number" class="form-control" name="holder_cvc"  placeholder="{{_i('Number of Holder Card')}}"
                                                           data-parsley-maxlength="191" >

                                                </div>
                                            </div>

                                                <!-- ============================================= Expire  ============================= -->
                                            <div class="form-group">
                                                <label for="name" class="col-xs-2 control-label">{{ _i('Expire') }}</label>

                                                <div class="col-xs-5">
                                                    <input type="date" name="holder_expire" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="" >

                                                </div>
                                            </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-info ">{{_i('Pay')}}</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>


                                </div>



                        </div>
                    </div>

                </div>





            </div>
        </div>
    </div>


@endsection

@push('js')

    <script  type="text/javascript">

        $('#bank_id').click(function(){
            var bankID = $(this).val();
            console.log(bankID);
            if(bankID){
                $.ajax({
                    type:"GET",
                    url:"{{url('user/bank/details')}}?bank_id="+bankID,
                    dataType:'json',
                    success:function(res){
                        if(res){
                            //console.log(res);
                            $("#bank_description").val(res['description']);

                        }else{
                            $("#bank_description").empty();
                        }
                    }
                });
            }else{
                $("#bank_description").empty();
            }
        });

    </script>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
                $("div.messageCustom").remove();
            }, 5000 );

        });
    </script>
@endpush

