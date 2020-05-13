<div class="tab-pane" id="attributes" role="tabpanel">
        <div class="row">
            
            <div class="col-md-12">  {{_i("Category")}}</div>
            <div class="col-md-12">
              
                <select class="form-control select2 attributeGroup" id="attributeGroup" name="attributeGroup">
                    <option value="">---</option>
                    @foreach($attributeGroup as $item)
                        <option value="{{ $item->id }}" {{ ( old("attributeGroup") == $item->id ? "selected":"") }}>{{ $item->name }}</option>
                    @endforeach
                 </select>
            </div>
        </div>


        {{--loader spinner--}}
        <div id='loadingmessage' style='display:none; margin-top: 20px' class="text-center">
            <img src="{{ url('/') }}/images/ajax-loader.gif"/>
        </div>
        <div class="column-data">

        </div>

</div>


