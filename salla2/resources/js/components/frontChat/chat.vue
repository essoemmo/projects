<template>
    <div>
        <beautiful-chat
                :participants="participants"
                :titleImageUrl="titleImageUrl"
                :onMessageWasSent="onMessageWasSent"
                :messageList="messageList"
                :newMessagesCount="newMessagesCount"
                :isOpen="isChatOpen"
                :close="closeChat"
                :icons="icons"
                :open="openChat"
                :showEmoji="false"
                :showFile="false"
                :showTypingIndicator="showTypingIndicator"
                :colors="colors"
                :alwaysScrollToBottom="alwaysScrollToBottom"
                :messageStyling="messageStyling"
                @onType="handleOnType"
                @edit="editMessage" />
    </div>
</template>

<script>
    import CloseIcon from 'vue-beautiful-chat/src/assets/close-icon.png'
    import OpenIcon from 'vue-beautiful-chat/src/assets/logo-no-bg.svg'
    import FileIcon from 'vue-beautiful-chat/src/assets/file.svg'
    import CloseIconSvg from 'vue-beautiful-chat/src/assets/close.svg'

    export default {
        props:[
            'auth','owner','messages'
        ],
        data() {
            return {
                icons: {
                    open: {
                        img: OpenIcon,
                        name: 'default',
                    },
                    close: {
                        img: CloseIcon,
                        name: 'default',
                    },
                    file: {
                        img: FileIcon,
                        name: 'default',
                    },
                    closeSvg: {
                        img: CloseIconSvg,
                        name: 'default',
                    },
                },
                participants: [
                    {
                        id: this.auth.id,
                        name: this.auth.name,
                        imageUrl: 'https://avatars3.githubusercontent.com/u/1915989?s=230&v=4'
                    },
                    {
                        id: this.owner.id,
                        name: this.owner.name,
                        imageUrl: 'https://cdn.iconscout.com/icon/premium/png-256-thumb/store-352-826632.png'
                    }
                ], // the list of all the participant of the conversation. `name` is the user name, `id` is used to establish the author of a message, `imageUrl` is supposed to be the user avatar.
                titleImageUrl: 'https://a.slack-edge.com/66f9/img/avatars-teams/ava_0001-34.png',
                messageList: [
                    {
                        type: 'text',
                        author: 1,
                        data: {
                            text:
                            'welcome ya prince of persia'
                        }
                    }
                ], // the list of the messages to show, can be paginated and adjusted dynamically
                newMessagesCount: 0,
                isChatOpen: false, // to determine whether the chat window should be open or closed
                showTypingIndicator: '', // when set to a value matching the participant.id it shows the typing indicator for the specific user
                colors: {
                    header: {
                        bg: '#4e8cff',
                        text: '#ffffff'
                    },
                    launcher: {
                        bg: '#4e8cff'
                    },
                    messageList: {
                        bg: '#ffffff'
                    },
                    sentMessage: {
                        bg: '#4e8cff',
                        text: '#ffffff'
                    },
                    receivedMessage: {
                        bg: '#eaeaea',
                        text: '#222222'
                    },
                    userInput: {
                        bg: '#f4f7f9',
                        text: '#565867'
                    }
                }, // specifies the color scheme for the component
                alwaysScrollToBottom: true, // when set to true always scrolls the chat to the bottom when new events are in (new message, user starts typing...)
                messageStyling: true // enables *bold* /emph/ _underline_ and such (more info at github.com/mattezza/msgdown)
            }
        },
        methods: {
            sendMessage(text) {
                if (text.length > 0) {
                    this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
                    this.onMessageWasSent({author: 'support', type: 'text', data: {text}})
                }
            },
            onMessageWasSent(message) {
                axios.post('/store1/send',{
                    contact_id: this.owner.id,
                    text: message
                });
                // called when the user sends a message
                this.messageList = [...this.messageList, message]
            },
            openChat() {
                // called when the user clicks on the fab button to open the chat
                this.isChatOpen = true
                this.newMessagesCount = 0
            },
            closeChat() {
                // called when the user clicks on the botton to close the chat
                this.isChatOpen = false

                // window.Echo.leave('online')
            },
            handleScrollToTop() {
                // called when the user scrolls message list to top
                // leverage pagination for loading another page of messages
            },
            handleOnType() {
                console.log('Emit typing event')
            },
            editMessage(message) {
                const m = this.messageList.find(m => m.id === message.id);
                m.isEdited = true;
                m.data.text = message.data.text;
            },
            handleIncoming(message){
                if (message.read == false){
                    this.newMessagesCount = this.isChatOpen ? this.newMessagesCount : this.newMessagesCount + 1
                }
                this.messageList.push({
                    type: 'text',
                    author: message.to === this.owner.id ? 'me' : this.auth.id,
                    data: {text:
                        message.text
                    }
                })
                return;
            }

        },
        mounted() {
            window.Echo.private(`messages.${this.auth.id}`).listen('NewMessage',(e)=>{
                this.handleIncoming(e.message);
            });
            window.Echo.join('online')

            for (var i = 0; i < this.messages.length; i++) {
                this.messageList.push({
                    type: 'text',
                    author: this.messages[i].to === this.owner.id ? 'me' : this.auth.id,
                    data: {text:
                        this.messages[i].text
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .sc-user-input--buttons{
        position: absolute;
        right: 0;
        width: 80px;
    }
    .sc-user-input--text{
        position: absolute;
        left: 0;
    }
</style>