<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ _i('Error') }}</title>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords"
          content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">

    <link rel="icon" href="{{ asset('masterAdmin/assets/images/favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
          href="{{asset('masterAdmin/bower_components/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css"
          href="{{ asset('masterAdmin/assets/icon/themify-icons/themify-icons.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('masterAdmin/assets/icon/icofont/css/icofont.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('masterAdmin/assets/pages/flag-icon/flag-icon.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('masterAdmin/assets/pages/menu-search/css/component.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('masterAdmin/assets/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('masterAdmin/assets/css/color/color-1.css') }}" id="color"/>
</head>
<body>

<div class="theme-loader">
    <div class="ball-scale">
        <div></div>
    </div>
</div>


<section class="login offline-404 p-fixed d-flex text-center">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <div class="auth-body">
                    <form>
                        <h1>404</h1>
                        <h2>{{ _i('Oops! Error Found Please Try Again Later') }}</h2>
                        <div class="color-purple">{{ _i('Window will close in') }}
                            <div style="font-weight: bolder" id="value">100</div>
                        </div>
                        <a href="javascript:void(0)"
                           class="btn btn-primary btn-lg m-t-30 return_checkout">{{ _i('Back to Home') }}</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>


<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->


<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jquery/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/tether/js/tether.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/popper.js/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>

<!-- modernizr js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/modernizr/js/modernizr.js')}}"></script>
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/classie/js/classie.js')}}"></script>


<!-- i18next.min.js -->
<script type="text/javascript" src="{{asset('masterAdmin/bower_components/i18next/js/i18next.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript"
        src="{{asset('masterAdmin/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('masterAdmin/assets/js/script.js') }}"></script>


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

</body>
</html>
