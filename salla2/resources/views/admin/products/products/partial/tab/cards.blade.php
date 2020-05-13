<div class="tab-pane"  id="productCard">
    <form method="post" id="form_card" data-parsley-validate>
        @csrf
        <div class="container">
            <div class="modal-body" id="prod_card">
                <div id="get_new_data">
                    <div class="row form-group">
                        <div class="col-md-2">

                            <label>{{_i('Code Details')}}</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="code[]" class="form-control" required="">
                        </div>
                        <div class="col-md-2">

                            <button class="btn btn-danger btn-sm del_card" >{{_i('delete')}}</button>
                        </div>
                    </div>
                </div>

                <div id="append_card">

                </div>


                <div class="form-group">
                    <button class="btn btn-default btn-block" id="increaes_code" ><i class="ti-plus"></i></button>
                </div>

            </div>




            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>
                <button type="submit" class="btn btn-primary">{{_i('Save')}}</button>
            </div>
        </div>
    </form>

</div>
@push("js")
<script type="text/javascript">
    $('body').on('click', '#increaes_code', function (e) {
    e.preventDefault();
    
    $('#append_card').append(` <div class="row form-group">
                        <div class="col-md-2">

                            <label>{{_i('Code Details')}}</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="code[]" class="form-control" required="">
                        </div>
                        <div class="col-md-2">

                            <button class="btn btn-danger btn-sm del_card" >{{_i('delete')}}</button>
                        </div>
                    </div>`);
    });
   
    $('body').on('submit', '#form_card', function (e) {
    e.preventDefault();
    var obj = new FormData(this);
    var id = $('.product_id').val();
    obj.append("card_id", id);
    $.ajax({
    url: '{{route('post_card')}}',
            method: "post",
            data: obj,
            dataType: 'json',
            cache       : false,
            contentType : false,
            processData : false,
            success: function (response) {
            // console.log(response.errors.title);

            if (response.status == 'success'){

            new Noty({
            type: 'success',
                    layout: 'topRight',
                    text: "{{ _i('Added is Successfly')}}",
                    timeout: 2000,
                    killer: true
            }).show();
            }
            // table.ajax.reload();
            // window.location.reload();
            },
    });
    })
    </script>
@endpush