<template>
    <div class="products-lists">

        <div class="content">
            <ProductColumnEdit ref="productcolumn" @getProductId="getId" :store="store" :allProducts="allProducts" :categories="allCat" :product_type="product_type"></ProductColumnEdit>
            <CategoryModel @catChange="bindCategory" :store="store" :categories="categories"></CategoryModel>
            <ProductModel :created_at="created_at" :store="store" :features="features" :prod="prod"></ProductModel>
            <ImageModel ref="imagemodel" @getMainImage="getImage" :store="store" :prod="prod"></ImageModel>
        </div>

    </div>
</template>

<script>
    import FilterProduct from './FilterProduct';
    import ProductColumnEdit from './ProductColumnEdit';
    import CategoryModel from './CategoryModel';
    import ProductModel from './ProductModel';
    import ImageModel from './ImageModel';
    export default {
        props:['product_type','categories','products','features','store'],
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
            getId: function (id) {
                axios.get('/adminpanel/getproduct/'+id).then((data) => {
                    this.prod = data.data;
                    this.created_at = this.prod.created_at;
                    this.$refs.imagemodel.removeAllFiles();

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
            ProductModel,
            CategoryModel,
            ProductColumnEdit,
            ImageModel
        }
    }
</script>

<style scoped>
.products-lists .col-md-4{
    margin: 0 auto;
    display: block;
    float: none !important;
}

    .dropdown-menu.open{
        left : -70px;
        overflow: visible;
        /*left: 0;*/
    }


</style>


<!--load more button-->
<!--https://stackoverflow.com/questions/53246481/load-more-button-in-vuejs-->