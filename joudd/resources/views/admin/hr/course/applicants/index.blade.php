@extends('admin.layout.layout')

@section('content')

<div class="box box-info">
  <!-- ===================================Open Form======================================-->
  <form action="{{route('create_applicant')}}" method="post" class="form-horizontal" id="demo-form"
    data-parsley-validate="">
    @csrf
    <div class="box-body">
      <!-- ===================== Course ID  =====================-->
      <div class="form-group">

        <label for="course_id" class="col-xs-4 control-label">{{_i('Course')}}</label>

        <div class="col-xs-6">
            <select id="course_id_1" required class="form-control" name="course_id">
                <option value>{{_i('Choose')}}</option>
                @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->title}}</option>
                @endforeach
            </select> @if ($errors->has('course_id'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('course_id') }}</strong>
            </span> @endif
        </div>
    </div>
      <!-- ===================== Cost ===================== -->
      <div class="form-group">
        <label for="cost" class="col-xs-4 control-label">{{_i('Cost')}}</label>
        <div class="col-xs-6">
          <label id='cost_1' name="cost" class="col-xs-4 control-label text-green" ></label>
          @if($errors->has('cost'))
          <strong>{{$errors->first('cost')}}</strong>
          @endif
        </div>
      </div>
       <!-- ===================== Discount Code =====================-->
       <div class="form-group">
        <label for="coupon_id" class="col-xs-4 control-label">{{_i('Coupon ID')}}</label>
        <div class="col-xs-6">
          <input id="coupon_id_1" class="form-control" maxlength="40" data-parsley-maxlength="40">
          <input id="coupon_id_2" type="hidden" name="coupon_id">
          @if($errors->has('coupon_id'))
          <strong>{{$errors->first('coupon_id')}}</strong>
          @endif
        </div>
      </div>
       <!-- ===================== Transaction Id =====================-->
       <div class="form-group">
        <label for="transaction_id" class="col-xs-4 control-label">{{_i('Transaction ID')}}</label>
        <div class="col-xs-6">
          <input name="transaction_id" class="form-control" maxlength="40" data-parsley-maxlength="40">
          @if($errors->has('transaction_id'))
          <strong>{{$errors->first('transaction_id')}}</strong>
          @endif
        </div>
      </div>
      <!--================== Transaction Type =====================-->
        <input type="hidden" name="transaction_type" value="bank_transfer">

      </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary">{{_i('Submit')}}</button>
    </div>
  </form>
  <!-- ===============================Close Form==================================-->
</div>
@endsection
@section('footer')
<script>

$('#course_id_1').change(function(){
    $.getJSON(`{{route("get_course")}}?id=${$('#course_id_1').val()}`).done(function(data){
        $('#cost_1').text(data.cost);
   }).fail(function(){
    $('#cost_1').text('Error');
   });
});
$('#coupon_id_1').change(function(){
    $.getJSON(`{{route("get_discount_code")}}?discount_code=${$('#coupon_id_1').val()}`).done(function(data){
        if(!data.is_active)
        {
            $('#coupon_id_1').attr('class','form-control');
        $('#coupon_id_2').val(data.id);
        }
        else{
            $('#coupon_id_1').attr('class','form-control alert alert-danger alert-dismissible');
            $('#coupon_id_1').val('Coupon is User Before.');

        }

   }).fail(function(data){
    $('#coupon_id_1').attr('class','form-control alert alert-danger alert-dismissible');
   });
});
</script>
@endsection
