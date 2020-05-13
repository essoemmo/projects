<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            body {
                  

                  direction: rtl;
                
                  margin: 5vh auto;
                  -webkit-font-smoothing: antialiased;
                  -moz-osx-font-smoothing: grayscale;
           
     
        line-height: 10px;


    }
    * {
        -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
        color-adjust: exact !important;                 /*Firefox*/
    }


    .certificate {
        background: white url("{{asset('cert/bg.png')}}") center center no-repeat;


        padding: 1em 2em;
        text-align: center;
        margin: auto;
        position: relative;
        box-shadow: 0 0 0 1px #C3C3C3, 0 0 0 3px white, 0 0 0 8px #000, 0 0 0 10px white, 0 0 0 11px #C3C3C3;
        overflow: hidden;
    }

    .certificate-number {
        text-align: left;
        position: absolute;
        top: 10%;
        left: 10%;
        font-size: 14px;
        direction: rtl
            
    }

    .logo {
        position: absolute;
        top: 10%;
        right: 10%;
        text-align: right;

    }

    .main-title {
        text-align: center;
        font-size: 40px;
        font-weight: 700;
        margin-top: 1em;
        margin-bottom: 1.5em;

        top: -100px;
    }

    .bold {
        font-weight: bold;
    }

    p {
        font-size: 25px;

    }

    .ceo {
        /*        float: left;
                margin-left: 15%;
                margin-top: -20px;*/
        background-image:  url("{{asset('cert/sign2.png')}}") ;
        background-size: 600px;
        background-repeat: no-repeat;background-position: center; 
        background-position: 90 0px !important;
/*      //  background-position-x: right;
        //
       // */
    }

    .barcode {

        position: absolute;
        bottom: 10%;


    }

    .barcode img {
        width: 100%;
        height: 100%;


    }

    .seal {
        width: 200px;
        height: auto;
        margin-right: 50px;
        top:-20px;
        position: relative

    }

    .seal img {
        width: 100%;
        top: -80px;
        position: absolute
    }

    .footer-note {
        text-align: right;
        position: absolute;
        font-size: 10px;
        margin-top: -50px;
        float :right;
        right: 70px;
    }

    /*    .footer-note:before {
            content: '\25CF ';
        }*/
    .column {
        float: right;
        width: 33.33%;
        height: 200px;
        
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>

    </head>
    <body>
        <div class="certificate">

            <h1 class="main-title">شهادة تدريب</h1>
            <div class="clearfix"></div>
            <p>تشـــــهد جمعيــــــة حائــــــل للتنميــــــة البشــــــرية بـــــــأن</p>
            <p class="bold">
                {{$result->first_name}} {{$result->last_name}} 
            </p>
            <p class="bold">سجل مدني رقم : 
                {{$result->personal_id}}
            </p>
            <p>قــــــــد اجتـــــــــــاز/ت الــــــدورة التدريبيـــــــة بعنـــــوان :</p>
            <p class="bold"> {{$result->title}} 
            </p>
            <p>وذلك بتاريخ 
                <?= $hijri_day ?> - <?= $hijri_month ?> -  <?= $hijri_year ?>
                هـ
                الموافق
                <span style="direction:rtl">     {{$date}} </span>
                م
                لمدة 
                (<?= $time["days"] ?>) 
                يوم
                بواقع
                (<?= $result->duration ?>) ساعة
            </p>
            <p>متمنيين له دوام التوفيق ،،</p>

            <div class="row">
                <div class="column"><img src="{{asset('cert/seal.png')}}" alt="" style="width:200px" class="seal"></div>
                <div class="column"> <p> </p></div>
                <div class="column ceo">المدير العام
                    <br>
                    <br>
                    <br>
                    <strong>على بن عماش الشمرى</strong>
                </div>
            </div>
            <!--            <div class="ceo" style=''>
                            <img src="{{asset('cert/seal.png')}}" alt="" style="width:200px" class="seal">
                            <img src="{{asset('cert/sign.png')}}" alt="">
                            المدير العام
                            <br>
                            <br>
                            <br>
                            <strong>على بن عماش الشمرى</strong>
                        </div>
            
                        <div class="seal"></div>-->


        </div>
    </body>
</html>



