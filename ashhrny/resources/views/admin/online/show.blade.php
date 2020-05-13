@extends('admin.layout.index',[
'title' => _i('All Online Payment'),
'activePageName' => _i('All Online Payment'),
] )


@section('content')

    @include('admin.layout.message')
    <div class="card">
        <div class="card-header">
            <h5>{{ _i('Online Payment') }}</h5>
        </div>
        <div class="card-block">
            @if($online == null)
                <div class="wrapper">
                    {!! Form::open(['route' => 'online_payment.store', 'method' => 'post','class'=>'j-forms','id'=>'j-forms','files'=>true,'data-parsley-validate']) !!}
                    {{--                    {{method_field('post')}}--}}
                    @honeypot {{--prevent form spam--}}
                    <div class="content">

                        <div class="unit">
                            <div class="input">
                                <label class="icon-right" for="password">
                                    <i class="fa fa-lock"></i>
                                </label>
                                <input type="password" id="password" name="key" placeholder="{{ _i('Key') }}" required>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" id="show-pass">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span> <span>{{ _i('Show Key') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="footer">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit"
                                        class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            @else
                <div class="wrapper">
                    {!! Form::open(['route' => 'online_payment.store', 'method' => 'POST','class'=>'j-forms','id'=>'j-forms','files'=>true]) !!}
                    @honeypot {{--prevent form spam--}}
                    <div class="content">

                        <div class="unit">
                            <div class="input">
                                <label class="icon-right" for="password">
                                    <i class="fa fa-lock"></i>
                                </label>
                                <input type="password" value="{{ $online->key }}" id="password" name="key"
                                       placeholder="{{ _i('Key') }}" required>
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" id="show-pass">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span> <span>{{ _i('Show Key') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="footer">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit"
                                        class="btn btn-primary btn-outline-primary m-b-0">{{ _i('Save') }}</button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('js')

    <script>
        $("#show-pass").on("change", function () {
            $("#show-pass").is(":checked") ? $("#password").attr("type", "text") : $("#password").attr("type", "password");
        });
    </script>

@endpush


