@extends('store.layout.master')

@section('content')

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row" >

                <div class="col-md-10 offset-md-1">
      
                    <form class="shadow-lg" action="{{url(app()->getLocale().'/store/notsubscribe')}}"  method="POST" style="background:#f8f9fa" >

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

@section('script')

@endsection

