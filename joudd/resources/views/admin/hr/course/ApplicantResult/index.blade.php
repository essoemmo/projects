@extends('admin.layout.layout')
@section('title')
{{_i('Course Result')}}
@endsection
@section('content')

<div class="box box-body box-info ">
  <form action="{{route('store_applicant_result')}}" method="POST" class="form-horizontal" id="form_1"
    data-parsley-validate="">
    @csrf
    <!--=============================== Courses ====================================-->
    <div class="form-group row">
      <label for="course_id" class="col-xs-4 control-label">{{_i('Course')}}:</label>
      <div class="col-xs-6">
        <select class="form-control" id="course_select_id" name="course_id" required>
          <option value>{{_i('Choose')}}</option>
          @foreach ($courses as $course)
          <option value="{{$course->id}}">{{$course->title}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <!-- ========================= inputs ===================== -->
    <div id="info_container" class="box box-body box-info">
      <table id="data_table" class="table table-bordered table-hover dataTable text-center" role="grid"
        aria-describedby="example1_info">
        <thead>
          <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
              aria-label="Engine version: activate to sort column ascending" style="width: 120px;">{{_i('ID')}}</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
              aria-label="Engine version: activate to sort column ascending" style="width: 120px;">{{_i('Name ')}}</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
              aria-label="Engine version: activate to sort column ascending" style="width: 120px;">{{_i('Status')}}</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
              aria-label="Engine version: activate to sort column ascending" style="width: 120px;">{{_i('Result')}}</th>
          </tr>
        </thead>
        <tbody id="applicants">

        </tbody>
      </table>
    </div>
    <div>
      <button type="submit" class="btn btn-info">{{_i('Save')}}</button>
    </div>
  </form>
</div>


@endsection @section('footer')
<script type="text/javascript">
  $(document).ready(function () {
    t = $('#data_table').DataTable(
      {
        columns:[
          {name:'ID',searchable: true},
          {name:'Name',searchable: true},
          {name:'Status'},
          {name:'Result'}
        ]
      }
    );
    $('#info_container').hide();
    $('#course_select_id').change(() => {
      $('#info_container').show();
      $('#applicants').html('');
      $.getJSON(`{{route('get_applicants_')}}?id=${$('#course_select_id').val()}`).done((data) => {
        t.clear();
        data.forEach((applicant) => {
          t.row.add([
            `<input type="hidden" name="applicant_ids[]" value="${applicant.app_id}"> ${applicant.app_id}`,
            `${applicant.first_name} ${applicant.last_name}`,
            `${ (applicant.is_active) ? '<i class="glyphicon glyphicon-ok-circle text-green">&nbsp;مفعل</i>' : '<i class="glyphicon glyphicon-flag text-red">&nbsp;غير مفعل</i>'}`,
            `<input class="text-center" name="applicants_degrees[]" value="${applicant.app_result_degree}"></td>`
          ]).draw(true);
        });
        });
      });
  });
</script>
@endsection
