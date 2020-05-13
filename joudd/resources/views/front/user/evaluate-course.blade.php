@extends('front.layout.app')


@section('content')

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('Evaluate Course')}}</li>
            </ol>
        </div>
    </nav>

<section class="register-form common-wrapper " >
    <div class="container" >
        <div class="row" >
            <div class="col-sm-12">
                <div class="center">
                    <a href="" class="btn btn-blue-outlined "> نموذج /  تقييم الدورة التدريبية </a>
                </div>
                <form class="shadow-lg" action=""  method="POST" data-parsley-validate="" style="padding: 20px;">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label > اسم الدورة : </label>
                            <label id="title"></label>
                        </div>
                        <div class="col-sm-6">
                            <label > مكان الدورة :  </label>
                            <label id="place"></label>

                        </div>


                        <div class="col-sm-3">
                            <label > مدة الدورة : </label>
                            <label id="duration"></label>
                        </div>

                        <div class="col-sm-3">
                            <label > تاريخ بداية الدورة : </label>
                            <label id="start_date" ></label>
                        </div>


                        <div class="col-sm-3">
                            <label  > تاريخ نهاية الدورة : </label>
                            <label id="end_date" ></label>
                        </div>

                        <label > ما رأيكم في المواضيع التالية ضع علامة (<i class="fa fa-check"></i>) في المكان المناسب :  </label>

                        <div class="col-sm-12">
                            <table id="courses_table" class="table table-bordered  dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" ></th>
                                        <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending" > {{_i(' البيان ')}}</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" > {{_i(' ممتاز ')}} </th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i(' جيد ')}}</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" > {{_i(' متوسط ')}}</th>
                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" > {{_i(' ضعيف ')}}</th>

                                    </tr>
                                </thead>
                                <tbody id="qustions">



                                </tbody>

                            </table>
                        </div>

                        <div class="col-sm-12" id="singleCourseQuestion">

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-blue-outlined"> إرسال </button>
                        </div>
                    </div>
                    <!-- </div> -->
                </form>
            </div>
        </div>
    </div>
</section>




@endsection

@section('script')

<script  type="text/javascript">
    function getCourseQuestions()
    {
        $.ajax({

            url: "{{url('')}}/<?=$api?>/questions/<?= $courseId ?>",
            /*url: "{{config('app.api_url')}}/api/<?=$api?>/questions/<?= $courseId ?>",
            url: "{{url(''.$api.'/questions/'.$courseId)}}",*/
            type: "get",
                        headers: {"Authorization" : "<?= request()->session()->get("access_token")?>"},

            success: function (result) {
               // console.log(result);
                var data = result.data;
                var course = result.course;
                if (course.length > 0) {
                    courseData = course[0];
                    console.log(courseData.title);
                    $("#title").text(courseData.title);
                    $("#duration").text(courseData.duration);
                    $("#start_date").text(courseData.start_date);
                    $("#end_date").text(courseData.end_date);
                    if (courseData.in_company == 1) {
                        $("#place").text("داخل الشركة");
                    } else {
                        $("#place").text("خارج الشركة");
                    }
                }
                // console.log(data.length);
                var html = "";
                var inputs = "";
                for (var i = 0; i < data.length; i++) {
                    item = data[i];
                    var is_multi = item.is_multi;
                    var is_required = item.is_required;
                    if (item.is_required === 1) {
                        is_required = 'required=""';
                    } else {
                        is_required = '';
                    }

                    if (item.is_multi === 1) {
                        html += ' <tr>' +
                                '<td><i class="fa fa-circle"></i></td>' +
                                '<td>' + item.title + '</td>' +
                                '<td><div class="checkbox"><label><input name="q[]['+item.id+']" type="radio" value="1" ' + is_required + '/></label></div></td>' +
                                '<td><div class="checkbox"><label><input name="q[]['+item.id+']" type="radio" value="2" ' + is_required + '/></label></div></td>' +
                                '<td><div class="checkbox"><label><input name="q[]['+item.id+']" type="radio" value="3" ' + is_required + '/></label></div></td>' +
                                '<td><div class="checkbox"><label><input name="q[]['+item.id+']" type="radio" value="4"' + is_required + '/></label></div></td>' +
                                '</tr>';
                    } else
                    {
                        //  alert(1);
                        inputs += ' <label> ' + item.title + ' : </label>' +
                                '<textarea cols="30" rows="5" class="form-control" ' + is_required + '  name="answer[]['+item.id+']"  placeholder="اكتب رأيك هنا..." >' +
                                '</textarea>';
                    }

                }
                $("#qustions").html(html);
                $("#singleCourseQuestion").html(inputs);
            }
        });
    }
    $(function () {
        getCourseQuestions();

    });
</script>

@endsection
