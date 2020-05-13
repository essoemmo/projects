

    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i("Delete")}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i("are you sure to delete this one?")}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">{{_i("Cancel")}}</button>
                    <button type="button" name="btn_del_product" class="btn btn-danger waves-effect waves-light" onclick="productdel(this)">{{_i("Delete")}}</button>
                </div>
            </div>
        </div>
    </div>
