<template>
    <div class="products-lists">

    <div class="content">
        <div class="row btns-row">
            <div class="col-xs-5 main-btn">
                <a class="btn btn-tiffany btn-rounded btn-xlg" id="add-btn" @click="addNewProduct()"><i class="fa fa-plus"></i> منتج جديد</a>
            </div>
<!--        <FilterProduct></FilterProduct>-->
        </div>
        <ProductColumn ref="productcolumn" @getProductId="getId" :store="store" :allProducts="allProducts" :categories="allCat" :product_type="product_type"></ProductColumn>
        <CategoryModel @catChange="bindCategory" :categories="categories" :store="store"></CategoryModel>
        <ProductModel :created_at="created_at" :features="features" :prod="prod" :store="store"></ProductModel>
        <ImageModel ref="imagemodel" @getMainImage="getImage" :prod="prod" :store="store"></ImageModel>
    </div>

    </div>
</template>

<script>
    import FilterProduct from './FilterProduct';
    import ProductColumn from './ProductColumn';
    import CategoryModel from './CategoryModel';
    import ProductModel from './ProductModel';
    import ImageModel from './ImageModel';
    export default {
        props:['store','product_type','categories','products','features'],
        data(){
            return {
                allCat: [],
                allProducts: [],
                prod: {},
                created_at: '',
                count: 0
            }
        },
        methods:{
            getImage:function(data){
                this.allProducts = this.allProducts.map((product)=>{
                   if (product.product.id == data.id){
                       product.product.product_photos = data.product_photos;
                   }
                    return product;
                });
            },
            bindCategory: function (categories) {
                this.allCat = categories;
            },
            addNewProduct: function () {

                this.allProducts.unshift({
                    id: null,
                    title: null,
                    description: null,
                    product: {
                        id: null,
                        product_type: {
                            id:null
                        },
                        max_count: null,
                        price: null,
                        categories: [],
                        features: [{
                            options:[]
                        }],
                        product_photos: [],
                    },
                    product_id: null,
                    count: ++this.count,
                });
                // this.$refs.productcolumn.types = this.product_type;
                // console.log(this.$refs.productcolumn.getids(1))
                this.selectpicker();
            },
            getId: function (id) {
                axios.get('/adminpanel/getproduct/'+id).then((data) => {
                    this.prod = data.data;
                    this.created_at = this.prod.created_at;
                    this.$refs.imagemodel.removeAllFiles();

                    // console.log(this.$refs.imagemodel.$refs.myVueDropzone.dropzone.files);
                    // this.$refs.imagemodel.$refs.myVueDropzone.removeAllFiles();
                    if (this.prod.product_photos.length > 0){
                        for (var i = 0; i < this.prod.product_photos.length; i++) {
                            if (this.prod.product_photos[i].main == 0){
                                var file = { id: this.prod.product_photos[i].id,size: 4096576, name: this.prod.product_photos[i].tag, type: "image/jpg" };
                                var url = this.prod.product_photos[i].photo;
                                this.$refs.imagemodel.$refs.myVueDropzone.manuallyAddFile(file, url);
                            }
                        }
                    }
                });

                // this.$refs.imagemodel.vmounted(id)
            },
            selectpicker:function(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            }
        },
        mounted(){
            var selected = [];
            this.allCat = this.categories;
            this.allProducts = this.products

        },
        components:{
            FilterProduct,
            ProductColumn,
            ProductModel,
            CategoryModel,
            ImageModel
        }
    }
</script>

<style scoped>


    .dropdown-menu.open{
        left : -70px;
        overflow: visible;
        /*left: 0;*/
    }


</style>


<!--load more button-->
<!--https://stackoverflow.com/questions/53246481/load-more-button-in-vuejs-->