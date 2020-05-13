@extends('front.layout.index')

@section('content')

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">


                <div class="col-md-10 offset-md-1">

                    <form class="shadow-lg" action="{{route('notsubscribe')}}"  method="POST" >

                        @csrf
                        <div class="row newsletter text-center mt-5">
                            <div class="col-sm-12 ">
                                <br />
                                <div class="alert alert-danger text-center">
                                    <label> <h5> {{_i('You are already subscribed')}} </h5> </label>
                                </div>
                                <div class="center">
                                    <button type="submit" class="btn btn-yellow">  {{_i('Click here to unsubscribe')}} </button>
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

@section('script')

@endsection

