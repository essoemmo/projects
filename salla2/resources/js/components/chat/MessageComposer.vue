<template>
    <div class="MessageComposer">
        <input type="text" class="form-control" v-model="message" @keydown.enter="send" placeholder="Type Your Message ..."></input>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                message: ''
            }
        },
       methods:{
           send(e){
               e.preventDefault();
               if (this.message == ''){
                   return;
               }
               this.$emit('send',this.message);
               this.message = null;
           }
       }
    }
</script>

<style scoped>
    /*textarea {*/
    /*    width: 100%;*/
    /*    height: 150px;*/
    /*    padding: 12px 20px;*/
    /*    box-sizing: border-box;*/
    /*    border: 2px solid #ccc;*/
    /*    border-radius: 4px;*/
    /*    background-color: #f8f8f8;*/
    /*    font-size: 16px;*/
    /*    resize: none;*/
    /*}*/


    textarea {
        border-radius: 4px;
        border-width: 1px;
        border-style: solid;
        border-color: grey;
        background-color: #dddadaa6 !important;

        height: 60px !important;
        overflow-y: auto;

        /*overflow: hidden;*/
        margin:  0;
        padding: 0;
        /*border:  0;*/
        outline: 0;
        width: 100%;
        font-size: 15px;
        resize: none;
    }



</style>