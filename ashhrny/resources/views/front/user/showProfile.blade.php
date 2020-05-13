@extends('front.layout.index')

@section('title')

    {{ $user->first_name }} {{ $user->last_name }}

@endsection

@section('content')

    @include('front.layout.header')
    @include('front.layout.headerSearch')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a title="{{ _i('Home') }}" href="{{ route('home') }}">  {{ _i('Home') }} </a></li>
                <li class="breadcrumb-item active" title="{{ $user->first_name }} {{ $user->last_name }}" aria-current="page">{{ $user->first_name }} {{ $user->last_name }}</li>
            </ol>
        </div>
    </nav>


    <div class="user-page py-3">
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    <div class="profile-sidebar  shadow-sm">
                        <!-- SIDEBAR USERPIC -->

                        <div class="profile-img">
                            @if($user->image == null)
                                <img data-src="{{ asset('/front/images/user.png') }}" alt="" class="img-fluid lazy">
                            @else
                                <img data-src="{{ asset($user->image) }}" alt="" class="img-fluid lazy">
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-md-9">

                    <div class="card  border-0">
                        <div class="card-header shadow-sm">
                            <div class="user-type">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="user-id">{{ _i('Membership No') }}  :  {{ membership_number($user->membership_number) }}</div>
                        </div>

                        <div class="card-body">

                                <div class="form-group row">
                                    <label   class="col-sm-3 col-form-label">{{ _i('Gender') }}</label>
                                    <div class="col-sm-9">
                                        <p>{{ $user->gender }}</p>
                                    </div>
                                </div>
                                @if($user->country != null)
                                    <div class="form-group row">
                                        <label   class="col-sm-3 col-form-label">{{ _i('Country') }}</label>
                                        <div class="col-sm-9">
                                            <p>{{ $user->country->translate(app()->getLocale())->title }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if(count($user_social) > 0 )
                                    @foreach($user_social as $link)
                                        <div class="form-group row">
                                            <label   class="col-sm-3 col-form-label">{{ $link->title }}</label>
                                            <div class="col-sm-9">
                                                <p>{{ $link->url }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <p>{{ _i('No Accounts') }}</p>
                                    </div>
                                </div>

                                @endif

                        </div>



                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection

@push('css')
    <style>
        .custom-file-label.id-photo::after {
        .grade;
        content: {{_i('Insert Identity Image')}};
        }
    </style>
@endpush

@push('js')

    <script>
        $(function () {
            'use strict';
            $('#country').on('change', function (e) {
                var country_id = $(this).val();
                $.ajax({
                    url:'{{ route('getCallCode') }}',
                    DataType:'json',
                    type:'get',
                    data: {country_id:country_id},
                    success:function (res) {
                        if(res[0] == true) {
                            $('.call_code').val(res[1]);
                        } else {
                            new Noty({
                                type: 'warning',
                                layout: 'topRight',
                                text: "{{ _i('Error Happened Please Try Again') }}",
                                timeout: 3000,
                                killer: true
                            }).show();
                        }
                    }
                })
            });
        });

        $('#country').change(function(){
            var countryID = $(this).val();
            if (countryID){
                $.ajax({
                    type:"GET",
                    url: "{{route('getCityList')}}",
                    DataType:'json',
                    data: {countryID:countryID},
                    success:function(res){
                        if (res[0] == true){
                            console.log(res[1]);
                            $("#city").css('display','flex');
                            $("#city_id").empty();
                            $("#city_id").append('<option>{{ _i('select') }}</option>');
                            $.each(res[1], function(key, value){
                                $("#city_id").append('<option value="' + value.id + '">' + value.title + '</option>');
                            });
                        } else{
                            $("#city").css('display','none');
                        }
                    }
                });
            } else{
                $("#city").css('display','none');
            }
        });
    </script>


@endpush
