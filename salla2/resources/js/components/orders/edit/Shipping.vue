<template>
<span class="col-sm-4">
    <div>
        <div class="card ship">
            <div class="card-header">
                <h3 class="card-title">الشحن</h3>
                <div class="heading-elements">
                    <button class="btn btn-tiffany" data-toggle="modal" data-target="#shipping" type="button"><i class="fa fa-edit"></i> تعديل</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body position-relative">
                <span class="userIcon" v-if="shippingaccept == 0" :class="{hidden: noship}">
                    لا يتطلب الشحن
                </span>
                <span :class="{hidden: !optionshipvisible}">
                <span class="userIcon">
                    <i class="ti-truck fa-5x"></i>
                </span>
                </span>
                <span class="userIcon" v-if="shippingaccept == 1" :class="{hidden: shipvisible}">
                    <span class="option-message">لا يوجد شحن لدولة {{countryname}} أو للمدينه الخاصه بها</span>
                </span>
                <span class="userIcon" v-if="shippingaccept == 1 && shipvisible === true" :class="{hidden: addressvisible}">
                    <div>{{countrytitle}}-{{citytitle}}</div>
                    <div>{{address.address}}</div>
                    <div>{{selectedOption.title}} - ({{selectedOption.delay}})</div>
                </span>
            </div>
        </div>
    </div>
    <div class="modal fade" ref="shipping" id="shipping" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">الشحن</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="selectpicker" v-model="shippingaccept" placeholder="select">
                            <option value="">هل يتطلب شحن؟</option>
                            <option value="0">لا يتطلب شحن</option>
                            <option value="1">نعم يتطلب شحن</option>
                        </select>
                    </div>
                    <div class="shipping_details" :class="{hidden: shippingaccept == 0}">
                        <div class="section-title">
                            عنوان الشحن
                        </div>
                        <div class="form-group">
                            <select name="countries" class="form-control country" v-model="address.countries" @change="getcities(address.countries)">
                                <option value="">اختر الدوله</option>
                                <option v-for="country in allcountry" :key="country.id" :value="country">{{country.title}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="cities" class="form-control city" v-model="address.cities" @change="CheckHasShip(address.countries,address.cities)">
                                <option value="">اختر المدينه</option>
                                <option v-if="cities" v-for="city in cities" :key="city.id" :value="city">{{city.title}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="address.Neighborhood" placeholder="اسم الحي">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="address.street" placeholder="اسم الشارع">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="address.address" placeholder="وصف البيت">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="address.code" placeholder="الرقم البريدي">
                        </div>
                    </div>
                    <div class="shipping_options" :class="{hidden: shippingaccept == 0}">
                        <div class="section-title">خيارات الشحن</div>
                        <span class="option-message" :class="{hidden : optionvisible}">لا يوجد شحن لدولة {{countryname}}</span>
                        <span class="option-message" :class="{hidden: optioncityvisible}">لا يوجد شحن لهذه المدينه</span>
                        <div class="options" :class="{hidden : !optionvisible}">
                            <div class="option-column" v-for="option in options">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" v-model.number="option.cost">
                                </div>
                                <div class="col-md-8">
                                    <label :for="option.id">
                                        <input type="radio" v-model="selectedOption" :name="option.id" :value="option">
                                        {{option.company.title}} ({{option.delay}}) + <span v-if="option.cash_delivery_commission != null">{{Number(option.cash_delivery_commission)}} (الدفع عند الاستلام)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-tiffany" type="button" @click="saveshipping">save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</span>
</template>

<script>
    export default {
        props:['countries'],
        data(){
            return {
                shippingaccept:'',
                countrytitle:'',
                citytitle:'',
                countryname:'',
                selectedOption:'',
                allcountry:[],
                cities:[],
                options : [],
                address:{
                    countries:null,
                    cities:null,
                    Neighborhood:null,
                    street:null,
                    address:null,
                    code:null,
                },
                optionvisible : true,
                shipvisible : true,
                addressvisible : true,
                noship : true,
                optionshipvisible : true,
                optioncityvisible : true,
            }
        },
        methods:{
            getcities(data){
                if(data){
                    this.cities = data.cities;
                    this.options = [];
                    this.selectedOption = '';
                    this.optioncityvisible = true;
                    this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
                    axios.post('/adminpanel/getCountriesShipping',data).then((response)=> {
                        if (response.data == true) {
                            this.optionvisible = true;
                            this.optionshipvisible = true;
                        } else {
                            this.optionvisible = false;
                            this.optionshipvisible = false;
                            this.options = [];
                            this.countryname = this.address.countries.title
                        }
                    });
                }else{
                    this.cities = [];
                    this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
                }
            },
            CheckHasShip:function(country,city){
                axios.post('/adminpanel/getShippingOptions',{country: country,city: city}).then((response)=> {
                    if (response.data.length > 0) {
                        this.options = response.data;
                        this.optioncityvisible = true;
                    } else {
                        this.optioncityvisible = false;
                        this.selectedOption = '';
                        this.options = [];
                        this.countryname = this.address.countries.title
                    }
                });
            },
            saveshipping:function () {
                if (this.shippingaccept == 1){
                    this.countrytitle = this.address.countries.title;
                    this.citytitle = this.address.cities.title;
                    this.addressvisible = false;
                    if (this.selectedOption != ''){
                        this.optionshipvisible = false;
                        this.shipvisible = true;
                    } else{
                        this.optionshipvisible = false;
                        this.shipvisible = false;
                    }
                    this.noship = false;
                    if (this.shipvisible === false){
                        this.$emit('getSelectedShipping',null,null);
                    }else{
                        this.$emit('getSelectedShipping',this.address,this.selectedOption);
                    }
                    $('#shipping').modal('toggle');
                }
                if (this.shippingaccept == 0){
                    this.addressvisible = false;
                    this.noship = false;
                    this.optionshipvisible = false;
                    this.$emit('getSelectedShipping',null,0);
                    $('#shipping').modal('toggle');
                }
                if (this.shippingaccept == ''){
                    this.addressvisible = true;
                    this.noship = true;
                    this.optionshipvisible = true;
                }
            }
        },
        mounted() {
            this.allcountry = this.countries;

        }
    }
</script>

<style scoped>
    .section-title{
        background: #f5f5f5;
        text-align: center;
        padding: 10px;
        color: #333;
        margin: 20px 0;
    }
    .option-message{
        margin-bottom: 15px;
        display: block;
    }
    .card-title{
        float: right;
    }
    .heading-elements{
        float: left;
    }

    .ti-truck{
        font-size: 50px;
        margin: 50px auto;
        justify-content: center;
        display: flex;
        align-items: center;
    }

    .ship .card-body{
        height: 190px;
        justify-content: center;
        align-items: center;
        display: flex;
    }
</style>