<!DOCTYPE html>
<html lang="{{LaravelGettext::getLocale()}}" @if(LaravelGettext::getLocale() == "ar") dir="rtl" @else dir="ltr" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ !empty($title)?$title:trans('admin.title') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/adminPanel/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('/') }}/adminPanel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/') }}/adminPanel/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/adminPanel/dist/css/dropzone.css">

    @if(LaravelGettext::getLocale() == "ar")
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('/') }}/adminPanel/dist/css/rtl/bootstrap-rtl.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/adminPanel/dist/css/rtl/custom-style.css">
        <link rel="stylesheet" href="https://parsleyjs.org/src/parsley.css">
        <style>
            .nav-icon {
                float: right;
            }
        </style>
    @endif
    @yield('css')

    <link rel="stylesheet" href="{{ asset('adminPanel/plugins/noty/noty.css') }}">
    <script src="{{ asset('adminPanel/plugins/noty/noty.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
