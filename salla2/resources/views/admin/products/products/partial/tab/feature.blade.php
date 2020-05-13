<div class="tab-pane"  id="productFeature">
    <form method="post" id="form-features">
        {{csrf_field()}}
        {{method_field('post')}}
        <div class="product-features" id="new_feature">
            <input type="hidden" form="form-features" name="id" class="product_id" value="">
            <div class="form-group">
                <div class="input-group mb-3 mt-3">
                    <span class="input-group-prepend">
                        <i class="ti-tag"></i>
                    </span>
                    <input type="text" form="form-features" class="form-control feature_title"
                           placeholder="{{_i('The name of the option (such as color, size, ...)')}}"
                           name="feature_title[]">
                    <button type="button"
                            class="btn btn-danger btn-sm mr-3 delete_feature">{{ _i('Delete') }}</button>
                </div>
            </div>

            <div class="form-group row new_option">

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-prepend">
                            <i class="ti-tag"></i>
                        </span>
                        <input type="text" class="form-control feature_option_title"
                               form="form-features" placeholder="{{ _i('Option') }}"
                               name="feature_option[0][t][]">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-prepend">
                            <i class="ti-money"></i>
                        </span>
                        <input type="text" class="form-control feature_option_price"
                               form="form-features" placeholder="{{ _i('Additional Price') }}"
                               name="feature_option[0][p][]">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-prepend">
                            <i class="ti-home"></i>
                        </span>
                        <input type="text" form="form-features"
                               class="form-control feature_option_count"
                               placeholder="{{ _i('Available Quantity') }}"
                               name="feature_option[0][c][]">
                    </div>
                </div>

            </div>

            <div class="new_option_one">

            </div>

            <button type="button" class="btn btn-tiffany mb-4 add_option"><i
                    class="ti-plus"></i>{{ _i('Add Option') }}</button>

            <br>
        </div>

        <div class="new_feature_one">

        </div>

    </form>


    <button type="button" onclick="myJsFunc();"
            class="btn btn-block btn-default btn-outline-default add_new_feature"><i
            class="ti-plus"></i></button>

    <div class="form-group mt-3">
        <button class="btn btn-tiffany save" form="form-features"
                type="submit">{{_i('save')}}</button>
    </div>

</div>