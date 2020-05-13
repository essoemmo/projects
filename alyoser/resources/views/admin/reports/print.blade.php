@extends('admin.layout.master')
@section('content')

    <div>

<textarea rows="5" cols="50">
<?php
    $file = file_get_contents($url, FILE_USE_INCLUDE_PATH);
    echo $file;
    ?>
</textarea>

    </div>



@endsection





