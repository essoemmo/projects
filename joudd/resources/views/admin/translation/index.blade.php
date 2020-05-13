<!-- Here you see table with all tabels need to translate and count recourds need to translate for sbacific language 


he selected from select on the table. -->
@extends('admin.layout.layout')

@section('box-title')

<h1 class="box-title">
    <?= _i("Translation") ?>
</h1>

@endsection
@section('content')
<div class="form-group">
    <!-- select for language -->
    <div class="col-md-3">
        <label id="language" name="language" class="form-label"></label>
              
        
    </div>
    <div class="col-md-5">
       
        <select class="form-control" name="language">
                   
                </select>
    </div>
</div>
<div class="form-group">
    <!-- table has all tables selected from database need to translate -->
    <table id="base_table" class="cell-border text-center" style="width:100%">
    </table>
</div>
@endsection
@push('js')
<script>
    var table = null;
    var default_lang = {{$defualt_lang}};
    var selected_language = 2;
    var url = "{{url('admin/translation')}}";
    const TRANSLATION_LABELS = {

    };

    function initPage() {
        initTable();
        initPageEvents();
        drawLanguageSelect();
    }

    function initTable() {
        this.table = $('#base_table').DataTable({
            "paging": false,
            "searching": false,
            "info": false,
            "autoWidth": true,
            "scrollX":true,
            columns: [{
                    title: "#"
                },
                {
                    title: "Name"
                },
                {
                    title: "All Records"
                },
                {
                    title: "Record Translated",
                    "render": function(data, type, row, meta) {
                        if(data == 0){
                            return `<span class="text-red">${data}</span>`;
                        }
                        return `<span>${data}</span>`;
                    }
                },
                {
                    data: null,
                    title: "Translation",
                    "render": function(data, type, row, meta) {
                        return `<a href="{{url('admin/translation')}}/${row[0]}?lang=${selected_language}" class="btn btn-block btn-info">{{_i('To Translate')}}</a>`;
                    }
                }
            ]
        });
    }
    //resource handle
    function getSource(url, data, on_success, on_error) {
        $.ajax({
            "url": url,
            "data": data,
            success: function(trans_data) {
                if (trans_data != null) {
                    on_success(trans_data);
                }
            },
            error: function(error) {
                if (error != null) {
                    on_error(error);
                }
            }
        });
    }
    //draw elements
    function drawLanguageSelect() {
        let next = function(langs) {
            if (langs == null || langs.length == 0) {
                return false;
            }
            lang_select = $('#language').html('<option value>Choose</option>');
            $.each(langs, function(i, r) {
                $(lang_select).append(`<option value="${r.id}">${r.name}</option>`);
            });
        }
        getSource(url, {
            "resource": "langs"
        }, next, onError)
    }

    function drawDataInTable(language) {
        if (language === undefined) {
            return false;
        } else {
            default_lang = language;
            selected_language = language;
            console.log(language);
        }
        let next = function(trans_data) {
            if (trans_data.length <= 0) {
                return false;
            } else {
                table.clear().draw();
                table.rows.add(trans_data);
                table.columns.adjust().draw();
            }
        }

        getSource(url, {
            "resource": "translation",
            'lang': default_lang
        }, next, onError)
    }
    //events
    function initPageEvents() {
        $('#language').on('change', function(e) {
            drawDataInTable($(this).val());
        });
    }

    function onError(error) {
        console.log(error);
    }

    function onSuccess(msg) {

    }

    $(function() {
        initPage();
    });
</script>
@endpush
