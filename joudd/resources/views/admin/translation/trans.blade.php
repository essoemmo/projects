<!-- show table with data and it's names with text box has old value then you can change it

with update button on top .
-->
@extends('admin.layout.layout')

@section('box-title')

<h1 class="box-title">
    <?= _i("Translation") ?>
</h1>

@endsection
@section('content')
<div class="box box-info">

    <div class="box-header">

        {{--<h3 class="box-title">Data Rolles With Full Features</h3>--}}
    </div>
    <!-- /.box-header -->
    <div class="box-body">
 <form id="from_table">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12">
                    <table id="base_table" class="table table-bordered table-striped dataTable text-center" role="grid" aria-describedby="example1_info" style="width:100%">
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                   
                        @csrf
                        <input type="hidden" name="trans_id" value="{{$trans_id}}">
                        <input type="hidden" name="lang_id" value="{{$lang}}">
                       
                            <button id="submit_XoIaA21" type="submit" class="btn btn-block btn-success submit">{{_i('Translate')}}</button>
                            <a class="btn btn-block btn-danger" href="{{ URL::previous() }}" role="button">{{_i('Back')}}</a>
                       
                   
                </div>
            </div>

        </div>
      </form>
    </div>
    <!-- /.box-body -->
</div>




@endsection
@push('js')

<script>
    var table = null;
    var default_lang = "{{$lang}}";
    var trans_id = "{{$trans_id}}";
    var url = "{{route('translation.store')}}";
    const TRANSLATION_LABELS = {
        BASE_TRANS: "{{_i('Word')}}",
        SEC_TRANS: "{{_i('Translation')}}",
        SUBMIT_BUTTON: "{{_i('Translate')}}",
        SUBMIT_LOADING: `<i class="fa fa-spin fa-refresh"></i>{{_i('Translate')}}`,
    }
    var columns = [{
            data: "base_id",
            title: "#"
        },
        {
            data: "trans_id",
            title: "Translation ID",
            "visible": false
        }
    ];

    function initPage() {
        drawWordsTable();
    }
    /* =========================== */
    function drawWordsTable() {
        $('#submit_XoIaA21').html(`${TRANSLATION_LABELS.SUBMIT_LOADING}`);
        let next = function (words) {

            //TODO::
            //0-  Use only one row for col creation.
            //1-  If trans_{with not id then add 2 col with base0 and trans0}
            //2-  base 0 has original value trans 0 has trans value if exists
            if (words.length <= 0) {
                return false;
            }
            $.each(words[0], function (c, v) {
                if (c.includes('id')) {
                    return true;
                }
                rs = c.split('_', 2);
                if (rs[0] == 'base') {
                    rs = `${TRANSLATION_LABELS.BASE_TRANS} ${rs[1]}`;
                    col = {
                        data: c,
                        title: rs,
                    }
                } else {
                    rs = `${TRANSLATION_LABELS.SEC_TRANS} ${rs[1]}`;
                    col = {
                        data: c,
                        title: rs,
                        "render": function (data, type, row, meta) {
                            //    console.log(data);
                            if (data == null || row.trans_id == null) {
                                if (c.indexOf("description") > -1)
                                    return `<textarea  name="word[${row.base_id}][]"  class="form-control"/>`

                                return `<input type="text" name="word[${row.base_id}][]" value="" class="form-control"/>`
                            } else {
                                //  console.log( rs[1] );
                                return `<input type="text" name="word[${row.base_id}][]" value="${data}" class="form-control"/>`
                            }
                        }
                    }
                }
                columns.push(col);
            });
            initTable();
            table.clear().draw();
            table.rows.add(words);
            table.columns.adjust().draw();
            $('#submit_XoIaA21').html(`${TRANSLATION_LABELS.SUBMIT_BUTTON}`);
        }
        getTranslationWords(next);
    }
    /* ============================== */
    function initTable() {
        this.table = $('#base_table').DataTable({
            "paging": true,
            "searching": false,
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "columns": columns
        });
    }

    function getTranslationWords(on_finish) {
        $.ajax({
            "url": url,
            "data": {
                'resource': 'translation_words',
                "trans_id": trans_id,
                "lang": default_lang
            },
            success: function (words) {
                if (words != null) {
                    on_finish(words);
                }

            },
            error: function (error) {

            },
        });
    }

    function sendData(on_finish) {
        form_data = $('#from_table').serialize();
        $.ajax({
            "url": "{{route('translation.store')}}",
            "data": form_data,
            "type": "post",
            success: function (res) {
                if (on_finish != null) {
                    on_finish(res);
                }

            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function initActions() {
        //Link Objects To Elements
        $('#from_table').on('submit', function (e) {
            e.preventDefault();
            sendData(function (msg) {
//                alertify.alert("{{_i('Success')}}", "{{_i('Translated')}}", function () {
//                   
//                });
 alertify.set('notifier','position', 'top-center');
 alertify.success("{{_i('Translated')}}");
            });
        });
    }

    function ajaxEvents() {
        $(document).ajaxSend((e) => {
            $('#submit_XoIaA21').html(`${TRANSLATION_LABELS.SUBMIT_LOADING}`);
        });
        $(document).ajaxComplete(e => {
            $('#submit_XoIaA21').html(`${TRANSLATION_LABELS.SUBMIT_BUTTON}`);
        });
    }
    $(function () {
        ajaxEvents();
        initActions();
        initPage();
    });
</script>
@endpush
