@include('admin.layouts.header')
@include('admin.layouts.nav')



<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div><!-- /.col -->
<!--            <?php

//                $city = \Illuminate\Support\Facades\DB::table('user_category')
//                    ->leftJoin('users','user_category.user_id','=','users.id')
//                    ->join('categories','user_category.category_id','=','categories.id')
//                    ->get();
//        dd($city);
           ?>-->

                <div class="col-sm-6">
                    <ol class="breadcrumb">

                        @yield('page_url')

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @include('admin.layouts.message')
        @yield('content')
    </section>
    <!-- /.content -->
    @include('admin.layouts.session')

</div>

@include('admin.layouts.footer')
