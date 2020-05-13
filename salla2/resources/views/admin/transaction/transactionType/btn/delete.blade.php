<script>
    $(document).ready(function () {
        $('body').on('click', '.dt-edit', function (e) {
            e.preventDefault();
            var main = $(this).data('main');
            var status = $(this).data('status');
            $('.main').change().val(main);
            $('.status').change().val(status);
        });
        //=================edit script ========================//
        $('.dt-edit').each(function () {
            $(this).on('click', function (evt) {
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = '{{csrf_token()}}';
                $(".edit-record-model").attr("action", url);
                $('body').find('.edit-record-model').append('<input name="_token" type="hidden" value="' + token + '">');
                $('body').find('.edit-record-model').append('<input name="_method" type="hidden" value="PUT">');
                $('#modal-edit .modal-body').empty()
                $this = $(this);
                var dtRow = $this.parents('tr');
                for (var i = 0; i < dtRow[0].cells.length; i++) {
                    var status = dtRow[0].cells[4].innerHTML;
                    if (i == 0) {
                        html = '<div class="form-group">' +
                            '<label for="title" class="control-label">title</label>' +
                            '<input type="text" required="" name="title" value="' + dtRow[0].cells[0].innerHTML + '" class="form-control">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="title" class="control-label">code</label>' +
                            '<input type="text" required="" name="code" value="' + dtRow[0].cells[1].innerHTML + '" class="form-control">' +
                            @if ($errors->has('code'))
                                '<span class="text-danger invalid-feedback">' +
                            '<strong>' + '{{ $errors->first('code') }}' + '</strong>' +
                            '</span>' +
                            @endif
                                '</div>' +
                            '<div class="form-group">' +
                            '<label for="title" class="control-label">main</label>' +
                            '<select required="" name="main" class="form-control main">' +
                            '<option value="">' + '{{_i('select ...')}}' + '</option>' +
                            '<option value="0">backend</option>' +
                            '<option value="1">frontend</option>' +
                            '</select>' +
                            @if ($errors->has('main'))
                                '<span class="text-danger invalid-feedback">' +
                            '<strong>' + '{{ $errors->first('main') }}' + '</strong>' +
                            '</span>' +
                            @endif
                                '</div>' +
                            '<div class="form-group">' +
                            '<label for="status" class="control-label">status</label>' +
                            '<select required="" name="status" class="form-control status">' +
                            '<option value="">' + '{{_i('select ...')}}' + '</option>' +
                            '<option value="myfatoorah">' + '{{_i('myfatoorah')}}' + '</option>' +
                            '<option value="paypal">' + '{{_i('paypal')}}' + '</option>' +
                            '</select>' +
                            @if ($errors->has('status'))
                                '<span class="text-danger invalid-feedback">' +
                            '<strong>' + '{{ $errors->first('status') }}' + '</strong>' +
                            '</span>' +
                            @endif
                                '</div>' +
                            '<button class="btn btn-primary" type="submit">save</button>';
                        id = $('#modal-edit .modal-body').append(html);
                    }
                }
                $('#modal-edit').modal('show');
                // $('.status').change(function () {
                //     if ($(this).children('option').attr('value') == status){
                //         $(this).children('option').attr('selected');
                //     }
                // });
            });
        });
        // For A Delete Record Popup
        $('.remove-record').click(function () {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var token = '{{csrf_token()}}';
            $(".remove-record-model").attr("action", url);
            $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="' + token + '">');
            $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
            $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
        });
        $('.remove-data-from-delete-form').click(function () {
            $('body').find('.remove-record-model').find("input").remove();
        });
        $('.modal').click(function () {
            // $('body').find('.remove-record-model').find( "input" ).remove();
        });
    });
</script>

<a href="javascript:void(0)" data-main="{{$main}}" data-status="{{$status}}"
   data-url="{{ url('/adminpanel/transactionType/'.$id.'/edit') }}" data-id="{{$id}}"
   class="dt-edit btn btn-icon waves-effect waves-light btn-primary"><i class="ti-pencil-alt"></i></a>
<a class="btn btn-circle btn-danger waves-effect waves-light remove-record" data-toggle="modal"
   data-url="{{ \Illuminate\Support\Facades\URL::route('transactionType.destroy', $id) }}" data-id="{{$id}}"
   data-target="#custom-width-modal"><i class="ti-trash"></i></a>


<form action="" method="POST" class="remove-record-model">
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">delete</h4>
                </div>
                <div class="modal-body">
                    <h4>are you sure to delete this one?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">cancel
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

