<template>
    <div class="ContactList scrollbar  scrollbar-rainy-ashville">
        <ul class="listing force-overflow">
            <li v-for="(contact,index) in sortedContacts" :key="contact.id" @click="selectContact(index, contact)" :class="{selected: index == selected}">
                <div class="contact">
                    <p>{{contact.name}}</p>
                    <p class="email">{{contact.email}}</p>
                    <p class="unread" v-if="contact.unread">{{contact.unread}}</p>
                    <online :friend="contact" :onlineUsers="onlineUsers"></online>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import online from './Online';
    export default {
        props:['contacts','onlineUsers'],
        data(){
            return {
                selected: 0,
            }
        },
        methods:{
            selectContact(index, contact){
                this.selected = index;
                this.$emit('selected',contact);
            }
        },
        computed:{
            sortedContacts(){
                return _.sortBy(this.contacts,[(contact)=>{
                    return contact.unread;
                }]).reverse();
            }
        },
        components:{
            online,
        }
    }
</script>

<style scoped>
    .ContactList{
        overflow-y: scroll;
    }
    .ContactList li{
        /*border-bottom: 1px solid rgba(142, 166, 171, 0.44);*/
        cursor: pointer;
    }

    li {
        list-style:none;
        padding:5px;
        border-bottom:1px solid #eee;
        display:block;
        cursor:pointer;
    }

    ul {
        list-style:none;
        padding: 5px;
        /*margin: 2px;*/
        background: #f9f9f9;
        width:100%;
    }

    li:hover {
        background: rgba(194, 192, 196, 0.2);
        color: rgba(3, 3, 3, 1);
    }
    ul li.active {
        background:#447BAB;
        color:#fff;
    }
    p.email{
        color: #85b9f3;
    }
    p {
        text-align: left;
    }


    .scrollbar-rainy-ashville::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        background-color: #F5F5F5;
        border-radius: 10px; }

    .scrollbar-rainy-ashville::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5; }

    .scrollbar-rainy-ashville::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        background-image: -webkit-gradient(linear, left bottom, left top, from(#fbc2eb), to(#a6c1ee));
        background-image: -webkit-linear-gradient(bottom, #fbc2eb 0%, #a6c1ee 100%);
        background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%); }





</style>
