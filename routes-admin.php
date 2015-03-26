<?php


Route::group(['prefix' => 'admin'], function () use ($namespace) {
    $namespace .= '\Admin';

    Route::group(array('prefix' => 'news'), function () use ($namespace) {
        Route::get('search.json', array('as' => 'admin.news.ajax', 'uses' => $namespace.'\NewsController@getDataTableJson', 'before' => 'permissions:admin.news.index'));
        Route::get('/', array('as' => 'admin.news.index', 'uses' => $namespace.'\NewsController@getDataTableIndex', 'before' => 'permissions'));


        $namespace .= '\NewsManager';

        Route::model('news_post_id', 'Cysha\Modules\News\Models\News');
        Route::group(array('prefix' => '{news_post_id}'), function () use ($namespace) {

            Route::post('edit', array( 'uses' => $namespace.'\EditNewsController@postEdit'));
            Route::get('edit', array('as' => 'admin.news.edit', 'uses' => $namespace.'\EditNewsController@getEdit'));
        });

        Route::post('add', array('uses' => $namespace.'\AddNewsController@postAdd', 'before' => 'permissions'));
        Route::get('add', array('as' => 'admin.news.add', 'uses' => $namespace.'\AddNewsController@getAdd', 'before' => 'permissions'));
    });

});
