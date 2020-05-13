<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul @if(LaravelGettext::getLocale() == "ar") class="navbar-nav mr-auto" @else class="navbar-nav ml-auto" @endif>

        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ url('/') }}/adminPanel/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="{{ auth()->user()->username }}">
                <span class="hidden-xs">{{auth()->user()->username}}</span>
            </a>
            <ul @if(LaravelGettext::getLocale() == "ar") class="dropdown-menu dropdown-menu-lg dropdown-menu-left" @else class="dropdown-menu dropdown-menu-lg dropdown-menu-right" @endif>
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ url('/') }}/adminPanel/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{auth()->user()->username}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">{{_('Profile')}}</a>
                        <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat float-right">{{ _i('Sign out') }}</a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-globe-africa"></i>
            </a>
            <ul @if(LaravelGettext::getLocale() == "ar") class="dropdown-menu dropdown-menu-lg dropdown-menu-left" @else class="dropdown-menu dropdown-menu-lg dropdown-menu-right" @endif>
                    <li class="nav-item">
                        <ul class="list-unstyled" id="langs">

                        </ul>
                    </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('adminHome')}}" class="brand-link">
        @if(settings()->loge != null)

                <img src="{{ asset('uploads/setting/' . settings()->loge) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

        @endif
        <span class="brand-text font-weight-light">
            @if(settings()->title != null)
                {{ settings()->title }}
            @else
                Zawag
            @endif
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('/')}}/adminPanel/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->username}}</a>
            </div>
        </div>

        @include('admin.layouts.menu')
    </div>
    <!-- /.sidebar -->
</aside>

@push('js')
<script>
    $(function(){
        $.ajax({
            url:"{{route('admin.languages')}}",
            success:(res)=>{
                console.log(res);
                if(res == null) return false;
                $('#langs').html('');
                res.forEach(lang => {
                    $('#langs').append(`<li><form action="{{aUrl('change_language')}}" method="get">
                    <input type="hidden" name="selLanguage" value="${lang.name}"/>
                    <button type="submit" class="btn btn-default btn-block">${lang['name']}</button></form></li>`);
                });
            },
            error:(err)=>{
                console.log(err);
            }
        });
    });
</script>
@endpush
