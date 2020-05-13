<template>
    <div class="modal fade" id="product-images" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="ti-close"></i></span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form @submit="imageSubmit" enctype="multipart/form-data">
                        <div class="product-image" id="product_image_1" data-image-id="">
                            <template v-for="image in prod.product_photos">
                                <slot>
                                    <label v-if="image.main == 1" for="product_photo"><img :src="image.photo" class="img-responsive" style="height: 100%;margin: 0 auto;width: 100%;object-fit: cover;"></label>
                                    <label v-else-if="image.main != 0 && image.main != 1" for="product_photo">اضغط لتحميل الصورة.</label>
                                </slot>
                            </template>
                            <input type="file" class="" name="product_image" id="product_photo" @change="onImageChange">
                        </div>

                        <button class="btn btn-tiffany">حفظ الصوره الرئيسيه</button>
                    </form>
                    <br>
                    <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"
                                  v-bind:dropzone-options="dropzoneOptions"
                                  v-on:vdropzone-error="failed"
                                  v-on:vdropzone-sending="sendingEvent"
                                  v-on:vdropzone-removed-file="imageRemoved">
                    </vue-dropzone>
                    <br>
                    <button class="btn btn-tiffany" @click="uploadFiles()">حفظ الصور</button>

                    <div class="clearfix"></div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>
<script>
    export default {
        props:['prod'],
        data: function () {
            return {
                image: '',
                dropzoneOptions: {
                    url: "/adminpanel/product/imagespost",
                    maxFilesize: 4, // MB
                    maxFiles: 4,
                    uploadMultiple: true,
                    autoProcessQueue: false,
                    parallelUploads: 10,
                    acceptedFiles: '.jpg,.jpeg,.JPEG,.JPG,.png,.PNG',
                    addRemoveLinks: true,
                    removeType: "server",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            }
        },
        methods:{
            failed:function(file,message,xhr){
                let response = xhr.response;
                let parse = JSON.parse(response, (key, value)=>{
                    return value;
                });
                $('.dz-error-message span').text(parse.message);
            },
            sendingEvent(file, xhr, formData){
                formData.append('product_id', this.prod.id);
            },
            uploadFiles(){
                this.$refs.myVueDropzone.processQueue();
            },
            onImageChange(e){
                this.image = e.target.files[0];
            },
            getprod(){
                this.prod;
            },
            imageSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('image', this.image);
                formData.append('product_id', this.prod.id);
                $('.pace-demo').removeClass('hidden');
                axios.post('/adminpanel/imageSubmit', formData, config)
                    .then((data)=> {
                        $('#product-images').modal('toggle');
                        $('#product-images').removeClass('show');
                        this.$emit('getMainImage',data.data);
                        $('.pace-demo').addClass('hidden');
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
                formData = null;
            },
            imageRemoved:function (file, error, xhr) {
                let id = file.id
                if(this.dropzoneOptions.removeType == "server") {
                    axios.post('/adminpanel/imagesdel', {id: id}).then((data) => {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: "تم الحذف بنجاح",
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                }else {
                    file.previewElement.remove();
                }
            },
            removeAllFiles: function() {
                this.dropzoneOptions.removeType = "client";
                this.$refs.myVueDropzone.removeAllFiles();
                this.dropzoneOptions.removeType = "server";
            },
        },
        components: {
            vueDropzone: vue2Dropzone
        },
    }
</script>

<style scoped>

</style>