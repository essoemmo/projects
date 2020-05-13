<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class stockStatus extends Model
{
    //use SoftDeletes;
    protected $guarded = ['id'];
  
    public function hasDescription()
    {
        return $this->hasMany('App\Models\stockStatusDescription', 'stock_status_id');
    }
    
    function get_hasDescription(){
      // print_r($this->relations['PostMeta']);
      return $this->relations['hasDescription'];
    }

   public function getName($language_id) {
    
      $row = $this->getOneById($this->id, $language_id);
      return $row->name;
   }

    public static function getOneById($id, $language_id)
    {      
      $data = StockStatus::join('stock_status_descriptions', 'stock_statuses.id', '=', 'stock_status_descriptions.stock_status_id')
            ->where([
                    ['stock_status_descriptions.stock_status_id', '=', $id],
                    ['stock_status_descriptions.language_id', '=', $language_id],
                    ['stock_status_descriptions.deleted_at', '=', NULL],
                   ])
             ->select('stock_statuses.*', 'stock_status_descriptions.name')
             ->first();
      return $data;
    }

    //get names by language
    public static function getByLanguage($language_id)
    {        
        $stock_statuses = DB::table('stock_statuses')
            ->join('stock_status_descriptions', 'stock_statuses.id', '=', 'stock_status_descriptions.stock_status_id')
            ->select('stock_statuses.*', 'stock_status_descriptions.name','stock_status_descriptions.language_id')
            ->where([
                    ['stock_status_descriptions.language_id', '=', $language_id],
                    ['stock_statuses.deleted_at', '=', NULL],
                   ])
            ->get();

        return $stock_statuses;      
    }
}
