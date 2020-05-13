<template>
    <div>
        <div class="form-group input-fly" style="left: 35%;" v-show="toggled">
            <input type="text" class="form-control" @keyup.enter="savecount" v-model="orderprice" style="width: 40px">
        </div>
        <a href="javascript:void(0)" @click="toggleItem"  class="count">{{prodata.count}}</a>
    </div>
</template>

<script>
    export default {
        props:['prodata','index'],
        data(){
            return {
                orderprice: null,
                toggled: false,
            }
        },
        methods:{
            toggleItem: function() {
                this.toggled = !this.toggled;
            },
            savecount(){
                if (this.prodata.max_count + this.prodata.count < this.orderprice) {
                    return;
                }
                this.toggled = false;
                this.$emit('productCount',this.orderprice,this.index);
                this.orderprice= null;
            }
        }
    }
</script>

<style scoped>

    .input-fly{
        display: block;
        position: absolute;
        top: -7px;
        left: 0;
    }
    .input-fly input{
        width: 70px;
    }
</style>