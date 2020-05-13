<form action="" method="POST" class="dublicate-record-model" id="repeat_pro">
    <input type="hidden" value="" id="dublicated-id">
    <div id="repeatProduct" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i('Dublicate Product')}}</h4>
                </div>
                <div class="modal-body">
                <h4>{{_i('Are you sure to dublicate')}}
                    <span class="product_name_double"></span>
                     </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i('cancel')}}</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{_i('Dublicate')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
