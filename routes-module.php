<?php

$namespace .= '\Module';

Route::group(['prefix' => 'news'], function () use ($namespace) {

    Route::model('news_post_id', 'Cysha\Modules\News\Models\News');
    Route::get('{news_post_id}-{slug}', ['as' => 'pxcms.news.view', 'uses' => $namespace.'\NewsController@getNewsById']);
});

Route::get('/', ['as' => 'pxcms.pages.home', 'uses' => $namespace.'\NewsController@getNews']);
