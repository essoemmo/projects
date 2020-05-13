<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use SoftDeletes;
//    use HasRecursiveRelationships;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'image', 'parent_id', 'top', 'sort_order', 'status'
    ];

    public function getParentKeyName()
    {
        return 'parent_id';
    }

    public function getPathName()
    {
        return 'path';
    }

    public function getPathSeparator()
    {
        return ',';
    }

   public function parent()
   {
       return $this->belongsTo('App\Models\Category', 'parent_id');
   }

   public function getParentsNames($language_id) {

      $category = $this->getOneById($this->id, $language_id);
   		if($this->parent) {
           return $this->parent->getParentsNames($language_id). " > " . $category->name;
        } else {
           return $category->name;
        }
   }

   public function getParentsNamesForEdit($currentId, $language_id) {

      $category = $this->getOneById($this->id, $language_id);

	   	if ($this->id != $currentId) {
	   		if($this->parent) {
	           return $this->parent->getParentsNames($language_id). " > " . $category->name;
	        } else {
	           return $category->name;
	        }
	   	}
	   	else {
	   	}
   }

   public function getName($language_id) {

      $category = $this->getOneById($this->id, $language_id);
      return $category->name;
   }


  public function children()
  {
      return $this->hasMany('App\Models\Category', 'parent_id');
  }

  public function children_rec()
  {
     return $this->children()->with('children_rec');
  }

    public function hasDescription()
    {
        return $this->hasMany('App\Models\CategoryDescription', 'category_id');
    }

    function get_hasDescription(){
      // print_r($this->relations['PostMeta']);
      return $this->relations['hasDescription'];
    }

    public static function getOneById($id, $language_id)
    {
      $category = DB::table('categories')
            ->join('category_descriptions', 'categories.id', '=', 'category_descriptions.category_id')
            ->select('categories.*', 'category_descriptions.name')
            ->where([
                    ['category_descriptions.category_id', '=', $id],
                    ['category_descriptions.language_id', '=', $language_id],
                    ['category_descriptions.deleted_at', '=', NULL],
                   ])
            ->first();
      return $category;
    }

    //get names by language
    public static function getByLanguage($language_id)
    {
        $categories = DB::table('categories')
            ->leftJoin('category_descriptions', 'categories.id', '=', 'category_descriptions.category_id')
            ->select('categories.*', 'category_descriptions.name')
            ->where([
                    ['categories.status', '=', 0],
                    ['category_descriptions.language_id', '=', $language_id],
                    ['categories.deleted_at', '=', NULL],
                   ])
            ->get();

        return $categories;
    }

    public static function getParentsByLanguage($language_id)
    {
        $categories = DB::table('categories')
            ->leftJoin('category_descriptions', 'categories.id', '=', 'category_descriptions.category_id')
            ->select('categories.*', 'category_descriptions.name')
            ->where([
                    ['categories.parent_id', '=', NULL],
                    ['categories.status', '=', 0],
                    ['category_descriptions.language_id', '=', $language_id],
                    ['categories.deleted_at', '=', NULL],
                    ['category_descriptions.deleted_at', '=', NULL],
                   ])
            ->orderBy('sort_order', 'asc')
            ->get();

        return $categories;
    }
}
