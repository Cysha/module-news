<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'news'], function (Router $router) {
    $router->get('{news_post_id}-{news_post_slug}', ['as' => 'pxcms.news.read', 'uses' => 'NewsController@getNewsById']);
    $router->get('/', ['as' => 'pxcms.news.index', 'uses' => 'NewsController@getNews']);
});
