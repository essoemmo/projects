<template>
    <div class="modal fade" ref="details" id="details" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ti-close"></i></span></button>
                    <h4 class="modal-title" v-for="detail in prod.product_details"> خيارات متقدمة {{detail.title}}</h4>
                </div>
                <div class="modal-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#productDetail" class="nav-link active" data-toggle="tab">بيانات المنتج</a></li>
                            <li class="nav-item"><a href="#product2" class="nav-link" data-toggle="tab">خيارات المنتج</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="productDetail">
                                <div id="product-details">

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-car"></i>
                                            </span>
                                            <select class="form-control " v-model="prod.delivary" data-size="3"  name="delivary" v-validate="'required'" :class="{'input': true, 'border-danger':  errors.has('delivary')}">
                                                <option class="option" value="">هل يتطلب توصيل</option>
                                                <option class="option" value="0">لا يتطلب توصيل</option>
                                                <option class="option" value="1">يتطلب توصيل</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-truck"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="weight = prod.weight" placeholder="وزن المنتج" name="weight" v-validate="'required'" :class="{'input': true, 'border-danger':  errors.has('weight')}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-receipt"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="sku = prod.sku" placeholder="sku">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-panel"></i>
                                            </span>
                                            <input type="text" class="form-control" v-model="count = prod.max_count" placeholder="الكميه"  name="count" v-validate="'required'" :class="{'input': true, 'border-danger':  errors.has('count')}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control datepicker" v-model="created_at" name="created_at" v-validate="'required'" :class="{'input': true, 'border-danger':  errors.has('created_at')}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-money"></i>
                                                </span>
                                                <input type="text" class="form-control" v-model="price = prod.price" placeholder="السعر"  name="price" v-validate="'required'" :class="{'input': true, 'border-danger':  errors.has('price')}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-wand"></i>
                                                </span>
                                                <input type="text" class="form-control" v-model="net = prod.net" placeholder="الضريبه">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-home"></i>
                                                </span>
                                                <input type="number" class="form-control" v-model="stock = prod.stock" placeholder="الكميه بالمخزن"  name="stock" v-validate="'required'" :class="{'input': true, 'border-danger':  errors.has('stock')}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-download"></i>
                                                </span>
                                                <input type="text" class="form-control" v-model="discount = prod.discount" placeholder="الخصم">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="text" class="form-control"></textarea>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-tiffany save" type="button" @click="saveProductDetails()">حفظ</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="product2">
                                <div class="feature-well" v-for="feature, index in prod.features">
                                    <div class="well">
                                        <div class="form-group parent">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-shopping-cart-full"></i>
                                                </span>
                                                <input type="text" v-model="feature.title" class="form-control" name="featurePTitle" v-validate="'required'" :class="{'input': true, 'border-danger': feature.title == null || feature.title == '' ? errors.has('featurePTitle'): null }" >
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-default delete" @click="featuredel(index)"><i class="ti-close"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group child row" v-for="option, inx in feature.options">
                                            <div class="col-md-4">
                                                <div class="input-group subCategory">
                                                    <input type="text" class="form-control" v-model="option.title" placeholder="اسم الخيار"  name="optionTitle"  v-validate="'required'" :class="{'input': true, 'border-danger': option.title == null || option.title == '' ? errors.has('optionTitle'): null }" >
                                                    <input type="hidden" class="c_sort">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group subCategory">
                                                    <input type="number" class="form-control" v-model="option.price" name="optionPrice" placeholder="السعر" v-validate="'required|numeric'" :class="{'input': true, 'border-danger': option.price == null || option.price == '' ? errors.has('optionPrice'): null }" >
                                                    <input type="hidden" class="c_sort">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group subCategory">
                                                    <input type="number" class="form-control" v-model="option.count" name="optionCount" placeholder="العدد" v-validate="'required|numeric'" :class="{'input': true, 'border-danger': option.count == null || option.count == '' ? errors.has('optionCount'): null }" >
                                                    <input type="hidden" class="c_sort">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <button class="btn btn-tiffany sub-feature" type="button" @click="addSubFeature(index)">اضاافة خيار</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-tiffany add-feature" type="button" @click="addFeature()"><i class="ti-plus"></i></button>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-tiffany save" type="button" @click="saveFeature()">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    export default {
        props: ['prod', 'features', 'store', 'created_at'],
        data() {
            return {
                allFeatures: [],
                count: 0,
            }
        },
        methods: {
            addFeature() {
                this.prod.features.push({
                    id: null,
                    title: null,
                    store_id: this.store.id,
                    options: [{
                        id: null,
                        title: null,
                        price: null,
                        count: null
                    }],
                    count: ++this.count,
                    product_id: this.prod.id
                })
            },
            addSubFeature(index) {
                this.prod.features[index].options.push({
                    id: null,
                    title: null,
                    price: null,
                    count: null
                })
            },
            featuredel(index) {
                this.$Progress.start();
                if (this.prod.features.length > 0) {
                    Swal.fire({
                        title: '',
                        text: "يرجى العلم إنه بالموافقة على حذف هذا التصنيف، سيتم حذف جميع التصنيفات الفرعية التابعة لهذا الخيار، وهذه الخطوة غير قابلة للتراجع",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'red-alert',
                        confirmButtonText: "تأكيد الحذف",
                        cancelButtonText: 'تراجع',
                    }).then((result) => {
                        if (result.value) {
                            axios.get('adminpanel/product/' + this.prod.features[index].id + '/featuredel')
                                .then((data) => {
                                    this.$delete(this.prod.features, index);
                                    swal.fire('تنبيه', 'تم الحذف بنجاح', "info");
                                    this.$Progress.finish();
                                });

                        }
                    })

                } else {
                    this.$delete(this.prod.features, index);
                }
            },
            saveFeature() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        var datacat;
                        axios.post('/adminpanel/savefeatures', this.prod.features).then((data) => {
                            $('#details').modal('toggle');
                            $('#details').removeClass('show');
                            datacat = data.data;
                            this.prod.features = datacat;
                        })
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 5000
                        })
                        return;
                    }

                    Swal.fire({
                        title: 'تنبيه',
                        text: "قم باستكمال باقي البيانات",
                        type: 'warning',
                    });
                });

            },
            saveProductDetails() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        var datacat;
                        axios.post('/adminpanel/saveProductDetails', this.prod).then((data) => {
                            $('#details').modal('toggle');
                        })
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 5000
                        })
                        return;
                    }

                    Swal.fire({
                        title: 'تنبيه',
                        text: "قم باستكمال باقي البيانات",
                        type: 'warning',
                    });
                });

            }
        },
        mounted() {
            // this.allFeatures = this.features;
        }
    }
</script>

<style scoped>
    #details .input-group-addon-small {
        border-right: 1px solid #ddd !important;
    }
    /*.input-group-addon:first-child{*/
    /*    border-right: 1px solid #ddd*/
    /*}*/

    .input-group {
        display: flex;
    }

    .input-group-prepend {
        border: 1px solid #ccc;
        line-height: 36px;
        padding: 0 15px;
    }

    .add-feature .ti-plus {
        font-size: 30px;
        font-weight: 900;
    }
</style>