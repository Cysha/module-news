<?php

$namespace .= '\Module';

Route::group(['prefix' => 'news'], function () {

    Route::get('{slug}', ['as' => 'pxcms.pages.index', 'uses' => $namespace.'\NewsController@getNewsBySlug']);
});

Route::get('/', ['as' => 'pxcms.pages.index', 'uses' => $namespace.'\NewsController@getNews']);
