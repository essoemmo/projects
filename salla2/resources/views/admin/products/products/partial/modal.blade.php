<!-- Modal -->
<?php
?>

@include("admin.products.products.partial.tab.photo")



<!-- Modal -->
<div class="modal fade" id="editdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{_i('Edit the product details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="nav-item "><a href="#productDetail" class="nav-link active"
                                                 data-toggle="tab">{{_i('Product Details')}}</a></li>
                        <li class="nav-item  " data-feature style="display: none">
                            <a href="#productFeature" class="nav-link productFeature"
                               data-toggle="tab">{{_i('Product Features')}}</a></li>

                        <li class="nav-item  " data-feature style="display: none">
                            <a href="#productSeo" class="nav-link productSeo"
                               data-toggle="tab">{{_i('Product Seo')}}</a></li>
                        <li class="nav-item " style="display: none" data-card=''>
                            <a href="#productCard" class="nav-link " data-toggle="tab">{{_i('Product Codes')}}
                            </a>
                        </li>
                        <li class="nav-item " style="display: none" data-digital=''>
                            <a href="#digitalProduct" class="nav-link " data-toggle="tab">{{_i('Attatch Files')}}
                            </a>
                        </li>
                        <li class="nav-item " style="display: none" data-donation=''>
                            <a href="#dontateProduct" class="nav-link producDnation"
                               data-toggle="tab">{{_i('Donation')}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        @include("admin.products.products.partial.tab.details")
                        @include("admin.products.products.partial.tab.feature")
                        @include("admin.products.products.partial.tab.seo")
                        @include("admin.products.products.partial.tab.cards")
                        @include("admin.products.products.partial.tab.digital")
                        @include("admin.products.products.partial.tab.donation")
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push("js")
    <script type="text/javascript">

        // product type / Card
        $(function () {

            $('body').on('click', '.del_card', function (e) {
                var id = $('.product_id').val();
                e.preventDefault();
                $(this).closest('.row').remove();

            });

            // donate product
            $('body').on('click', '.pr_donate', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#Donate_id').val(id);
                $.ajax({
                    url: '{{route('get_donate')}}',
                    method: "get",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    // cache       : false,
                    // contentType : false,
                    // processData : false,

                    success: function (response) {

                        console.log(response)
                        if (response.status == 'success') {
                            $('#get_new_data_donate').empty();
                            for (var i = 0; i < response.data.length; i++) {
                                $('#get_new_data_donate').append(
                                    `        <div class="row form-group">
                                        <label>{{_i('min_price')}}</label>
                                        <input type="number" name="min_price[]" min="1" value="${response.data[i].min_price}" class="form-control" required="">
                                        <br>
                                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                    </div>

                                    <div class="row form-group">
                                        <label>{{_i('max_price')}}</label>
                                        <input type="number" name="max_price[]" min="1" value="${response.data[i].max_price}" class="form-control" required="">
                                        <br>
                                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                    </div>`
                                )
                            }

                        } else {
                            $('#get_new_data_donate').empty();
                            $('#append_donate').empty();
                            $('#get_new_data_donate').append(
                                `       <div class="row form-group">
                                        <label>{{_i('min_price')}}</label>
                                        <input type="number" name="min_price[]" min="1" class="form-control" required="">
                                        <br>
                                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                    </div>

                                    <div class="row form-group">
                                        <label>{{_i('max_price')}}</label>
                                        <input type="number" name="max_price[]" min="1" class="form-control" required="">
                                        <br>
                                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                    </div>`
                            )
                        }
                    },
                });
            });
            $('body').on('click', '#increaes_code_donate', function (e) {
                e.preventDefault();
                var html = `   <div class="row form-group">
                                        <label>{{_i('min_price')}}</label>
                                        <input type="number" name="min_price[]" min="1"  class="form-control" required="">
                                        <br>
                                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                    </div>

                                    <div class="row form-group">
                                        <label>{{_i('max_price')}}</label>
                                        <input type="number" name="max_price[]" min="1" class="form-control" required="">
                                        <br>
                                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                    </div>`;
                $('#append_donate').append(html);
            });
            $('body').on('submit', '#form_dontate', function (e) {

                e.preventDefault();
                var id = $('.product_id').val();
                $('#Donate_id').val(id);
                $.ajax({
                    url: '{{route('post_donate')}}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // console.log(response.errors.title);

                        if (response.status == 'success') {

                            new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: "{{ _i('Added Successfly')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        } else {
                            new Noty({
                                type: 'error',
                                layout: 'topRight',
                                text: "{{ _i('Fail')}}",
                                timeout: 2000,
                                killer: true
                            }).show();
                        }
                    }

                });
            });
        });
    </script>
@endpush
