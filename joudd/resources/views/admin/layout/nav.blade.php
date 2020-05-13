


<li class="active treeview">


    <!--- ============================ settings ====================== --->
@if(auth()->user()->can('Settings-Edit')|auth()->user()->can('Settings-Delete')|auth()->user()->can('Settings-Add') |
 auth()->user()->can('Currency-Edit')|auth()->user()->can('Currency-Delete')|auth()->user()->can('Currency-Add') |
  auth()->user()->can('Country-Edit')|auth()->user()->can('Country-Delete')|auth()->user()->can('Country-Add') |
      auth()->user()->can('City-Edit')|auth()->user()->can('City-Delete')|auth()->user()->can('City-Add')  )

<li class="treeview {{request()->is('admin/settings') || request()->is('admin/price_setting')|| request()->is('admin/currency') ||
     request()->is('admin/country/*') || request()->is('admin/city/*')||request()->is('admin/groups/all')
     ||request()->is('admin/notification/to') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-dashboard"></i> <span>  {{_i('Settings')}} </span>
        <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">


        @if(auth()->user()->can('Settings-Edit')|auth()->user()->can('Settings-Delete')|auth()->user()->can('Settings-Add'))
            {{------------- site settings  -----------------}}
            <li class="{{request()->is('admin/settings')? 'active' : ''}}">
                <a href="{{url('/admin/settings')}}">
                    <i class="fa fa-cogs"></i> <span>{{_i('Site Settings')}}</span>
                </a>
            </li>

            <li  class="{{request()->is('admin/price_setting') ? 'active' : ''}}">
            <a href="{{url('/admin/price_setting')}}">
                <i class="fa fa-dollar"></i> <span>{{_i('Comission Setting')}}</span>
            </a>
        </li>
        @endif

        @if(auth()->user()->can('Currency-Edit')|auth()->user()->can('Currency-Delete')|auth()->user()->can('Currency-Add'))
        <li  class="{{request()->is('admin/currency') ? 'active' : ''}}">
            <a href="{{url('/admin/currency')}}">
                <i class="fa fa-dollar"></i> <span>{{_i('Currencies')}}</span>
            </a>
        </li>
        @endif

        {{------------- countries -----------------}}
        @if(auth()->user()->can('Country-Edit')|auth()->user()->can('Country-Delete')|auth()->user()->can('Country-Add'))

                    @if(auth()->user()->can('Country-Edit','Country-Delete'))
                        <li class="{{(request()->is('admin/country/all')) ? 'active':''}}"><a href="{{url('/admin/country/all')}}"><i class="fa fa-circle-o"></i> {{_i('Countries')}} </a></li>
                    @endif
        @endif

        {{------------- cities -----------------}}
        @if(auth()->user()->can('City-Edit')|auth()->user()->can('City-Delete')|auth()->user()->can('City-Add'))
<!--            <li class="treeview {{(request()->is('admin/city/*')) ? 'active':''}}">
                <a href="#"><i class="fa fa-circle-o"></i> {{_i('Cities')}}
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>

                <ul class="treeview-menu">
                    @if(auth()->user()->can('City-Add'))
                        <li class="{{(request()->is('admin/city/all')) ? 'active':''}}"><a href="{{url('/admin/city/all')}}"><i class="fa fa-circle-o"></i> {{_i('All')}} </a></li>
                    @endif
                </ul>
            </li>-->
        @endif

        <!--------------------- notifications & groups  ------------------>
            @if(auth()->user()->can('Groups-Edit')|auth()->user()->can('Groups-Delete')|auth()->user()->can('Groups-Add'))
                <li class="{{(request()->is('admin/groups/all')) ? 'active':''}}"><a href="{{url('/admin/groups/all')}}"><i class="fa fa-circle-o"></i> {{_i('Groups')}} </a></li>
            @endif
            @if(auth()->user()->can('Notification-Show'))
                <li class="{{(request()->is('admin/notification/to')) ? 'active':''}}"><a href="{{url('/admin/notification/to')}}"><i class="fa fa-circle-o"></i> {{_i('Send Notification')}} </a></li>
            @endif

    </ul>

</li>
@endif
<!--========================= end settings section =============================--->

@if(auth()->user()->can('Role-Add')|auth()->user()->can('Role-Edit')|auth()->user()->can('Role-Delete')
    |auth()->user()->can('User-Edit')|auth()->user()->can('User-Delete'))
{{-- roles --}}
<li class="treeview {{(request()->is('admin/group/*') || request()->is('admin/user/*')||request()->is('admin/allRoles')
||request()->is('admin/role/*') ) ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-key"></i> <span>  {{_i('Security')}} </span>
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
<!-----======================= end security section============================= --->

<!--- ============================ articles ====================== --->
@if(auth()->user()->can('Article-Add')| auth()->user()->can('Article-Edit') |auth()->user()->can('Article-Delete') |
auth()->user()->can('ArticleCategory-Add')| auth()->user()->can('ArticleCategory-Edit') |auth()->user()->can('ArticleCategory-Delete') )
<li class="treeview {{request()->is('admin/article/*')||request()->is('admin/artcle_category/*')  ? 'active' : '' }}">
    <a href="#"><i class="fa fa-edit"></i> <span>  {{_i('Content Management')}} </span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        {{------------- article  -----------------}}
        @if(auth()->user()->can('Article-Add')| auth()->user()->can('Article-Edit') |auth()->user()->can('Article-Delete'))
        <li class="treeview {{(request()->is('admin/article/*')) ? 'active' : '' }}">
            <a href="#"><i class="fa fa-circle-o"></i> {{_i('Article')}}
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
                <li class="{{(request()->is('admin/article/create')) ? 'active' : '' }} "><a href="{{url('/admin/article/create')}}"><i class="fa fa-circle-o"></i>{{_i('Add')}}</a></li>
                <li class="{{(request()->is('admin/article/all')) ? 'active' : '' }}"><a href="{{url('/admin/article/all')}}"><i class="fa fa-circle-o"></i> {{_i('All')}} </a></li>
            </ul>
        </li>
        @endif
        {{------------- artcl categories -----------------}}
        @if(auth()->user()->can('ArticleCategory-Add')| auth()->user()->can('ArticleCategory-Edit') |auth()->user()->can('ArticleCategory-Delete'))
        <li class="treeview {{(request()->is('admin/artcle_category/*')) ? 'active':''}}">
            <a href="#"><i class="fa fa-circle-o"></i> {{_i('Category')}}
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{(request()->is('admin/artcle_category/create')) ? 'active':''}}"><a href="{{url('/admin/artcle_category/create')}}"><i class="fa fa-circle-o"></i> {{_i('Add')}} </a></li>
                <li class="{{(request()->is('admin/artcle_category/all')) ? 'active':''}}"><a href="{{url('/admin/artcle_category/all')}}"><i class="fa fa-circle-o"></i> {{_i('All')}} </a></li>
            </ul>
        </li>
        @endif

    </ul>
</li>
@endif

 <!-- =========================== gallery ================================-->
            @if( auth()->user()->can('Gallery-Edit') |auth()->user()->can('Gallery-Delete') |auth()->user()->can('Gallery-Add'))
                <li class="treeview {{request()->is('admin/gallery/*')? 'active':''}}">
                    <a href="#">
                        <i class="fa fa-image"></i> <span>{{_i('Gallery')}}</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(auth()->user()->can('Gallery-Edit') |auth()->user()->can('Gallery-Add'))
                            <li class="{{request()->is('admin/gallery/create')? 'active':''}}"><a href="{{url('/admin/gallery/create')}}"><i class="fa fa-circle-o"></i> {{_i('Add')}} </a></li>
                        @endif
                        @if(auth()->user()->can('Gallery-Edit') |auth()->user()->can('Gallery-Delete'))
                            <li class="{{request()->is('admin/gallery/all')? 'active':''}}"><a href="{{url('/admin/gallery/all')}}"><i class="fa fa-circle-o"></i> {{_i('All')}}</a></li>
                        @endif
                    </ul>
                </li>
            @endif


{{-------------------------------------------------- Courses --------------------------------}}
@if(auth()->user()->can('Course-Add')|auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete')
    |auth()->user()->can('Applicant-Add')|auth()->user()->can('Applicant-Edit') |auth()->user()->can('Applicant-Delete')
    |auth()->user()->can('CourseCategory-Add')|auth()->user()->can('CourseCategory-Edit')| auth()->user()->can('CourseCategory-Delete')
    |auth()->user()->can('BankTransfer-Add')|auth()->user()->can('BankTransfer-Edit')| auth()->user()->can('BankTransfer-Delete')|
    auth()->user()->can('TransactionType-Add') | auth()->user()->can('TransactionType-Edit')| auth()->user()->can('TransactionType-Delete')|
    auth()->user()->can('EducationLevel-Add') | auth()->user()->can('EducationLevel-Edit')| auth()->user()->can('EducationLevel-Delete')|
     auth()->user()->can('CourseRequest-Controll')|auth()->user()->can('Rating-Show')|auth()->user()->can('Rating-Delete')|
     auth()->user()->can('CourseComments-Show')|auth()->user()->can('CourseComments-Delete')|auth()->user()->can('Transactions-Show')
    )


        {{------------- courses -----------------}}
        @if(auth()->user()->can('Course-Add')|auth()->user()->can('Course-Edit')|auth()->user()->can('Course-Delete')|
        auth()->user()->can('CourseCategory-Add')|auth()->user()->can('CourseCategory-Edit')|auth()->user()->can('CourseCategory-Delete'))
            <li class="treeview {{(request()->is('admin/course/all')||request()->is('admin/course/create')||request()->is('admin/course/category/all')
                ||request()->is('admin/course/question/index_course_question')||request()->is('admin/courses/applicants/applicant_result/index')
                ||request()->is('admin/courses/discount_codes/index_discount_codes')
                ||request()->is('admin/education_level/*')||request()->is('admin/rating/*')||request()->is('admin/course_comment/*')
               ||request()->is('admin/course/bank_transfer/*') || request()->is('admin/transaction_type/*') ||request()->is('admin/course_exam/*')
               ||request()->is('admin/courseRequest')||request()->is('admin/rating/*')||request()->is('admin/course_comment/*')
               ||request()->is('admin/orders/*')
                 ) ? 'active':''}}">
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
{{--                        <li class="{{(request()->is('admin/course/question/index_course_question'))?'active':''}}"><a href="{{route('index_course_question')}}"><i class="fa fa-circle-o"></i> {{_i('Course Questions')}} </a></li>--}}

{{--                        <li class="{{(request()->is('admin/courses/applicants/applicant_result/index'))?'active':''}}"><a href="{{route('index_applicant_result')}}"><i class="fa fa-circle-o"></i> {{_i('Course Result')}} </a></li>--}}
{{--                        <li class="{{(request()->is('admin/courses/discount_codes/index_discount_codes'))?'active':''}}"><a href="{{route('index_discount_codes')}}"><i class="fa fa-circle-o"></i> {{_i('Discount Codes Generator')}} </a></li>--}}

                    @endif
                    @if(auth()->user()->can('BankTransfer-Add')|auth()->user()->can('BankTransfer-Edit')|auth()->user()->can('BankTransfer-Delete'))
                        <li class="{{(request()->is('admin/course/bank_transfer/all')) ? 'active':''}}"><a href="{{url('/admin/course/bank_transfer/all')}}"><i class="fa fa-circle-o"></i> {{_i('Bank Transfers')}} </a></li>
                    @endif

                        {{------------- transactionType -----------------}}
                    @if(auth()->user()->can('TransactionType-Add') | auth()->user()->can('TransactionType-Edit')| auth()->user()->can('TransactionType-Delete') )
                        <li class="{{(request()->is('admin/transaction_type/all')) ? 'active':''}}"><a href="{{url('/admin/transaction_type/all')}}"><i class="fa fa-circle-o"></i> {{_i('Transaction Types')}} </a></li>
                    @endif
                    @if(auth()->user()->can('EducationLevel-Add') | auth()->user()->can('EducationLevel-Edit')| auth()->user()->can('EducationLevel-Delete') )
                        <li class="{{(request()->is('admin/education_level/all')) ? 'active':''}}"><a href="{{url('/admin/education_level/all')}}"><i class="fa fa-circle-o"></i> {{_i('Education Levels')}} </a></li>
                    @endif
                    @if(auth()->user()->can('CourseRequest-Controll') )
                        <li class="{{(request()->is('admin/courseRequest')) ? 'active':''}}"><a href="{{url('/admin/courseRequest')}}"><i class="fa fa-circle-o"></i> {{_i('Courses Requests')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Rating-Show')|auth()->user()->can('Rating-Delete'))
                        <li class="{{(request()->is('admin/rating/all')) ? 'active':''}}"><a href="{{url('/admin/rating/all')}}"><i class="fa fa-circle-o"></i> {{_i('Course Rate')}} </a></li>
                    @endif
                    @if(auth()->user()->can('CourseComments-Show')|auth()->user()->can('CourseComments-Delete') )
                        <li class="{{(request()->is('admin/course_comment/all')) ? 'active':''}}"><a href="{{url('/admin/course_comment/all')}}"><i class="fa fa-circle-o"></i> {{_i('Courses Comments')}} </a></li>
                    @endif
                     @if(auth()->user()->can('Transactions-Show') )
                        {{------------- course order  -----------------}}
                        <li class="treeview {{(request()->is('admin/orders/*')) ? 'active' : '' }}">
                            <a href="#"><i class="fa fa-circle-o"></i>  {{_i('Orders')}}
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                            </a>

                            <ul class="treeview-menu">
                                <li class="{{(request()->is('admin/orders/offline/all')) ? 'active' : '' }} "><a href="{{url('/admin/orders/offline/all')}}"><i class="fa fa-circle-o"></i>{{_i('Offline')}}</a></li>
                                <li class="{{(request()->is('admin/orders/online/all')) ? 'active' : '' }}"><a href="{{url('/admin/orders/online/all')}}"><i class="fa fa-circle-o"></i> {{_i('Online')}} </a></li>
                            </ul>
                        </li>
                     @endif

                </ul>
            </li>
        @endif
@endif

        {{------------- course exam -----------------}}
        @if(auth()->user()->can('Course-Exam-Add')|auth()->user()->can('Course-Exam-Edit')|auth()->user()->can('Course-Exam-Delete'))
            <li class="treeview {{(request()->is('admin/course_exam/*')) ? 'active':''}}">
                <a href="#"><i class="fa fa-circle-o"></i> {{_i('Course_Exams')}}
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>

                <ul class="treeview-menu">
                    @if(auth()->user()->can('Course-Exam-Edit')|auth()->user()->can('Course-Exam-Delete'))
                        <li class="{{(request()->is('admin/course_exam/all')) ?'active':''}}"><a href="{{url('/admin/course_exam/all')}}"><i class="fa fa-circle-o"></i> {{_i('Course Exams')}} </a></li>
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
                        <li class="{{(request()->is('admin/trainer/pending')) ?'active':''}}"><a href="{{url('/admin/trainer/pending')}}"><i class="fa fa-circle-o"></i> {{_i('Pending Trainers')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete'))
                        <li class="{{(request()->is('admin/trainer/report')) ?'active':''}}"><a href="{{url('/admin/trainer/report')}}"><i class="fa fa-circle-o"></i> {{_i('Trainers Reports')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Trainer-Edit')|auth()->user()->can('Trainer-Delete'))
{{--                        <li class="{{(request()->is('admin/course/question/index_trainer_question')) ?'active':''}}"><a href="{{route('index_trainer_question')}}"><i class="fa fa-circle-o"></i> {{_i('Trainer Questions')}} </a></li>--}}
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


        @if(auth()->user()->can('Bill-Add')| auth()->user()->can('Bill-Edit') |auth()->user()->can('Bill-Delete'))
            <li class="treeview {{request()->is('admin/bills/*')? 'active':''}}">
                <a href="#">
                    <i class="fa fa-image"></i> <span>{{_i('bill')}}</span>
                    <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                    @if(auth()->user()->can('Bill-Add'))
                        <li class="{{request()->is('admin/bills/create')? 'active':''}}"><a href="{{url('/admin/bills/create')}}"><i class="fa fa-circle-o"></i> {{_i('Add')}} </a></li>
                    @endif
                    @if(auth()->user()->can('Bill-Edit') |auth()->user()->can('Bill-Delete'))
                        <li class="{{request()->is('admin/bills/all')? 'active':''}}"><a href="{{url('/admin/bills/all')}}"><i class="fa fa-circle-o"></i> {{_i('All')}}</a></li>
                    @endif
                </ul>
            </li>
        @endif

        @if(auth()->user()->can('Competition-Add')| auth()->user()->can('Competition-Edit') |auth()->user()->can('Competition-Delete'))
            <li class="treeview {{request()->is('admin/competition/*')? 'active':''}}">
                <a href="#">
                    <i class="fa fa-image"></i> <span>{{_i('competition')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   @if(auth()->user()->can('Competition-Add'))
                    <li class="{{request()->is('admin/competition/create')? 'active':''}}"><a href="{{url('/admin/competition/create')}}"><i class="fa fa-circle-o"></i> {{_i('Add')}} </a></li>
                   @endif
                   @if(auth()->user()->can('Competition-Edit') |auth()->user()->can('Competition-Delete'))
                    <li class="{{request()->is('admin/competition/all')? 'active':''}}"><a href="{{url('/admin/competition/all')}}"><i class="fa fa-circle-o"></i> {{_i('All')}}</a></li>
                   @endif
                </ul>
            </li>
        @endif





        <!-- =========================== Contacts ================================-->
    @if(auth()->user()->can('Contact-Show') | auth()->user()->can('Contact-Delete')  )
        <li  class="{{request()->is('admin/contact/*')? 'active':''}}">
            <a href="{{url('/admin/contact/all')}}">
                <i class="fa fa-envelope-o "></i>{{_i('Contacts ')}}
            </a>
        </li>
    @endif
<!-- =========================== News Letters ================================-->
@if(auth()->user()->can('NewsLetters-Add')| auth()->user()->can('NewsLetters-Edit') |auth()->user()->can('NewsLetters-Delete'))
    <li  class="{{request()->is('admin/newsletters/*')? 'active':''}}">
        <a href="{{url('/admin/newsletters/all')}}">
            <i class="fa fa-bell"></i> {{_i('News Letters')}}
        </a>
    </li>
@endif






