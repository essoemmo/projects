<script>
    $(document).ready(function(){
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

<a href="../offline/{{$id}}/show" target="_blank" class=" btn   btn-primary" title="{{_i('Show')}}">
    <i class="ti ti-eye"></i> {{_i('Show')}}
</a>
<a href="../offline/{{$id}}/accept" class=" btn  btn-info" title="{{_i('Accept')}}">
    <i class="ti ti-check-box"></i> {{_i('Accept')}}
</a>
<a href="../offline/{{$id}}/refused" class=" btn  btn-danger" title="{{_i('Refuse')}}">
    <i class="icofont icofont-close-squared-alt"></i> {{_i('Refuse')}}
</a>

{{--<a href="{{url('admin/orders/offline/'.$id.'/accept')}}"  title="{{_i('Accept')}}">--}}
{{--    <button class=" btn btn-icon waves-effect waves-light btn-info" >--}}
{{--        <i class="fa fa-check-square-o"></i>--}}
{{--    </button>--}}

{{--</a>--}}
{{--<a class="btn btn-danger waves-effect waves-light remove-record" title="{{_i('Delete')}}" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('order.destroy', $id) }}" data-id="{{$id}}" data-target="#custom-width-modal"><i class="fa fa-trash"></i> </a>--}}


<form action="" method="POST" class="remove-record-model">
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i('delete')}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i('are you sure to delete this one ?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i('cancel')}}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">delete</button>
                </div>
            </div>
        </div>
    </div>
</form>