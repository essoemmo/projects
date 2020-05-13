<!-- Sidebar Menu -->

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @if(auth()->user()->can('show-security'))
        <li class="nav-item has-treeview {{request()->is('admin/permission/all') || request()->is('admin/role/all') || request()->is('admin/users') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/permission/all') || request()->is('admin/role/all') || request()->is('admin/users') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('security') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('/admin/permission/all')}}"  class="nav-link" style="{{request()->is('admin/permission/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('permissions') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/role/all') }}" class="nav-link" style="{{request()->is('admin/role/all') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('role') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ aUrl('users') }}" class="nav-link" style="{{request()->is('admin/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('users') }}</p>
                    </a>
                </li>
            </ul>
        </li>
       @endif
        @if(auth()->user()->can('show-generalsetting'))
        <li class="nav-item has-treeview {{request()->is('admin/settings') || request()->is('admin/translate') || request()->is('admin/massege/users') || request()->is('admin/slider') ?'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/settings') || request()->is('admin/translate') || request()->is('admin/massege/users') || request()->is('admin/slider') ?'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('Setting') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">

            @if(auth()->user()->can('slider-show'))
                <li class="nav-item">
                    <a href="{{url('admin/slider')}}" style="{{request()->is('admin/slider') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                        <p>{{ _i('Slider') }}</p>

                        <i class="fa fa-ice-cream "></i>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{route('settings-index')}}" style="{{request()->is('admin/settings') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
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

                <li class="nav-item">
                    <a href="{{route('sms.index')}}" style="{{request()->is('admin/translate') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('sms management') }}</p>
                    </a>
                </li>

            </ul>
        </li>
        @endif

{{-- </li>--}}

        @if(auth()->user()->can('show-content_management'))
            <li class="nav-item has-treeview {{request()->is('admin/contentManagementt') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{request()->is('admin/contentManagement') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        {{ _i('content management') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('contentManagement.index')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('content management') }}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('contentManagement.create')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('create management') }}</p>
                        </a>
                    </li>
                </ul>

            </li>
        @endif

        @if(auth()->user()->can('show-banner'))
            <li class="nav-item has-treeview {{request()->is('admin/banner') ||request()->is('admin/banner/create')  ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{request()->is('admin/banner') || request()->is('admin/banner/create')  ? 'active' : ''}}">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        {{ _i('banner management') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('banner.index')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('banner management') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('banner.create')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('create banner') }}</p>
                        </a>
                    </li>
                </ul>

            </li>
        @endif

        @if(auth()->user()->can('show-memberships'))
        <li class="nav-item has-treeview {{request()->is('admin/memberships') || request()->is('admin/memberships/details') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/memberships') || request()->is('admin/memberships/details')? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                        {{ _i('membership') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('memberships.index')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('membership') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('memberships-details.index')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('membership details') }}</p>
                    </a>
                </li>
            </ul>

        </li>
         @endif

        @if(auth()->user()->can('show-banks'))
            <li class="nav-item has-treeview {{request()->is('admin/banks') || request()->is('admin/banks/create') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{request()->is('admin/banks') || request()->is('admin/banks/create')? 'active' : ''}}">
                    <i class="nav-icon fas fa-user-shield"></i>
                    <p>
                        {{ _i('ادارة الدفع') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('banks.index')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                            <i class="fas fa-user-lock nav-icon"></i>
                            <p>{{ _i('البنوك') }}</p>
                        </a>
                    </li>

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('memberships-details.index')}}"  class="nav-link" style="{{request()->is('admin/memberships') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">--}}
{{--                            <i class="fas fa-user-lock nav-icon"></i>--}}
{{--                            <p>{{ _i('membership details') }}</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>

            </li>
        @endif


        @if(auth()->user()->can('show-categories'))
        <li class="nav-item has-treeview {{request()->is('admin/categories') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/categories') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('categories') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link" style="{{request()->is('admin/categories') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('categories') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-material_status'))
        <li class="nav-item has-treeview {{request()->is('admin/material_status')  ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/material_status') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('material_status') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('material_status.index')}}" class="nav-link" style="{{request()->is('admin/material_status') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('material_status') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user()->can('show-Features'))
        <li class="nav-item has-treeview {{request()->is('admin/Features') || request()->is('admin/Features/option') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/Features') || request()->is('admin/Features/option') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('Features') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('Features.index') }}" class="nav-link" style="{{request()->is('admin/Features') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('featureGroup') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('index-Option') }}" class="nav-link" style="{{request()->is('admin/Features/option') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('options') }}</p>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-members'))
        <li class="nav-item has-treeview {{request()->is('admin/members') || request()->is('admin/members/create') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/members') || request()->is('admin/members/create') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('All Members') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('members.index') }}" class="nav-link" style="{{request()->is('admin/members') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('All Members') }}</p>
                    </a>
                </li>
                    @if(auth()->user()->can('member-Add'))
                <li class="nav-item">
                    <a href="{{ route('members.create') }}" class="nav-link" style="{{request()->is('admin/members/create') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('create Members') }}</p>
                    </a>
                </li>
                        @endif

                <li class="nav-item">
                    <a href="{{route('block-member')}}" style="{{request()->is('admin/block/member') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('block user') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('type-member')}}" style="{{request()->is('admin/block/member') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('user type') }}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('setting-member')}}" style="{{request()->is('admin/block/member') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('setting user') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-message-member'))
        <li class="nav-item has-treeview {{request()->is('admin/message/member')  ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/message/member')  ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('converstions') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('converstions.index') }}" class="nav-link" style="{{request()->is('admin/members') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('All converstions') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-stories'))
        <li class="nav-item has-treeview {{request()->is('admin/Stories') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/Stories') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('Stories') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('Stories.index') }}" class="nav-link" style="{{request()->is('admin/Stories') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('All Stories') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-categoryArticle'))
        <li class="nav-item has-treeview {{request()->is('admin/categoryArticle') || request()->is('admin/articles') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/categoryArticle') || request()->is('admin/articles') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('Article') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('categoryArticle.index') }}" class="nav-link" style="{{request()->is('admin/categoryArticle') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('CategoryArticle') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('articles.index') }}" class="nav-link" style="{{request()->is('admin/articles') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('Article Mangement') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-Bestmember'))
        <li class="nav-item has-treeview {{request()->is('admin/Bestmember')  ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/Bestmember')  ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('Bestmember') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('Bestmember.index') }}" class="nav-link" style="{{request()->is('admin/categoryArticle') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('Bestmember') }}</p>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-ActiveMember'))
        <li class="nav-item has-treeview {{request()->is('admin/ActiveMember')  ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/Activemember')  ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('ActiveMember') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('Activemember.index') }}" class="nav-link" style="{{request()->is('admin/categoryArticle') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>{{ _i('ActiveMember') }}</p>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        @if(auth()->user()->can('show-massege-user'))
        <li class="nav-item has-treeview {{request()->is('admin/massege/users') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/massege/users') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('UserMassege') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                                    <a href="{{url('admin/massege/users')}}" style="{{request()->is('admin/massege/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                                    <p>{{ _i('UserMassege') }}</p>
                       <i class="fa fa-user "></i>
                  </a>
               </li>
            </ul>

        </li>
        @endif
        @if(auth()->user()->can('show-subscriped'))
        <li class="nav-item has-treeview {{request()->is('admin/subscriped') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->is('admin/subscriped') ? 'active' : ''}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    {{ _i('subscriped') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('admin/new/letter')}}" style="{{request()->is('admin/massege/users') ?'background-color:rgba(255,255,255,.1);color:#fff;' : ''}}" class="nav-link">
                        <p>{{ _i('subscriped') }}</p>
                        <i class="fa fa-user "></i>
                    </a>
                </li>
            </ul>

        </li>
        @endif

    </ul>
</nav>
<!-- /.sidebar-menu -->
