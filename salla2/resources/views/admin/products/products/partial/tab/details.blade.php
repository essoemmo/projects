  <div class="tab-pane active" id="productDetail">
                            <form method="post" id="form-details">
                                {{csrf_field()}}
                                {{method_field('post')}}
                                <div id="product-details">
                                    <input type="hidden" name="id" class="product_id" value="">

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-car"></i>
                                            </span>
                                            <select class="form-control" name="delivary" id="delivary">
                                                <option class="option"
                                                        value="">{{_i('Does delivery require?')}}</option>
                                                <option class="option" value="0">{{_i('No delivery required')}}</option>
                                                <option class="option" value="1">{{_i('Requires delivery')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-truck"></i>
                                            </span>
                                            <input type="text" class="form-control" id="weight"
                                                   placeholder="{{_i('weight')}}" name="weight">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-receipt"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="{{_i('sku')}}"
                                                   name="sku" id="sku">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-panel"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="{{_i('count')}}"
                                                   name="count" id="max_count">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <i class="ti-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control datepicker" name="created_at"
                                                   id="created_at">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-money"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="{{_i('price')}}"
                                                       name="price" id="price">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-receipt"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="{{_i('net')}}"
                                                       name="net" id="net">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-home"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="{{_i('stoke')}}"
                                                       id="stock" name="stock">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <i class="ti-download"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="{{_i('discount')}}"
                                                       name="discount" id="discount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="text" id="text" class="ckeditor form-control"></textarea>
                                    </div>

<!--                                    <br>
                                    <div class="form-group">
                                      
                                    </div>-->
                                     <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('close')}}</button>
                                           <button class="btn btn-tiffany save" type="submit">{{_i('save')}}</button>
              
            </div>
                                </div>
                            </form>

                        </div>