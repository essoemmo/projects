<template>
    <div class="orderList">
        <div class="card order-info-panel">
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
                        {{date | formatDate}}
                    </div>
                </div>
                <div class="col-sm-4">
                    <span class="order-top-line">
                        حالة الطلب
                    </span>
                    <div class="order-second-line">
                        جديد
                    </div>
                </div>
            </div>
        </div>
        <div class="row order-column">
            <OrderUser :users="users" @getSelectedUser="getuser"></OrderUser>
            <Shipping :user="user" :countries="countries" :cities="cities" @getSelectedShipping="getshipping"></Shipping>
            <Payment @getSelectedPayment="getpayment" :transtransaction_types="transtransaction_types"></Payment>
        </div>
            <OrderTable :product_type="product_type" @getSelectedProduct="getproducts" :shippingOption="shippingOption" :products="products"></OrderTable>
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
        props:['product_type','ordernumber','users','countries','cities','products','transtransaction_types'],
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
                if (this.disableButton() === false && this.order == null){
                    axios.post('/adminpanel/saveallorders',{user:this.user,address:this.address,product:this.allProduct,ordernumber:this.ordernumber,shippingOption:this.shippingOption,payment:this.payment}).then((data)=>{
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