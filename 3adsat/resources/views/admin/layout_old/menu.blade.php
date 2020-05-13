<!-- Sidebar Menu -->

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        {{ _i('Dashboard') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('Dashboard') }}</p>
                        </a>
                    </li>
                </ul>
            </li>

        <li class="nav-item has-treeview {{request()->is('admin/panel/permission/all') || request()->is('admin/panel/role/all') || request()->is('admin/panel/users') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/panel/permission/all') || request()->is('admin/panel/role/all') || request()->is('admin/panel/users') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('security') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('/admin/panel/permission/all')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('permissions') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/panel/role/all') }}" class="nav-link" style="{{request()->is('admin/role/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('role') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/panel/users') }}" class="nav-link" style="{{request()->is('admin/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('users') }}</p>
                    </a>
                </li>
            </ul>
        </li>

            <li class="nav-item has-treeview {{request()->is('admin/panel/settings') || request()->is('admin/panel/translate') || request()->is('admin/panel/massege/users') || request()->is('admin/panel/slider') ?'menu-open' : ''}}">
                <a href="#" class="nav-link {{request()->is('admin/panel/settings') || request()->is('admin/panel/translate') || request()->is('admin/panel/massege/users') || request()->is('admin/panel/slider') ?'active' : ''}}">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        {{ _i('Setting') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('countries.index')}}" style="{{request()->is('admin/translate') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('countries') }}</p>
                        </a>
                    </li>

                        <li class="nav-item">
                            <a href="{{url('admin/panel/slider')}}" style="{{request()->is('admin/panel/slider') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                                <p>{{ _i('Slider') }}</p>

                                <i class="fa fa-ice-cream "></i>
                            </a>
                        </li>

                    <li class="nav-item">
                            <a href="{{url('admin/panel/settings/homepage/')}}" style="{{request()->is('admin/panel/settings/homepage') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                                <p>{{ _i('HomePage') }}</p>

                                <i class="fa fa-ice-cream "></i>
                            </a>
                        </li>


                    <li class="nav-item">
                        <a href="{{route('settings-index')}}" style="{{request()->is('admin/panel/settings') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('GeneralSetting') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('translation.index')}}" style="{{request()->is('admin/translate') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('Translation') }}</p>
                        </a>
                    </li>

                </ul>
            </li>


        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('General') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('categories.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('category') }}</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            {{ _i('products') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('products.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>{{ _i('products') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('spheres.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>{{ _i('spheres') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('cylinder.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>{{ _i('cylinder') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('axis.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>{{ _i('Axis') }}</p>
                            </a>
                        </li>
                        <!----- rate ---->
                        <li class="nav-item">
                            <a href="{{url('/admin/panel/rating/all')}}"  class="nav-link" style="{{request()->is('admin/panel/rating/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fa fa-genderless "></i>
                                <p>{{ _i('Rate') }}</p>
                            </a>
                        </li>

                    </ul>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            {{ _i('attributes') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('attributegroups.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>{{ _i('attributesGroup') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('attributes.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>{{ _i('attributes') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('manufacturers.index')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('manufacturers') }}</p>
                    </a>
                </li>
            </ul>

        <li class="nav-item">
            <a href="{{url('/admin/panel/contact/all')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                <i class="fas fa-envelope nav-icon"></i>
                <p>{{ _i('Contacts') }}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{url('/admin/panel/newsletters/all')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                <i class="fas fa-bell nav-icon"></i>
                <p>{{ _i('News Letters') }}</p>
            </a>
        </li>

        <!--- ARTICLES ---->

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    {{ _i('Content Management') }}
                    <i class="right fas fa-edit-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class=" nav-icon fas fa-book"></i>
                        <p>
                            {{ _i('Category') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/panel/artcle_category/create')}}"  class="nav-link" style="{{request()->is('admin/panel/artcle_category/create') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class=" fa  fa-plus "></i>
                                <p>{{ _i('Add') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/panel/artcle_category/all')}}"  class="nav-link" style="{{request()->is('admin/panel/artcle_category/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class=" fa  fa-genderless "></i>
                                <p>{{ _i('All') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
<!---- articles ------->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file  "></i>
                        <p>
                            {{ _i('Articles') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/panel/article/create')}}"  class="nav-link" style="{{request()->is('admin/panel/article/create') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fa  fa-plus "></i>
                                <p>{{ _i('Add') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/panel/article/all')}}"  class="nav-link" style="{{request()->is('admin/panel/article/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                                <i class="fa  fa-genderless "></i>
                                <p>{{ _i('All') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>




        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
