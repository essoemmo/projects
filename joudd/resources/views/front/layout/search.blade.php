

<section class="find-course m-0">
    <div class="container">
        <div class="form-wrapper">
            <form class="form-inline d-flex justify-content-lg-between justify-content-sm-around align-content-center" action="{{url('/search')}}" method="get">

                <span class="find-course-title">{{ _i('Search For Course') }}</span>

                <select class="custom-select my-1 form-control " id="parent_cat" name="parent_cat">
                    <option selected disabled>{{_i('Choose...')}}</option>

                    @foreach(\App\Hr\Course\Co_category::where('parent_id' , null)->where('lang_id' , getLang(session('lang')))->orderBy('id', 'desc')->get() as $cat)
                        <option value="{{$cat->id}}" name="cat_id">{{$cat->cat_name}}</option>
                    @endforeach

                </select>

                <select class="custom-select my-1 form-control " id="child_cat" name="child_cat">
                    <option selected disabled>{{_i('Choose...')}}</option>

                </select>

                <input type="search" class="form-control search-input" placeholder="{{ _i('Search For Course') }}" name="search_key">

                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</section>


@push('js')

    <script>
        $('#parent_cat').click(function(){
            var parentID = $(this).val();
            console.log(parentID);
            if(parentID){
                $.ajax({
                    type:"GET",
                    url:"{{url('/child_cat/list')}}?parent_id="+parentID,
                    dataType:'json',
                    success:function(res){
                        //console.log(res);
                        if(res){
                            $("#child_cat").empty();
                            $("#child_cat").append('<option selected disabled> {{_i('Choose...')}} </option>');
                            $.each(res,function(key,value){
                                $("#child_cat").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#child_cat").empty();
                        }
                    }
                });
            }else{
                $("#child_cat").empty();
            }
        });
    </script>

@endpush