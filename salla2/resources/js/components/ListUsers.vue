<template>
    <div>
        <search @makesearch="getsearched"></search>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">Created at</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user, index in usersfilters" :key="user.id">
                <th scope="row"><input v-model="check" type="checkbox" :value="user" :id="user.id"></th>
                <td>{{user.name}}</td>
                <td>{{user.created_at}}</td>
            </tr>
            </tbody>
        </table>
        <vuepagination  :pagination="users"
                        @paginate="getUsers()"
                        :offset="4">
        </vuepagination>
        <br>
        <br>
        <button type="submit" class="btn btn-success" @click="createAgent()">Submit</button>
    </div>
</template>

<script>
    import vuepagination from './VuePagination';
    import search from './Search';
    export default {
        data(){
            return{
                url: '/adminpanel/ticketSetting/agent/users/paginate',
                users: [],
                offset: 4,
                check:[],
                searchfield:'',
                paginator: {
                    current: 1,
                    total: 1,
                    limit: 10,
                }

            }
        },
        methods:{
            getsearched:function(search){
                this.searchfield = search;
            },
            pushdata:function(value3){
                this.check.push(value3)
            },
            createAgent:function () {
                if (this.check == ''){
                    return;
                }
                axios.post('/adminpanel/ticketSetting/agent',this.check).then((response)=>{
                    Swal.fire({
                        type: 'success',
                        title: 'save succes'
                    });
                })
            },
            getUsers() {
                axios.get(this.url+`?page=${this.users.current_page}`)
                    .then((response) => {
                        this.users = response.data;
                    })
                    .catch(() => {
                        console.log('handle server error from here');
                    });
            }

        },
        mounted(){
            axios.get(this.url).then((response)=>
                // this.path = response.data,
                this.users = response.data,
            );
            axios.get('/adminpanel/ticketSetting/agent/users/checked').then((response)=>
                // this.path = response.data,
                this.check = response.data,
            );
            this.getUsers();
        },
        computed:{
            usersfilters(){
                if(this.searchfield){
                    return this.users.data.filter(user => {
                        return user.name.match(this.searchfield);
                    });
                }else{
                    return this.users.data;
                }
                },
    },
        components: {
            search,
            vuepagination
        }
    }
</script>

<style scoped>
.table tr th{
    text-align: right;
}
</style>
