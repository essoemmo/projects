<?php
//Load Navigation
$nav = require_once(resource_path('views/master/layout/include/nav.php'));
//Route::getCurrentRoute()->getPath();
// \Request::route()->uri() ;//\Request::path();

function GetMenu($item, $child = 0) {
    $active ="";
//    echo $item["route"];
    if($item["route"]!==""){
    $index =strpos(\Request::route()->uri() , $item["route"]) ;
    $active =($index >-1)? "active pcoded-trigger" : "";
    
    }
?>

<li class="{{$active}} <?=(isset($item['type']) && $item["type"] == 'item') ? 'pcoded-hasmenu' :'pcoded'?> ">
    <a href="<?= (isset($item['type']) && $item["type"] == 'none') ? url($item["route"]) : 'javascript:void(0)' ?>" class="" >
        <span class="pcoded-micon"><i class="<?=isset($item["icon"])? $item["icon"] : 'ti-view-grid'?>"></i></span>
        <span class="pcoded-mtext" data-i18n="nav.widget.main"> {{$item["label"]}}</span>
        <span class="pcoded-mcaret"></span>
      
    </a>
      
    <?php if (isset($item['type']) && $item["type"] == 'item') { ?>
    <ul class="pcoded-submenu " >
        <?php
        if (isset($item['links'])) {

        foreach ($item['links'] as $sub) {
        if (isset($sub['type']) && $sub["type"] == 'item') {
            ?>
                                <?php
            GetMenu($sub, 1);

        }
         else {
        //  if (!empty($sub["permission"]) && auth()->guard('admin')->user()->can($sub["permission"])) {
        //
             
        ?>
        <li  class=" {{$active}} <?=(isset($item['type']) && $item["type"] == 'item')? "" : 'pcoded'?>">
            <a href="{{url($sub['route'])}}" >

                <span class="pcoded-micon"><i class="ti-view-grid"></i></span>
                <span class="pcoded-mtext" data-i18n="nav.widget.main"> {{$sub["label"]}}</span>
                <span class="pcoded-mcaret"></span>


            </a>
        </li>
        <?php

        }
       
        }
        }

        ?>
    </ul>
    <?php } ?>
    
    
</li>
<?php
}
//    }
?>


<nav class="pcoded-navbar" pcoded-header-position="relative">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
@if (!empty(\App\Bll\Utility::getMasterprofile()->image))
      <img class="img-40" src="{{asset('/uploads/users/'.\App\Bll\Utility::getMasterprofile()->id.'/'.\App\Bll\Utility::getMasterprofile()->image)}}" alt="User-Profile-Image">
               
      @else

      <img class="img-40" src="{{asset('masterAdmin/assets/images/user.png')}}" alt="User-Profile-Image">
@endif
              
 <div class="user-details">
{{--                    <span>{{ admin()->user()->first_name }} {{ admin()->user()->last_name }}</span>--}}
                    <span id="more-details">{{ _i('Admin') }}<i class="ti-angle-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{url('master/settings')}}"><i class="ti-settings"></i>{{ _i('Settings') }}</a>
                        <a href="{{url('master/profile')}}"><i class="ti-user"></i>{{ _i('View Profile') }}</a>
                        <a href="{{ url('master/logout') }}"><i class="ti-layout-sidebar-left"></i>{{ _i('Logout') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">{{ _i('Navigation') }}</div>
        <ul class="pcoded-item pcoded-left-item">
            @foreach($nav as $item)
                <?php GetMenu($item) ?>
            @endforeach



        </ul>

    </div>
</nav>

