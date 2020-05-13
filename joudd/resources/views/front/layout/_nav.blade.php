


<li class="active treeview">


@if(auth()->user()->can('Role-Add')|auth()->user()->can('Role-Edit')|auth()->user()->can('Role-Delete')
    |auth()->user()->can('User-Edit')|auth()->user()->can('User-Delete'))
{{-- roles --}}
<li class="treeview {{(request()->is('admin/group/*') || request()->is('admin/user/*')||request()->is('admin/allRoles')
||request()->is('admin/role/*')) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-key"></i> <span>  {{_i('Roles')}} </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">

        @if(auth()->user()->can('Role-Add')|auth()->user()->can('Role-Edit')|auth()->user()->can('Role-Delete'))
        <li class="treeview {{(request()->is('admin/group/*') ||request()->is('admin/allRoles')||request()->is('admin/role/*') ) ? 'active' : '' }}">
            <a href="#"><i class="fa fa-circle-o"></i> {{_i('Roles Management')}}
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
                @if(auth()->user()->can('Role-Add'))
                    <li class="{{(request()->is('admin/group/add')) ? 'active' : '' }} "><a href="{{url('/admin/group/add')}}"><i class="fa fa-circle-o"></i>{{_i('Add Role')}}</a></li>
                @endif
                @if(auth()->user()->can('Role-Delete','Role-Edit'))
                    <li class="{{request()->is('admin/allRoles') ? 'active' : ''}}"><a href="{{url('admin/allRoles')}}"><i class="fa fa-circle-o"></i> {{_i('Roles Management')}} </a></li>
                @endif

            </ul>
        </li>
        @endif

          {{------------- users -----------------}}
        @if(auth()->user()->can('User-Edit')|auth()->user()->can('User-Delete')|auth()->user()->can('User-Add'))
        <li class="treeview {{(request()->is('admin/user/*')) ? 'active':''}}">
            <a href="#"><i class="fa fa-circle-o"></i> {{_i('Users')}}
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu">
                @if(auth()->user()->can('User-Add'))
                    <li class="{{(request()->is('admin/user/create')) ? 'active':''}}"><a href="{{url('/admin/user/create')}}"><i class="fa fa-circle-o"></i> {{_i('New User')}} </a></li>
                @endif
                @if(auth()->user()->can('User-Edit','User-Delete'))
                    <li class="{{(request()->is('admin/user/all')) ? 'active':''}}"><a href="{{url('/admin/user/all')}}"><i class="fa fa-circle-o"></i> {{_i('Users')}} </a></li>
                @endif

            </ul>
        </li>
        @endif
        {{-------------------------------- Permission ------------------------------------------}}
@if(auth()->user()->can('Permission-Add'))
        <li ><a href="{{url('/admin/permission/create')}}"><i class="fa fa-circle-o"></i> {{_i('Add Permission')}} </a></li>
 @endif
@if(auth()->user()->can('Permission-Edit')|auth()->user()->can('Permission-Delete'))
        <li ><a href="{{url('/admin/permissions')}}"><i class="fa fa-circle-o"></i> {{_i('Permissions')}} </a></li>

        {{--<li><a href="{{url('/admin/userRoles')}}"><i class="fa fa-circle-o"></i> User Roles </a></li>--}}
 @endif
    </ul>

  </li>
</li>

@endif



{{-------------------------------------------------- Courses --------------------------------}}
@if(auth()->user()->can('Course-Add')|auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete')|auth()->user()->can('Trainer-Add')
    |auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete')|auth()->user()->can('Applicant-Add')|auth()->user()->can('Applicant-Edit')
    |auth()->user()->can('Applicant-Delete')|auth()->user()->can('CourseCategory-Add')|auth()->user()->can('CourseCategory-Edit')|auth()->user()->can('CourseCategory-Delete'))



        {{------------- courses -----------------}}
        @if(auth()->user()->can('Course-Add')|auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete')|
        auth()->user()->can('CourseCategory-Add')|auth()->user()->can('CourseCategory-Edit')|auth()->user()->can('CourseCategory-Delete'))
            <li class="treeview {{(request()->is('admin/course/create')||request()->is('admin/course/*')||request()->is('admin/course/category/all')
                ||request()->is('admin/course/question/index_course_question')||request()->is('admin/courses/applicants/applicant_result/index')
                ||request()->is('admin/courses/discount_codes/index_discount_codes')||request()->is('admin/course/bank_transfer/all')) ? 'active':''}}">
                <a href="#"><i class="fa fa-circle-o"></i> {{_i('Courses')}}
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>

                <ul class="treeview-menu">
                    @if(auth()->user()->can('Course-Add'))
                        <li class="{{(request()->is('admin/course/create')) ? 'active':''}}"><a href="{{url('/admin/course/create')}}"><i class="fa fa-circle-o"></i> {{_i('New Course')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete'))
                        <li class="{{(request()->is('admin/course/all')) ? 'active':''}}"><a href="{{url('/admin/course/all')}}"><i class="fa fa-circle-o"></i> {{_i('Courses')}} </a></li>
                    @endif
                    @if(auth()->user()->can('CourseCategory-Add')|auth()->user()->can('CourseCategory-Edit')|auth()->user()->can('CourseCategory-Delete'))
                        <li class="{{(request()->is('admin/course/category/all'))?'active':''}}"><a href="{{url('/admin/course/category/all')}}"><i class="fa fa-circle-o"></i> {{_i('Course Categories')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete'))
                        <li class="{{(request()->is('admin/course/question/index_course_question'))?'active':''}}"><a href="{{route('index_course_question')}}"><i class="fa fa-circle-o"></i> {{_i('Course Questions')}} </a></li>

                        <li class="{{(request()->is('admin/courses/applicants/applicant_result/index'))?'active':''}}"><a href="{{route('index_applicant_result')}}"><i class="fa fa-circle-o"></i> {{_i('Course Result')}} </a></li>
                        <li class="{{(request()->is('admin/courses/discount_codes/index_discount_codes'))?'active':''}}"><a href="{{route('index_discount_codes')}}"><i class="fa fa-circle-o"></i> {{_i('Discount Codes Generator')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete'))
                        <li class="{{(request()->is('admin/course/bank_transfer/all')) ? 'active':''}}"><a href="{{url('/admin/course/bank_transfer/all')}}"><i class="fa fa-circle-o"></i> {{_i('Bank Transfers')}} </a></li>
                    @endif

                </ul>
            </li>
        @endif
        {{------------- trainers -----------------}}
        @if(auth()->user()->can('Trainer-Add')|auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete'))
            <li class="treeview {{(request()->is('admin/trainer/*')||request()->is('admin/course/question/index_trainer_question')) ? 'active':''}}">
                <a href="#"><i class="fa fa-circle-o"></i> {{_i('Trainers')}}
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>

                <ul class="treeview-menu">
                    @if(auth()->user()->can('Trainer-Add'))
                        <li class="{{(request()->is('admin/trainer/create')) ?'active':''}}"><a href="{{url('/admin/trainer/create')}}"><i class="fa fa-circle-o"></i> {{_i('New Trainer')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete'))
                        <li class="{{(request()->is('admin/trainer/all')) ?'active':''}}"><a href="{{url('/admin/trainer/all')}}"><i class="fa fa-circle-o"></i> {{_i('Trainers')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete'))
                        <li class="{{(request()->is('admin/trainer/report')) ?'active':''}}"><a href="{{url('/admin/trainer/report')}}"><i class="fa fa-circle-o"></i> {{_i('Trainers Reports')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete'))
                        <li class="{{(request()->is('admin/course/question/index_trainer_question')) ?'active':''}}"><a href="{{route('index_trainer_question')}}"><i class="fa fa-circle-o"></i> {{_i('Trainer Questions')}} </a></li>
                    @endif

                </ul>
            </li>
        @endif
        {{------------- Applicants -----------------}}
        @if(auth()->user()->can('Applicant-Add')|auth()->user()->can('Applicant-Edit')|auth()->user()->can('Applicant-Delete')|
        auth()->user()->can('ApplicantPending-Add')|auth()->user()->can('ApplicantPending-Delete'))
            <li class="treeview {{(request()->is('admin/course/applicant/create')||request()->is('admin/course/applicant/all')||
            request()->is('admin/course/applicant/pending/all')) ? 'active':''}}">
                <a href="#"><i class="fa fa-circle-o"></i> {{_i('Applicants')}}
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>

                <ul class="treeview-menu">
                    @if(auth()->user()->can('Applicant-Add'))
                        <li class="{{(request()->is('admin/course/applicant/create'))?'active':''}}"><a href="{{url('/admin/course/applicant/create')}}"><i class="fa fa-circle-o"></i> {{_i('New Applicant')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Applicant-Edit')|auth()->user()->can('Applican-Delete'))
                        <li class="{{(request()->is('admin/course/applicant/all'))?'active':''}}"><a href="{{url('/admin/course/applicant/all')}}"><i class="fa fa-circle-o"></i> {{_i('Applicants')}} </a></li>
                    @endif
                    @if(auth()->user()->can('ApplicantPending-Add')|auth()->user()->can('ApplicantPending-Delete'))
                        <li class="{{(request()->is('admin/course/applicant/pending/all'))?'active':''}}"><a href="{{url('/admin/course/applicant/pending/all')}}"><i class="fa fa-circle-o"></i> {{_i('Pendings')}} </a></li>
                    @endif
                </ul>
            </li>
        @endif

   

@endif













