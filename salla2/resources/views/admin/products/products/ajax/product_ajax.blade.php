@if(count($products) > 0)
<?php $script = "" ?>
@foreach($products as $product)
<?php
if ($product->hidden == 1) {
    $script .= "ProductHide({$product->id});";
}
$type =($product->product_type()->first());
$code ="";
if($type!==null)
{
$code =App\Models\ProductTypeCode::where("code", $type->type_code)->first();
if($code !==null )
{
    $code = $code->code;
}
}
?>

<div class="col-md-4 col-sm-3">

    <div class="product-box" >
        <form name="frm_product">
            <div class="product-img-details">
                <img src="{{ asset($product->mainPhoto()) }}" alt="#" class="product-img">
                <button type="button" class="bt btn-tiffany add-img"
                        onclick="getProdImgid(this)"> {{_i("Add Photo")}}</button>
            </div>
            <div class="inputs-product-body">

                @csrf
                <div class="form-group type">
                    <span class="addon-tag"><i class="fa fa-tag"></i></span>

                    {!! Form::select('types', $product_type,$product->Type() , ['class' => 'input selectpicker' ,"placeholder" =>_i("Product Type")]) !!}
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <span class="addon-tag"><i class="ti-shopping-cart-full"></i></span>
                    <input type="text" class="form-control product_name input"
                           value="<?= ($product->product_details()->first() != null) ? $product->product_details()->first()->title : "" ?>"
                           name="product_name" placeholder="{{_i("Product Name")}}" required=""
                           class="input border-danger">
                    <div class="clearfix"></div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <span class="addon-tag"><i class="ti-money"></i></span>
                        <input type="number" min="1" max="1000000" class="form-control price"
                               value="<?= $product->price ?>" name="price" required=""
                               placeholder="{{_i("Price")}}" class="input border-danger">
                        <div class="clearfix"></div>
                    </div>
                    <div class="col">
                        <span class="addon-tag"><i class="ti-tag"></i></span>
                        <input type="number" min="1" max="1000000" class="form-control product_count"
                               value="<?= $product->max_count ?>" name="count" placeholder="{{_i("Count")}}"
                               required="" class="input border-danger">
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="product-desc col-sm-6 input-group">
                        <span class="addon-tag"><i class="fa fa-tag"></i></span>
                        {!! Form::select('categories[]', $cats,$product->Category(), [ "multiple" =>"multiple" , "class" => " selectpicker" ]) !!}
                        <button class="btn btn-tiffany add-category input-group-btn" data-toggle="modal"
                                data-target="#category" type="button"><i class="ti-plus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="category-select col-sm-6">
                        <button class="btn btn-default optional-category" type="button"  onclick="getDetails(this)" data-code="{{$code}}">{{_i("Details")}}<i class="ti-angle-left"></i>
                        </button>



                    </div>
                </div>
                <div class="form-group " style="float:right">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <!--<input type="hidden" name="product_type_code" value="{{$code}}">-->

                    <button class="btn btn-tiffany save save-product" type="button"
                            onclick="saveProduct(this)">{{_i("Save")}}</button>
                </div>

                <span  class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-default" href="#">{{_i("More")}} <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu active">

                        <!--<li><a href="javascript:void(0)" onclick="productdel(this)">{{_i("delete")}}</a></li>-->

                        <li><a class="dropdown-item get_link" href="#" data-id="{{$product->id}}
                               " data-clipboard-action="copy" data-clipboard-text="{{request()->getScheme()}}://{{$store->domain}}.{{request()->getHost()}}/store/product/{{$product->id}}"><i class="icofont icofont-link"></i>
                                {{_i('Get URL')}}</a></li>
                        <li><a class="dropdown-item repeat" href="#" data-id="{{$product->id}}"data-toggle="modal" data-url="{{ route('product_dublicate',$product->id) }}" data-target="#repeatProduct"><i class="icofont icofont-page"></i>{{_i('Duplicate')}}</a></li>
                        <li><a class="dropdown-item stats" href="#" data-id="{{$product->id}}" data-toggle="modal" data-target="#statsProduct"><i class="icofont icofont-chart-line-alt"></i>{{_i('Statistics')}}</a></li>
                        <li><a class="dropdown-item orders" href="{{route('product.customers',$product->id)}}" data-id="{{$product->id}}"><i class="icofont icofont-law-document"></i>{{_i('Product orders')}}</a></li>

                        <li><a class="dropdown-item hide" href="#" data-id="{{$product->id}}"><?= ($product->hidden==0)? '<i class="icofont icofont-eye-blocked"></i>'._i('Temporarily hide product') : '<i class="icofont icofont-eye-alt"></i>'._i('Show product') ?></a></li>

                        <li><a class="dropdown-item deletepro text-danger" href="#" data-id="{{$product->id}}" onclick="confirmBeforeDelete(this)" ><i class="icofont icofont-basket"></i>{{_i('Final deletion')}}</a></li>
                    </ul>
                </span>

                <?php
                 $langs = App\Models\Language::get();
                ?>


                <div class="btn-group">
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title="{{_i('Translation')}}">
                      <span class="ti ti-settings"></span>
                    </button>
                    <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
                @foreach ($langs as $lang)
                    @if ($lang->id != $product->product_details()->first()->lang_id)
                    <li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="{{$product->id}}" data-lang="{{$lang->id}}"
                        style="display: block; padding: 5px 10px 10px;">{{$lang->title}}</a></li>
                    @endif
                @endforeach
                    </ul>
                  </div>

                <div class="clearfix"></div>

            </div>
        </form>
    </div>

</div>
@endforeach
@push("js")
<script type="text/javascript">
    $(function(){

    })

</script>
@endpush
<button v-if="allProducts.length > productToShow - 1" onclick="ToShow"
        class="btn btn-tiffany btn-block">{{_i("show more reviews")}}</button>

@else

<div class="col-12" id='no-items'>
    <div class="alert alert-danger text-center">
        <p class="lead">{{ _i('No Products') }}</p>
    </div>
</div>

@endif

@include('admin.products.products.includes.productstatus')
@include('admin.products.products.includes.trans')
@include('admin.products.products.includes.repeat')
@include('admin.products.products.includes.btn.delete')

