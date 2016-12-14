<?php

namespace Cms\Modules\News\Providers;

use Cms\Modules\Core\Providers\CmsRoutingProvider;
use Illuminate\Support\Facades\Route;

class NewsRoutingProvider extends CmsRoutingProvider
{
    protected $namespace = 'Cms\Modules\News\Http\Controllers';

    /**
     * @return string
     */
    protected function getFrontendRoute()
    {
        return __DIR__.'/../Http/routes-frontend.php';
    }

    /**
     * @return string
     */
    protected function getBackendRoute()
    {
        return __DIR__.'/../Http/routes-backend.php';
    }

    /**
     * @return string
     */
    protected function getApiRoute()
    {
        return __DIR__.'/../Http/routes-api.php';
    }

    public function boot()
    {
        parent::boot();

        Route::bind('news_post_id', function ($id) {
            return with(new Post())->findOrFail($id);
        });
    }
}
