@extends('admin.layout.layout')
@section('title')
{{_i('Applicant Info')}}
@endsection
@section('content')


{{-- Right --}}

<div class="row">
  <div class="col-xs-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"> <i class="fa fa-fw fa-book"></i>{{_i('Applicant Info')}}</h3>
      </div>
      <div class="box-body">
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('First Name')}}</label>
          <p class="form-control-static col-xs-8">{{$applicant->first_name}}</p>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('Last Name')}}</label>
          <p class="form-control-static col-xs-8">{{$applicant->last_name}}</p>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('Email')}}</label>
          <p class="form-control-static col-xs-8">{{$applicant->email}}</p>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('Mobile')}}</label>
          <p class="form-control-static col-xs-8">{{$applicant->mobile}}</p>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('Is Active')}}</label>
          <p class="form-control-static col-xs-8">{{($applicant->is_active==1)?'متواجد':'غير متواجد'}}</p>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('Address')}}</label>
          <p class="form-control-static col-xs-8">{{$applicant->address}}</p>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-4">{{_i('Birth Date')}}</label>
          <p class="form-control-static col-xs-8">{{$applicant->dob}}</p>
        </div>
      </div>
    </div>
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">الدورات السابقه</h3>
      </div>
      <div class="box-body">
        <table id="data_table" class="table table-bordered table-hover dataTable text-center">
          <thead>
            <tr>
              <th>{{_i('Title')}}</th>
              <th>{{_i('Duration')}}</th>
              <th>{{_i('Cost')}}</th>
              <th>{{_i('Amount')}}</th>
              <th>{{_i('Is Paid')}}</th>
              <th>{{_i('Transaction Id')}}</th>
              <th>حذف</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
  </div>
  {{-- Left --}}
  <div class="col-xs-6">
    <div class="box box-info col-xs-6">
      <div class="box-header with-border">
        <h3 class="box-title">الدوره التدريبيه</h3>
      </div>
      <div class="box-body">
        {{-- Course --}}
        <div class="form-group">
          <label class="col-xs-4 control-label">الدوره</label>
          <div class="col-xs-8">
            <select id="course_id_1" class="form-control select2">
              <option>Choose</option>
            </select>
          </div>
        </div>
        {{-- Cost --}}
        <div class="form-group">
          <label class="col-xs-4 control-label">التكلفه</label>
          <div class="col-xs-8 text-center text-green">
            <label id="cost_1" class="form-control-static">0</label>
          </div>
        </div>
        {{-- Discount --}}
        <div class="form-group">
          <label for="coupon_id" class="col-xs-4 control-label">{{_i('Coupon ID')}}</label>
          <div class="col-xs-8">
            <input id="coupon_id_1" class="form-control" maxlength="40" data-parsley-maxlength="40">
            <input id="coupon_id_2" type="hidden" name="coupon_id">
          </div>
        </div>
        {{-- Transaction Code --}}
        <div class="form-group">
          <label for="transaction_id" class="col-xs-4 control-label">{{_i('Transaction ID')}}</label>
          <div class="col-xs-8">
            <input id="transaction_id" class="form-control" required maxlength="40" data-parsley-maxlength="40">
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button id="register_bn" type="button" onclick="register()" class="btn btn-default btn-lrg ajax"
          title="Ajax Request">
          <i id="register_bn_icon" class=""></i>&nbsp; تسجيل
        </button>
      </div>
    </div>



    <!-- evaluation -->

    <div class="box box-info col-xs-6">
      <div class="box-header with-border">
        <h3 class="box-title">{{_i('Result of Course Evaluation')}}</h3>
      </div>
      <div class="box-body">
        {{-- Course --}}
        <div class="form-group">
          <label class="col-xs-4 control-label">{{_i('Course')}}</label>
          <div class="col-xs-8">
            <select id="course_select_id" class="form-control select2" name="course_evaluation">
              <option>{{_i('Choose')}}</option>
            @foreach($attached_courses as $course)
                <option value="{{$course->id}}">{{$course->title}}</option>
              @endforeach
            </select>
          </div>
        </div>



      </div>
      <div class="box-footer">

        <div class="row" id="evaluation_form">
          <div class="col-md-12">
            <div class="center">
              <a href="" class="btn btn-green "> نموذج /  تقييم الدورة التدريبية </a>
            </div>

              <div class="row">
               <!-- <div class="col-sm-6">
                  <label > اسم الدورة : </label>
                  <label id="title"></label>
                </div>
                <div class="col-sm-6">
                  <label > مكان الدورة :  </label>
                  <label id="place"></label>

                </div>

                <div class="row">

                  <div class="col-sm-6">
                    <label > تاريخ بداية الدورة : </label>
                    <label id="start_date" ></label>
                  </div>

                  <div class="col-sm-6">
                    <label  > تاريخ نهاية الدورة : </label>
                    <label id="end_date" ></label>
                  </div>

                  <div class="col-sm-6">
                    <label > مدة الدورة : </label>
                    <label id="duration"></label>
                  </div>
                </div>

                <label > ما رأيكم في المواضيع التالية ضع علامة (<i class="fa fa-check"></i>) في المكان المناسب :  </label> -->

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


              </div>
              <!-- </div> -->

          </div>
        </div>


      </div>
    </div>




  </div>
</div>
@endsection
@section('footer')
<script type="text/javascript">

  $('#evaluation_form').hide();

  var t;
  $(document).ready(function () {
    t = drawCoursesTable();
    getCourses();
    onCourseChange();
    CouponIdValidate();
    getEvaluation();
  });
  function drawCoursesTable() {
    return $('#data_table').DataTable({
      "ajax": { "url": "{{route('info_applicant')}}", "data": { "courses": 1, "id": "{{$applicant->id}}" } },
      "columns": [
        { data: 'title', searchable: true },
        { data: 'duration', searchable: true },
        { data: 'cost', searchable: true },
        { data: 'amount', searchable: true },
        { data: 'is_paid', searchable: true },
        { data: 'transaction_id', searchable: true },
        { data: 'remove', searchable: false },
      ]
    });
  }
  function getCourses() {
    $.ajax({
      "url": "{{route('course.index')}}",
      "data": { "courses": 1 },
      "success": function (response) {
        drawCourseSelector(response);
      }
    });
  }
  function drawCourseSelector(courses) {
    //get courses then draw select.
    s = $('#course_id_1');
    s.html('');
    s.append('<option>Choose</option>');
    $.each(courses, function (key, course) {
      s.append(`<option value=${course.id}>${course.title}</option>`);
    });

  }
  function onCourseChange() {
    $('#course_id_1').change(function () {
      $.getJSON(`{{route("get_course")}}?id=${$('#course_id_1').val()}`).done(function (data) {
        $('#cost_1').text(data.cost);
      }).fail(function () {
        $('#cost_1').text('Error');
      });
    });
  }
  function CouponIdValidate() {
    $('#coupon_id_1').change(function () {
      $.getJSON(`{{route("get_discount_code")}}?discount_code=${$('#coupon_id_1').val()}`).done(function (data) {
        if (!data.is_active) {
          $('#coupon_id_1').attr('class', 'form-control');
          $('#coupon_id_2').val(data.id);
        } else {
          $('#coupon_id_1').attr('class', 'form-control alert alert-danger alert-dismissible');
          $('#coupon_id_1').val("");
          $('#coupon_id_2').val("");

        }

      }).fail(function (data) {
        $('#coupon_id_1').attr('class', 'form-control alert alert-danger alert-dismissible');
        $('#coupon_id_1').val("");
        $('#coupon_id_2').val("");
      });
    });
  }
  function register() {
    //send course_id to server then server will regist.
    //then redraw datatable.
    course_id = $('#course_id_1').val();
    coupon_id = $('#coupon_id_2').val();
    transaction_id = $('#transaction_id').val();
    $.ajax({
      url: "{{route('info_applicant')}}",
      "data": { "register": 1, "course_id": course_id, "id": "{{$applicant->id}}", "applicant_id": "{{$applicant->id}}", "coupon_id": coupon_id, "transaction_id": transaction_id },
      "success": function (response) {
        clean();
      },
      "fail": function () {
        clean();
      },
      "beforeSend": function (data) {
        $('register_bn_icon').attr('class', 'fa fa-spin fa-refresh');
      }
    });
  }
  function removeCourse(app_course_id) {
    $.ajax({
      url: "{{route('info_applicant')}}",
      "data": { "unregister": 1, "app_course_id": app_course_id },
      "success": function (response) {
        clean();
      }
    });
  }
  function clean() {
    $('register_bn_icon').attr('class', '');
    getCourses();
    $('#coupon_id_1').val('');
    $('#coupon_id_2').val('');
    $('#transaction_id').val('');
    $('#cost_1').text('0');
    t.ajax.reload();
  }

  function getEvaluation(){

    $('#course_select_id').change(function(){
      $('#evaluation_form').show();
      $.ajax({
        url:"<?=route('info_applicant')?>",
        data:{'course_id' : parseInt($(this).val()),'id' :'<?= $applicant->id ?>','eva':1},
      }).done(function(data){
        console.log(data);
        var res = data.data;

        if(res.length > 0){
          var html = "";
          var inputs = "";

          for (var i = 0; i < res.length; i++) {
            item = res[i];
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
                      '<td><div class="checkbox"><label><input name="'+item.id+'" type="radio" value="'+item.answer+' " ' + is_required + '/></label></div></td>' +
                      '<td><div class="checkbox"><label><input name=" '+item.id+' " type="radio" value="2" ' + is_required + '/></label></div></td>' +
                      '<td><div class="checkbox"><label><input name=" '+item.id+' " type="radio" value="3" ' + is_required + '/></label></div></td>' +
                      '<td><div class="checkbox"><label><input name=" '+item.id+' " type="radio" value="4"' + is_required + '/></label></div></td>' +
                      '</tr>';
            } else
            {
              //  alert(1);
              inputs += ' <label> ' + item.title + ' : </label>' +
                      '<textarea cols="30" rows="5" class="form-control" ' + is_required + '  name="['+item.id+']"  placeholder="اكتب رأيك هنا..." >' +
                      '</textarea>';
            }

          }


          $("#qustions").html(html);
          $("#singleCourseQuestion").html(inputs);
        }


      })
    });
  }


</script>
@endsection