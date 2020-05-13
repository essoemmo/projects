<!--<div class="btn-group dropdown-split-primary">
    <button type="button" class="btn btn-primary"><i class="icofont icofont-user-alt-3"></i>Primary</button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle primary</span>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item waves-effect waves-light" href="#">Action</a>
        <a class="dropdown-item waves-effect waves-light" href="#">Another action</a>
        <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item waves-effect waves-light" href="#">Separated link</a>
    </div>
</div>-->

<ul class="top-level-menu">
    <li>
        <button class="btn btn-dark first_link">{{ _i('Filter') }}</button>

        <ul class="second-level-menu">
            <li>
                <a href="javascript:void(0)">{{ _i('Status') }}</a>
                <ul class="third-level-menu">
                    <li><a href="javascript:void(0)" class="status" data-code="all">{{ _i('All Products') }}</a></li>
                    <li><a href="javascript:void(0)" class="status" data-code="sale">{{ _i('Products For Sale') }}</a>
                    </li>
                    <li><a href="javascript:void(0)" class="status"
                           data-code="discount">{{ _i('Discounted Products') }}</a></li>
                    <li><a href="javascript:void(0)" class="status"
                           data-code="outofstock">{{ _i('Out Of Stock Products') }}</a></li>
                </ul>
            </li>
            @if(count($cats) > 0)
                <li>
                    <a href="javascript:void(0)">{{ _i('Category') }}</a>
                    <ul class="third-level-menu">
                        @foreach($cats as $index => $category)
                            <li><a href="javascript:void(0)" class="category"
                                   data-category="{{ $index }}">{{ $category }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @if(count($product_type) > 0)
                <li>
                    <a href="javascript:void(0)">{{ _i('Types') }}</a>
                    <ul class="third-level-menu">
                        @foreach($product_type as $index => $type)
                            <li><a href="javascript:void(0)" class="type"
                                   data-id="{{ $index }}">{{ $type }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </li>

    <li>
        <button class="btn btn-dark first_link">{{ _i('Services') }}</button>

        <ul class="second-level-menu">
            <li>
                <a href="category/create"><i class="ti-layers-alt mr-2"></i> {{ _i('Categories') }}</a>
            </li>

            <li>
                <a href="{{ route('arrangeProducts') }}"><i
                        class="ti-exchange-vertical mr-2"></i> {{ _i('Arrange the products') }}</a>
            </li>

            <li>
                <a href="{{ route('productsInventory') }}"><i
                        class="ti-package mr-2"></i> {{ _i('Products Inventory') }}</a>
            </li>

            <li>
                <a href="{{ route('productsImport') }}"><i
                        class="ti-import mr-2"></i> {{ _i('Import New Products') }}</a>
            </li>

            <li>
                <a href="javascript:void(0)">
                    <i class="ti-export mr-2"></i> {{ _i('Export Products') }}</a>
                <ul class="third-level-menu">
                    <li><a href="{{ route('productsExportExcel') }}"><i
                                class="ti-export mr-2"></i> {{ _i('Export Products In XLSX') }}</a></li>
                    <li><a href="{{ route('productsExportCVS') }}"><i
                                class="ti-export mr-2"></i> {{ _i('Export Products In CVS') }}</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" data-toggle="modal"
                   data-target="#deleteAll"><i
                        class="ti-trash mr-2"></i> {{ _i('Delete All Products') }}</a>
            </li>

            {{--            <li>--}}
            {{--                <a href="{{ route('syncInstagram') }}"><i--}}
            {{--                        class="ti-instagram mr-2"></i> {{ _i('Instagram') }}</a>--}}
            {{--            </li>--}}

        </ul>
    </li>
</ul>

@include('admin.products.products.includes.btn.deleteAll')
@push('css')

    <style>
        .first_link:after {
            content: "\e64b";
            font-family: themify;
            margin-left: 35px;
        }

        .third-level-menu {
            position: absolute;
            top: 0;
            left: -250px;
            width: 150px;
            list-style: none;
            padding: 0;
            margin: 0;
            display: none;
        }

        .third-level-menu > li {
            height: 30px;
            width: 250px;
            background: #fff;
        }

        .third-level-menu > li:hover {
            background: #CCCCCC;
        }

        .second-level-menu {
            position: absolute;
            top: 30px;
            right: 0;
            width: 250px;
            list-style: none;
            padding: 0;
            margin: 0;
            display: none;
        }

        .second-level-menu > li {
            position: relative;
            height: 40px;
            background: #fff;
        }

        .second-level-menu > li:hover {
            background: #CCCCCC;
        }

        .top-level-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .top-level-menu > li {
            position: relative;
            float: left;
            height: 30px;

            margin-right: 15px;
            background: #5dd5c4;
            border-radius: 50px;
        }

        .top-level-menu > li:hover {
            background: #CCCCCC;
        }

        .top-level-menu li:hover > ul {
            /* On hover, display the next level's menu */
            display: inline-block;
            z-index: 99999;
        }


        /* Menu Link Styles */

        .top-level-menu a /* Apply to all links inside the multi-level menu */
        {

            color: #666;
            text-decoration: none;
            padding: 0 0 0 10px;

            /* Make the link cover the entire list item-container */
            display: block;
            line-height: 30px;
        }

        .top-level-menu a:hover {
            color: #000000;
        }

    </style>

@endpush


@push('js')

    <script>
        $('.status').on('click', function () {
            var code = $(this).data('code');
            $.ajax({
                url: '{{ url("adminpanel/product_status") }}',
                method: 'GET',
                DataType: 'json',
                data: {code: code},
                success: function (res) {
                    console.log(res);
                    $('#allProducts_div').html(res);
                    $('.selectpicker').selectpicker('refresh');
                }
            })
        });
        $('.category').on('click', function () {
            var category = $(this).data('category');
            $.ajax({
                url: '{{ url("adminpanel/product_category")}}',
                method: 'GET',
                DataType: 'json',
                data: {category: category},
                success: function (res) {
                    console.log(res);
                    $('#allProducts_div').html(res);
                    $('.selectpicker').selectpicker('refresh');
                }
            })
        });
        $('a.type').on('click', function () {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ url("adminpanel/product_type")}}',
                method: 'GET',
                DataType: 'json',
                data: {id: id},
                success: function (res) {
                    console.log(res);
                    $('#allProducts_div').html(res);
                    $('.selectpicker').selectpicker('refresh');
                }
            })
        })
    </script>

@endpush
