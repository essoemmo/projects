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
{{--<a href="genres/{{$id}}/edit" data-target=".edit_modal" data-toggle="modal" class="btn btn-success edit" data-id="{{$id}}" data-title="{{$title}}" ><i class="ti-pencil-alt"></i></a>--}}


<a href="cities/{{$id}}/edit" data-target=".edit_modal" data-toggle="modal" class="btn btn-success edit" data-id="{{$id}}"  data-country_id="{{$country_id}}"
   @foreach(langs() as $lang) data-title-{{$lang->locale}}="{{\App\Models\CityTranslation::where('city_id',$id)->where('locale',$lang->locale)->first()['title']}}" @endforeach>
    <i class="ti-pencil-alt"></i></a>


<a class="btn btn-danger waves-effect waves-light remove-record" data-toggle="modal" data-url="{{ \Illuminate\Support\Facades\URL::route('cities.destroy', $id) }}" data-id="{{$id}}" data-target="#custom-width-modal"><i class="ti-trash" style="color: #fff;"></i></a>
<form action="" method="POST" class="remove-record-model">
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i('Delete_Record')}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i('You Want You Sure Delete This Record')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{_i('delete')}}</button>
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i('close')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>



