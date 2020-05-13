<template>
    <div class="order-table">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">المنتجات</h3>
                <div class="heading-elements">
                    <button data-toggle="modal" data-target="#ordertable" class="btn btn-tiffany" type="button"><i class="fa fa-plus"></i> اضافة</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>المنتج</th>
                        <th>الكميه</th>
                        <th>السعر</th>
                        <th>المجموع</th>
                    </tr>
                    <tr class="productRow" v-for="pro, index in SavedProducts" :key="pro.id" :class="{hidden: productvisible}">
                        <td>
                            <button style="float: right;margin-top: 20px;margin-left: 20px;" class="btn btn-danger" @click="productdel(index)"><span>x</span></button>
                            <div class="media">
                                <img class="media-object media-right img-responsive" :src="pro.photo">
                                <div class="media-body media-left">
                                    <div>{{pro.title}}</div>
                                    <div v-if="pro.option == null">{{pro.price}}</div>
                                    <div v-else-if="pro.option.price">{{pro.option.price + pro.price}}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <count :prodata="pro" :index="index" @productCount="countchange"></count>
                        </td>
                        <td>
                            <slot v-if="pro.option == null">
                                <a href="javascript:void(0)">{{pro.price}}</a>
                            </slot>
                            <slot v-else-if="pro.option.price">
                                <a href="javascript:void(0)">{{pro.option.price + pro.price}}</a>
                            </slot>
                        </td>
                        <td>
                            <slot v-if="pro.option == null">
                            {{pro.total = pro.price * pro.count}}
                            </slot>
                            <slot v-else-if="pro.option.price">
                                {{pro.total = (pro.price + pro.option.price) * pro.count}}
                            </slot>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">مجموع السله</td>
                        <td>{{sallaTotal}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">تكلفة الشحن</td>
                        <td>{{shippingOption != null && shippingOption != 0 ? shippingOption.cost + Number(shippingOption.cash_delivery_commission) : 0}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">كوبونات التخفيض</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">اجمالي الطلب</td>
                        <td>{{shippingOption != null && shippingOption != 0 ? shippingOption.cost+Number(shippingOption.cash_delivery_commission)+sallaTotal : sallaTotal}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal fade" ref="ordertable" id="ordertable" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">اضافة منتج</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="javascript:void(0)" @click="addProduct()"><i class="fa fa-plus"></i> إضافة منتج جديد</a>
                            </div>
                            <div class="col-md-8 col-md-offset-1">
                                <input @keyup="getsearch(product.title)" type="text" class="form-control" v-model="product.title" placeholder="البحث في قائمة المنتجات">
                                <ul :class="{ hidden: menuvisible}" class="list-unstyled search-menu">
                                    <li v-for="product, index in productsfilter" @click="getproduct(index)" :key="product.id" :style="{opacity: product.product.max_count == 0 ? 0.4 : 1}">
                                        <div class="media">
                                            <img v-if="product.product.product_photos[0]" class="media-object media-right img-responsive" :src="product.product.product_photos[0].photo">
                                            <img v-else class="media-object media-right img-responsive" src="/images/placeholder.png">
                                            <div class="media-body media-left">
                                                <div>{{product.title}}</div>
                                                <div>{{product.product.price}}</div>
                                            </div>
                                            <span style="color:red" v-if="product.product.max_count == 0">تم اجتياز الحد الاقصي للمنتج</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="add-product" v-if="!addProClicked">
                            <form @submit="formSubmit" enctype="multipart/form-data" data-parsley-validate="">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"></label>
                                                <input name="title" required="" class="form-control" v-model="product.title" placeholder="اسم المنتج">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="productType"></label>
                                                <select name="productType" required="" class="selectpicker" v-model="product.type">
                                                    <option v-for="type in product_type" :key="type.id" :value="type.id">{{type.title}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="count"></label>
                                                <input name="count" required="" class="form-control" placeholder="الكميه" v-model="product.max_count">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price"></label>
                                                <input name="price" required="" class="form-control" placeholder="السعر" v-model="product.price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="image">
                                        <img src="/images/placeholder.png" class="img-responsive" alt="">
                                        <input type="file" required="" name="image" @change="upload">
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary">add new product</button>
                            </form>
                        </div>

                        <div class="row product-show" v-if="addProClicked">
                            <div class="row">
                                <div class="col-md-8">
                                    <div v-if="product.features" v-for="option, index in product.features">
                                        <label :for="option.id">
                                            <input type="radio" v-model="selectedFeature" :name="option.title" :value="option" @change="selectfeature">
                                            <span>{{option.title}}</span>
                                        </label>
                                    <table class="table">
                                        <tr>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Count</th>
                                        </tr>
                                        <tr v-for="opt in option.options" v-if="opt.count > 0">
                                            <td>
                                                <label :for="opt.id">
                                                    <input type="radio" :disabled="selectedFeature == null || selectedFeature.id != opt.feature_id" @change="selectOption" v-model="selectedOptionFeature" :name="opt.title" :value="opt">
                                                    {{opt.title}}
                                                </label>
                                            </td>
                                            <td>
                                                {{opt.price}}
                                            </td>
                                            <td>
                                                {{opt.count}}
                                            </td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="media">
                                        <img class="media-object media-right img-responsive" :src="product.photo">
                                        <div class="media-body media-left">
                                            <div>{{productname}}</div>
                                            <div>{{product.price}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-tiffany" type="button" @click="saveproduct(product)">حفظ</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>

<script>
    import count from './count';
    export default {
        props:['products','shippingOption','product_type'],
        data(){
            return {
                image:'',
                orderprice:null,
                ordercount:null,
                selectedFeature:null,
                selectedOptionFeature:null,
                productname:'',
                count:0,
                product:{
                    id:null,
                    title:null,
                    price:null,
                    max_count:null,
                    photo:null,
                    option:null,
                },
                SavedProducts:[],
                allProducts: [],
                productsfilter: '',
                sallaTotal: 0,
                total:0,
                menuvisible: true,
                addProClicked: true,
            }
        },
        methods:{
            getproduct(index){
                if (this.productsfilter[index].product.max_count == 0){
                    return;
                } else{
                    this.product = {
                        id: this.productsfilter[index].id,
                        title: this.productsfilter[index].title,
                        price: this.productsfilter[index].product.price,
                        max_count: this.productsfilter[index].product.max_count,
                        photo: this.productsfilter[index].product.product_photos[0].photo,
                        features: this.productsfilter[index].product.features,
                    }
                    this.productname = this.productsfilter[index].title
                    this.menuvisible = true;
                    this.addProClicked = true;
                }
            },
            getsearch:function (search) {
                // axios.get('/adminpanel/orders/refreshproducts').then((data) => {
                //     this.allProducts = data.data;
                // });
                if(search){
                    this.menuvisible = false
                    this.productsfilter = this.allProducts.filter(product => {
                        return product.title.match(search);
                    });
                }else{
                    this.productsfilter = null;
                    this.menuvisible = true;
                }
            },
            saveproduct:function (product) {
                var productcount = 0;
                if (this.productsfilter.length > 0){
                    $('#ordertable').modal('toggle');
                    $('#ordertable').removeClass('show');
                    if (product.id != null){
                        this.allProducts = this.allProducts.map((pro)=>{
                           if (pro.id == product.id){
                               pro.product.max_count = pro.product.max_count - 1;
                           }
                           return pro;
                        });
                        this.SavedProducts.push({
                            id:product.id,
                            title:product.title,
                            price:product.price,
                            max_count:product.max_count - 1,
                            photo:product.photo,
                            count:1,
                            total:product.price + (product.option ? product.option.price : 0),
                            option:product.option?product.option:null,
                            procount:++this.count
                        });
                        this.productvisible = false;
                        this.SavedProducts = this.SavedProducts.map((product)=>{
                            productcount += product.total;
                            return product;
                        })
                        this.sallaTotal = productcount;
                        this.selectedOptionFeature != null ? this.selectedOptionFeature.count -= 1 : null;
                        this.$emit('getSelectedProduct',this.SavedProducts);
                        this.selectedOptionFeature = null;
                        this.selectedFeature = null;
                    }else{
                        this.productvisible = true;
                    }

                    this.productsfilter = null;
                    this.product = {};
                    this.productname = null;
                }else{
                    Swal.fire({
                        title: 'تنبيه',
                        text: "من فضلك اختار المنتج",
                        type: 'warning',
                    });
                }
            },
            selectfeature(){
                this.selectedOptionFeature = null;
            },
            selectOption(){
                this.product.option = null;
                this.product.option =  this.selectedOptionFeature;
            },
            productdel(index){
                this.allProducts = this.allProducts.map((pro)=>{
                    if (pro.id == this.SavedProducts[index].id){
                        pro.product.max_count = this.SavedProducts[index].max_count + this.SavedProducts[index].count;
                    }
                    return pro;
                });
                this.sallaTotal = this.sallaTotal - this.SavedProducts[index].total
                this.SavedProducts.splice(index,1)
            },
            addProduct(){
                this.addProClicked = false;
                this.selectedFeature = null;
                this.selectedOptionFeature = null;
                this.productname = null;
                this.product = {
                    id:null,
                    title:null,
                    price:null,
                    max_count:null,
                    photo:null,
                    option:null,
                };
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            upload(e){
                this.image = e.target.files[0];
            },
            formSubmit(e){
                e.preventDefault();
                let currentObj = this;
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('image', this.image);


                axios.post('/adminpanel/orders/saveproduct', this.product)
                    .then((data)=> {
                        this.addProClicked = true;
                        this.product = data.data;
                        formData.append('product_id',this.product.product_id)
                        axios.post('/adminpanel/imageSubmit', formData,config).then((data) => {
                            this.product = data.data.product_details[0];
                            this.allProducts.push(this.product);
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: "تم الحفظ بنجاح",
                                showConfirmButton: false,
                                timer: 2000
                            })
                            this.image = null;
                            this.product = {
                                id:null,
                                title:null,
                                price:null,
                                max_count:null,
                                photo:null,
                                option:null,
                            };
                        })


                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
            },
            countchange(count,index){
                if (this.SavedProducts[index].max_count + this.SavedProducts[index].count < count){
                    console.log('clicked')
                    return
                }else{
                    var minuscount = Number(count) - this.SavedProducts[index].count;
                    if (minuscount > 0){
                        this.SavedProducts[index].max_count += 1;
                        this.SavedProducts[index].count = Number(count);
                        this.SavedProducts[index].max_count -= Number(count);
                    }
                    if (minuscount < 0){
                        this.SavedProducts[index].max_count = (this.SavedProducts[index].max_count + this.SavedProducts[index].count) - Number(count);
                        this.SavedProducts[index].count = Number(count);
                    }
                    this.allProducts = this.allProducts.map((pro)=>{
                        if (pro.id == this.SavedProducts[index].id){
                            pro.product.max_count = this.SavedProducts[index].max_count;
                        }
                        return pro;
                    });
                    if (this.SavedProducts[index].option != null){
                        this.sallaTotal += minuscount * (this.SavedProducts[index].price + this.SavedProducts[index].option.price);
                    }else{
                        this.sallaTotal += minuscount * this.SavedProducts[index].price;
                    }
                }
            }
        },
        mounted() {
            this.allProducts = this.products;
        },
        components:{
            count
        }
    }
</script>

<style scoped>
    .order-table .table tr th ,.order-table .table tr td{
        text-align: right;
        padding-right:10px
    }
    .order-table .table tr:first-child{
        height: 50px;
        border-bottom: 1px solid #f7f7f7;
        background: #f7f7f7;
    }
    .order-table .table .productRow{
        height: 70px !important;
    }
    .order-table .table tr:not(:first-child){
        height: 50px;
        border-bottom: 1px solid #f7f7f7;
    }
    .search-menu{
        border: 1px solid #ccc;
        padding: 2px 10px;
        max-height: 110px;
        height: auto;
        overflow-y:scroll;
    }
    .search-menu li{
        padding: 5px 0;
        cursor:pointer;
        background: #f7f7f7;
    }
    .search-menu li:not(:last-child){
        border-bottom: 1px solid #ccc;
    }
    .media-object{
        width: 70px;
        float:right;
    }
    .product-show .media-object{
        width: 100px;
        margin-right: 50px;
    }
    .table td{
        position: relative;
    }
    .table{
        display: table;
    }
    .order-table .card-title{
        float: right;
    }
    .order-table .heading-elements{
        float: left;
    }
</style>