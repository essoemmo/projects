<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<div class="container">

    <div>

        <div class="card">
            <div class="row invoice-contact">
                <div class="col-md-8">
                    <div class="invoice-box row">
                        <div class="col-sm-12">
                            <table class="table table-responsive invoice-table table-borderless">
                                <tbody>
    {{--                                <tr>--}}
    {{--                                    <td><img src="assets/images/logo-blue.png" class="m-b-10" alt=""></td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>Phoenixcoded</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>208, Paris Point, Varachha Road, Surat. (1234) - 567891</td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td><a href="mailto:demo@gmail.com" target="_top">demo@gmail.com</a>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                                <tr>--}}
    {{--                                    <td>+91 919-91-91-919</td>--}}
    {{--                                </tr>--}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row invoive-info">
                    <div class="col-md-4 col-xs-12 invoice-client-info">
                        <h6>Client Information :</h6>
                        <h6 class="m-0">{{ $data['user']->first_name }} {{ $data['user']->last_name }}</h6>
                        <p class="m-0">{{ $data['user']->mobile }}</p>
                        <p>{{ $data['user']->email }}</p>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h6>Order Information :</h6>
                        <table class="table table-responsive invoice-table invoice-order table-borderless">
                            <tbody>
                            <tr>
                                <th>Date :</th>
                                <td>{{ $data['order']->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Status :</th>
                                <td>
                                    <span class="label label-warning">{{ $data['order']->status }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Id :</th>
                                <td>
                                    #{{ $data['order']->orderNumber }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h6 class="text-uppercase text-primary">Total Due :
                            <span>{{ $data['order']->total }}</span>
                        </h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table  invoice-detail-table">
                                <thead>
                                <tr class="thead-default">
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($data['orderItems'] as $item)
                                        <td>
                                            <h6>{{ $item->product->translate(app()->getLocale())->title }}</h6>
                                            @if(count(codes($item->product->id,$item->count)) != 0)
                                                @foreach(codes($item->product->id,$item->count) as $code)
                                                    <p>{{ $code->code }}</p>
                                                @endforeach
                                            @else
                                                <p>{{ codes($item->product->id,$item->count)->code }}</p>
                                            @endif

                                        </td>
                                        <td>{{ $item->count }}</td>
                                        <td>{{ round($item->price * getRate(country_code())->rate) }}</td>
                                        <td>{{ $item->count * round($item->price * getRate(country_code())->rate) }}</td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive invoice-table invoice-total">
                            <tbody>
                            <tr class="text-info">
                                <td>
                                    <hr>
                                    <h5 class="text-primary">Total :</h5>
                                </td>
                                <td>
                                    <hr>
                                    <h5 class="text-primary">{{ $data['order']->total }}</h5>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <h6>Terms And Condition :</h6>--}}
{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

    </div>
</div>
</body>

</html>
