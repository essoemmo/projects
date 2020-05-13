<template>

    <div id="allProducts_div" class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4" v-if="index < allProducts.length" v-for="productIndex, index in productToShow">
            <div class="product-box">
                <div class="product-img-details">
                    <template v-if="!allProducts[index].product.product_photos.length">
                        <slot>
                            <img :src="'/images/placeholder.png'" alt="#" class="product-img">
                        </slot>
                    </template>
                    <template v-else-if="allProducts[index].product.product_photos.length" v-for="image in allProducts[index].product.product_photos">
                        <slot>
                            <img v-if="image.main == 1" :src="image.photo" alt="#" class="product-img">
                        </slot>
                    </template>
                    <!--                    <button type="button" class="bt btn-tiffany add-img" @click="getProdImgid(index)">اضف صوره</button>-->
                    <button type="button" class="bt btn-tiffany add-img" data-toggle="modal" data-target="#photoModal">اضف صوره</button>
                </div>
                <div class="inputs-product-body">
                    <form>
                        <div class="form-group type">
                            <span class="addon-tag"><i class="fa fa-tag"></i></span>
                            <select class="selectpicker" v-if="allProducts[index].product.product_type" v-model="allProducts[index].product.product_type.id" name="types" v-validate="'required'" :class="{'input': true, 'border-danger': allProducts[index].product.product_type.id == null ? errors.has('types'): null }">
                                <template v-for="type, index in types">
                                    <option :key="type.id" :value="type.id" :data-subtext="type.description">{{type.title}}</option>
                                </template>
                            </select>
                            <select class="selectpicker" v-else="allProducts[index].product.product_type" v-model="allProducts[index].product.product_type" name="types" v-validate="'required'" :class="{'input': true, 'border-danger': allProducts[index].product.product_type == null ? errors.has('types'): null }">
                                <template v-for="type, index in types">
                                    <option :key="type.id" :value="type" :data-subtext="type.description">{{type.title}}</option>
                                </template>
                            </select>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <span class="addon-tag"><i class="fa fa-product-hunt"></i></span>
                            <input type="text" class="form-control product_name" name="product_name" v-model="allProducts[index].title" v-validate="'required'" :class="{'input': true, 'border-danger': allProducts[index].title == null || allProducts[index].title == '' ? errors.has('product_name'): null }">
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <span class="addon-tag"><i class="fa fa-money"></i></span>
                                <input type="number" min="1" max="1000000" class="form-control price" name="price" v-model="form.price = allProducts[index].product.price" v-validate="'required|numeric'" :class="{'input': true, 'border-danger': allProducts[index].product.price == null || allProducts[index].product.price == '' ? errors.has('price'): null }">
                                <div class="clearfix"></div>
                            </div>
                            <div class="col">
                                <span class="addon-tag"><i class="fa fa-tag"></i></span>
                                <input type="number" min="1" max="1000000" class="form-control product_count" name="count" v-model="form.count = allProducts[index].product.max_count" v-validate="'required|numeric'" :class="{'input': true, 'border-danger': allProducts[index].product.max_count == null || allProducts[index].product.max_count == '' ? errors.has('count'): null }">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="product-desc col-sm-6">
                                <span class="addon-tag"><i class="fa fa-tag"></i></span>
                                <select multiple="multiple" class="selectpicker" v-model="allProducts[index].product.categories" name="categories">
                                    <template v-for="category, index in categories">
                                        <option :key="category.id" :value="category" :selected="true">{{category.title}}</option>
                                    </template>
                                </select>
                                <button class="btn btn-tiffany add-category" data-toggle="modal" data-target="#category" type="button"><i class="ti-plus"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="category-select col-sm-6">
                                <!--                                <button class="btn btn-default optional-category" type="button"   @click="sendId(index)">التفاصيل <i class="ti-angle-left"></i></button>-->
                                <button class="btn btn-default optional-category" type="button" data-toggle="modal" data-target="#editdetails"  @click="sendId(index)">التفاصيل <i class="ti-angle-left"></i></button>
                            </div>
                        </div>
                        <div class="form-group" style="float:right">
                            <button class="btn btn-tiffany save save-product" type="button" @click="saveProduct(index)">save</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>

                </div>
            </div>
        </div>
        <button v-if="allProducts.length > productToShow - 1" @click="ToShow" class="btn btn-tiffany btn-block">show more reviews</button>
    </div>

</template>

<script>
    export default {
        props:['store','categories','product_type','allProducts'],
        data(){
            return {
                selected: '',
                productToShow: 6,
                types: [],
                prods: [],
                type: {
                    text: null,
                    value: null,
                },
                form: new Form({
                    type: '',
                    product_name: '',
                    count: '',
                    price: '',
                    categorySelect:[]
                }),
            }
        },
        methods:{
            saveProduct:function (index) {

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if (this.allProducts[index].id == null){
                            $('.pace-demo').removeClass('hidden');
                            axios.post('/adminpanel/saveproduct',
                                {
                                    id: this.allProducts[index].id,
                                    product_name: this.allProducts[index].title,
                                    count: this.allProducts[index].product.max_count,
                                    price: this.allProducts[index].product.price,
                                    type: this.allProducts[index].product.product_type.id,
                                    categories: this.allProducts[index].product.categories,
                                    store_id:this.store.id
                                }).then(({ data }) => {
                                this.allProducts[index] = data;

                                $('.pace-demo').addClass('hidden');
                            }).catch(err => {
                                $('.pace-demo').addClass('hidden');
                            });
                        }else{
                            $('.pace-demo').removeClass('hidden');
                            axios.post('/adminpanel/updateproduct',
                                {
                                    id: this.allProducts[index].id,
                                    product_name: this.allProducts[index].title,
                                    count: this.allProducts[index].product.max_count,
                                    price: this.allProducts[index].product.price,
                                    type: this.allProducts[index].product.product_type.id,
                                    cats: this.allProducts[index].product.categories,
                                    store_id:this.store.id
                                }).then(({ data }) => {

                                $('.pace-demo').addClass('hidden');
                            });
                            this.form.type = null;
                        }
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 5000
                        })
                        return;
                    }

                    if ( this.allProducts[index].product.product_type == '' || this.allProducts[index].product.product_type.id == null){
                        Swal.fire({
                            title: 'تنبيه',
                            text: "قم باختيار نوع المنتج لتتمكن من حفظ المنتج",
                            type: 'warning',
                        });
                    }else{
                        Swal.fire({
                            title: 'تنبيه',
                            text: "قم باستكمال باقي البيانات",
                            type: 'warning',
                        });
                    }
                });
                // if (this.allProducts[index].product_tyoe == '' || this.allProducts[index].title == ''){

                // }else{

                // }
            },
            sendId(index){
                $('.optional-category').attr('data-id',this.allProducts[index].product.id);
                // if (this.allProducts[index].product.id != null){
                //     $('#details').modal('toggle');
                //     this.$emit('getProductId',this.allProducts[index].product.id)
                // }else{
                //     Swal.fire({
                //         title: 'تنبيه',
                //         text: "قم بحفظ هذه البيانات أولا قبل الاستكمال",
                //         type: 'warning',
                //     });
                // }
            },
            getProdImgid(index){
                if (this.allProducts[index].product.id != null){
                    $('#product-images').modal('toggle');
                    this.$emit('getProductId',this.allProducts[index].product.id)
                }else{
                    Swal.fire({
                        title: 'تنبيه',
                        text: "قم بحفظ هذه البيانات أولا قبل الاستكمال",
                        type: 'warning',
                    });
                }
            },
            productdel(index){
                axios.post('/adminpanel/product/productdel', {id: this.allProducts[index].id}).then((data) => {
                    this.allProducts = data.data;
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: "تم الحذف بنجاح",
                        showConfirmButton: false,
                        timer: 2000
                    })
                })
                this.allProducts.splice(index,1);
            },
            ToShow(){
                this.productToShow += 6
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });

            }
        },
        mounted() {
            this.types = this.product_type;
            this.prods = this.allProducts;
        }
    }
</script>

<style scoped>
    .product-desc .dropdown-menu{
        position: static !important;
    }

    .dropdown-menu.open {
        left: 70px;
        overflow: visible;
    }


    input{
        padding-right:30px;
    }

</style>
