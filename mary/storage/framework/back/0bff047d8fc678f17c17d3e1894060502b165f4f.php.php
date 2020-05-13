<?php
$option = \App\Models\Option::findOrFail($id);
$option_group = \App\Models\Option_group::
where('id','=',$option->group_id)
    ->first();
echo $option_group->title;
?>

