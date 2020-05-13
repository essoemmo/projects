<footer>
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
                            <div class="col-lg-{{intval(8/$section['columns'])}} col-md-{{intval(12/$section['columns'])}}">
                                {!! $single_content['content'] !!}
                            </div>
                        @endforeach

                        @if($loop->first)
                                <div class="col-lg-4 col-md-12 align-self-center mt-md-3 text-md-center">
                                    <form class="form-inline mb-2" action="{{url(app()->getLocale().'/store/subscribe/newsletters')}}" method="POST" data-parsley-validate="">
                                        @csrf
                                        <input type="email" name="email" class="form-control mb-2" id="inlineFormInputName2"
                                               placeholder="{{_i('Your Email')}}" required="" >
                                        @if ($errors->has('email'))
                                            <strong>{{ $errors->first('email') }}</strong>
                                        @endif

                                        <button type="submit" class="btn btn-primary mb-2">{{_i('Subscribe')}}</button>
                                    </form>
                                    <div class="row text-center">
                                        <div class="col-5 ">
                                            <a href=""><img src="{{asset('red/images/andriod.png')}}" alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="col-5 ">
                                            <a href=""><img src="{{asset('red/images/ios.png')}}" alt="" class="img-fluid"></a>
                                        </div>
                                    </div>
                                </div>
                        @endif
                    </div>
                @endforeach
                    @else

                        <div class="row">
                            <div class="col-lg-3 col-md-12 align-self-center mt-md-3 text-md-center">
                                <form class="form-inline mb-2" action="{{url(app()->getLocale().'/store/subscribe/newsletters')}}" method="POST" data-parsley-validate="">
                                    @csrf
                                    <input type="email" name="email" class="form-control mb-2" id="inlineFormInputName2"
                                           placeholder="{{_i('Your Email')}}" required="" >
                                    @if ($errors->has('email'))
                                        <strong>{{ $errors->first('email') }}</strong>
                                    @endif

                                    <button type="submit" class="btn btn-primary mb-2">{{_i('Subscribe')}}</button>
                                </form>
                                <div class="row text-center">
                                    <div class="col-6 ">
                                        <a href=""><img src="{{asset('red/images/andriod.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                    <div class="col-6 ">
                                        <a href=""><img src="{{asset('red/images/ios.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
        </div>
    </div>

    <hr>

    <div class="copyrights text-md-center ">
        <div class="container">
            <div class="d-lg-flex justify-content-between align-items-center">
                <div>{{_i('Copyright')}} © {{date('Y')}} .com™. {{_i('All rights reserved')}}.</div>
                <div class="social">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->facebook_url }} @else # @endif"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->twitter_url }} @else # @endif"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href=" @if(!empty(setting())) {{ setting()->instagram_url }} @else # @endif"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div>{{_i('design and development by')}} <span><a href="https://www.serv5.com" class="light-blue">serv5.com</a></span></div>
            </div>
        </div>
    </div>

</footer>

<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>

<script src="{{asset('red/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('red/js/popper.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="{{asset('red/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('red/js/lazyload.min.js')}}"></script>
<script src="{{asset('red/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('red/js/droopmenu.min.js')}}"></script>
<script src="{{asset('red/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('red/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('red/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('red/js/wow.min.js')}}"></script>

<!----------- additional links ------------->
<script src="{{asset('custom/sweetalert2.all.min.js')}}"></script>
<!-- data-table js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script src="{{asset('red/js/custom.js')}}"></script>

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

