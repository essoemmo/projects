<?php
$option = \App\Models\Option::findOrFail($id);
$option_group = \App\Models\Option_group::
where('id','=',$option->group_id)
    ->first();
echo $option_group->title;
?>

<?php /**PATH C:\xampp\htdocs\mary\resources\views/admin/features/option/group.blade.php ENDPATH**/ ?>