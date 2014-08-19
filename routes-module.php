<?php

$namespace .= '\Module';

Route::group(['prefix' => 'news'], function () use ($namespace) {

    Route::get('{slug}', ['as' => 'pxcms.pages.home', 'uses' => $namespace.'\NewsController@getNewsBySlug']);
});

Route::get('/', ['as' => 'pxcms.pages.home', 'uses' => $namespace.'\NewsController@getNews']);
