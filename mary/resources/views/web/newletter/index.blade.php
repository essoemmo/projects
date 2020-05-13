@extends('web.layout.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{_i('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{_i('Subscribed')}}</li>
            </ol>
        </div>
    </nav>


    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">

                <div class="col-md-10 offset-md-1">

                    <form class="shadow-lg" action="{{url('/user/notsubscribe')}}"  method="POST" >

                        @csrf
                        <div class="row">
                            <div class="col-sm-12 ">
                                <br />
                                <div class="alert alert-info " >
                                    <label> {{_i('Thanks for subscribe')}} </label>
                                </div>
                                <div class="center">
                                    <button type="submit"  class="btn btn-blue-outlined mt-4 "> {{_i('Click here to unsubscribe')}} </button>
                                </div>
                                <br />

                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection


