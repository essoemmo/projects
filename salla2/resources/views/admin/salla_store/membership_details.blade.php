@extends('admin.AdminLayout.index')

@section('title')
    {{_i('Sallatk')}}&nbsp;<strong>{{$membership_data['title']}}</strong>
@endsection

@section('page_url')
    <li class="breadcrumb-item">
        <a href="{{url('adminpanel')}}">
            <i class="icofont icofont-home"></i>
        </a>
    </li>
    <li class="breadcrumb-item active"><a href="#">{{ _i('Sallatk') ." ". $membership_data['title']}}</a>
    </li>
@endsection

@push('css')
    <style>
        .membership_image {
            display: block;
            max-width: 40%;
            margin: 0 auto;
            /*vertical-align: middle;*/
        }

        .membership_title {
            color: #5dd5c4;
            font-size: 30px;
        }
    </style>
@endpush

@section('content')

    <div class="row">
        <div class="col-sm-12 ">
            <div class="card">
                <div class="card-header">
                    <h5> {{_i('Sallatk')}}&nbsp;<strong>{{$membership_data['title']}}</strong></h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                    </div>
                </div>
                <div class="card-block">

                    <div class="card-body card-block text-center">
                        <div class="form-group row ">
                            <img class=" membership_image" src="{{asset('images/logo.png')}}">
                        </div>
                        <h6 class="membership_title">{{_i('Sallatk')}}
                            &nbsp;<strong>{{$membership_data['title']}}</strong></h6>
                        <br>
                        <!----  membership details ----->
                        <div class="form-group row ">
                            <p>{{$membership_data['description']}}</p>
                            <p>{!! $membership_data['info'] !!}</p>
                        </div>

                        <div class="row">
                            <div class=" col-sm-12 text-center ">
                                <form action="{{url('adminpanel/membership/buy')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="membership_id" value="{{$membership['id']}}">
                                    <input type="hidden" name="currency_code" value="{{$membership['currency_code']}}">
                                    <input type="hidden" name="price" value="{{$membership['price']}}">
                                    <input type="hidden" name="expire_at" value="{{$membership_expire}}">
                                    <button type="submit"
                                            class="btn btn-primary col-sm-8"> {{_i('Buy Membership')}}</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

