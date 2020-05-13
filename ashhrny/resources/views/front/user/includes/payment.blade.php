<p>{{ _i('Choose Payment') }}</p>
<div class="pay-options text-center">
    {{--                                                <p>{{ _i('Online Payment') }}</p>--}}
    {{--                                                <ul class="list-inline d-flex justify-content-center my-4">--}}
    {{--                                                    <li class="list-inline-item"><a class="btn btn-primary collapsed"--}}
    {{--                                                                                    data-toggle="collapse"--}}
    {{--                                                                                    href="#collapseExample" role="button"--}}
    {{--                                                                                    aria-expanded="false"--}}
    {{--                                                                                    aria-controls="collapseExample">--}}
    {{--                                                            <img src="{{ asset('/front/images/visa.png') }}" alt="" class="img-fluid">--}}
    {{--                                                        </a></li>--}}
    {{--                                                    <li class="list-inline-item"><a class="btn btn-primary collapsed"--}}
    {{--                                                                                    data-toggle="collapse"--}}
    {{--                                                                                    href="#collapseExample2" role="button"--}}
    {{--                                                                                    aria-expanded="false"--}}
    {{--                                                                                    aria-controls="collapseExample2">--}}
    {{--                                                            <img src="{{ asset('/front/images/mastercard.png') }}" alt="" class="img-fluid">--}}
    {{--                                                        </a></li>--}}
    {{--                                                    <li class="list-inline-item"><a class="btn btn-primary collapsed"--}}
    {{--                                                                                    data-toggle="collapse"--}}
    {{--                                                                                    href="#collapseExample3" role="button"--}}
    {{--                                                                                    aria-expanded="false"--}}
    {{--                                                                                    aria-controls="collapseExample3">--}}
    {{--                                                            <img src="{{ asset('/front/images/paypal.png') }}" alt="" class="img-fluid">--}}
    {{--                                                        </a></li>--}}
    {{--                                                    <li class="list-inline-item"><a class="btn btn-primary collapsed"--}}
    {{--                                                                                    data-toggle="collapse"--}}
    {{--                                                                                    href="#collapseExample4" role="button"--}}
    {{--                                                                                    aria-expanded="false"--}}
    {{--                                                                                    aria-controls="collapseExample4">--}}
    {{--                                                            <img src="{{ asset('/front/images/bitbady.png') }}" alt="" class="img-fluid">--}}
    {{--                                                        </a></li>--}}
    {{--                                                </ul>--}}

    @if(count($banks) > 0)
        <p>{{ _i('Offline Payment') }}</p>
        <ul class="list-inline d-flex justify-content-center my-4">
            @foreach($banks as $bank)
                <li class="list-inline-item"><a
                        class="btn btn-primary collapsed"
                        data-toggle="collapse"
                        href="#bank_{{ $bank->id }}" role="button"
                        aria-expanded="false"
                        aria-controls="collapseExample">
                        <img src="{{ asset($bank->image) }}" alt=""
                             class="img-fluid get_id">
                        <input type="hidden" class="bank_id"
                               value="{{ $bank->id }}">
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="options-content">
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form action="">

                    <input type="text" class="form-control"
                           placeholder="اسم صاحب الكارت">


                    <input type="text" class="form-control"
                           placeholder="رقم الكارت">


                    <input type="text" class="form-control"
                           placeholder="تاريخ إنتهاء صلاحية الكارت">

                </form>
            </div>
        </div>

        <div class="collapse" id="collapseExample2">
            <div class="card card-body">
                <form action="" class="row">
                    <input type="text" class="form-control"
                           placeholder="اسم صاحب الكارت">


                    <input type="text" class="form-control"
                           placeholder="رقم الكارت">


                    <input type="text" class="form-control"
                           placeholder="تاريخ إنتهاء صلاحية الكارت">
                </form>

            </div>
        </div>

        <div class="collapse" id="collapseExample3">
            <div class="card card-body">

                <form action="">
                    <input type="text" class="form-control"
                           placeholder="بريدك الالكتروني لحساب الباي بال">

                </form>
            </div>
        </div>

        <div class="collapse" id="collapseExample4">
            <div class="card card-body">

                <form action="">
                    <input type="text" class="form-control"
                           placeholder="بريدك الالكتروني لحساب الباي بال">

                </form>
            </div>
        </div>
    </div>

    <div class="options-content">
        <input type="hidden" form="myForm1" name="bank_id" id="bank_id">
        @foreach($banks as $bank)
            <div class="collapse" id="bank_{{ $bank->id }}">
                <div class="card card-body">
                    <span> {{ _i('Bank Number') }} : {{ $bank->code }}</span>
                    <span> {{ _i('Bank Name') }} : {{ $bank->translate(app()->getLocale())->title }}</span>
                    <br>
                    {{--                                                                <form action="{{ route('celebrityAds.store') }}" method="POST" id="saveOrder_{{ $bank->id }}" class="row" enctype="multipart/form-data" data-parsley-validatewe>--}}
                    {{--                                                                    @csrf--}}
                    <div>
                        <input type="hidden" form="myForm1" name="payment_type"
                               class="bank" value="bank">
                    </div>
                    <input type="text" form="myForm1" class="form-control"
                           name="holder_name_{{ $bank->id }}"
                           id="holder_name_{{ $bank->id }}"
                           value="{{old('holder_name')}}"
                           placeholder="{{ _i('Holder name') }}" required="">


                    <input type="text" form="myForm1" class="form-control"
                           name="bank_transactions_num_{{ $bank->id }}"
                           id="bank_transactions_num_{{ $bank->id }}"
                           value="{{old('bank_transactions_num')}}"
                           placeholder="{{ _i('Bank Transactions number') }}"
                           required="">


                    <input type="file" form="myForm1"
                           class="form-control form-control-round"
                           onchange="showImg(this)"
                           name="image_{{ $bank->id }}">

                    <img class="img-responsive pad"
                         id="article_img_{{ $bank->id }}">

                    {{--                                                                    <div class="text-center">--}}
                    {{--                                                                        <a href="javascript:void(0)" class="btn grade pay">{{ _i('Pay') }}</a>--}}
                    {{--                                                                    </div>--}}

                    {{--                                                                </form>--}}
                </div>
            </div>
        @endforeach
    </div>

</div>
