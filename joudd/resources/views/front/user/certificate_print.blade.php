<body dir="rtl">
<style rel="stylesheet" type="text/css">
    body {
        font-family: 'Cairo', sans-serif;
        margin: 5vh auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

 
</style>
<?php
    echo file_get_contents(config("app.api_url") . "/user/cert/" . $course_id);
    ?>
</body>