
<div class="subscribe common-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 align-self-center">
                <div class="subscribe-headers">
                    <h5>{{_i('Subscribe to the mailing list')}}</h5>
                    <p>{{_i('Subscribe to the mailing list to receive all that is new')}} </p>
                </div>
                <div class="subscribe-form" >
                    <form action="{{url(app()->getLocale().'/store/subscribe/newsletters')}}" method="POST" data-parsley-validate="">
                        @csrf
                        <input type="email" class="form-control"  name="email"  placeholder="{{_i('Your Email')}}" required="" >
                        @if ($errors->has('email'))
                            <strong>{{ $errors->first('email') }}</strong>
                        @endif
                        <input type="submit" class="subscribe-btn" value=" {{_i('Subscribe Now')}}">
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<footer>

    <div class="container">

        @php
            $pages = \App\Models\Pages\Page::where('store_id' , \App\Bll\Utility::getStoreId())->get();
        @endphp
{{-- @dd($pages); --}}
        @if(!empty($pages))
            @foreach($pages as $page)
                <div class="row">
                    <?php $pages_data = \App\Models\Pages\PageData::where('source_id',null)->where('page_id' , $page['id'])->get();?>
                    @foreach($pages_data as $page_content)
                        <div class="col-md-6">
                            <div class="footer-links">
                            {!! $page_content['title'] !!}
                            </div>
                        </div>
                    @endforeach

                @if($loop->first)
                <div class="col-md-6">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="{{route('signin', app()->getLocale())}}">{{_i('Sign In')}}</a></li>
                    <li class="list-inline-item"><a href="{{route('store_register' ,app()->getLocale())}}">{{_i('Join Us')}}</a></li>
                </ul>
                <form action="">
                    <div class="form-wrapper input-group">
                        <input type="text" class="form-control" placeholder="{{_i('Type your search words here')}}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>
                </form>
                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->facebook_url }} @else # @endif"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->twitter_url }} @else # @endif"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->instagram_url }} @else # @endif"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>

                <div class="copyrights">{{_i('design and development by')}}  <a href="https://www.serv5.com" >serv5.com</a></div>

            </div>
                @endif
        </div>
            @endforeach

        @else
            <div class="row">

                <div class="col-md-4">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="{{route('signin' ,app()->getLocale())}}">{{_i('Sign In')}}</a></li>
                        <li class="list-inline-item"><a href="{{route('store_register' ,app()->getLocale())}}">{{_i('Join Us')}}</a></li>
                    </ul>
                    <form action="">
                        <div class="form-wrapper input-group">
                            <input type="text" class="form-control" placeholder="{{_i('Type your search words here')}}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                    <div class="social">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->facebook_url }} @else # @endif"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->twitter_url }} @else # @endif"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->instagram_url }} @else # @endif"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    <div class="copyrights">{{_i('design and development by')}}  <a href="https://www.serv5.com" >serv5.com</a></div>

                </div>
            </div>
        @endif

    </div>

</footer>



<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="{{asset('perpal/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('perpal/js/popper.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="{{asset('perpal/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('perpal/js/lazyload.min.js')}}"></script>
<script src="{{asset('perpal/js/droopmenu.min.js')}}"></script>
<script src="{{asset('perpal/js/lightslider.min.js')}}"></script>
<script src="{{asset('perpal/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('perpal/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('perpal/js/wow.min.js')}}"></script>
<!-- Select 2 js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/select2/js/select2.full.min.js')}}"></script>


<!-- data-table js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script src="{{asset('perpal/js/custom.js')}}"></script>

<script src="{{asset('custom/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('custom/parsley.min.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@stack('js')
</body>
</html>