
<br />
<div class="subscribe common-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-4 align-self-center">
                <div class="subscribe-headers">
                    <h5>{{_i('Subscribe to the newsletter')}}</h5>
                    <p>{{_i('Subscribe to the newsletter to receive all that is new')}} </p>
                </div>
            </div>
            <div class="col-md-8 align-self-center">
                <div class="subscribe-form">
                    <form action="{{url(app()->getLocale().'/store/subscribe/newsletters')}}" method="POST" data-parsley-validate="" >
                        @csrf
                        <input type="email" name="email" class="form-control" placeholder="{{_i('Your Email')}}" required="" >
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


<footer class="text-center">
    <div class="links">
        <div class="container">
            @php
                $footer_sections = \App\Models\Content_section::where('type', 'footer')->where('store_id' , \App\Bll\Utility::getStoreId())->orderBy('order', 'asc')
               ->select('content_sections.id','content_sections.columns')
               ->get();
            @endphp
            @if(count($footer_sections) >0 )
                @foreach($footer_sections as $section)
                    <div class="row">
                        <?php $contents_data = \App\ContentSectionData::where('section_id' , $section['id'])->where('source_id',null)->get();?>
                        @foreach($contents_data as $single_content)
                            <div class="col-lg-{{intval(12/$section['columns'])}} col-md-{{intval(12/$section['columns'])}}">
                                {!! $single_content['content'] !!}
                            </div>
                        @endforeach

                    </div>
                @endforeach

            @endif
<br />
            <div class="social">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->facebook_url }} @else # @endif"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->twitter_url }} @else # @endif"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->instagram_url }} @else # @endif"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <img src="{{asset('blue/images/paymethods.png')}}" alt="" class="img-fluid">
            </div>

        </div>
    </div>






    <div class="copyrights ">
        <div class="container">
            <div class="text-center">
                <div>{{_i('Copyright')}} © {{date('Y')}} .com™. <a href="https://www.serv5.com" class="light-blue">{{_i('By')}} serv5.com</a></div>

            </div>
        </div>
    </div>
</footer>


<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="{{asset('blue/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('blue/js/popper.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="{{asset('blue/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('blue/js/lazyload.min.js')}}"></script>
<script src="{{asset('blue/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('blue/js/droopmenu.min.js')}}"></script>
<script src="{{asset('blue/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('blue/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('blue/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('blue/js/wow.min.js')}}"></script>

<!----------- additional links ------------->
<script src="{{asset('custom/sweetalert2.all.min.js')}}"></script>
<!-- data-table js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script src="{{asset('blue/js/custom.js')}}"></script>

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
