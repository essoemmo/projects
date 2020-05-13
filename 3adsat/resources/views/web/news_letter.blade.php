<div class="col-md-4">
    <img src="{{ asset('uploads/setting/'.settings()->loge) }}" alt="" class="img-fluid footer-logo">

    <form class="form-inline mt-3" action="{{url('/user/subscribe/newsletters')}}" method="POST" data-parsley-validate="">
        @csrf

        <input type="email" name="email" class="form-control mb-2" id="inlineFormInputName2"
               placeholder="{{_i('Your Email')}}" required="" >
        @if ($errors->has('email'))
            <strong>{{ $errors->first('email') }}</strong>
        @endif

        <button type="submit" class="btn btn-primary mb-2 mr-2">{{_i('Subscribe')}}</button>
    </form>
</div>