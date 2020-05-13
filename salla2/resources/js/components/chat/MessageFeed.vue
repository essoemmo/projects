<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li   v-for="message in messages" :class="`message${message.to == contact.id ? ' received': ' sent'}`" :key="message.id">
                <div class="text left">
                    {{message.text}}
<!--                    <span >{{message.text}}</span>-->
                </div>
                <div class="clear"></div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:['contact','messages'],
        data(){
            return {

            }
        },
        methods:{
            scrollToBottom(){
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                },50)
            }
        },
        watch:{
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();
            },
        }
    }
</script>

<style scoped>
    .feed{
        overflow-y: scroll;
    }
    .feed ul{
        list-style: none;
    }
    li.message{
        margin: 10px;
        max-width: 500px;
        padding: 5px;
        border-radius: 4px;
        position: relative;
        border-width: 1px;
        border-style: solid;
        border-color: grey;
        /*padding: 10px;*/
        clear: both;
    }
    li.message.received{
        text-align: right;
        /*background: #999;*/
        display: inline-block;
        float: right;
    }
    li.message.sent{
        text-align: left;
        display: inline-block;
        float: left;
    }



    li.message.sent
    {
        float: left;
    }

    .message.sent
    {
        background-color: #f0eef2;
    }

    li.message.sent:after
    {
        content: "";
        display: inline-block;
        position: absolute;
        left: -8.5px;
        top: 7px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-right: 8px solid #f0eef2;
    }

    li.message.sent:before
    {
        content: "";
        display: inline-block;
        position: absolute;
        left: -9px;
        top: 7px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-right: 8px solid black;
    }

    .message.received:after
    {
        content: "";
        display: inline-block;
        position: absolute;
        right: -8px;
        top: 6px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-left: 8px solid #dbedfe;
    }

    .message.received:before
    {
        content: "";
        display: inline-block;
        position: absolute;
        right: -9px;
        top: 6px;
        height: 0px;
        width: 0px;
        border-top: 8px solid transparent;
        border-bottom: 8px solid transparent;
        border-left: 8px solid black;
    }

    .message.received
    {
        float: right;
        background-color: #dbedfe;
    }

    .clear
    {
        clear: both;
    }

</style>
