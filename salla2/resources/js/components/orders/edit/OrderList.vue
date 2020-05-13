<template>
    <div class="orderList">
        <div class="card panel-flat order-info-panel">
            <div class="card-body text-center row">
                <div class="col-sm-4">
                    <span class="order-top-line">
                        رقم الطلب
                    </span>
                    <div class="order-second-line">
                        {{ordernumber}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="order-top-line">
                        التاريخ
                    </span>
                    <div class="order-second-line">
                        {{created_at | formatDate}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="order-top-line">
                        حالة الطلب
                    </span>
                    <div class="order-second-line">
                        مفعل
                    </div>
                </div>
            </div>
        </div>
        <div class="row order-column">
            <OrderUser ref="orderuser" :users="users" @getSelectedUser="getuser"></OrderUser>
            <Shipping ref="ordershipping" :user="user" :countries="countries" :cities="cities" @getSelectedShipping="getshipping"></Shipping>
            <Payment ref="payment" @getSelectedPayment="getpayment" :transtransaction_types="transtransaction_types"></Payment>
        </div>
            <OrderTable ref="ordertable" :product_type="product_type" @getSelectedProduct="getproducts" :shippingOption="shippingOption" :products="products"></OrderTable>
        <div class="row">
            <div class="col-md-6">
                <button :disabled="disableButton()" class="btn btn-tiffany btn-block" @click="saveall()">save</button>
            </div>
            <div class="col-md-6">
                <button :disabled="ordervisible" class="btn btn-default btn-block">print</button>
            </div>
        </div>
    </div>
</template>

<script>
    import OrderTable from "./OrderTable";
    import Payment from "./Payment";
    import Shipping from "./Shipping";
    import OrderUser from "./OrderUser";
    export default {
        props:['getaddress','getorder','transactions','product_type','ordernumber','users','countries','cities','products','transtransaction_types'],
        data(){
            return {
                user:{
                    id:null,
                    name:null,
                    email:null,
                    phone:null
                },
                'date':new Date(),
                'address':{},
                'order':null,
                'payment':null,
                'created_at':null,
                'allProduct':[],
                'shippingOption':null,
                'ordervisible':true,
            }
        },
        methods:{
            getuser(user){
                this.user = {
                    id: user.id,
                    name: user.name,
                    email: user.email,
                    phone: user.phone
                }
            },
            getshipping(address,shipping){
                this.shippingOption = null;
                this.shippingOption = shipping;
                this.address = address;
            },
            getproducts(products){
                this.allProduct = products;
            },
            getpayment(payment){
                this.payment = payment;
            },
            disableButton(){
                if(this.user.id != null && this.shippingOption != null && this.allProduct.length > 0){
                    return false
                }
                return true;
            },
            saveall(){
                if (this.disableButton() === false){
                    axios.post('/adminpanel/updateallorders',{order: this.getorder,user:this.user,address:this.address,product:this.allProduct,ordernumber:this.ordernumber,shippingOption:this.shippingOption,payment:this.payment}).then((data)=>{
                        this.order = data.data;
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 3000
                        });
                        this.ordervisible = false;
                    });
                }
            }
        },
        mounted(){
            var productcount = 0;
            this.order = this.getorder;
            this.created_at = this.getorder.created_at;
            this.$refs.orderuser.username = this.order.user.name;
            this.user.id = this.order.user.id;
            this.user.name = this.order.user.name;
            this.user.email = this.order.user.email;
            this.user.phone = this.order.user.phone;
            this.$refs.orderuser.phonenumber = this.order.user.phone;
            this.$refs.orderuser.uservisible = false;
            if (this.getaddress.country_id != null && this.getaddress.city_id != null){
                this.$refs.ordershipping.selectedOption = this.order.shipping_option ? this.order.shipping_option : '';
                this.shippingOption = this.order.shipping_option;
                this.$refs.ordershipping.address = this.getaddress;

                this.$refs.ordershipping.shippingaccept = '1';
                if (this.$refs.ordershipping.selectedOption != ''){
                    this.$refs.ordershipping.optionshipvisible = false;
                    this.$refs.ordershipping.addressvisible = false;
                }
                this.$refs.ordershipping.citytitle = this.getaddress.city.title;
                this.$refs.ordershipping.countrytitle = this.getaddress.country.title;
            }else{
                this.$refs.ordershipping.optionshipvisible = false;
                this.$refs.ordershipping.noship = false;
                this.shippingOption = 0;
            }
            // console.log(this.order.order_products)
            // console.log(this.$refs.ordertable.SavedProducts,this.order.order_products.length);
            for (var i = 0;i < this.order.order_products.length ; i++){
                this.$refs.ordertable.productvisible = false;

                this.$refs.ordertable.SavedProducts.push({
                    count: this.order.order_products[i].count,
                    id: this.order.order_products[i].product_id,
                    max_count: this.order.order_products[i].product.max_count,
                    price: this.order.order_products[i].price,
                    title: this.order.order_products[i].title,
                    total: this.order.order_products[i].price * this.order.order_products[i].count,
                });

            }
            this.products.map((product)=>{
                this.$refs.ordertable.SavedProducts.map((save)=>{
                    if (product.product.id == save.id){
                        save.title = product.title;
                    }
                })
            });

            this.$refs.ordertable.SavedProducts.map((product)=>{
                productcount += product.total;
                return product;
            });
            this.$refs.ordertable.sallaTotal = productcount;
            this.allProduct = this.$refs.ordertable.SavedProducts;
            this.$refs.payment.payvisible = false;
            if (this.transactions == 0){
                this.$refs.payment.selected = 'بانتظار الدفع';
            } else{
                this.$refs.payment.transtransaction_types.map((type)=>{
                    if (type.id == this.transactions.type_id) {
                        this.$refs.payment.selected = type.title;
                    }
                    return type;
                });
                this.payment = {
                    id:this.order.transactions[0].id,
                    code:this.order.transactions[0].code,
                    main:this.order.transactions[0].main,
                    title:this.order.transactions[0].title,
                }
            }
        },
        components:{
            OrderUser,
            Shipping,
            Payment,
            OrderTable,
        }
    }
</script>

<style scoped>

</style>