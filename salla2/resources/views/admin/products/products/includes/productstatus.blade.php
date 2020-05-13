
<div id="statsProduct" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">{{_i(' Product Status')}}</h4>
                <span id="pro_id"></span>
            </div>
            <div class="modal-body">

                <div class="col-md-12 col-xl-12">
                    <div class="card table-card group-widget mr-4">
                        <div class="row-table">
                            <div class="col-sm-4 bg-primary card-block-big mr-3">
                                <i class="icofont icofont-music"></i>
                            <span class="pen">{{_i('Sales')}}</span>
                                <p id="sales" class="count"></p>
                            </div>
                            <div class="col-sm-4 bg-dark-primary card-block-big mr-3">
                                <i class="icofont icofont-video-clapper"></i>
                                <span class="pen">{{_i('Orders')}}</span>
                            <p id="ord_num" class="count"></p>
                            </div>
                            <div class="col-sm-4 bg-darkest-primary card-block-big mr-3">
                                <i class="icofont icofont-email"></i>
                                <span class="pen">{{_i('penfits')}}</span>
                                <p id="pen" class="count"></p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
