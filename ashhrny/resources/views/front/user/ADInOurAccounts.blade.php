@extends('front.layout.index')

@section('title')

    {{ _i('Advertise on our accounts') }}

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
                        <div class="card-header shadow-sm mb-4">
                            <div class="user-type">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-id">{{ _i('Membership No') }}
                                : {{ membership_number($user->membership_number) }}</div>
                        </div>

                        @if(count($user_adv) > 0)
                            <div class="text-center">
                                <div class="last-ad-time">
                                    {{ _i('Last Ad posted') }}
                                    <?php
                                    $num = (string)$last_ad;
                                    $revestr = strrev($num);
                                    $reverse = (int)$revestr;
                                    $last_to_array = array_map('intval', str_split($reverse))
                                    ?>
                                    @for($ii = 0; $ii < count($last_to_array) ; $ii++)
                                        <span class="number">{{ $last_to_array[$ii] }}</span>
                                    @endfor
                                </div>
                            </div>

                            <div class="card-header shadow-sm">
                                <div class="text-center">{{ _i('My Advertisement') }}</div>
                            </div>
                            <div class="ads-slider my-3">
                                @foreach($user_adv as $adv)
                                    <div class="single-ad-slide facebook">
                                        <div class="ad-icon icon">
                                            @if($user->image == null)
                                                <img data-src="{{ asset('/front/images/user.png') }}" alt=""
                                                     class="img-fluid lazy">
                                            @else
                                                <img data-src="{{ asset($adv->user->image) }}" alt=""
                                                     class="img-fluid lazy">
                                            @endif
                                        </div>
                                        <div class="ad-icon icon"><i class="fab fa-facebook-f"></i></div>
                                        <div class="slide-content">
                                            <p>{{ _i('User Name') }}
                                                : {{ $adv->user->first_name }} {{ $adv->user->last_name }}</p>
                                            <p>{{ _i('Content Type') }}
                                                : {{ $adv->content_type->translate(app()->getLocale())->title }}</p>
                                            <p>
                                                {{ _i('Advertising period from') }}
                                                @if($adv->from != null)
                                                    {{ date('d F h:i A', strtotime($adv->from)) }}
                                                @endif
                                                {{ _i('To') }}
                                                @if($adv->to != null)
                                                    {{ date('d F Y h:i A', strtotime($adv->to)) }}
                                                @endif
                                            </p>
                                            <p>{{ _i('The cost of advertising') }}
                                                : {{ $adv->total }} {{ _i('SAR') }} </p>
                                            {{--                                            <a href="" class="btn btn-light">{{ _i('Rate') }}</a>--}}
                                            {{--                                            <button type="button" class="btn btn-light get_ad_id" data-toggle="modal"--}}
                                            {{--                                                    data-target="#rateModal">{{ _i('Rate') }}--}}
                                            {{--                                                <input type="hidden" name="ad_id" class="ad_id" value="{{ $adv->id }}">--}}
                                            {{--                                            </button>--}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="card-header shadow-sm my-5">
                            <div class="text-center">{{ _i('Add New Advertisement') }}</div>
                        </div>

                        @if($price != null)
                            <form action="{{ route('ourAccountAds.store') }}" id="myForm1" method="post"
                                  enctype="multipart/form-data">

                                @csrf

                                @honeypot {{--prevent form spam--}}

                                <div class="social-icons">
                                    @php
                                        $setting_socials = \App\Models\SocialLinkSetting::all();
                                    @endphp
                                    <ul class="list-inline text-center mb-4">
                                        @foreach($setting_socials as $row)
                                            <li class="list-inline-item text-center"><a href="https://{{$row['url']}}"
                                                                                        rel="nofollow"
                                                                                        title="{{$row['title']}}"
                                                                                        target="_blank"
                                                                                        style="color: black"><i
                                                        class="fab {{$row['icon']}}"></i></a></li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h6 class="text-danger">{{ _i('The cost of a single ad') }}</h6>
                                    </div>
                                    <div class="col-sm-7">
                                        <span
                                            class="price">{{ $price->price }}</span> {{ _i('SAR') }} {{ _i('On many accounts') }}
                                    </div>

                                </div>

                                <input type="hidden" name="advertisement_type" value="website">

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Account') }}
                                        <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="social_link_id" required id="social_link" class="form-control">
                                            @if(count($user_social) > 0)
                                                <option disabled selected>{{ _i('Select') }}</option>
                                                @foreach($user_social as $link)
                                                    <option value="{{ $link->id }}">{{ $link->url }} ({{ $link->title }}
                                                        )
                                                    </option>
                                                @endforeach
                                            @else
                                                <option disabled selected>{{ _i('No Accounts') }}</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Account Type') }}
                                        <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="account_content_type" required id="account_type_id"
                                                class="form-control">
                                            @if(count($content_type) > 0)
                                                <option disabled selected>{{ _i('Select') }}</option>
                                                @foreach($content_type as $type)
                                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                                @endforeach
                                            @else
                                                <option disabled selected>{{ _i('No Account Content Types') }}</option>
                                            @endif
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Ad Cost') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" disabled
                                               class="form-control" value="{{ $price->price . ' '. _i('SAR') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i(' Add Image / Video') }}
                                        <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" required class="form-control custom-file-input ad_image"
                                                   name="file" id="inputGroupFile01"
                                                   aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01"></label>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Advertisement Text') }}
                                        <span
                                            class="text-danger mr-2">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea name="ad_text" required id="content" cols="30" rows="5"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>

                            </form>

                            <div class="text-left">
                                <button type="button"
                                        class="btn grade m-2 get_price validate">{{ _i('Add Advertisement') }}</button>
                            </div>
                        @else
                            <div class="alert alert-danger">{{ _i('Not Available') }}</div>
                        @endif
                    <!-- Modal -->
                        @include('front.user.includes.modal')

                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $('.validate').on('click', function () {
            $('#myForm1').parsley().validate();
            if ($('#myForm1').parsley().validate() == true) {
                $('#exampleModalCenter').modal('show');
            }
        });

        $('.showModal').on('click', function () {
            $('#exampleModalCenter').modal('hide');
            $('#payModal').modal('show');
        });

        $('.get_price').on('click', function () {
            var price = $('.price').text();
            var total = parseInt(price);
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
    </script>

@endpush