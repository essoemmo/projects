<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Bll;

/**
 * Description of Article
 *
 * @author fz
 */
class Article {

    //put your code here
    public static function getStoreCategories() {

        $blog_cats = \App\Models\Article\ArticleCategory::leftJoin('article_category_data' ,'article_category_data.category_id','article_category.id')
            ->select('article_category.id', 'article_category_data.title')
            ->where('article_category_data.lang_id' , getLang(app()->getLocale()))
            ->where('article_category.published' , 1)
            ->where('article_category.store_id' , \App\Bll\Utility::getStoreId())
            ->orderBy('article_category.id', 'desc')->get();
        return $blog_cats;

//        return \App\Models\Article\ArticleCategory::join("article_category_data", "article_category_data.category_id", "=", "article_category.id")
//                        ->where('published', 1)
//                        ->where('lang_id', getLang(session('lang')))
//                        ->where("store_id", Utility::getStoreId())->get();
    }

}
