<?php
$counut = \Illuminate\Support\Facades\DB::table('user_histories')
->where('user_id',$id)->count();
echo $counut;

?>