<?php


Route::group(['prefix' => 'admin'], function () use ($namespace) {
    $namespace .= '\Admin';

    Route::group(array('prefix' => 'news'), function () use ($namespace) {
        Route::model('newsid', 'Cysha\Modules\News\Models\News');
        Route::group(array('prefix' => '{newsid}'), function () use ($namespace) {
            $namespace .= '\NewsManager';

            Route::post('edit', array( 'uses' => $namespace.'\EditNewsController@postEdit'));
            Route::get('edit', array('as' => 'admin.news.edit', 'uses' => $namespace.'\EditNewsController@getEdit'));
        });

        Route::get('add', array('as' => 'admin.news.add', 'uses' => $namespace.'\NewsController@getAdd', 'before' => 'permissions'));

        Route::get('search.json', array('as' => 'admin.news.ajax', 'uses' => $namespace.'\NewsController@getDataTableJson', 'before' => 'permissions:admin.news.index'));
        Route::get('/', array('as' => 'admin.news.index', 'uses' => $namespace.'\NewsController@getDataTableIndex', 'before' => 'permissions'));
    });

});
