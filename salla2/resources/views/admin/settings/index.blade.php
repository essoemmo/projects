@extends('admin.AdminLayout.index')

@section('title')
    {{ _i('Store Settings') }}
@endsection

@push('css')
    <style>

        .blog-page {
            margin: 43px;
            height: 200px;
        }

        h3 i {
            font-size: 45px !important;
        }

        .counter-card-1 [class*="card-"] div > i,
        .counter-card-2 [class*="card-"] div > i,
        .counter-card-3 [class*="card-"] div > i {
            font-size: 30px;
            color: #1abc9c !important;
        }
    </style>

@endpush


@section('content')

    {{--    Store settings--}}
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Store settings')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Settings')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <!-- Blog-card group-widget start -->
        <div class="row">


            @if(Auth::guard('store')->user()->hasPermissionTo('Settings-Add') )
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3><a href="{{ url('adminpanel/settings/get') }}"
                                       class="text-primary">{{_i('Basic Settings') }}</a></h3>
                                <p>{{ _i('Link, logo, name, location') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="icofont icofont-gear"></i>
                            </div>
                        </div>
                    </div>
                </div>

            @endif


            @if(Auth::guard('store')->user()->hasPermissionTo('shipping-add') )
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('adminpanel/shipping') }}"
                                       class="text-primary">{{_i('Shipping Settings') }}</a>
                                </h3>
                                <p>{{ _i('Connect with shipping companies') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="icofont icofont-truck-loaded"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::guard('store')->user()->hasPermissionTo('BankTransfer-Add') | Auth::guard('store')->user()->hasPermissionTo('BankTransfer-Edit')
            | Auth::guard('store')->user()->hasPermissionTo('BankTransfer-Delete'))
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('adminpanel/transferBank') }}"
                                       class="text-primary">{{_i('bank transfer') }}</a>
                                </h3>
                                <p>{{ _i('Activating bank transfers') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="ti-home"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::guard('store')->user()->hasPermissionTo('Controll-Maintenance'))
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ route('storeOptions.index') }}"
                                       class="text-primary">{{_i('Store Options') }}</a>
                                </h3>
                                <p>{{ _i('Site control options') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-toggle-off"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::guard('store')->user()->hasPermissionTo('Brand-Add') |Auth::guard('store')->user()->hasPermissionTo('Brand-Edit')|Auth::guard('store')->user()->hasPermissionTo('Brand-Delete') )
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('adminpanel/brands') }}"
                                       class="text-primary">{{  _i('Brands') }}</a>
                                </h3>
                                <p>{{ _i('View and control brands') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="icofont icofont-gift-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{--                @can(['Brand-Add','Brand-Edit','Brand-Delete'])--}}
            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3>
                                <a href="{{ route('sms.index') }}"
                                   {{--                                <a href="#"--}}
                                   class="text-primary ">{{  _i('SMS name reservation') }}</a>
                            </h3>
                            <p>{{ _i('Preparing documents to reserve a store name') }}</p>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <i class="fa fa-envelope-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{--                @endcan--}}


        </div>


    </div>
    {{--Store settings--}}


    {{--    Advanced settings--}}
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Advanced settings')}}</h4>
        </div>
    </div>
    <div class="page-body">
        <!-- Blog-card group-widget start -->
        <div class="row">


            @if(Auth::guard('store')->user()->hasPermissionTo('Chat-Show'))
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ route('connectServices') }}"
                                       class="text-primary">{{  _i('Connect services') }}</a>
                                </h3>
                                <p>{{ _i('Statistics, ads, chat') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-puzzle-piece"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(Auth::guard('store')->user()->hasPermissionTo('Content-Add')|
            Auth::guard('store')->user()->hasPermissionTo('Content-Edit')|Auth::guard('store')->user()->hasPermissionTo('Content-Delete') )
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('/adminpanel/content_management') }}"
                                       class="text-primary">{{  _i('Content') }}</a>
                                </h3>
                                <p>{{ _i('Content Management') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="icofont icofont-pencil-alt-5"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



            @if(Auth::guard('store')->user()->hasPermissionTo('Banner-Add')|
                Auth::guard('store')->user()->hasPermissionTo('Banner-Edit')|Auth::guard('store')->user()->hasPermissionTo('Banner-Delete') )
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('adminpanel/settings/banners') }}"
                                       class="text-primary">{{  _i('Banners') }}</a>
                                </h3>
                                <p>{{ _i('Show banners to customers in the store') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="icofont icofont-file-image"></i>
                            </div>
                        </div>
                    </div>
                </div>

            @endif


            @if(Auth::guard('store')->user()->hasPermissionTo('Slider-Add')|
                   Auth::guard('store')->user()->hasPermissionTo('Slider-Edit')|Auth::guard('store')->user()->hasPermissionTo('Slider-Delete') )
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('adminpanel/settings/sliders') }}"
                                       class="text-primary">{{  _i('Sliders') }}</a>
                                </h3>
                                <p>{{ _i('Show sliders to customers in the store') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="icofont icofont-files"></i>
                            </div>
                        </div>
                    </div>
                </div>

            @endcan

            @if(Auth::guard('store')->user()->hasPermissionTo('Controll-Seo'))
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ route('seo.index') }}"
                                       class="text-primary">{{  _i('SEO') }}</a>
                                </h3>
                                <p>{{ _i('SEO') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3>
                                <a href="{{ url('adminpanel/settings/currency') }}"
                                   class="text-primary">{{  _i('Currencies') }}</a>
                            </h3>
                            <p>{{ _i('Currencies available in the store') }}</p>
                            <div class="progress ">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div>
                            <i class="fa fa-usd"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::guard('store')->user()->hasPermissionTo('AdminUser-Add') |
            Auth::guard('store')->user()->hasPermissionTo('AdminUser-Edit')| Auth::guard('store')->user()->hasPermissionTo('AdminUser-Delete'))
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ url('adminpanel/user/all') }}"
                                       class="text-primary">{{  _i('Store staff') }}</a>
                                </h3>
                                <p>{{ _i('Control the powers of store employees') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3>
                                <a href="{{ route('taxPrep') }}"
                                   class="text-primary">{{  _i('TAX') }}</a>
                            </h3>
                            <p>{{ _i('Tax preparation') }}</p>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div>
                            <i class="fa fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-xl-4">
                <div class="card counter-card-1">
                    <div class="card-block-big d-flex justify-content-between">
                        <div>
                            <h3>
                                <a href="{{ route('accountControl.index') }}"
                                   class="text-primary">{{  _i('Account control') }}</a>
                            </h3>
                            <p>{{ _i('Stop the subscription, delete the store') }}</p>
                            <div class="progress ">
                                <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                     role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                            <div>
                                <i class="fa fa-credit-card"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if(Auth::guard('store')->user()->hasPermissionTo('Data-Recovery'))
                <div class="col-md-12 col-xl-4">
                    <div class="card counter-card-1">
                        <div class="card-block-big d-flex justify-content-between">
                            <div>
                                <h3>
                                    <a href="{{ route('dataRecovery.index') }}"
                                       class="text-primary">{{  _i('Data recovery') }}</a>
                                </h3>
                                <p>{{ _i('Recover deleted orders and products') }}</p>
                                <div class="progress ">
                                    <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                         role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
    {{--    Advanced settings--}}


    @if(Auth::guard('store')->user()->hasPermissionTo('ArticleCategory-Add')|Auth::guard('store')->user()->hasPermissionTo('ArticleCategory-Edit')|
            Auth::guard('store')->user()->hasPermissionTo('ArticleCategory-Delete'))
        {{--    Blog settings--}}
        <div class="page-header">
            <div class="page-header-title">
                <h4>{{_i('Blog settings')}}</h4>
            </div>
        </div>
        <div class="page-body">
            <!-- Blog-card group-widget start -->
            <div class="row">

                @if(Auth::guard('store')->user()->hasPermissionTo('ArticleCategory-Add')|Auth::guard('store')->user()->hasPermissionTo('ArticleCategory-Edit')|
                Auth::guard('store')->user()->hasPermissionTo('ArticleCategory-Delete'))
                    <div class="col-md-12 col-xl-4">
                        <div class="card counter-card-1">
                            <div class="card-block-big d-flex justify-content-between">
                                <div>
                                    <h3>
                                        <a href="{{ url('adminpanel/artcle_category/all') }}"
                                           class="text-primary">{{  _i('Blog Categories') }}</a>
                                    </h3>
                                    <p>{{ _i('Blog Categories') }}</p>
                                    <div class="progress ">
                                        <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                             role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <i class="icofont icofont-edit"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

                @if(Auth::guard('store')->user()->hasPermissionTo('Article-Add')|Auth::guard('store')->user()->hasPermissionTo('Article-Edit')|
                                    Auth::guard('store')->user()->hasPermissionTo('Article-Delete'))
                    <div class="col-md-12 col-xl-4">
                        <div class="card counter-card-1">
                            <div class="card-block-big d-flex justify-content-between">
                                <div>
                                    <h3>
                                        <a href="{{ url('adminpanel/articles') }}"
                                           class="text-primary">{{  _i('Blogs') }}</a>
                                    </h3>
                                    <p>{{ _i('Blogs') }}</p>
                                    <div class="progress ">
                                        <div class="progress-bar progress-bar-striped progress-xs progress-bar-pink"
                                             role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div>
                                    <i class="icofont icofont-page"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif


            </div>

        </div>
        {{--    Blog settings--}}
    @endif
@endsection


@push('js')

    <script>
        // show slider image
        function showSliderImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#slider_img').attr('src', e.target.result).width(180).height(120);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

        //show slider logo
        function showSliderLogo(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#slider_logo').attr('src', e.target.result).width(180).height(120);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);
        }

        function showImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $('#setting_img').attr('src', e.target.result).width(250).height(250);
            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function showOldImg(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                console.log(e);
                $("#old_img").attr('src', e.target.result).width(300).height(250);

            };
            console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        function apperImage(input) {

            var filereader = new FileReader();
            filereader.onload = (e) => {
                // console.log(e);
                $('#new_img').attr('src', e.target.result).width(300).height(250);
            };
            // console.log(input.files);
            filereader.readAsDataURL(input.files[0]);

        }

        $(document).ready(function () {
            // For A Delete Record Popup
            $('.remove-record').click(function () {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = '{{csrf_token()}}';
                $(".remove-record-model").attr("action", url);
                $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="' +
                    token + '">');
                $('body').find('.remove-record-model').append(
                    '<input name="_method" type="hidden" value="DELETE">');
                $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="' +
                    id + '">');
            });
            $('.remove-data-from-delete-form').click(function () {
                $('body').find('.remove-record-model').find("input").remove();
            });
            $('.modal').click(function () {
                // $('body').find('.remove-record-model').find( "input" ).remove();
            });
        });

        $(function () {
            $('#sliders-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url(' / adminpanel / settings / slider / datatable ')}}',
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'logo',
                        name: 'logo'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });
        $(function () {
            $('#counter-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url(' / adminpanel / settings / counter ')}}',
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'counter',
                        name: 'counter'
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });


        $('.comingSoon').on('click', function () {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '{{ _i('This Feature Is Coming Soon') }}',
                showConfirmButton: false,
                timer: 2000
            });
        })

    </script>

@endpush
