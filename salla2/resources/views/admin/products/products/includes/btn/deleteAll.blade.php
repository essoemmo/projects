<div id="deleteAll" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <form action="{{ route('deleteAllProducts') }}" method="POST">
        @csrf
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">{{_i('Delete All Products')}}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{_i('All products of the store will be deleted this step The move is not reversible')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect waves-light">{{_i('delete')}}</button>
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">{{_i('close')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>

