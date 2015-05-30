<?php

use Illuminate\Routing\Router;

$router->group([
    'prefix' => 'news'
], function (Router $router) {

    $router->group(['prefix' => '{news_post_id}/update'], function (Router $router) {
        $router->post('/', ['uses' => 'UpdateController@postUpdate']);
        $router->get('/', ['as' => 'admin.news.update', 'uses' => 'UpdateController@getUpdate']);
    });

    $router->post('create', ['uses' => 'CreateController@postCreate']);
    $router->get('create', ['as' => 'admin.news.create', 'uses' => 'CreateController@getCreate']);

    $router->post('/', ['uses' => 'ManagerController@newsManager']);
    $router->get('/', ['as' => 'admin.news.manager', 'uses' => 'ManagerController@newsManager']);
});
