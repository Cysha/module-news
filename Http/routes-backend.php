<?php

use Illuminate\Routing\Router;

$router->group([
    'prefix' => 'news',
], function (Router $router) {

    $router->group(['prefix' => '{news_post_id}'], function (Router $router) {
        $router->group(['prefix' => 'update'], function (Router $router) {
            $router->post('/', ['uses' => 'UpdateController@postUpdate']);
            $router->get('/', ['as' => 'admin.news.update', 'uses' => 'UpdateController@getUpdate']);
        });

        $router->group(['prefix' => 'delete'], function (Router $router) {
            $router->delete('delete', ['as' => 'admin.news.delete', 'uses' => 'UpdateController@deletePost']);
        });
    });

    $router->group(['prefix' => 'create'], function (Router $router) {
        $router->post('/', ['uses' => 'CreateController@postCreate']);
        $router->get('/', ['as' => 'admin.news.create', 'uses' => 'CreateController@getCreate']);
    });

    $router->post('/', ['uses' => 'ManagerController@newsManager']);
    $router->get('/', ['as' => 'admin.news.manager', 'uses' => 'ManagerController@newsManager']);
});
