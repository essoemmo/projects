<?php


namespace App\Models\Content;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    protected  $table = "content_sections";
    protected $fillable = ['title' , 'order' , 'columns' , 'type'];
    public $timestamps = true;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'content_sections_products', 'section_id');
    }
}
