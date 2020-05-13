@extends('front.layout.app')

@section('content')

    <nav aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb bg-gray">
                <li class="breadcrumb-item"><a href="{{url('/')}}">{{_i('Home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">ملحقات الدورة التدريبية</li>
            </ol>
        </div>
    </nav>


    <div class="register-form common-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(!empty($msg))
                        <div class="alert alert-success"> {{ $msg }}</div>
                    @endif
                    <table id="courses_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" > الرقم </th>
                            <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" aria-sort="descending"> لينك التحميل </th>
                        </tr>
                        </thead>
                        <tbody id="files">

                        </tbody>

                    </table>
                </div>


            </div>


        </div>
    </div>

@endsection

@section('script')

    <script  type="text/javascript">
        function getCourseFiles()
        {
            $.ajax({

                url: "{{config('app.api_url')}}/api/course/media/{{$course_id}}",
                type: "get",
                headers: {"Authorization" : "<?= request()->session()->get("access_token")?>"},

                success: function (result) {
                    //  console.log(result);
                    var data = result.data;
                    console.log(data.length);
                    var html = "";
                    for (var i = 0; i < data.length; i++)
                    {
                        html += ' <tr> <td>' + [i+1] + '</td>' +
                                '<td><a href="' + data[i] + '"> ' + data[i] + '</a> </td>' +
                                ' </tr>';
                    }
                    $("#files").html(html);
                }
            });
        }

        $(function () {
            getCourseFiles();
        });
    </script>

@endsection