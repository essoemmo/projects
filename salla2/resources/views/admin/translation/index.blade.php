<!-- Here you see table with all tabels need to translate and count recourds need to translate for sbacific language 


he selected from select on the table. -->
@extends('admin.AdminLayout.index')
@section('box-title')

<h1 class="box-title">
    {{ _i("Translation") }}
</h1>

@endsection
@section('content')
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-header-title">
            <h4>{{_i('Translation')}}</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{_i('Translation')}}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
        <div class="form-group">
            <!-- select for language -->
            <div class="col-md-3">
                {{Form::label('language','Language',['class'=>'form-label'])}}
            </div>
            <div class="col-md-5">
                {{Form::select('language',[],null,['class'=>'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            <!-- table has all tables selected from database need to translate -->
            <table id="base_table" class="cell-border text-center" style="width:100%">
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@push('js')
<script>
    var table = null;
    var default_lang = 1;
    var selected_language = 1;
    var url = "{{route('translation.index')}}";
    const TRANSLATION_LABELS = {

    }

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
                        return `<a href="{{url('adminpanel/translation')}}/${row[0]}?lang=${selected_language}" class="btn btn-block btn-info">To Translate</a>`;
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
                $(lang_select).append(`<option value="${i}">${r}</option>`);
            });
        }
        getSource(url, {
            "resource": "langs"
        }, next, onError)

    }

    function drawDataInTable(language) {
        if (language == null) {
            default_lang = 1;
        } else {
            default_lang = language;
            selected_language = language;
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