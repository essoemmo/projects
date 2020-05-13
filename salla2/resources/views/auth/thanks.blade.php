@extends('front.layout.master')
@section('content')

<section class="plans common-wrapper">
    <div class="container">
       
        <div class="row">

            <div class="col-md-8 col-sm-8 offset-md-2">
                <div class="single-plan  pink  wow slideInUp ">
                    <div class="plan-title">  {{_i("Thanks for your registeration")}}</h3> </div>
                    
                     <p>
                        {{_i("An email has been sent to ")}} 
                        <span class="text-success" >{{$email}}</span>   
                        {{_i("Please check your email address to activate your account.")}}
                    </p>
                  
                </div>
            </div>

        </div>
    </div>
</section>

<section class="register-form common-wrapper ">
    <div class="container">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <div class="center">
                    <h3 class="pink">
                       
                 
                </div>

            </div>
        </div>
    </div>
</section>


@endsection
