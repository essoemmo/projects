<div class="card card-body">
    <form action="{{ route('saveOrder') }}" method="POST" class="row" enctype="multipart/form-data" data-parsley-validate>
        @csrf

        <input type="hidden" name="source[type]" value="sadad">

        <input type="hidden" name="amount" value="{{ \Cart::getTotal() }}">

        <div class="col-sm-6 text-center">
            <div class="col-xs-10">
                <input type="text" class="form-control" name="source[username]" id="username"
                       value="{{old('source[username]')}}" placeholder="{{ _i('User Name') }}" required="">
                <span class="text-danger invalid-feedback">
                    <strong>{{$errors->first('source[username]')}}</strong>
                </span>
            </div>
        </div>

    </form>

    <div class="text-center">
        <a href="javascript:void(0)" class="btn btn-yellow pay py-2">{{ _i('Pay') }}</a>
    </div>
</div>
