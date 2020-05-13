<footer>
    <div class="links">
        <div class="container">
            <div class="row">

                <div class="col-md-2">
                    <h6>الدعم الفني</h6>
                    <ul class="footer-list list-unstyled">
                        <li><a href="#">رابط</a></li>
                        <li><a href="#">رابط</a></li>
                        <li><a href="#">رابط</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>الدعم الفني</h6>
                    <ul class="footer-list list-unstyled">
                        <li><a href="#">رابط</a></li>
                        <li><a href="#">رابط</a></li>
                        <li><a href="#">رابط</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>الدعم الفني</h6>
                    <ul class="footer-list list-unstyled">
                        <li><a href="#">رابط</a></li>
                        <li><a href="#">رابط</a></li>
                        <li><a href="#">رابط</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="{{ url('/') }}/web/images/logo-small.png" alt="" style="max-height: 180px" class="img-fluid footer-logo">

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

            </div>
        </div>
    </div>

    <hr>

    <div class="copyrights text-md-center">
        <div class="container">
            <div class="d-lg-flex justify-content-between">
                <div>Copyright © 2018 .com™. All rights reserved.</div>
                <div class="social">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
                <div>design and development by <span><a href="https://www.serv5.com" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>

</footer>
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script type="text/javascript" src="{{ url('/') }}/web/js/jquery-3.3.1.min.js"></script>
<script src="{{ url('/') }}/web/js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="{{ url('/') }}/web/js/droopmenu.min.js"></script>
<script src="{{ url('/') }}/web/js/bootstrap-rtl.js"></script>
<script src="{{ url('/') }}/web/js/lazyload.min.js"></script>
<script src="{{ url('/') }}/web/js/bootstrap-input-spinner.js"></script>
<script src="{{ url('/') }}/web/js/jquery.nice-select.min.js"></script>
<script src="{{ url('/') }}/web/js/owl.carousel.min.js"></script>
<script src="{{ url('/') }}/web/js/wow.min.js"></script>
<script src="{{ url('/') }}/web/js/custom.js"></script>

<script src="{{asset('custom/parsley.min.js')}}"></script>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@if(\Xinax\LaravelGettext\Facades\LaravelGettext::getLocale() == "en")
    <script src="{{url('/')}}/web/js/custom-en.js"></script>

    @endif
    @stack('js')

</body>
</html>
