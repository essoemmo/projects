<template>
    <div class="is-pulled-right">
        <i class="fa fa-circle red" v-if="!checkUser()"></i>
        <i class="fa fa-circle green"v-else></i>
    </div>
</template>

<script>
    export default {
        props:['friend','onlineUsers'],
        methods:{
            checkUser(){
                return _.find(this.onlineUsers,{id: this.friend.id});
            }
        }
    }
</script>

<style scoped>
    .red{
        background: red;
        width: 10px;
        height: 10px;
        display: block;
        border-radius: 50%;
    }
    .green{
        background: green;
        width: 10px;
        height: 10px;
        display: block;
        border-radius: 50%;
    }
</style>