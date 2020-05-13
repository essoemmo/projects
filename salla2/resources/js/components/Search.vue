<template>
    <div>
        <div class="form-horizontal">
            <label for="search">search:<input type="text" v-model="search" @keyup="getsearch()"></label>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                search: '',
            }
        },
        methods:{
            getsearch(){
                this.$emit('makesearch',this.search);
            }
        }
    }
</script>

<style scoped>

</style>
