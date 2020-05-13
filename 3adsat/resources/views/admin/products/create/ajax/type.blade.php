@if($type == 1)
    <div id="show_lenses">
        <div class="checkbox">
            <label>
                <input type="checkbox" onchange="$('#sphere').toggle();" name="lenses_options[]" value="s">
                {{_i("Show SPHERE")}}
            </label>
            <select class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="sphere[]" id="sphere" style="display: none">
                @foreach($spheres as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>

@elseif($type == 2)
    <div id="show_lenses">

        <div class="checkbox">
            <label>
                <input type="checkbox" onchange="$('#sphere').toggle();" name="lenses_options[]" value="s">
                {{_i("Show SPHERE")}}
            </label>
            <select class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="sphere[]" id="sphere" style="display: none">
                @foreach($spheres as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="lenses_options[]" onchange="$('#cylinder').toggle();" value="cyl">
                {{_i("Show CYLINDER")}}
            </label>
            <select class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="cylinder[]" id="cylinder" style="display: none">
                @foreach($cylinder as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="lenses_options[]" value="a" onchange="$('#axis').toggle();">
                {{_i("Show AXIS")}}
            </label>
            <select class="form-control selectpicker" multiple="multiple" title='Choose one of the following...' name="axis[]" id="axis" style="display: none">
                @foreach($axis as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="lenses_options[]" value="auto_reorder" onchange="$('#auto_reorder').toggle();">
                {{_i("Show auto reorder")}}
            </label>
            <input type="text" placeholder="15,30" name="auto_reorder" class="" id="auto_reorder" style="display: none"/>
        </div>
    </div>
@endif

<script>
    $('.selectpicker').selectpicker();
</script>


