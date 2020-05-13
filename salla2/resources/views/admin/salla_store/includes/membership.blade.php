@push('css')

    <style>
        .card-header h5 {
            color: #5cd5c4;
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 0;
        }

        .plan-top {
            background-position: top 16px center;
            background-size: 60px;
            background-repeat: no-repeat;
            border-bottom: 1px solid #f5f5f5;
            padding: 16px;
            /*padding-top: 72px;*/
        }

        .plan-title {
            color: #29abe2;
            font-size: 25px;
            font-weight: 200;
        }

        .plan-bottom {
            padding: 16px;
        }

        .plan-top {
            background-position: top 16px center;
            background-size: 60px;
            background-repeat: no-repeat;
            border-bottom: 1px solid #f5f5f5;
            padding: 16px;
            padding-top: 72px;
        }

        .plan-title, .plan-price, .plan-period, .plan-currency {
            color: #764aaf !important;
        }

        .plan-price {
            font-size: 80px;
        }

        .text-tiffany {
            color: #5dd5c4;
        }

    </style>
@endpush

<div class="row">
    <div class="col-sm-12 ">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="ti-layout position-left"></i>
                    {{ _i('Sallatk Membership') }}  </h5>
                <div class="card-header-right">
                </div>
            </div>
            <div class="card-block">

                <div class="row users-card">

                    @foreach($memberships as $membership)

                        <div class="col-lg-6 col-xl-3 col-md-6">
                            <div class="card rounded-card user-card">
                                <div class="card-block text-center">
                                    <div class="plan-top">
                                        <img src="{{asset('images/star.PNG')}}">
                                        <h6 class="plan-title">
                                            {{_i('Sallatk')}}&nbsp;<strong>{{$membership['title']}}</strong>
                                        </h6>
                                    </div>

                                    @if($user_membership['membership_id'] == $membership['id'])
                                        <div class="plan-bottom">
                                            <span class="plan-price">{{$user_membership['price']}}</span>
                                            <span class="plan-currency"> {{$membership['currency_code']}}</span>
                                            <p class="plan-period">@if($user_membership['price'] == 0) {{_i('Free')}} @else {{_i('annually')}}  @endif</p>

                                            <span class="text-tiffany">
                                            <i class="ti ti-check"></i>
                                             {{_i('Expire at')}}
                                                {{$user_membership['expire_at']}}
                                        </span>

                                        </div>
                                    @else
                                        <div class="plan-bottom">
                                            <span class="plan-price">{{$membership['price']}}</span>
                                            <span class="plan-currency"> {{$membership['currency_code']}}</span>
                                            <p class="plan-period">@if($membership['price'] == 0) {{_i('Free')}} @else {{_i('annually')}}  @endif</p>

                                            <a href="{{url('adminpanel/membership/'.$membership['id'])}}">

                                                <button type="submit"
                                                        class="btn btn-primary btn-round">{{_i('Subscribe Now')}} </button>
                                            </a>

                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>

                    @endforeach


                </div>

            </div>

        </div>
    </div>
</div>
