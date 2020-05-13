<template>

    <div class="modal fade" id="category" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ti-close"></i></span></button>
                    <h4 class="modal-title">categories</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="category-well" v-for="category, index in allCategories" v-if="category.parent_id == null" :data-cat-id="category.id">
                            <div class="well">
                                <div class="form-group parent" :data-cat-id="category.id">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" v-model="category.title" :data-category-id="category.id" name="parentCategory" v-validate="'required'" :class="{'input': true, 'border-danger': category.title == null || category.title == '' ? errors.has('parentCategory'): null }" >
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-default up" @click="catUp(index)"><i class="ti-angle-up"></i></button>
                                            <button type="button" class="btn btn-default down" @click="catDown(index)"><i class="ti-angle-down"></i></button>
                                            <button type="button" class="btn btn-default delete" @click="categorydel(index)"><i class="ti-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div v-for="child , subindex in category.children" class="form-group child" :id="category.id" :data-cat-id="child.id">
                                    <div class="input-group mb-3 subCategory">
                                        <input type="text" class="form-control" v-model="child.title" :data-category-id="child.id" name="childCategory" v-validate="'required'" :class="{'input': true, 'border-danger': child.title == null || child.title == '' ? errors.has('childCategory'): null }">
                                        <input type="hidden" class="c_sort" :value="child.number">
                                        <div class="input-group-append" :id="child.id">
                                            <button class="btn btn-default up" type="button" @click="up(subindex,index)"><i class="ti-angle-up"></i></button>
                                            <button class="btn btn-default down" type="button" @click="down(subindex,index)"><i class="ti-angle-down"></i></button>
                                            <button class="btn btn-default delete" type="button" @click="subdel(subindex,index)"><i class="ti-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-tiffany sub-category" type="button" @click="addSubCategory(category.id,index)">اضافة تصنيف فرعي جديد</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="form-group">
                    <button class="btn btn-tiffany category" type="button" @click="addCategory()">اضافة تصنيف رئيسي جديد</button>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button class="btn btn-tiffany save-category" type="button" @click="saveAllCat()">حفظ</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    export default {
        props:['categories','store'],
        data(){
            return {
                allCategories:[],
                subCategory:{
                    title: '',
                    parent_id:'',
                    number:''
                },
                idnumber : 100000000000
            }
        },
        methods:{
            addSubCategory: function (test,index) {
                this.allCategories = this.allCategories.map((category) => {
                   if (category.id == test){
                       var length = category.children.length;
                       length == null ? length = 0 : length;
                       category.children.push({
                           id: null,
                           title: '',
                           parnet_id: test,
                           store_id: this.store.id,
                           number: length+1,
                           count: index,
                       });
                   }
                   return category;
                });
            },
            addCategory: function () {
                var length = this.allCategories.length;
                length == null ? length = 0 : length;
                this.allCategories.push({
                    id: this.idnumber++,
                    title: '',
                    number: length+1,
                    parent_id: null,
                    store_id: this.store.id,
                    children: [],
                    count: length+1,
                });
            },
            up: function (subindex,index) {
                if (this.allCategories[index].children[subindex - 1] != null){
                    var setchild;
                    setchild = this.allCategories[index].children[subindex - 1];
                    this.$set(this.allCategories[index].children,subindex - 1,this.allCategories[index].children[subindex])
                    this.$set(this.allCategories[index].children,subindex,setchild)
                    this.allCategories[index].children[subindex].number = this.allCategories[index].children[subindex].number + 1;
                    this.allCategories[index].children[subindex - 1].number = this.allCategories[index].children[subindex].number - 1;
                    setchild = '';
                }
            },
            down: function (subindex,index) {
                if (this.allCategories[index].children[subindex + 1] != null){
                    var setchild;
                    setchild = this.allCategories[index].children[subindex + 1];
                    this.$set(this.allCategories[index].children,subindex + 1,this.allCategories[index].children[subindex])
                    this.$set(this.allCategories[index].children,subindex,setchild)
                    this.allCategories[index].children[subindex].number = this.allCategories[index].children[subindex].number - 1;
                    this.allCategories[index].children[subindex + 1].number = this.allCategories[index].children[subindex].number + 1;
                    setchild = '';
                }
            },
            catUp: function (index) {
                if (this.allCategories[index - 1] != null){
                    var setcat;
                    setcat = this.allCategories[index - 1];
                    this.$set(this.allCategories,index - 1,this.allCategories[index])
                    this.$set(this.allCategories,index,setcat)
                    this.allCategories[index].number = this.allCategories[index].number + 1;
                    this.allCategories[index - 1].number = this.allCategories[index].number - 1;
                    setcat = '';
                }
            },
            catDown: function (index) {
                if (this.allCategories[index + 1] != null){
                    var setcat;
                    setcat = this.allCategories[index + 1];
                    this.$set(this.allCategories,index + 1,this.allCategories[index]);
                    this.$set(this.allCategories,index,setcat);
                    this.allCategories[index].number = this.allCategories[index].number - 1;
                    this.allCategories[index + 1].number = this.allCategories[index].number + 1;
                    setcat = '';
                }
            },
            subdel: function (subindex,index) {
                this.$Progress.start();
                if (this.allCategories[index].children[subindex].id != null){
                    Swal.fire({
                        title: '',
                        text: "يرجى العلم إنه بالموافقة على حذف هذا التصنيف، سيتم حذف جميع التصنيفات الفرعية التابعة لهذا التصنيف، وهذه الخطوة غير قابلة للتراجع",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'red-alert',
                        confirmButtonText: "تأكيد الحذف",
                        cancelButtonText:  'تراجع',
                    }).then((result) => {
                        if (result.value) {
                            axios.get('adminpanel/product/' + this.allCategories[index].children[subindex].id + '/catdel')
                                .then((data) => {
                                    this.allCategories[index].children.map((child)=>{
                                        if (child.number > this.allCategories[index].children[subindex].number){
                                            child.number = child.number - 1;
                                            return child;
                                        }
                                    });
                                    this.$delete(this.allCategories[index].children,subindex);
                                    swal.fire( 'تنبيه' ,  'تم الحذف بنجاح' ,  "info" );
                                    this.$Progress.finish();
                                    datacat = data.data;
                                    this.$emit('catChange',datacat);
                                    this.allCategories = datacat;
                                });

                        }
                    })

                }else{
                    this.allCategories[index].children.map((child)=>{
                        if (child.number > this.allCategories[index].children[subindex].number){
                            child.number = child.number - 1;
                            return child;
                        }
                    });
                    this.$delete(this.allCategories[index].children,subindex);
                }
            },
            categorydel: function (index) {
                this.$Progress.start();
                if (this.allCategories[index].id != null){
                    Swal.fire({
                        title: '',
                        text: "يرجى العلم إنه بالموافقة على حذف هذا التصنيف، سيتم حذف جميع التصنيفات الفرعية التابعة لهذا التصنيف، وهذه الخطوة غير قابلة للتراجع",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'red-alert',
                        confirmButtonText: "تأكيد الحذف",
                        cancelButtonText:  'تراجع',
                    }).then((result) => {
                        if (result.value) {
                            axios.get('adminpanel/product/' + this.allCategories[index].id + '/catdel')
                                .then((data) => {
                                    if (data.data != 'failed'){
                                        this.allCategories.map((category)=>{
                                            if (category.number > this.allCategories[index].number){
                                                category.number = category.number - 1;
                                                return category;
                                            }
                                        });
                                        this.$delete(this.allCategories,index);
                                        this.$emit('catChange',data.data);
                                        swal.fire( 'تنبيه' ,  'تم الحذف بنجاح' ,  "info" );
                                        this.$Progress.finish();
                                    }else{
                                        Swal.fire({
                                            title: '',
                                            text: "لا يمكن حذف هذا القسم لوجود منتجات به قم بحذفها أولا",
                                            type: 'warning',
                                        });
                                    }
                                    datacat = data.data;
                                    this.$emit('catChange',datacat);
                                    this.allCategories = datacat;
                                });

                        }
                    })

                }else{
                    this.allCategories.map((category)=>{
                        if (category.number > this.allCategories[index].number){
                            category.number = category.number - 1;
                            return category;
                        }
                    });
                    this.$delete(this.allCategories,index);
                }
            },
            saveAllCat(){
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.allCategories = this.allCategories.map((category)=>{
                            if(category.title == '' || category.title == null){
                                category = null;
                            }
                            return category;
                        })
                        var datacat;
                        axios.post('/adminpanel/saveAllCat',this.allCategories).then((data) => {
                            $('#category').modal('toggle');
                            $('#category').removeClass('show');
                            datacat = data.data;
                            this.$emit('catChange',datacat);
                            this.allCategories = datacat;
                        })
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحفظ بنجاح",
                            showConfirmButton: false,
                            timer: 5000
                        })
                        return;
                    }

                    this.allCategories = this.categories
                    Swal.fire({
                        title: 'تنبيه',
                        text: "من فضلك استكمل بيانات الاقسام قبل الحفظ",
                        type: 'warning',
                    });
                });

            }
        },
        mounted() {
            this.allCategories = this.categories;
        }
    }
</script>

<style scoped>
    .input-group{
        display:flex
    }
    .up,.down,.delete{
        padding: 10px;
    }
</style>