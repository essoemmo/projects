<template>
<span class="col-md-4">
    <div>
        <div class="card pay">
            <div class="card-header">
                <h3 class="card-title">الدفع</h3>
                <div class="heading-elements">
                    <button class="btn btn-tiffany" data-toggle="modal" data-target="#payment" type="button"><i class="fa fa-edit"></i> تعديل</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body position-relative">
                <span class="userIcon" :class="{hidden: payvisible}">
                    {{selected}}
                </span>
                <span class="userIcon" :class="{hidden: !payvisible}">
                    <i class="ti-money"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="modal fade" ref="payment" id="payment" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">الدفع</h4>
                </div>
                <div class="modal-body">
                     <div class="shipping_details">
                        <div class="section-title">
                            خيارات الدفع
                        </div>
                        <div class="transaction_types">
                            <ul class="list-unstyled">
                                <li v-for="type in transtransaction_types" @if="type.main == 0">
                                    <label :for="type.title">
                                        <input type="radio" v-model="selectedType" :name="type.title" :value="type">
                                        {{type.title}}
                                    </label>
                                </li>
                            </ul>
                            <br>
                        </div>
                    </div>
                    <button class="btn btn-tiffany" type="button" @click="savepayment">save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</span>
</template>

<script>
    export default {
        props:['transtransaction_types'],
        data(){
            return {
                selectedType:null,
                selected:null,
                payvisible:true,
            }
        },
        methods:{
            savepayment(){
                if (this.selectedType != null){
                    this.$emit('getSelectedPayment',this.selectedType);
                    this.selected = this.selectedType.title;
                    this.payvisible = false;
                    $('#payment').modal('toggle');
                    $('#payment').removeClass('show');
                    this.selectedType = null;
                }else{
                    this.payvisible = true;
                    this.selectedType = null;
                    Swal.fire({
                        title: 'تنبيه',
                        text: "من فضلك اختار طريقة الدفع",
                        type: 'warning',
                    });
                }
            }
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
.card-title{
    float: right;
}
.heading-elements{
    float: left;
}

.ti-money{
    font-size: 50px;
    margin: 50px auto;
    justify-content: center;
    display: flex;
    align-items: center;
}

.pay .card-body{
    height: 190px;
    justify-content: center;
    align-items: center;
    display: flex;
}
</style>