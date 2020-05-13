<div class="tab-pane" id="digitalProduct">
    <form method="post" id="form_digital" data-parsley-validate="" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="modal-body" id="prod_digital">

                <input type="hidden" name="diagital_id" id="diagital_id" value="">
                <div id="get_new_data_degital">
                    <div class="row form-group">
                        <label>{{_i('fileName')}}</label>
                        <input type="file" name="file[]" class="form-control" required="" multiple>
                        <br>
                        <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                    </div>
                </div>

                <div id="append_degital">

                </div>


                <div class="form-group">
                    <button class="btn btn-default btn-block" id="increaes_code_digital" style="margin: 15px"><i class="ti-plus"></i></button>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>
                <button type="submit" id="btn_save_digital" class="btn btn-primary">{{_i('Save')}}</button>
            </div>
        </div>
    </form>
</div>
@push("js")
<script type="text/javascript">
    $(function(){
    $('body').on('click', "#btn_save_digital", function (e) {
    e.preventDefault();
    var frm = $(this).form();
    var obj = new FormData(frm[0]);
    var id = $('.product_id').val();
    obj.append("diagital_id", id);
    $.ajax({
    url: '{{route('post_digital')}}',
            method: "post",
            data: obj,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
            if (response.status == 'success') {
            {
            $.each((response.data), function (i, item) {
            item = $.parseJSON(item);
            
            $("#form_digital input[name='file[]']").replaceWith(item.file);
            $("#form_digital button.del_card").replaceWith('<button class="btn btn-danger btn-sm " onclick="delDigital('+item.id+',this)">{{_i('delete')}}</button>');

            })

            }
            new Noty({
            type: 'success',
                    layout: 'topRight',
                    text: "{{ _i('Added is Successfly')}}",
                    timeout: 2000,
                    killer: true
            }).show();
            }
            else
            {
                 new Noty({
            type: 'error',
                    layout: 'topRight',
                    text: "{{ _i('Fail')}}",
                    timeout: 2000,
                    killer: true
            }).show();
            }
            // table.ajax.reload();
            // window.location.reload();
            },
    });
    });
    $('body').on('click', '#increaes_code_digital', function (e) {
    e.preventDefault();
    addDigital();
    });
    $("#form_digital").submit(function(e) {
    e.preventDefault();
    });
    });
    function loadDigital() {
    // e.preventDefault()
    //var id = $(this).data('id');
    var id = $('.product_id').val();
    //alert(id);
    $('#diagital_id').val(id);
    $.ajax({
    url: '{{route('get_digital')}}',
            method: "get",
            data: {
            id : id
            },
            dataType: 'json',
            // cache       : false,
            // contentType : false,
            // processData : false,

            success: function (response) {

            
                    if (response.status == 'success'){
            $('#get_new_data_degital').empty();
            for (var i = 0; i < response.data.length; i++){
            $('#get_new_data_degital').append(
                    ` <div class="row form-group">
            
                           <div class="col-md-5">  
                            ${response.data[i].file}
                           
                            </div>
                          <div class="col-md-5">  
                                  <input type="text" name="title[${response.data[i].id}][]" value='${response.data[i].title}' >

                               </div>
                            <div class="col-md-2">  
                                            <button class="btn btn-danger btn-sm " onclick="delDigital(${response.data[i].id},this)">{{_i('delete')}}</button>

                            </div>
                        </div>`
                    )
            }

            } else{
            $('#get_new_data_degital').empty();
            $('#append_degital').empty();
            $('#get_new_data_degital').append(
                    ` <div class="row form-group">
                            <div class="col-md-5">  
                           <input type="file" name="file[]" class="form-control" required="" multiple>
                          
                            </div>
                          <div class="col-md-5">  
                             <input type="text" name="title[new][]" >
                              </div>
                            <div class="col-md-2">  
                         <button class="btn btn-danger btn-sm del_card">{{_i('delete')}}</button>

                            </div>
                        </div>`
                    )
            }
            },
    });
    }
    function delDigital(id, obj)
    {

    
    $.ajax({
    url: 'product/del_digital',
            method: "post",
            dataType: 'json',
            data: {   _token: '{{ csrf_token() }}', id:id },
            success: function (response) {
            if (response.status == 'success'){
            $(obj).closest('.row').remove();
            }

            },
    });
    }

    function addDigital()
    {
    var html = ` <div class="row form-group">
                            <div class="col-md-5">  
                           <input type="file" name="file[]" class="form-control" required="" multiple>
                          
                            </div>
                          <div class="col-md-5">  
                                       <input type="text" name="title[new][]" >
                               </div>
                            <div class="col-md-2">  
                         <button class="btn btn-danger btn-sm del_card">{{_i('delete')}}</button>

                            </div>
                        </div>`;
    $('#append_degital').append(html);
    }

</script>
@endpush