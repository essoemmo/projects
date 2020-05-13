@extends('front.layout.index')

@section('title')

    {{ _i('My Ads') }}

@endsection

@section('content')

    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="{{ _i('Home') }}"
                                               href="{{ route('home') }}">  {{ _i('Home') }} </a></li>
                <li class="breadcrumb-item active" title="{{ _i('My Profile') }}"
                    aria-current="page">{{ _i('My Profile') }}</li>
            </ol>
        </div>
    </nav>

    <div class="user-page py-3">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    @include('front.user.includes.sideMenu')
                </div>
                <div class="col-md-9">

                    <div class="card  border-0">
                        <div class="card-header shadow-sm">
                            <div class="user-type">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-id">{{ _i('Membership No') }}
                                : {{ membership_number($user->membership_number) }}</div>
                        </div>

                        @if(count($user_ads) > 0)
                            <div class="ads-slider my-3">
                                @foreach($user_ads as $adv)
                                    <div class="single-ad-slide facebook">
                                        <div class="ad-icon icon"><i class="fab fa-facebook-f"></i></div>
                                        <div class="slide-content">
                                            <p>{{ _i('Account Name') }} : {{ $adv->social_link->url }}</p>
                                            {{--                                            <p>{{ _i('Account Type') }} : تلالالالالا</p>--}}
                                            {{--                                            <p>عدد المتابعين : 1000 متابع</p>--}}
                                            <p>{{ _i('Duration') }} : {{ $adv->duration }} {{ _i('Hours') }}</p>
                                            <p>{{ _i('Account Type') }}
                                                : {{ $adv->content_type->translate(app()->getLocale())->title }}</p>
                                            <p>{{ _i('Cost') }}
                                                : {{  number_format($adv->total -  (($adv->total * 10) / 100))  }} {{ _i('SAR') }} </p>
                                            <button type="button" class="btn btn-light get_ad_id" data-toggle="modal"
                                                    data-target="#advertiseModal">{{ _i('Advertise') }}
                                                <input type="hidden" name="ad_id" class="ad_id" value="{{ $adv->id }}">
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- rateModal -->
                            {{--                            <div class="modal fade text-center" id="advertiseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
                            {{--                                <div class="modal-dialog modal-dialog-centered" role="document">--}}
                            {{--                                    <div class="modal-content justify-content-center">--}}
                            {{--                                        <div class="modal-header">--}}
                            {{--                                            <h5 class="modal-title " id="exampleModalCenterTitle">{{ _i('Advertise') }}</h5>--}}
                            {{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--                                                <span aria-hidden="true">&times;</span>--}}
                            {{--                                            </button>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="modal-body">--}}
                            {{--                                            <form action="{{ route('advertise') }}" method="POST" id="advertiseForm" data-parsely-validate>--}}
                            {{--                                                <input type="hidden" name="social_adv_id" form="advertiseForm" class="social_adv_id">--}}
                            {{--                                                @csrf--}}
                            {{--                                                <div class="form-group row">--}}
                            {{--                                                    <label for="rate_id" class="col-sm-3 col-form-label">{{ _i('From') }}</label>--}}
                            {{--                                                    <div class='col-sm-9'>--}}
                            {{--                                                        <input type='datetime-local' class="form-control" name="from" />--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="form-group row">--}}
                            {{--                                                    <label for="rate_id" class="col-sm-3 col-form-label">{{ _i('To') }}</label>--}}
                            {{--                                                    <div class="col-sm-9">--}}
                            {{--                                                        <input type='datetime-local' class="form-control" name="to" />--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                            </form>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="modal-footer">--}}
                            {{--                                            <button type="submit" form="advertiseForm" class="btn grade">{{ _i('Advertise') }}</button>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        @else
                            <div class="alert alert-danger">{{ _i('No Ads') }}</div>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $('.showModal').on('click', function () {
            $('#exampleModalCenter').modal('hide');
            $('#payModal').modal('show');
        });

        $('#duration').keyup(function () {
            var duration = $(this).val();
            var price = $('.price').text();
            var total = parseInt(price) * parseInt(duration);
            $('.total').text(total);
        });

        $('.get_id').on('click', function () {
            var bank_id = $(this).next('.bank_id').val();
            $('#bank_id').val(bank_id);
        });

        function showImg(input) {
            var id2 = window.id;
            var filereader = new FileReader();
            filereader.onload = (e) => {
                $('#article_img_' + id2).attr('src', e.target.result).width(250).height(250);
            };
            filereader.readAsDataURL(input.files[0]);

        }

        $('.pay_online_visa').on('click', function () {
            document.getElementById('payOnline_visa').submit();
        });

        $('.get_ad_id').on('click', function () {
            var id = $(this).children('.ad_id').val();
            $('.social_adv_id').val(id);
        })
    </script>

@endpush
