<div class="tab-pane" id="productSeo">
    <form method="post" id="form-seo">
        {{csrf_field()}}
        {{method_field('post')}}

        <div class="content mt-4">

            <input type="hidden" class="item_id" name="item_id"
                   value="">

            <div class="form-group row">
                <label
                    class="col-sm-2 col-form-label" for="title">{{ _i('Title') }}</label>
                <div class="col-sm-10">
                    <input type="text" id="title" name="meta_title" class="form-control meta_title"
                           placeholder="{{ _i('Product Page Title') }}"
                           value="">
                </div>
            </div>

            <div class="form-group row">
                <label
                    class="col-sm-2 col-form-label"
                    for="description">{{ _i('Description') }}</label>
                <div class="col-sm-10">
                <textarea name="meta_description" id="description" cols="30"
                          rows="30" style="height: 100px" class="form-control meta_description"
                          placeholder="{{ _i('Product Page Description') }}"></textarea>
                </div>
            </div>

        </div>

    </form>
    <hr>
    <div class="form-group mt-3">
        <button class="btn btn-tiffany save" form="form-seo"
                type="submit">{{_i('save')}}</button>
    </div>

</div>
