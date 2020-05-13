@extends('front.layout.welcome')


@section('content')
<nav aria-label="breadcrumb" class="welcome">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page"> الشهادة</li>
        </ol>
    </div>
</nav>


<section class="register-form common-wrapper ">
<!--<section class="contact-page common-wrapper">-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <a target="pdf" class="btn btn-app" href="<?= config("app.api_url")?>/user/pdf/<?=$course_id?>">
                        <i class="fa fa-print"></i> طباعه
                    </a>
                </center>
            </div>
        </div>
    </div>
    <div class="row"> &nbsp;</div>
    <?php
    echo file_get_contents(config("app.api_url") . "/user/cert/" . $course_id);
    ?>

</section>
<script type="text/javascript">
    function print()
    {
         var win =      window.open('<?= config("app.api_url")?>/user/pdf/'.$course_id, "myActionWin", "width=500,height=300,toolbar=0");
        // win.print();
    }
    </script>
@endsection

