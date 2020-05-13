@extends('front.layout.index')

@section('content')

    <div class="payment-methods">
        <div class="container">
            <div class="wrapper">
            @include('admin.layout.message')
                <div class="section-title">{{ _i('Payment Methods') }}</div>

                <div class="bill-total text-center">
                    <h6>{{ _i('Total') }}</h6>
                    <span class="bg-gray d-inline-block">{{ round(\Cart::getTotal() * getRate(country_code())->rate) }} {{ currency()->code }}</span>
                </div>
                <hr>
                <h6 class="text-white text-center my-4">{{ _i('Choose a payment method') }}</h6>
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="bank-tab" data-toggle="tab" href="#bank" role="tab"
                           aria-controls="bank" aria-selected="true">{{ _i('By The Bank') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="COD-tab" data-toggle="tab" href="#COD" role="tab"
                           aria-controls="COD" aria-selected="false">{{ _i('Electronic Payment') }}</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                        @if(count($banks) > 0)
                            <div class="pay-options text-center">
                            <ul class="list-inline d-flex justify-content-center my-4">
                                @foreach($banks as $bank)
                                <li class="list-inline-item">
                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample_{{ $bank->id }}" role="button" aria-expanded="false" aria-controls="collapseExample_{{ $bank->id }}">
                                        <img src="{{ asset($bank->image) }}" alt="{{ $bank->title }}" class="img-fluid get_id">
                                        <input type="hidden" class="bank_id" value="{{ $bank->id }}">
                                    </a></li>
                                @endforeach
                            </ul>

                            <div class="options-content">
                                @foreach($banks as $bank)
                                    <div class="collapse" id="collapseExample_{{ $bank->id }}">
                                        <span style="color: #fff"> {{ _i('Bank Number') }} : {{ $bank->code }}</span>
                                        <div class="card card-body">
                                            <form action="{{ route('saveOrder') }}" method="POST" id="saveOrder_{{ $bank->id }}" class="row" enctype="multipart/form-data" data-parsley-validate>
                                                @csrf
                                                <div>
                                                    <input type="hidden" name="user" value="{{ auth()->user()->id }}">

                                                    <input type="hidden" name="orderNumber" value="{{ $number }}">

                                                    <input type="hidden" name="bank_id" class="bank_id" value="{{ $bank->id }}">

                                                    <input type="hidden" name="currency" value="{{ currency()->code }}">

                                                    <input type="hidden" name="payment_type" value="bank">

                                                    @foreach(\Cart::getContent() as $item)
                                                        <input type="hidden" name="product[]" value="{{ $item->id }}">
                                                        <input type="hidden" name="count_{{ $item->id }}" value="{{ $item->quantity }}">
                                                        <input type="hidden" name="price_{{ $item->id }}" value="{{ round($item->price * getRate(country_code())->rate) }}">
                                                        <input class="total_after" type="hidden" name="total" value="{{ round(\Cart::getTotal() * getRate(country_code())->rate) }}">
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="col-xs-10">
                                                        <input type="text" class="form-control" name="holder_name_{{ $bank->id }}" id="holder_name"
                                                               value="{{old('holder_name')}}" placeholder="{{ _i('Holder name') }}" required="">
                                                        <span class="text-danger">
                                                            <strong>{{$errors->first('holder_name')}}</strong>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="col-xs-10">
                                                        <input type="text" class="form-control" name="bank_transactions_num_{{ $bank->id }}" id="bank_transactions_num"
                                                               value="{{old('bank_transactions_num')}}" placeholder="{{ _i('Bank Transactions number') }}" required="">
                                                        <span class="text-danger">
                                                            <strong>{{$errors->first('bank_transactions_num')}}</strong>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="col-xs-10">
                                                        <input type="file" class="form-control form-control-round" onchange="showImg(this)" name="image_{{ $bank->id }}">
                                                        <span class="text-danger">
                                                            <strong>{{$errors->first('image')}}</strong>
                                                        </span>
                                                        <img class="img-responsive pad" id="article_img_{{ $bank->id }}">
                                                    </div>
                                                </div>
                                            </form>

                                                <div class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-yellow pay py-2">{{ _i('Pay') }}</a>
                                                </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        @else
                            <div class="alert alert-danger">
                                {{ _i('No Banks') }}
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="COD" role="tabpanel" aria-labelledby="COD-tab">

{{--                            <div class="alert alert-danger">--}}
{{--                                {{ _i('No Online Payment') }}--}}
{{--                            </div>--}}

                        @if($online != null)

                            <div class="pay-options text-center">
                                <ul class="list-inline d-flex justify-content-center my-4">
                                    <li class="list-inline-item">
    {{--                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample_mada" role="button" aria-expanded="false" aria-controls="collapseExample_mada">--}}
    {{--                                        <img src="{{ asset('front/images/mada.png') }}" alt="" class="img-fluid get_id">--}}
    {{--                                    </a>--}}
                                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample_visa" role="button" aria-expanded="false" aria-controls="collapseExample_visa">
                                            <img src="{{ asset('front/images/visa.png') }}" alt="" class="img-fluid get_id">
                                        </a>
                                    </li>
                                </ul>

                                <div class="options-content">
    {{--                                <div class="collapse" id="collapseExample_mada">--}}
    {{--                                    @include('front.payment.includes.mada')--}}
    {{--                                </div>--}}

                                    <div class="collapse" id="collapseExample_visa">
                                        @include('front.payment.includes.visa')
                                    </div>
                                </div>
                            </div>
                        @else

                            <div class="alert alert-danger text-center">
                                {{ _i('No Online Payment') }}
                            </div>
                        @endif



                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>

        $('.get_id').on('click', function () {
            window.id = $(this).next('.bank_id').val();
        });


        function showImg(input) {
            var id2 = window.id;
            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#article_img_' + id2).attr('src', e.target.result).width(250).height(250);
            };
            filereader.readAsDataURL(input.files[0]);

        }

        $('.pay').on('click', function () {
            var id3 = window.id;
            document.getElementById('saveOrder_' + id3).submit();
        });

        $('.pay_online_visa').on('click', function () {
            document.getElementById('payOnline_visa').submit();
        });

    </script>

@endpush
