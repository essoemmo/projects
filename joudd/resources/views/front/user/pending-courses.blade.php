@extends('front.layout.app')


@section('content')

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{_i('My Pending Courses')}}</li>
            </ol>
        </div>
    </nav>


<div class="blog common-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('msg'))
                <div class="alert alert-success">
                    {{ session('msg') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="courses_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  > {{_i('الدورة')}}</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  > {{_i('رقم التحويل')}}</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  > {{_i('خصم')}} </th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  > {{_i('القيمة')}}</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  > {{_i('التاريخ')}}</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  > {{_i('حذف')}}</th>
                        </tr>
                    </thead>
                    <tbody id="courses">
                    <tbody >

                    </tbody>

                </table>
            </div>


        </div>


    </div>
</div>

@endsection

@push('js')

<script  type="text/javascript">
    function getCourses()
    {
        $.ajax({
            url: "{{url('user/pending')}}/{{$user->email}}",
            type: "get",
            headers: {"Authorization" : "<?= request()->session()->get("access_token")?>"},

            success: function (result) {
                var data = result.data;
                var html = "";
                for (var i = 0; i < data.length; i++)
                {
                    item = data[i];
                    var discount = item.discount + " %";
                    if (item.discount === null)
                        discount = "";

                    html += ' <tr> <td class="text-center" >' + item.title + '</td>' +
                            '<td class="text-center" >' + item.transaction_id + ' </td>' +
                            '<td class="text-center" >' + discount + '</td>' +
                            '<td class="text-center" > ' + item.amount + '</td>' +
                            '<td class="text-center" >' + item.created + '</td>'+
                            '<td class="text-center" >' +
                            '<form class="inline" method="POST" action="{{url('/user/pendingcourse/delete')}}" >'+
                                '<input type="hidden" name="_token" value="<?= csrf_token() ?>">'+
                                '<input type="hidden" name="applicant_email" value="{{$user->email}}">'+
                                '<input type="hidden" name="course_id" value="'+ item.course_id +'">'+
                                '<button type="submit" class="btn btn-link" title="Delete"> <i class="fa fa-remove text-danger"></i></button>'+
                            '</form> </td>';
                }
                $("#courses").html(html);
            } //href="'.$pending->pid.'/delete"
        });
    }

    $(function () {
        getCourses();
    });
</script>

@endpush