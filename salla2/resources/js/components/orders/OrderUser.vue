<template>
    <span class="col-md-4">
    <div>
        <div class="card user">
            <div class="card-header">
                <h3 class="card-title">العميل</h3>
                <div class="heading-elements">
                    <button class="btn btn-tiffany" data-toggle="modal" data-target="#userorder" type="button"><i class="fa fa-edit"></i> تعديل</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body position-relative">
                <span class="userIcon" :class="{hidden: !uservisible}">
                    <i class="ti-user"></i>
                </span>
                <span class="userIcon" :class="{hidden: uservisible}">
                    <div>{{username}}</div>
                    <div v-if="phonenumber != null"><i class="ti-phone" style="color:#5dd5c4"></i> {{phonenumber}}</div>
                </span>
            </div>
        </div>
    </div>
    <div class="modal fade" ref="userorder" id="userorder" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">العملاء</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="javascript:void(0)" @click="addUser()"><i class="ti-plus"></i> إضافة عميل جديد</a>
                        </div>
                        <div class="col-md-8 col-md-offset-1">
                            <input @keyup="getsearch(user.name)" type="text" class="form-control" v-model="user.name" placeholder="البحث في قائمة العملاء">
                            <ul :class="{ hidden: menuvisible}" class="list-unstyled search-menu">
                                <li v-for="user, index in usersfilters" @click="getuser(index)" :key="user.id">{{user.name}}</li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row" :class="{hidden: detailVisible}">
                        <div class="col-md-4">
                            <input type="email" required="" v-model.email="email" class="form-control" placeholder="email">
                        </div>
                        <div class="col-md-4">
                            <input type="number" v-model="phone" class="form-control" placeholder="phone">
                        </div>
                        <div class="col-md-4">
                            <input type="text" v-model="name" class="form-control" placeholder="name">
                        </div>
                    </div>
                    <br>
                    <button :class="{hidden: newVisible}" class="btn btn-tiffany" type="button" @click="saveNewUser()">save new user</button>
                    <br :class="{hidden: newVisible}">
                    <br :class="{hidden: newVisible}">
                    <button class="btn btn-tiffany" type="button" @click="saveuser(user)">حفظ</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </span>
</template>

<script>
    export default {
        props:['users'],
        data(){
            return {
                allUsers : [],
                username : null,
                phonenumber : null,
                name : null,
                email : null,
                phone : null,
                user:{
                    id:null,
                    name:null,
                    email:null,
                    phone:null
                },
                usersfilters:'',
                menuvisible:true,
                uservisible:true,
                detailVisible:true,
                newVisible:true,
            }
        },
        methods:{
            getuser: function(index){
                    this.detailVisible = false;
                    this.user = {
                        id: this.usersfilters[index].id,
                        name: this.usersfilters[index].name,
                        email: this.usersfilters[index].email,
                        phone: this.usersfilters[index].phone
                    }
                    this.username = this.usersfilters[index].name;
                    this.phonenumber = this.usersfilters[index].phone;
                    this.name = this.usersfilters[index].name;
                    this.email = this.usersfilters[index].email;
                    this.phone = this.usersfilters[index].phone;
                    this.menuvisible = true;
                    this.newVisible = true;
            },
            getsearch:function (search) {
                    if(search){
                        this.menuvisible = false
                        this.usersfilters = this.allUsers.filter(user => {
                            return user.name.match(search);
                        });
                    }else{
                        this.usersfilters = null;
                        this.user.id = null;
                        this.name = null;
                        this.email = null;
                        this.phone = null;
                        this.menuvisible = true;
                    }
            },
            saveuser:function (user) {
                if (this.usersfilters.length > 0){
                    this.$emit('getSelectedUser',user);
                    $('#userorder').modal('toggle');
                    $('#userorder').removeClass('show');
                    this.user = {};
                    this.name = null;
                    this.phone = null;
                    this.email = null;
                    this.detailVisible = true;
                    if (user.id){
                        this.uservisible = false;
                    }else{
                        this.uservisible = true;
                    }
                }else{
                    Swal.fire({
                        title: 'تنبيه',
                        text: "من فضلك اختار الاسم الصحيح",
                        type: 'warning',
                    });
                }
            },
            addUser(){
                this.detailVisible = false;
                this.newVisible = false;
                this.user = {
                    id:null,
                    name:null,
                    email:null,
                    phone:null
                }
                this.name = null;
                this.password = null;
                this.email = null;
            },
            saveNewUser(){
                if (this.user.id == null){
                    axios.post('/adminpanel/orders/savenewuser',{name:this.name,phone:this.phone,email:this.email}).then((data) => {
                        this.allUsers.push(data.data);
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if(result){
                                this.name = null;
                                this.password = null;
                                this.email = null;
                                this.detailVisible = true;
                                this.newVisible = true;
                            }
                        });
                    }).catch(function (error) {
                        Swal.fire({
                            title: 'تنبيه',
                            text: "هذا الايميل مستخدم من قبل",
                            type: 'warning',
                        })
                    });;
                }
            }
        },
        mounted() {
            this.allUsers = this.users;
        }
    }
</script>

<style scoped>
.search-menu{
    border: 1px solid #ccc;
    padding: 2px 10px;
    max-height: 110px;
    height: auto;
    overflow-y:scroll;
}
.search-menu li{
    padding: 5px 0;
    cursor:pointer
}
.search-menu li:not(:last-child){
    border-bottom: 1px solid #ccc;
}

.card-title{
    float: right;
}
.heading-elements{
    float: left;
}
.userIcon{
    text-align: center;
}

.ti-user{
    font-size: 50px;
    margin: 50px auto;
    justify-content: center;
    display: flex;
    align-items: center;
}
    .user .card-body{
        height: 190px;
        justify-content: center;
        align-items: center;
        display: flex;
    }
</style>