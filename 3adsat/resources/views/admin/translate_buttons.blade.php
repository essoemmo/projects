<?php
$languages = App\Models\Language::all();
$translation = \App\Models\Translation::where("table_db_name", $table)->first();

?>
@foreach($languages as $lang)
<a href="{{ url('admin/panel/translation/' . (($translation!==null)? $translation->id : "") . '?lang=' . $lang->id ) }}" target="_blank" class="btn btn-primary">
    <img src="{{asset("languages")}}/{{$lang->image}}"> {{_("To")}} {{ $lang->name }}
</a>

@endforeach