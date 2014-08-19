<?php namespace Cysha\Modules\News\Controllers\Module;

use Cysha\Modules\News as News;

class NewsController extends BaseController
{

    public function getNews()
    {
        return News\Models\News::all();
    }

    public function getNewsBySlug($slug)
    {
        return News\Models\News::whereSlug($slug)->get()->first();
    }

}
