@php
    $currency = \App\Bll\Constants::defaultCurrency;
@endphp

@push('css')
    <style scoped>
        .order-table .table tr th,
        .order-table .table tr td {
            text-align: right;
            padding-right: 10px
        }

        .order-table .table tr:first-child {
            height: 50px;
            border-bottom: 1px solid #f7f7f7;
            background: #f7f7f7;
        }

        .order-table .table .productRow {
            height: 70px !important;
        }

        .order-table .table tr:not(:first-child) {
            height: 50px;
            border-bottom: 1px solid #f7f7f7;
        }

        .search-menu {
            border: 1px solid #ccc;
            padding: 2px 10px;
            max-height: 110px;
            height: auto;
            overflow-y: scroll;
        }

        .search-menu li {
            padding: 5px 0;
            cursor: pointer;
        }

        .search-menu li:hover {
            background: #f7f7f7;
        }

        .search-menu li:not(:last-child) {
            border-bottom: 1px solid #ccc;
        }

        .media-object {
            width: 70px;
            float: right;
        }

        .product-show .media-object {
            width: 100px;
            margin-right: 50px;
        }

        .table td {
            position: relative;
        }

        .table {
            display: table;
        }

        .order-table .card-title {
            float: right;
        }

        .order-table .heading-elements {
            float: left;
        }

        .input-fly {
            display: block;
            position: absolute;
            top: -7px;
            left: 0;
        }

        .input-fly input {
            width: 70px;
        }

    </style>
@endpush

<div class="order-table col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{_i("products")}}</h3>
            <div class="heading-elements">
                <button data-toggle="modal" data-target="#ordertable" class="btn btn-tiffany" type="button"><i
                        class="fa fa-plus"></i>{{_i("Add products")}}</button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                <tr>
                    <th>{{_i("product")}}</th>
                    <th>{{_i("price")}}</th>
                    <th>{{_i("qty")}}</th>
                    <th>{{_i("total")}}</th>
                    <th>{{_i("Action")}}</th>
                </tr>
                </thead>

                <tbody id='product__detai'>

                </tbody>

                <tr class="productRowOne">
                    <td colspan="3">{{_i("Cart Total")}}</td>
                    <td class="total__befor"></td>
                    <td></td>
                </tr>
                <tr class="productRowOne">
                    <td colspan="3">{{_i("Shipping cost")}}</td>
                    <td class="Shipping__cost"></td>
                    <td></td>
                </tr>
                {{--                <tr class="productRowOne">--}}
                {{--                    <td colspan="3">{{_i("Discount coupons")}}</td>--}}
                {{--                    <td></td>--}}
                {{--                    <td></td>--}}
                {{--                </tr>--}}
                <tr class="productRowOne">
                    <td colspan="3">{{_i("Order Total")}}</td>
                    <td class="total"></td>
                    <td></td>
                </tr>

            </table>
            <div class="row">
                <div class="col-md-6">
                    {{--                                    <button  class="btn btn-tiffany btn-block" onclick="saveall()">{{_i("save")}}</button>--}}
                    <button type="submit" class="btn btn-tiffany btn-block" id="saveAll">{{_i("save")}}</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-default btn-block">{{_i("print")}}</button>
                </div>
            </div>


        </div>
    </div>
    <div class="modal fade" ref="ordertable" id="ordertable" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{_i("adding product")}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="javascript:void(0)" onclick="addProduct()"><i
                                    class="ti-plus"></i> {{_i("add new product")}}</a>
                        </div>
                        <div class="col-md-8 col-md-offset-1">
                            {{--                                <input onkeyup="getsearch(value)" type="text" class="form-control" id="search-product" placeholder="{{_i("searching_in_products_list")}}">--}}
                            <input type="text" class="form-control" id="search-product"
                                   placeholder="{{_i("searching in products list")}}">
                            <ul class="list-unstyled search-menu" style="display: none">


                            </ul>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="add-product">
                    </div>

                    <div class="row product-show">
                    </div>
                    <br>
                    {{--                    <button class="btn btn-tiffany col-md-12" type="button"--}}
                    {{--                            onclick="saveproduct()">{{_i("save")}}</button> --}}

                    <button class="btn btn-tiffany col-md-12" type="button" style="cursor: pointer;"
                            id="saveProduct">{{_i("save")}}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


@push('js')
    <script src="{{asset('AdminFlatAble/jquery.number.min.js')}}"></script>
    <script language="javascript">

        window.SavedProducts = []
        window.allProducts = {!! json_encode($products) !!}

        function getproduct(index) {
            // console.log(productsfilters[index].product_photos);
            window.product = {
                id: productsfilters[index].id,
                title: productsfilters[index].title,
                price: productsfilters[index].price,
                max_count: productsfilters[index].max_count,
                count: 1,
                // options: productsfilters[index].product.features
            };
            // console.log(productsfilters);


            if (productsfilters[index].product_photos.length == 0) {


                this.product.photo = 'http://localhost/salla2/images/placeholder.png'
            } else {
                this.product.photo = '../..' + productsfilters[index].product_photos[0].photo
            }

            $('.product-show').empty();
            $('.product-show').append('<li onclick="getproduct(index)"><div class="media">')
            $('.product-show').append('<img class="media-object media-right img-responsive" src="' + this.product.photo + '">')
            $('.product-show').append('<div class="media-body media-left"><div>' + this.product.title + '</div>' + '<div>' + this.product.price + '</div></div>')
            if (this.product.max_count == 0) {
                $('.product-show').append('<span style="color:red">{{_i("max count reached its limit")}}</span>')
            }
            $('.product-show').append('</div></li></ul>')
        }


        function getsearch(value) {
            if (value) {

                window.productsfilters = allProducts.filter(product => {
                    // not it suddenly made a problem
                    return product.title.match(value);
                });

                var products = $('.search-menu').empty();

                for ($i = 0; $i < productsfilters.length; $i++) {
                    products.append('<li onclick="getproduct(' + $i + ')">' + productsfilters[$i].title + '</li>');
                }
                $('.search-menu').show();
            } else {
                window.productsfilters = null;
                $('.search-menu').empty();
                $('.search-menu').hide();
            }
        }

        function saveproduct() {

            var productcount = 0;
            $('#ordertable').modal('toggle');
            $('#ordertable').removeClass('show');
            var allProducts = productsfilters.map((pro) => {
                if (pro.id == product.id) {
                    // pro.product.max_count = pro.product.max_count - 1;
                }
                return pro;
            });
            SavedProducts.push({
                id: product.id,
                title: product.title,
                price: product.price,
                max_count: product.max_count - 1,
                photo: product.photo,
                count: 1,
                total: product.price + (product.option ? product.option.price : 0),
                option: product.option ? product.option : null,
                procount: ++this.count
            });
            productvisible = false;
            SavedProducts = SavedProducts.map((product) => {
                productcount += product.total;
                return product;
            })


            $(".product-show").empty();
            $(".productRowOne").remove();

            $(".carttotalrow").remove();
            $(".shippingoptionvaluerow").remove();
            $(".couponsrow").remove();
            $(".changewholetotalrow").remove();
            $(".table tbody").append('<tr class="productRow" id="productRow_' + product.id + '"></tr>')
            $("#productRow_" + product.id + "").empty();
            $("#productRow_" + product.id + "").append('<td><button style="float: right;margin-top: 20px;margin-left: 20px;" class="btn btn-danger"onclick="productdel(' + product.id + ')"><span>x</span></button><div class="media" id="media_' + product.id + '">');
            $("#media_" + product.id + "").append('<img class="media-object media-right img-responsive" src="' + product.photo + '">')
            $("#media_" + product.id + "").append('<div class="media-body media-left"><div>' + product.title + '</div>')
            $("#productRow_" + product.id + "").append('</td><td class="addcount" id="addcount' + product.id + '"><slot>1</slot></td>')
            $("#addcount" + product.id + "").append('<div class="form-group input-fly" style="left: 35%;" v-show="toggled"><input onkeyup="countchange(' + product.id + ')" id="changingcount' + product.id + '" value="1" type="text" class="form-control"  style="width: 40px"></div><a href="javascript:void(0)"  class="count"></a>')
            if (product.options.length == 0) {
                $("#productRow_" + product.id + "").append('</td><td><slot><a href="javascript:void(0)" class="changeprice" id="changeprice' + product.id + '">' + product.price + '</a></slot>')
            } else {
                $("#productRow_" + product.id + "").append('</td><td><slot><a href="javascript:void(0)" class="changeprice" id="changeprice' + product.id + '">' + product.option.price + product.price + '</a></slot>')
            }
            if (product.options.length == 0) {
                window.total = this.product.price
                $("#productRow_" + product.id + "").append('</td><td><slot class="changetotal" id="changetotal' + product.id + '">' + total + '</slot></td>')
            } else {
                window.total = (product.price + product.price) * product.count
                $("#productRow_" + product.id + "").append("</td><td><slot class='changetotal' id='changetotal" + product.id + "'>" + total + "</slot>")
            }
            $("#productRow_" + product.id + "").append("</td></tr>")


            $(".table").append("<tr class='carttotalrow'><td colspan='3'>{{_i('cart_total')}}</td><td class='carttotal'></td></tr>")
            $(".table").append("<tr class='shippingoptionvaluerow'><td colspan='3'>{{_i('shipping_cost')}}</td><td id='shippingoptionvalue'>{!! $shippingOption ?? 0 !!}</td></tr>")
            $(".table").append("<tr class='couponsrow'><td colspan='3'>{{_i('discount_coupons')}}</td><td class='coupons' id='coupons" + product.id + "'></td></tr>")
            $(".table").append("<tr class='changewholetotalrow'><td colspan='3'>{{_i('order_total')}}</td><td class='changewholetotal'></td></tr>")

            countchange(product.id)
            $('.search-menu').empty();

            //this.productsfilters = null;
            //this.product = {};
            //this.productname = null;

            $('.search-menu').empty();


        }

        function selectfeature() {
            this.selectedOptionFeature = null;
        }

        function selectOption() {
            this.product.option = null;
            this.product.option = this.selectedOptionFeature;
        }

        function productdel(id) {
            allProducts = allProducts.map((pro) => {
                if (pro.id == SavedProducts[0].id) {
                    pro.product.max_count = SavedProducts[0].max_count + SavedProducts[0].count;
                }
                return pro;
            });

            let index = SavedProducts.findIndex(i => i.id === id);
            SavedProducts.splice(index, 1)
            $("#productRow_" + id + "").remove();


            let prices = [];
            $('.changeprice').each(function () {
                prices.push($(this).text());
            });


            if (prices.length == 0) {

                $(".carttotal").empty()
                $(".carttotal").append(0)

                $(".changewholetotal").empty()
                $(".changewholetotal").append(0)

            } else {

                prices = prices.map((a) => parseInt(a));

                window.totalprice = prices.reduce((a, b) => a + b);

                $(".carttotal").empty()
                $(".carttotal").append(totalprice.toString())

                $(".changewholetotal").empty()
                $(".changewholetotal").append(totalprice.toString() + $("#shippingoptionvalue").val())
            }


        }

        function addProduct() {
            var selectedFeature = null;
            var selectedOptionFeature = null;
            var productname = null;
            var product = {
                id: null,
                title: null,
                price: null,
                max_count: null,
                photo: null,
                option: null,
            };
            productform()

        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('change', '#image', function (e) {

            let file_data = $('#image').prop('files')[0];
            window.form_data = new FormData();
            form_data.append('file', file_data);
            readURL(this);

            //window.image = $("#image").val();
        });


        function cancel() {
            $(".add-product").empty();
        }

        function formSubmit() {

            let product = {
                title: $('#title').val(),
                type: $('#productType').val() === null ? 0 : $('#productType').val(),
                max_count: $('#count').val(),
                price: $('#price').val(),
                image: $('#image').val(),
            }

            let currentObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            axios.post('../adminpanel/orders/saveproduct', product)
                .then((data) => {
                    $('.product-show').append('<div class="row"><div class="col-md-8">');
                    if (product.features != null) {
                        for ([option, index] in product.features) {
                            $('.product-show').append('<label for="' + option.id + '">');
                            $('.product-show').append('<input type="radio" v-model="selectedFeature" name="' + option.title + '" value="' + option + '" change="' + selectfeature + '">');
                            $('.product-show').append('<span>' + option.title + '</span></label>');
                            $('.product-show').append('<table class="table"><tr><th>Title</th><th>Price</th><th>Count</th></tr>');
                        }
                        for (opt in options.options) {
                            if (opt.count > 0) {
                                $('.product-show').append('<td><label :for="opt.id">');
                                if (selectedFeature == null || selectedFeature.id != opt.feature_id) {
                                    $('.product-show').append('<input disabled type="radio" onchange="selectOption" :name="opt.title" :value="opt">')
                                } else {
                                    $('.product-show').append('<input type="radio" onchange="selectOption" :name="opt.title" :value="opt">')
                                }
                                $('.product-show').append(opt.title);
                                $('.product-show').append('</label></td><td>');
                                $('.product-show').append(opt.price);
                                $('.product-show').append('</td><td>');
                                $('.product-show').append(opt.count);
                                $('.product-show').append('</td></tr></table></div></div>')
                                $('.product-show').append('<div class="col-md-4"><div class="media">')
                                $('.product-show').append('<img class="media-object media-right img-responsive" src="' + product.photo + '"><div class="media-body media-left">')
                                $('.product-show').append('<div>' + product.name + '</div><div>' + product.price + '</div></div></div></div></div>')
                            }
                        }
                        $('.product-show').append('<div class="col-md-4"><div class="media"><img class="media-object media-right img-responsive" src="' + product.photo + '">')
                        $('.product-show').append('<div class="media-body media-left">')
                        $('.product-show').append('<div>' + productname + '</div><div>' + product.price + '</div></div></div></div>')
                    }
                    let newproduct = data.data;
                    form_data.append('product_id', newproduct.id);
                    axios.post('../adminpanel/imageSubmit', form_data).then((data) => {
                        newproduct.product.product_photos = new Array(0);
                        newproduct.product.product_photos[0] = {};
                        newproduct.product.product_photos[0].photo = data.data.data;
                        allProducts.push(newproduct);
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 2000
                        })
                        //this.allProducts.push(newproduct)
                        $(".add-product").empty()
                        this.image = null;
                        this.product = {
                            id: null,
                            title: null,
                            price: null,
                            max_count: null,
                            photo: null,
                            option: null,
                        };
                    })


                })
                .catch(function (error) {
                    var errors = error.response.data.errors;
                    var errormessage = []
                    if (errors.title != null) {
                        errormessage.push(errors.title[0])
                    }
                    if (errors.price != null) {
                        errormessage.push(errors.price[0])
                    }
                    if (errors.max_count != null) {
                        errormessage.push(errors.max_count[0])
                    }
                    if (errors.image != null) {
                        errormessage.push(errors.image[0])
                    }

                    Swal.fire({
                        title: 'تنبيه',
                        text: errormessage,
                        type: 'warning',
                    })


                });
        }

        function countchange(id) {


            let count = $("#changingcount" + id + "").val();

            if (product.max_count < count) {
                Swal.fire({
                    title: 'تنبيه',
                    text: "أقصى عدد متاح فالمتجر لهذا المنتج هو " + product.max_count + "",
                    type: 'warning',
                });

                return false;
            }

            let productOriginPrice = this.product.price
            let addingprice = productOriginPrice * $("#changingcount" + id + "").val();

            let selectedProduct = SavedProducts.map((pro) => {
                if (pro.id == product.id) {
                    pro.count = count;
                }
                return pro;
            });


            //$("#addcount"+id+"").empty();
            //$("#addcount"+id+"").append('<slot>'+count+'</slot>')
            //$("#addcount"+id+"").append('<div class="form-group input-fly" style="left: 35%;" v-show="toggled"><input onkeyup="countchange('+id+')" type="text" class="form-control changingcount"  style="width: 40px"></div><a href="javascript:void(0)" @click="toggleItem"  class="count"></a>')

            $("#changeprice" + id + "").empty()
            $("#changeprice" + id + "").append(addingprice)

            $("#changetotal" + id + "").empty()
            $("#changetotal" + id + "").append(addingprice)

            let prices = [];
            $('.changeprice').each(function () {
                prices.push($(this).text());
            });

            prices = prices.map((a) => parseInt(a));

            window.totalprice = prices.reduce((a, b) => a + b);

            $(".carttotal").empty()
            $(".carttotal").append(totalprice.toString())

            $(".changewholetotal").empty()
            $(".changewholetotal").append(totalprice.toString() + $("#shippingoptionvalue").val())

        }

        function productform() {
            $('.add-product').append('<form enctype="multipart/form-data" data-parsley-validate="">')
            $('.add-product').append('<div class="row add-product-row"><div class="col-md-6"><div class="form-group titlefield">')
            $('.titlefield').append('<label for="title"></label><input name="title" required="" class="form-control" id="title" placeholder="{{_i("product_name")}}"></div>')
            $('.add-product-row').append('<div class="col-md-6"><div class="form-group"><label for="productType"></label><select id="productType" required="" class="selectpicker form-control">')
            @foreach($product_type as $type)
            $('#productType').append('<option id="type" value="{{$type->id}}">{{$type->title}}</option>')
            @endforeach
            $('.add-product-row').append('</select></div></div>')
            $('.add-product-row').append('<div class="clearfix"></div>')
            $('.add-product-row').append('<div class="col-md-6"><div class="form-group countfield"><label for="count"></label>')
            $('.countfield').append('<input id="count" required="" class="form-control" placeholder="{{_i("qty")}}"></div></div>')
            $('.add-product-row').append('<div class="col-md-6"><div class="form-group pricefield"><label for="price"></label>')
            $('.pricefield').append('<input id="price" required="" class="form-control" placeholder="{{_i("price")}}" id="$product->price"></div></div></div>')
            $('.add-product-row').append('<div class="col-md-6"><label for="image"><input type="file" required="" id="image" name="image"></label></div></div>')
            $('.add-product-row').append('<div class="col-md-6"><img id="blah" width="250" height="250" style="margin-left:46px" src="/images/placeholder.png" alt="your image" /></div>');
            $('.add-product-row').append('<br/><div class="col-md-12" style="margin-top: 10px;"><button class="btn btn-primary col-md-6" onclick="formSubmit()">{{_i("add new    product")}}</button><button class="btn btn-primary col-md-6" onclick="cancel()">{{_i("cancel")}}</button></div></form>')
        }

        $(function () {
            $('body').on('keyup', '#search-product', function (e) {
                e.preventDefault();

                var val = $(this).val();
                $.ajax({
                    url: '{{route('get-product')}}',
                    method: "get",
                    data: {
                        val: val
                    },
                    dataType: 'json',

                    // cache       : false,
                    // contentType : false,
                    // processData : false,

                    success: function (response) {
                        $('.search-menu').empty();
                        $('.search-menu').show();
                        for (var i = 0; i < response.data.length; i++) {
                            // if (response.data[i].product_details != null){
                            //     $('.search-menu').append(`<li class="prod_id" data-id="${response.data[i].id}">${response.data[i].product_details[0].title}</li>`)
                            // }
                            if (response.data[i].product_details.length > 0) {
                                $('.search-menu').append(`<li class="prod_id" data-id="${response.data[i].id}">${response.data[i].product_details[0].title}</li>`)
                            }
                        }
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                });
            })

            $('body').on('click', '.prod_id', function (e) {
                e.preventDefault();
                var pro_id = $(this).data('id');

                $.ajax({
                    url: '{{route('get-product-single')}}',
                    method: "get",
                    data: {
                        pro_id: pro_id
                    },
                    dataType: 'json',

                    // cache       : false,
                    // contentType : false,
                    // processData : false,

                    success: function (response) {
                        // console.log(response);
                        $('.add-product').empty();
                        $('.add-product').append(`
                        <div class="row">
                            <div class="col-md-6">
                                <span id="product__id" style="display:none">${response.data.id}</span>
                                <div class="row">
                                    <p class="lead col-md-6">{{_i('title')}} :</p> <h5 class="col-md-6" id="product__title">${response.data.title}</h5>
                                </div>
                                <div class="row">
                                    <p class="lead col-md-6">{{_i('price')}} :</p> <h6 class="col-md-6" id="product__price">${response.data.price} {{ $currency }}</h6>
                                </div>
                                <div class="row">
                                    <p class="lead col-md-6">{{_i('Available quantity')}} :</p> <h6 class="col-md-6" id="product__price">${response.data.max_count}</h6>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <span> {{_i('image')}} </span>  <img id="product__image" src="${response.data.photo}" style="width: 100px">
                               </div>
                       </div>
                        `);
                        // console.log(response);
                    }
                    // table.ajax.reload();
                    // window.location.reload();
                });


            });

            $('body').on('click', '#saveProduct', function (e) {
                e.preventDefault();

                var id = $('#product__id').html();
                var title = $('#product__title').html();
                var price = $('#product__price').html();
                var img = $('#product__image').attr('src');


                var html = `
             <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="${img}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">${title}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${price}</td>
                    <td data-th="Quantity">
                        <input type="number" name="product[${id}][quantity]" data-price="${price}" value="1" min="1" class="quantity"/>
                    </td>
                    <td data-th="Subtotal" class="text-center Subtotal">${price}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="${id}"><i class="ti-trash"></i></button>
                    </td>
                </tr>`;

                $('#product__detai').append(html);

                calculate();
            })

            $('body').on('keyup', '.quantity', function (e) {
                e.preventDefault();

                var val = parseInt($(this).val());
                var price = parseInt($(this).data('price'));


                $(this).closest('tr').find('.Subtotal').html($.number(val * price, 2));

                calculate();
            })


            function calculate() {

                var price = 0;

                $('.Subtotal').each(function ($index) {
                    price += parseFloat($(this).html().replace(/,/g, ''));
                });

                $('.total__befor').html($.number(price, 2));

                // calculate the shpiing and total

                var total = parseFloat($('.total__befor').html().replace(/,/g, ''));
                var Shipping__cost = parseInt($('.Shipping__cost').html());

                $('.total').html($.number(total + Shipping__cost, 2));

            }


            $('body').on('click', '.remove-from-cart', function (e) {
                e.preventDefault();

                var id = $(this).data('id');

                $(this).closest('tr').remove();

                //calculate total
                calculate();

            })

        });

    </script>

@endpush
