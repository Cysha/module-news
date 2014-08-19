<?php namespace Cysha\Modules\News\Controllers\Module;

use Cysha\Modules\News as News;

class NewsController extends BaseController
{

    public function getNews()
    {

        $posts = News\Models\News::getCurrent();

        return $this->setView('news.homepage', [
            'posts' => $posts
        ]);
    }

    public function getNewsBySlug($slug)
    {
        return News\Models\News::whereSlug($slug)->get()->first();
    }

}
