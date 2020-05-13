<?php
$counut = \Illuminate\Support\Facades\DB::table('user_histories')
->where('user_id',$id)->count();
echo $counut;

?><?php /**PATH /home/euzawaaj/public_html/mary/resources/views/admin/status/active/btn/hits.blade.php ENDPATH**/ ?>