<link href="https://fonts.googleapis.com/css?family=Cairo:400,700&display=swap" rel="stylesheet">
<style rel="stylesheet" type="text/css">
  body {
        font-family: 'Cairo', sans-serif;
      
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
* {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
    color-adjust: exact !important;                 /*Firefox*/
}


    .certificate {
        background: white url("{{asset('cert/bg.png')}}") center center no-repeat;
        width: 60%;
        min-height: 245px;
        padding: 1em 2em;
        text-align: center;
        margin: auto;
        position: relative;
        box-shadow: 0 0 0 1px #C3C3C3, 0 0 0 3px white, 0 0 0 8px #000, 0 0 0 10px white, 0 0 0 11px #C3C3C3;
        overflow: hidden;
    }

    .certificate-number {
        text-align: left;
        direction: rtl;
    }

    .logo {
        position: absolute;
        top: 2%;
        right: 2%;
    }

    .main-title {
        text-align: center;
        font-size: 40px;
        font-weight: 700;
        margin-top: 1em;
        margin-bottom: 1.5em;
    }

    .bold {
        font-weight: 700;
    }

    p {
        font-size: 25px;
        line-height: 40px;
    }

    .ceo {
        float: left;
        margin-left: 15%;
        margin-top: 3em;
        background-image:  url("{{asset('cert/sign2.png')}}") ;
        background-position-x: left;
    background-repeat: no-repeat;
    background-size: 149px;
    }

    .barcode {
        width: 100px;
        height: 100px;
        position: absolute;
        bottom: 1%;
        left: 1%;

    }

    .barcode img {
        width: 100%;
        height: 100%;

    }

    .seal {
        width: 200px;
        height: auto;
        margin-left: 60%;
    }

    .seal img {
        width: 100%;
        
    }

    .footer-note {
        text-align: right;
        margin-top: 4em;
        font-size: 14px;
    }

    .footer-note:before {
        content: '\25CF ';
    }
</style>

<div class="certificate">
    <div class="certificate-number">
        <strong>شهادة رقم :</strong>
        <?= $result->cert_no ?>
    </div>
    <div class="logo"><img src="{{asset('cert/logo.png')}}" alt=""></div>
    <h1 class="main-title">شهادة تدريب</h1>
    <div class="clearfix"></div>
    <p>تشهد جمعية حائل للتنمية البشرية بأن</p>
    <p>
        {{$result->first_name}} {{$result->last_name}}
    </p>
    <p class="bold">سجل مدني رقم : 
        {{$result->personal_id}}
    </p>
    <p>قد اجتاز/ت الدورة التدريبية بعنوان :</p>
    <p class="bold"> {{$result->title}} 
    </p>
    <p>وذلك بتاريخ 
        <?= $hijri_day ?>    <?= $hijri_month ?>    <?= $hijri_year ?>
        هـ
        الموافق
        <span style="direction:rtl">     {{$date}} </span>
        م
        لمدة 
        (<?= $time["days"] ?>) 
        بواقع
        (<?= $result->duration ?>) ساعة
    </p>
    <p>متمنيين له دوام التوفيق ،،</p>

    <div class="ceo" style=''>
        <!--<img src="{{asset('cert/sign.png')}}" alt="">-->
        <strong>المدير العام</strong>
        <br>
        <br>
        <br>
        <strong>على بن عماش الشمرى</strong>
    </div>

    <div class="seal"><img src="{{asset('cert/seal.png')}}" alt=""></div>

    <div class="barcode">
        {!! QrCode::size(100)->generate(url('/')."/user/cert/".$result->cert_no); !!}
        <p>Scan me to return to the original page.</p>
    </div>

    <div class="footer-note"> للتحقق من الشهادة الرجاء الدخول علي موقع الجمعية ( http://www.hailh.org.sa/ ) والضغط على
        أيقونة ( التحقق من الشهادة )
    </div>
</div>

