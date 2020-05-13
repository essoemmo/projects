
@extends('master.layout.index',[
'title' => _i('Default categories'),
'subtitle' => _i('Default Categories'),
'activePageName' => _i('Categories'),

] )

@section('title')
{{_i('Default Categories')}}
@endsection

@section('header')

@endsection

@push('css')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endpush
@section('content')

<!-- Page-header start -->
<!--<div class="page-header">
    <div class="page-header-title">
        <h4>{{_i('Add Category')}}</h4>
    </div>

</div>-->
<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-body">
    <!-- Blog-card start -->
    <div class="card blog-page" id="blog">
        <div class="card-block">

            <div class="">
                <div class="category_well" >
                    <form id='frm_master' data-parsley-validate=''>
                        @csrf
                        @foreach($categories as $category)


                        <div class="well" id="well_{{$category->id}}">
                            <div class="form-group parent" data-cat-id="category.id">
                                <div class="input-group mb-3">
                                    <input type="text" value="{{$category->title}}" class="form-control input" data-category_id="{{$category->id}}" name="parentCategory[{{$category->id}}]" required="" class="input border-danger" >
                                    <input type="hidden" class="p_sort" id='sort_{{$category->id}}' value="{{$category->number}}" name='parent_sort[{{$category->id}}]'>

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default up" onclick="moveMasterUp(this,{{$category->id}})"><i class="ti-angle-up"></i></button>
                                        <button type="button" class="btn btn-default down" onclick="moveMasterDown(this,{{$category->id}})"><i class="ti-angle-down"></i></button>
                                        <button type="button" data-del='1' class="btn btn-default delete" onclick="categorydel(this,{{$category->id}})"><i class="ti-close"></i></button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            foreach ($category->children()->get() as $child) {
                                ?>
                                <div class="form-group child"  >
                                    <div class="input-group mb-3 subCategory">
                                        <input type="text" value='{{$child->title}}' class="form-control"name="category[{{$category->id}}][{{$child->id}}]" required="" class="input border-danger">
                                        <input type="hidden" class="c_sort" value="{{$child->number}}" name="sort[{{$category->id}}][{{$child->id}}]">
                                        <div class="input-group-append" id="child.id">
                                            <button class="btn btn-default up" type="button" onclick="up(this,{{$category->id}})"><i class="ti-angle-up"></i></button>
                                            <button class="btn btn-default down" type="button" onclick="down(this,{{$category->id}})"><i class="ti-angle-down"></i></button>
                                            <button class="btn btn-default delete" type="button"  data-del='1'  onclick="subdel(this, {{$child->id}})"><i class="ti-close"></i></button>
                                        </div>
                                    </div>
                                </div>
    <?php
}
?>
                            <div class="form-group">
                                <button class="btn btn-tiffany sub-category" type="button" onclick="addSubCategory({{$category->id}})">{{_i("Add sub product")}}</button>
                            </div>
                        </div>




                        @endforeach
                    </form>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-tiffany category" type="button" onclick="addCategory()">{{_i("Add Category")}}</button>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button class="btn btn-tiffany save-category" type="button" onclick="saveAllCat()">{{_i("Save")}}</button>
                </div>
            </div>
<?php
//dd($categories);
?>
            @push("js")
            <script type="text/javascript">


                function  addCategory() {

                index = "m_" + ($("#frm_master").children(".well").length + 1);
                i = $("#frm_master").children(".well").last().find(".p_sort").val();
                if (isNaN(i))
                        i = 0;
                i = parseInt(i) + 1;
                well = ($(".well").length + 1);
                if (isNaN(well))
                        well = 0;
                $("#frm_master").append(`  <div class="well" id="well_` + index + `">
                                        <div class="form-group parent" ">
                                            <div class="input-group mb-3">
                                                <input type="text" value="" class="form-control input"  name="parentCategory[new][` + well + `][]" required="" class="input border-danger" >
                                                <input type="hidden" class="p_sort" id="sort_` + index + `" value="` + i + `" name='parent_sort[new][` + well + `][]'>
                                                  <div class="input-group-append">
                                                    <button type="button" class="btn btn-default up" onclick="moveMasterUp(this, '` + index + `')"><i class="ti-angle-up"></i></button>
                                                    <button type="button" class="btn btn-default down" onclick="moveMasterDown(this, '` + index + `')"><i class="ti-angle-down"></i></button>
                                                    <button type="button" data-del='0' class="btn btn-default delete" onclick="categorydel(this,'` + index + `')"><i class="ti-close"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                        <button class="btn btn-tiffany sub-category" type="button" onclick="addSubCategory('` + index + `','1')">{{_i("Add sub product")}}</button>
                                    </div>
                                    </div>
                                    `);
                }
                function  addSubCategory(index, initialized = "") {
                //parent
                var select = ".child";
                if ($("#well_" + index).find(select).length == 0)
                {
                i = 0;
                select = ".parent";
                obj = $("#well_" + index).children(select).last();
                }
                else
                {
                //i=$("#well_" + index).last(".child").find(".c_sort").val();
                i = $("#well_" + index).last(".child").find(".c_sort").length;
                // i =parseInt(i)+1;
                // alert(i);
                obj = $("#well_" + index).find(select).last();
                }
                var key = "";
                if (initialized == "")
                {
                var key = "[" + index + "][new]";
                }
                else
                {
                index = ($(".well").length);
                var key = "[new][" + index + "]";
                }

                obj.append(`  <div class="form-group child"  >
                                            <div class="input-group mb-3 subCategory">
                                                <input type="text" class="form-control" data-category-id="" name="category` + key + `[]" required="" class="input border-danger">
                                                <input type="hidden" class="c_sort" name="sort` + key + `[]" value="` + i + `">
                                                <div class="input-group-append" id="child.id">
                                                    <button class="btn btn-default up" type="button" onclick="up(this, ` + index + `)"><i class="ti-angle-up"></i></button>
                                                    <button class="btn btn-default down" type="button" onclick="down(this, ` + index + `)"><i class="ti-angle-down"></i></button>
                                                    <button class="btn btn-default delete" data-del='0' type="button" onclick="subdel(this,` + index + ` )"><i class="ti-close"></i></button>
                                                </div>
                                            </div>
                                        </div>`);
                }
                function moveMasterUp(obj, i)
                {
                var current = $(obj.closest(".well"));
                var find = $(obj.closest(".well")).prev(".well");
                if (find.length > 0)
                {
                $(current).insertBefore(find);
                var pos = $(current).find(".p_sort").val(); //.find(".p_sort").html()
                pos = parseInt(pos);
                $(current).find(".p_sort").val(pos - 1);
                var pos = $(find).find(".p_sort").val(); //.find(".p_sort").html()
                pos = parseInt(pos);
                $(find).find(".p_sort").val(pos + 1);
                }


                }
                function up(obj, i)
                {
                var current = $(obj.closest(".child"));
                var find = $(obj.closest(".child")).prev(".child");
                if (find.length > 0)
                {
                $(current).insertBefore(find);
                }
                }
                function down(obj, i)
                {
                var current = $(obj.closest(".child"));
                var find = $(obj.closest(".child")).next(".child");
                if (find.length > 0)
                {
                $(current).insertAfter(find);
                }
                }
                function moveMasterDown(obj, i)
                {
                var current = $(obj.closest(".well"));
                var find = $(obj.closest(".well")).next(".well");
                if (find.length > 0)
                {
                $(current).insertAfter(find);
                var pos = $(current).find(".p_sort").val(); //.find(".p_sort").html()
                pos = parseInt(pos);
                $(current).find(".p_sort").val(pos + 1);
                var pos = $(find).find(".p_sort").val(); //.find(".p_sort").html()
                pos = parseInt(pos);
                $(find).find(".p_sort").val(pos - 1);
                }



                }
                function categorydel(obj, index) {

                if ($(obj).data("del") == "1"){


                Swal.fire({
                title: '',
                        text: "{{_i("Please be aware that agreeing to delete this category, will delete all sub - classifications of this category, and this step is not irreversible")}}",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'red-alert',
                        confirmButtonText: "{{_i('Confirm Delete')}}",
                        cancelButtonText:  '{{_i("Cancel")}}',
                }).then((result) => {
                if (result.value) {
                $.get('{{url("master/cat")}}/' + index + '/del')
                        .then((data) => {
                        if (data != 'failed'){
                        $("#well_" + index).remove();
                        swal.fire('{{_i("Alert")}}', '{{_i("Deleted Successfully")}}', "info");
                        } else{
                        Swal.fire({
                        title: '',
                                text: "{{_i('This section cannot be deleted because there are products in it. Delete it first')}}",
                                type: 'warning',
                        });
                        }

                        });
                }
                });
                } else{
                $("#well_" + index).remove();
                }
                }

                function  saveAllCat(){
                var result = $("#frm_master").parsley().validate();
                if (result) {

                var datacat = $("#frm_master").serialize();
                $.post('{{url("master/cat/save")}}', datacat).then((data) => {
                $('#category').modal('toggle');
                $('#category').removeClass('show');
                location.reload();
                //                            this.$emit('catChange',datacat);
                //                            this.allCategories = datacat;
                });
                Swal.fire({
                position: 'top-end',
                        icon: 'success',
                        title: "{{_i('Saved Successfully')}}",
                        showConfirmButton: false,
                        timer: 5000
                }).then(function(){

                });
                return;
                }
                Swal.fire({
                title: '{{_i("Alert")}}',
                        text: "{{_i('Please complete missing data ')}}",
                        icon: 'warning',
                });
                // window.reload();
                }
                function subdel(obj, i)
                {
                if ($(obj).data("del") == "1"){


                $.get('{{url("adminpanel/product")}}/' + i + '/catdel').then((data) => {


                swal.fire("{{_i('alert')}}", '{{_i("Deleted Successfully")}}', "info");
                $(obj.closest(".child")).remove();
                });
                } else{

                $(obj.closest(".child")).remove();
                }
                }// sub del
                function   reLoadCategories(data)
                {

                }

            </script>

            <style >
                .input-group{
                    display:flex
                }
                .up,.down,.delete{
                    padding: 10px;
                }
            </style>
            <script src="{{asset('custom/sweetalert2.all.min.js')}}"></script>

            @endpush



        </div>
    </div>


    @endsection
