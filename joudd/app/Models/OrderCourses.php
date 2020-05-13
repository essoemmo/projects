<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderCourses extends  Model
{


    protected $table = 'order_courses';
    protected $fillable = [
        'course_id', // course id or media id
        'order_id',
        'type',
        'price',
        'currency_id',
    ];
    public $timestamps = true;
}