
@extends('web.layout.master')

@section('content')


    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Contact Us')}} </li>
            </ol>
        </div>
    </nav>



<section class="contact-page common-wrapper">

    <div class="container">

        <div class="contact-info">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-info-column">
                        <i class="fa fa-map-marker"></i>
                        <h5>{{_i('Address')}}</h5>
                        <p>{{ settings()['address'] }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-column">
                        <i class="fa fa-phone"></i>
                        <h5> {{_i('Call Us')}}</h5>
                        <p>{{ $phone->phone }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-column">
                        <i class="fa fa-envelope"></i>
                        <h5> {{_i('Contact Email')}}</h5>
                        <p>{{ settings()->contact_email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="map-wrapper">
            <div class="google-maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1752.768858647445!2d-0.22962320641646145!3d51.59042137702072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876108b08ac8657%3A0xc6241b957359e27d!2sMiddlesex+University+London!5e0!3m2!1sen!2seg!4v1525079564159" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <br> <br> <br>


        <div class="contact-form">
            <form action="{{url('/contact')}}" method="post" class="course-register-form" data-parsley-validate="">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="{{_i('Your Name')}}"  name="name" required="" maxlength="150"	data-parsley-maxlength="150"
                               minlength="3" data-parsley-minlength="3" value="{{auth()->user() ? auth()->user()->name : old('name') }}">
                    </div>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" placeholder="{{_i('Your Email')}}" name="email" required=""
                               data-parsley-type="email" maxlength="100" data-parsley-maxlength="100" value="{{auth()->user() ? auth()->user()->email : old('email') }}">
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control"  placeholder="{{_i('Phone')}}" name="phone"
                                data-parsley-maxlength="15" value="{{auth()->user() ? auth()->user()['phone'] : old('phone') }}">
                    </div>
                    <div class="col-sm-6">
{{--                        <input type="text" class="form-control" placeholder="الدولة">--}}
                        <select  class="form-control select2 select2-hidden-accessible" name="country_id" style="width:100%" aria-hidden="true"  >
                            <option value selected disabled>{{_i('Choose Country')}}</option>

                            @foreach($countries as $country)
                                <option value="{{$country->country_id}}"> {{$country['name']}}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-sm-12">
                                <textarea name="message" id="" cols="30" rows="5" class="form-control"  required=""
                            minlength="10" data-parsley-minlength="10"   placeholder="{{_i('Your Message')}}">{{old('message')}}</textarea>
                    </div>
                </div>

                <div class="center"><input type="submit" class="btn btn-blue" value="{{_i('Send')}}"></div>


            </form>
        </div>
    </div>


</section>

@endsection
