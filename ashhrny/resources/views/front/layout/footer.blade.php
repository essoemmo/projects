
<footer class="grade">

    <div class="container">
        <div class="text-center">
            <h6>{{_i('Post to our accounts')}}</h6>

            <div class="social-icons">
                @php
                $setting_socials = \App\Models\SocialLinkSetting::all();
                @endphp
                <ul class="list-inline ">
                    @foreach($setting_socials as $row)
                    <li class="list-inline-item"><a href="https://{{$row['url']}}" rel="nofollow" title="{{$row['title']}}" target="_blank" ><i class="fab {{$row['icon']}}"></i></a></li>
                    @endforeach
                </ul>
            </div>

            @include('front.layout.footer_nav')

        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p><a title="serv5.com" href="https://www.serv5.com" target="_blank">{{_i('Designed and programmed by a company')}} {{_i('Serv5')}} </a>
                    </p>

                </div>
                <div class="col-md-6">
                    <p class="cr"> <a title="ashhrni.com" href="https://ashhrni.com">{{_i('All rights reserved to the site')}} {{_i('Ashurni')}} {{date('Y')}} </a></p>

                </div>
            </div>


        </div>
    </div>

</footer>

<a href="#" title="{{ _i('Up') }}" class="go-top"><i class="fa fa-chevron-up"></i></a>
