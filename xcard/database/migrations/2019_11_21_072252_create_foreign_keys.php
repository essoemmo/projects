<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('countries_translations', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('currencies', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('currencies_translation', function(Blueprint $table) {
			$table->foreign('currency_id')->references('id')->on('currencies')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->foreign('parent_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('categories_translations', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sliders_translations', function(Blueprint $table) {
			$table->foreign('slider_id')->references('id')->on('sliders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('settings_translations', function(Blueprint $table) {
			$table->foreign('setting_id')->references('id')->on('settings')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Social_links', function(Blueprint $table) {
			$table->foreign('setting_id')->references('id')->on('settings')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blog_categories_translations', function(Blueprint $table) {
			$table->foreign('blog_category_id')->references('id')->on('blog_categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blogs', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('blog_categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blog_translations', function(Blueprint $table) {
			$table->foreign('blog_id')->references('id')->on('blogs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tag_translations', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blogs_tags', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blogs_tags', function(Blueprint $table) {
			$table->foreign('blog_id')->references('id')->on('blogs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('platforms_translations', function(Blueprint $table) {
			$table->foreign('platform_id')->references('id')->on('platforms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('regions_translations', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('game_details_translations', function(Blueprint $table) {
			$table->foreign('game_detail_id')->references('id')->on('Game_details')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('genre_translations', function(Blueprint $table) {
			$table->foreign('genre_id')->references('id')->on('genre')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('works_on_id')->references('id')->on('works_on')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('platform_id')->references('id')->on('platforms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blogs_products', function(Blueprint $table) {
			$table->foreign('blog_id')->references('id')->on('blogs')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('blogs_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->foreign('related_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('countries_regions', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('countries_regions', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('languages_translations', function(Blueprint $table) {
			$table->foreign('language_id')->references('id')->on('languages')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products_translations', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('languages_products', function(Blueprint $table) {
			$table->foreign('language_id')->references('id')->on('languages')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('languages_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gameDetails_products', function(Blueprint $table) {
			$table->foreign('game_detail_id')->references('id')->on('Game_details')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('gameDetails_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('genres_products', function(Blueprint $table) {
			$table->foreign('genre_id')->references('id')->on('genre')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('genres_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('country_id')->references('id')->on('countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('site_language_id')->references('id')->on('site_languages')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('content_sections_translations', function(Blueprint $table) {
			$table->foreign('content_section_id')->references('id')->on('content_sections')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('content_sections_products', function(Blueprint $table) {
			$table->foreign('content_section_id')->references('id')->on('content_sections')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('content_sections_products', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users_ratings', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users_ratings', function(Blueprint $table) {
			$table->foreign('ra_id')->references('id')->on('ratings')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Products_Images', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
        Schema::table('products_categories', function(Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('products_categories', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
	}

	public function down()
	{
		Schema::table('countries_translations', function(Blueprint $table) {
			$table->dropForeign('countries_translations_country_id_foreign');
		});
		Schema::table('currencies', function(Blueprint $table) {
			$table->dropForeign('currencies_country_id_foreign');
		});
		Schema::table('currencies_translation', function(Blueprint $table) {
			$table->dropForeign('currencies_translation_currency_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_parent_id_foreign');
		});
		Schema::table('categories_translations', function(Blueprint $table) {
			$table->dropForeign('categories_translations_category_id_foreign');
		});
		Schema::table('sliders_translations', function(Blueprint $table) {
			$table->dropForeign('sliders_translations_slider_id_foreign');
		});
		Schema::table('settings_translations', function(Blueprint $table) {
			$table->dropForeign('settings_translations_setting_id_foreign');
		});
		Schema::table('Social_links', function(Blueprint $table) {
			$table->dropForeign('Social_links_setting_id_foreign');
		});
		Schema::table('blog_categories_translations', function(Blueprint $table) {
			$table->dropForeign('blog_categories_translations_blog_category_id_foreign');
		});
		Schema::table('blogs', function(Blueprint $table) {
			$table->dropForeign('blogs_category_id_foreign');
		});
		Schema::table('blog_translations', function(Blueprint $table) {
			$table->dropForeign('blog_translations_blog_id_foreign');
		});
		Schema::table('tag_translations', function(Blueprint $table) {
			$table->dropForeign('tag_translations_tag_id_foreign');
		});
		Schema::table('blogs_tags', function(Blueprint $table) {
			$table->dropForeign('blogs_tags_tag_id_foreign');
		});
		Schema::table('blogs_tags', function(Blueprint $table) {
			$table->dropForeign('blogs_tags_blog_id_foreign');
		});
		Schema::table('platforms_translations', function(Blueprint $table) {
			$table->dropForeign('platforms_translations_platform_id_foreign');
		});
		Schema::table('regions_translations', function(Blueprint $table) {
			$table->dropForeign('regions_translations_region_id_foreign');
		});
		Schema::table('game_details_translations', function(Blueprint $table) {
			$table->dropForeign('game_details_translations_game_detail_id_foreign');
		});
		Schema::table('genre_translations', function(Blueprint $table) {
			$table->dropForeign('genre_translations_genre_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_works_on_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_platform_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_region_id_foreign');
		});
		Schema::table('blogs_products', function(Blueprint $table) {
			$table->dropForeign('blogs_products_blog_id_foreign');
		});
		Schema::table('blogs_products', function(Blueprint $table) {
			$table->dropForeign('blogs_products_product_id_foreign');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->dropForeign('related_products_product_id_foreign');
		});
		Schema::table('related_products', function(Blueprint $table) {
			$table->dropForeign('related_products_related_id_foreign');
		});
		Schema::table('countries_regions', function(Blueprint $table) {
			$table->dropForeign('countries_regions_country_id_foreign');
		});
		Schema::table('countries_regions', function(Blueprint $table) {
			$table->dropForeign('countries_regions_region_id_foreign');
		});
		Schema::table('languages_translations', function(Blueprint $table) {
			$table->dropForeign('languages_translations_language_id_foreign');
		});
		Schema::table('products_translations', function(Blueprint $table) {
			$table->dropForeign('products_translations_product_id_foreign');
		});
		Schema::table('languages_products', function(Blueprint $table) {
			$table->dropForeign('languages_products_language_id_foreign');
		});
		Schema::table('languages_products', function(Blueprint $table) {
			$table->dropForeign('languages_products_product_id_foreign');
		});
		Schema::table('gameDetails_products', function(Blueprint $table) {
			$table->dropForeign('gameDetails_products_game_detail_id_foreign');
		});
		Schema::table('gameDetails_products', function(Blueprint $table) {
			$table->dropForeign('gameDetails_products_product_id_foreign');
		});
		Schema::table('genres_products', function(Blueprint $table) {
			$table->dropForeign('genres_products_genre_id_foreign');
		});
		Schema::table('genres_products', function(Blueprint $table) {
			$table->dropForeign('genres_products_product_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_country_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_site_language_id_foreign');
		});
		Schema::table('content_sections_translations', function(Blueprint $table) {
			$table->dropForeign('content_sections_translations_content_section_id_foreign');
		});
		Schema::table('content_sections_products', function(Blueprint $table) {
			$table->dropForeign('content_sections_products_content_section_id_foreign');
		});
		Schema::table('content_sections_products', function(Blueprint $table) {
			$table->dropForeign('content_sections_products_product_id_foreign');
		});
		Schema::table('users_ratings', function(Blueprint $table) {
			$table->dropForeign('users_ratings_user_id_foreign');
		});
		Schema::table('users_ratings', function(Blueprint $table) {
			$table->dropForeign('users_ratings_ra_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_product_id_foreign');
		});
		Schema::table('Products_Images', function(Blueprint $table) {
			$table->dropForeign('Products_Images_product_id_foreign');
		});
	}
}
