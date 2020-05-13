<?php
$user = \App\Models\User::findOrFail($id);
   $national = \App\Models\Nationalty::where('id','=',$user->nationalty_id)->first();
   $national_coun = \Illuminate\Support\Facades\DB::table('nationalies_data')
       ->where('nationalty_id',$national['id'])
       ->value('county_name');

   echo $national_coun;


?>