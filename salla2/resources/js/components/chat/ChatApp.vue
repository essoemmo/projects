<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></Conversation>
        <ContactList :onlineUsers="onlineUsers" :contacts="contacts" @selected="startConversationWith"></ContactList>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';
    export default {
        props:[
            'user'
        ],
        data(){
            return {
                selectedContact: null,
                onlineUsers: '',
                messages: [],
                contacts: [],
            }
        },
        mounted() {
            window.Echo.private(`messages.${this.user.id}`).listen('NewMessage',(e)=>{
                console.log(e)
                this.handleIncoming(e.message);
            });
            axios.get('/adminpanel/contacts').then((response)=>{
                this.contacts = response.data;
            })
            window.Echo.join('online')
                .here((users) => {
                    this.onlineUsers = users;
                    console.log(this.onlineUsers)
                })
                .joining((user)=>{
                    this.onlineUsers.push(user)
                    console.log(this.onlineUsers)
                })
                .leaving((user) => {
                    this.onlineUsers = this.onlineUsers.filter((u) => {u != user});
                    console.log(this.onlineUsers)
                });
        },
        methods: {
            startConversationWith(contact){
                this.updateUnreadCount(contact, true);
               axios.get(`/adminpanel/conversation/${contact.id}`).then((response)=>
                   this.messages = response.data,
                   this.selectedContact = contact
               );
            },
            saveNewMessage(text){
                this.messages.push(text);
            },
            handleIncoming(message){
                console.log(message)
                if(this.selectedContact && message.from == this.selectedContact.id){
                    this.saveNewMessage(message);
                    return;
                }
            },
            updateUnreadCount(contact, reset){
                this.contacts = this.contacts.map((contact) => {
                    if(contact.id != contact.id){
                        return contact;
                    }
                    if (reset){
                        contact.unread = 0;
                    }else{
                         contact.unread += 1;
                    }

                    return contact;
                })
            }
        },
        components:{
            Conversation,
            ContactList,
        }
    }
</script>

<style scoped>
    .chat-app{
        display: flex;
        height: 500px;
    }
</style>
