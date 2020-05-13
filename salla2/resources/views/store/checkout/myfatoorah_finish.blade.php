@extends('store.layout.master')

@push('css')
    <style>
        .register-form .form-control {
            margin: 0;
        }
    </style>
@endpush

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{_i('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Success Payment')}}</li>
            </ol>
        </div>
    </nav>

    <section class="register-form common-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="center">
                        <a href=""><img src="{{ asset('perpal/images/order-accepted.png') }}" alt="" class="img-fluid"></a>
                        <div class="welcome-head-2">{{ _i('Congratulations .. the payment is accepted') }}</div>
                        <div class="color-purple">{{ _i('Window will close in') }}
                            <div style="font-weight: bolder" id="value">100</div>
                        </div>
                        <a href="javascript:void(0)"
                           class="btn btn-mainColor btn-block my-3 return_checkout">{{ _i('Return To Check Out') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')

    <script type="text/javascript">
        $('.return_checkout').on('click', function () {
            window.close();
        });

        function animateValue(id, start, end, duration) {
            var range = end - start;
            var current = start;
            var increment = end > start ? 1 : -1;
            var stepTime = Math.abs(Math.floor(duration / range));
            var obj = document.getElementById(id);
            var timer = setInterval(function () {
                current += increment;
                obj.innerHTML = current;
                if (current == end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }

        animateValue("value", 100, 0, 5000);
        setTimeout('self.close()', 5000);
    </script>

@endpush
