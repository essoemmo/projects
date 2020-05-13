<!--    <link href="css/bootstrap.min.css" rel="stylesheet">-->
<link href="{{ asset('front/css/bootstrap-rtl.css') }}" rel="stylesheet">
<!--    <link href="css/font-awesome.min.css" rel="stylesheet">-->
<link href="{{asset('front/css/slick.css')}}" rel="stylesheet">
<link href="{{asset('front/css/slick-theme.css')}}" rel="stylesheet">
<link href="{{asset('front/css/animate.css')}}" rel="stylesheet">
<script async src="https://kit.fontawesome.com/e5696f83c8.js" crossorigin="anonymous"></script>
<link href="{{asset('front/css/style.css')}}" rel="stylesheet">


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- parsleyjs  css file -->
<link href="{{asset('custom/parsely/parsley.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('adminPanel/noty/plugins/noty/noty.css') }}">
<script src="{{ asset('adminPanel/noty/plugins/noty/noty.min.js') }}"></script>

<!--- dropzone --->
<link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('css/ekko-lightbox.css')}}">

<style>
    .errorpassmessage ul li {
        line-height: normal;
    }

    .errorpassconfirmmessage ul li {
        line-height: normal;
    }

    .errorMessageFirst ul li {
        line-height: normal;
    }

    .errorMessageLast ul li {
        line-height: normal;
    }

    .errorMessageEmail ul li {
        line-height: normal;
    }

    @media (max-width: 576px) {
        .single-account .context .name {
            font-size: 16px;
            margin: 0;
            white-space: nowrap;
        }

        .single-account .account-img img {
            width: 100%;
            height: 78px;
            min-height: 100%;
        }
    }
</style>
@stack('css')

<style>
    .modal {
        overflow-y: auto;
    }
</style>
