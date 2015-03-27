<?php

$namespace .= '\Module';

Route::group(['prefix' => 'news'], function () use ($namespace) {

    Route::model('newsid', 'Cysha\Modules\News\Models\News');
    Route::get('{newsid}-{slug}', ['as' => 'pxcms.news.view', 'uses' => $namespace.'\NewsController@getNewsById']);
});
