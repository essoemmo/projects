<?php

$setting_template = \App\Models\Settings\Setting::where('store_id', \App\Bll\Utility::getStoreId())->first();
if ($setting_template!=null && $setting_template->template_id != null) {
    $template = \App\Models\Template::where('id', $setting_template->template_id)->first();
    $layout_code = $template['code'];
} else {
    $template = \App\Models\Template::first();
    $layout_code = $template['code'];
}
//get from database here
//$layout ="purple";
//$layout ="default";

if (request()->get("code") !== null) {
    $layout_code = request()->get("code");
}
//$layout ="shade";
$layout = "store.layout." . $layout_code;

    ?>
@if($layout_code=="shade")
    @include($layout.'.page');

@else

?>

@include($layout.'.header')
@include('store.layout.fav')
@yield('content')

@include('store.layout.modal')
@include("store.layout.message")
@include($layout.'.footer')

@include('store.layout.addCart')
@include('store.layout.features')
@endif