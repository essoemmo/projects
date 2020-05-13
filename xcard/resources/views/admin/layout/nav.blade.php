<?php
//Load Navigation
$nav = require_once(resource_path('views/admin/layout/include/nav.php'));
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
                <img class="img-40" src="{{asset('adminPanel/assets/images/user.png')}}" alt="User-Profile-Image">
                <div class="user-details">
                    <span>{{ admin()->user()->first_name }} {{ admin()->user()->last_name }}</span>
                    <span id="more-details">{{ _i('Admin') }}<i class="ti-angle-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{url('admin/profile')}}"><i class="ti-user"></i>{{ _i('View Profile') }}</a>
                        <a href="{{aUrl('setting')}}"><i class="ti-settings"></i>{{ _i('Settings') }}</a>
                        <a href="{{ aUrl('logout') }}"><i class="ti-layout-sidebar-left"></i>{{ _i('Logout') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5">{{ _i('Navigation') }}</div>
        <ul class="pcoded-item pcoded-left-item">
   @foreach($nav as $item)
                <?php GetMenu($item) ?>
            @endforeach

<!--            <li class="pcoded-hasmenu "> -  if active want => add (active pcoded-trigger) to class -
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">   -  if active want => add (active) to class -
                        <a href="index.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Default</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="dashboard-ecommerce.html">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.ecommerce">Ecommerce</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="ti-layout"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.page_layout.main">Page layouts</span>
                    <span class="pcoded-badge label label-warning">NEW</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">

                    <li class=" pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
                            <span class="pcoded-mtext">Vertical</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="menu-static.html" >
                                    <span class="pcoded-micon"><i class="icon-chart"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.page_layout.vertical.static-layout">Static Layout</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class=" ">
                        <a href="menu-bottom.html">
                            <span class="pcoded-micon"><i class="icon-pie-chart"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.page_layout.bottom-menu">Bottom Menu</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>

-->



         

        </ul>

    </div>
</nav>

