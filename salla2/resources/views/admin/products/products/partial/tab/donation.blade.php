<div class="tab-pane"  id="dontateProduct">
    <form method="post" id="form_dontate" data-parsley-validate="" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="modal-body" id="prod_donate">

                            <input type="hidden" name="Donate_id" id="Donate_id" value="">
                            <div id="get_new_data_donate">
                                <div class="row form-group">
                                    <label>{{_i('min_price')}}</label>
                                    <input type="number" name="min_price[]" min="1" class="form-control" required="">
                                    <br>
                                    <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                </div>

                                <div class="row form-group">
                                    <label>{{_i('max_price')}}</label>
                                    <input type="number" name="max_price[]"  min="1" class="form-control" required="">
                                    <br>
                                    <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                                </div>
                            </div>

                            <div id="append_donate">

                            </div>


                            <div class="form-group">
                                <button class="btn btn-default btn-block" id="increaes_code_donate" style="margin: 15px"><i class="ti-plus"></i></button>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>
                            <button type="submit" class="btn btn-primary ">{{_i('Save')}}</button>
                        </div>
                    </div>
                </form>
</div>

@push('js')

    <script>
        function loadDonation() {
            var id = $('.product_id').val();
            //alert(id);
            $('#Donate_id').val(id);
            $.ajax({
                url: '{{route('get_donate')}}',
                method: "get",
                data: {
                    id : id
                },
                dataType: 'json',

                success: function (response) {


                    if (response.status == 'success'){
                       // console.log(response.data);
                        $('#get_new_data_donate').empty();
                        for (var i = 0; i < response.data.length; i++){
                            $('#get_new_data_donate').append(
                                ` <div class="row form-group">

                            <label>{{_i('min_price')}}</label>
                            <input type="number" name="min_price[]" min="1" class="form-control" required="" value="${response.data[i].min_price}"> <br>
                            <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                            </div>


                            <div class="row form-group">
                                <label>{{_i('max_price')}}</label>
                                <input type="number" name="max_price[]"  min="1" class="form-control" required="" value="${response.data[i].max_price}">
                                    <br>
                                <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                        </div> `
                            )
                        }

                    } else{
                        $('#get_new_data_donate').empty();
                        $('#append_donate').empty();
                        $('#get_new_data_donate').append(
                            ` <div class="row form-group">

                            <label>{{_i('min_price')}}</label>
                            <input type="number" name="min_price[]" min="1" class="form-control" required="" > <br>
                            <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                            </div>


                            <div class="row form-group">
                                <label>{{_i('max_price')}}</label>
                                <input type="number" name="max_price[]"  min="1" class="form-control" required="" >
                                    <br>
                                <button class="btn btn-danger btn-sm del_card" style="margin: 15px">{{_i('delete')}}</button>
                        </div> `
                        )
                    }
                },
            });
        }
    </script>

 @endpush