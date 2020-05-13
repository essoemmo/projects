<footer>

    <div class="container">
        @php
            $footer_sections = \App\Models\Content_section::where('type', 'footer')->where('store_id',\App\BLL\Utility::getStoreId())->orderBy('order', 'asc')
           ->select('content_sections.id','content_sections.columns')
           ->get();
        @endphp
        @if(count($footer_sections) >0 )
            @foreach($footer_sections as $section)
            <div class="row">
                <?php $contents_data = \App\ContentSectionData::where('section_id' , $section['id'])->where('lang_id',getLang(session('lang')))->get();?>
                @foreach($contents_data as $single_content)

                   <div class="col-md-{{intval(9/$section['columns'])}}">
                      <div class="footer-about-shop">
{{--                                <h6>{{_i('about sallatk')}}</h6>--}}
                          {!! $single_content['content'] !!}
                      </div>
                   </div>
                @endforeach

                 @if($loop->first)
                 <div class="col-md-3">
                    <div class="social">
                        <ul class="list-inline">
                            @php
                                $salla_setting = \App\Models\Settings\Setting::where('store_id',\App\BLL\Utility::getStoreId())->first();
                            @endphp
                            @if(!empty($salla_setting))
                            <li class="list-inline-item"><a href="{{$salla_setting['facebook_url']}}"><i class="fa fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="{{$salla_setting['twitter_url']}}"><i class="fa fa-twitter"></i></a></li>
                            {{-- <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"></i></a></li> --}}
                            <li class="list-inline-item"><a href="{{$salla_setting['instagram_url']}}"><i class="fa fa-instagram"></i></a></li>
                            {{-- <li class="list-inline-item"><a href="#"><i class="fa fa-whatsapp"></i></a></li>     --}}
                            @endif
                        </ul>
                        <h6>{{_i('payment\'s methods')}}</h6>
                        <img src="{{url('/')}}/front/images/paymethods.png" alt="" class="img-fluid">
                    </div>
                </div>
                @endif

            </div>
            @endforeach
        @else

        <div class="row">
            <div class="col-md-3">
                <div class="social">
                    <ul class="list-inline">
                        @php
                            $salla_setting = \App\Models\Settings\Setting::where('store_id',\App\BLL\Utility::getStoreId())->first();
                        @endphp
                        <li class="list-inline-item"><a href="@if(!empty($salla_setting)){{$salla_setting['facebook_url'] }}@endif"><i class="fa fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a href="@if(!empty($salla_setting)){{$salla_setting['twitter_url'] }}@endif"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="@if(!empty($salla_setting)){{$salla_setting['instagram_url'] }}@endif"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                    <h6>{{_i('payment\'s methods')}}</h6>
                    <img src="{{url('/')}}/front/images/paymethods.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>

        @endif

    </div>


    <div class="copyrights text-md-center ">
        <div class="container">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div>{{_i('Copyright')}} © {{date('Y')}} .com™. {{_i('All rights reserved')}}.</div>

                <div>{{_i('design and development by')}} <span><a href="https://serv5.com/" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>



<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('front/js/lazyload.min.js')}}"></script>
<script src="{{asset('front/js/jquery.countimator.min.js')}}"></script>
<script src="{{asset('front/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>
{{--parsleyjs--}}
<script src="{{asset('custom/parsley.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('front/select2/dist/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2()
</script>

@yield('js')
@stack('js')


</body>
</html>

