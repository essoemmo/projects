@extends('front.layout.index')

@section('title')

    {{ _i('Featured ad') }}

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

                        <form action="{{ route('saveOrder') }}" id="save_order" method="POST"
                              data-parsley-validate>

                            @csrf

                            @honeypot {{--prevent form spam--}}

                            <input type="hidden" name="social_link_id"
                                   class="social_link_id">
                            <input type="hidden" name="feature_id"
                                   class="feature_id">

                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">{{ _i('Account Type') }} <span
                                        class="text-danger mr-2">*</span></label>
                                <div class="col-sm-9">
                                    <select name="social_link_id" id="social_link" class="form-control" required>
                                        @if(count($user_social) > 0)
                                            <option disabled selected>{{ _i('Select') }}</option>
                                            @foreach($user_social as $link)
                                                <option value="{{ $link->id }}">{{ $link->url }} ({{ $link->title }})
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled selected>{{ _i('No Accounts') }}</option>
                                        @endif
                                    </select>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="feature" class="col-sm-3 col-form-label">{{ _i('Where the ad is shown') }}
                                    <span class="text-danger mr-2">*</span></label>
                                <div class="col-sm-9">
                                    <select name="place" id="feature" class="form-control" required>
                                        <option selected disabled>{{ _i('Select') }}</option>
                                        <option value="featured">{{ _i('Featured Members') }}</option>
                                        <option value="slider">{{ _i('Slider') }}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="cost" style="display: none">
                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label for="" class="col-sm-3 col-form-label">{{ _i('Duration') }} <span--}}
                                {{--                                            class="text-danger mr-2">*</span></label>--}}
                                {{--                                    <div class="col-sm-9">--}}
                                {{--                                        <input type="text" name="duration" data-parsley-type="number" id="duration"--}}
                                {{--                                               class="form-control" placeholder="{{ _i('Duration In Hours') }}"--}}
                                {{--                                               required>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h6 class="text-danger">{{ _i('The cost of a single ad') }}</h6>
                                    </div>
                                    <div class="col-sm-7">
                                        <span class="price"></span> {{ _i('SAR') }} {{ _i('For A Month') }} <span
                                            class="day_price"></span> {{ _i('SAR') }} {{ _i('For A Single Day') }}
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="text-left">
                                            <button type="button" class="btn grade get_price validate"
                                                    id="get_data">{{ _i('Send') }}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="wait" style="display: none">
                                <div class="alert alert-danger text-center">
                                    {{ _i('A request is already under review') }}
                                </div>
                            </div>

                            <div class="approved" style="display: none">
                                <div class="alert alert-success text-center">
                                    {{ _i('Your request has been approved and will be shown from') }} ( <span
                                        class="from"></span> ) {{ _i('to') }} ( <span class="to"></span> )
                                </div>
                            </div>

                            @include('front.user.includes.modal')


                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')

    <script>
        $('.validate').on('click', function () {
            $('#save_order').parsley().validate();
            if ($('#save_order').parsley().validate() == true) {
                $('#exampleModalCenter').modal('show');
            }
        });

        var price = '';
        $('#feature').on('change', function () {
            var feature = $(this).val();
            $('.wait').css('display', 'none');
            $('.cost').css('display', 'none');
            $('.approved').css('display', 'none');
            $.ajax({
                url: '{{ route('featurePrice') }}',
                method: 'GET',
                DataType: 'json',
                type: 'get',
                data: {_token: '{{ csrf_token() }}', feature: feature},
                success: function (res) {
                    if (res[0] == true) {
                        price = res[1].price;
                        $('.cost').css('display', 'block');
                        $('.price').text(price);
                        $('.day_price').text((price / 30).toFixed(2));
                        $('#duration').val('');
                    } else if (res[0] == 'wait') {
                        $('.wait').css('display', 'block');
                    } else if (res[0] == 'approved') {
                        $('.approved').css('display', 'block');
                        $('.from').text(res[1].from);
                        $('.to').text(res[1].to);
                    }
                }
            })
        });

        // $('.get_price').keyup(function () {
        //     var total = parseInt(price);
        //     console.log(price, total);
        //     $('.total').text(total);
        // });

        $('.showModal').on('click', function () {
            $('#exampleModalCenter').modal('hide');
            $('#payModal').modal('show');
        });

        $('.get_id').on('click', function () {
            window.id = $(this).next('.bank_id').val();
        });

        $('#get_data').on('click', function () {
            var social_link_id = $('#social_link').val();
            var feature = $('#feature').val();
            // var duration = $('#duration').val();
            var total = parseInt(price);
            $('.total').text(total);
            $('.social_link_id').val(social_link_id);
            // $('.duration_time').val(duration);
            $('.feature_id').val(feature);
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
            document.getElementById('save_order').submit();
        });

        $('.pay_online_visa').on('click', function () {
            document.getElementById('payOnline_visa').submit();
        });

    </script>

@endpush

