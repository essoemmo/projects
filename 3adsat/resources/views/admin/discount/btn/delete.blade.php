<script>
    $(document).ready(function(){
        $('.dt-edit').each(function () {
            $(this).on('click', function(evt){
                var id = $(this).attr('data-id');
                var url = $(this).attr('data-url');
                var token = '{{csrf_token()}}';
                $(".edit-record-model").attr("action",url);
                $('body').find('.edit-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
                $('body').find('.edit-record-model').append('<input name="_method" type="hidden" value="PUT">');
                $('#modal-edit .modal-body').empty()
                $this = $(this);
                var dtRow = $this.parents('tr');
                for(var i=0; i < dtRow[0].cells.length; i++){
                    if (i == 0){
                        html = '<div class="form-group">' +
                            '<label for="title" class="control-label">{{_i('title')}}</label>' +
                            '<input type="text" required="" name="title" value="'+dtRow[0].cells[0].innerHTML+'" class="form-control">' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label for="title" class="control-label">{{_i('code')}}</label>' +
                            '<input type="text" required="" name="code" value="'+dtRow[0].cells[1].innerHTML+'" class="form-control">' +
                            @if ($errors->has('code'))
                                '<span class="text-danger invalid-feedback">'+
                            '<strong>'+'{{ $errors->first('code') }}'+'</strong>'+
                            '</span>'+
                            @endif
                                '</div>' +
                            '<div class="form-group">' +
                            '<label for="title" class="control-label">{{_i('discount')}}</label>' +
                            '<input type="text" required="" name="discount" value="'+dtRow[0].cells[2].innerHTML+'" class="form-control">' +
                            @if ($errors->has('discount'))
                                '<span class="text-danger invalid-feedback">'+
                            '<strong>'+'{{ $errors->first('discount') }}'+'</strong>'+
                            '</span>'+
                            @endif
                                '</div>' +
                            '<div class="form-group">' +
                            '<label for="type" class="control-label">{{_i('type')}}</label>' +
                            '<input type="text" required="" name="type" value="'+dtRow[0].cells[3].innerHTML+'" class="form-control">' +
                            @if ($errors->has('type'))
                                '<span class="text-danger invalid-feedback">'+
                            '<strong>'+'{{ $errors->first('type') }}'+'</strong>'+
                            '</span>'+
                            @endif
                                '</div>' +
                            '<button class="btn btn-primary" type="submit">{{_i('save')}}</button>';
                        id = $('#modal-edit .modal-body').append(html);
                    }
                }
                $('#modal-edit').modal('show');
            });
        });
        // For A Delete Record Popup
        $('.remove-record').click(function() {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var token = '{{csrf_token()}}';
            $(".remove-record-model").attr("action",url);
            $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
            $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
            $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
        });

        $('.remove-data-from-delete-form').click(function() {
            $('body').find('.remove-record-model').find( "input" ).remove();
        });
        $('.modal').click(function() {
            // $('body').find('.remove-record-model').find( "input" ).remove();
        });
    });
</script>

<a href="javascript:void(0)" data-url="{{ url('/admin/panel/discount/'.$id) }}" data-id="{{$id}}" class="dt-edit btn waves-effect waves-light btn-primary"><i class="fa fa-edit"></i></a>
<a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('discount.destroy', $id) }}" data-id="{{$id}}" data-target="#custom-width-modal"><i class="ti-trash"></i></a>

<form action="" method="post" class="remove-record-model">
    @csrf
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i('Delete Record')}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i('You Want You Sure Delete This Record')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i('close')}}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{_i('delete')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>

