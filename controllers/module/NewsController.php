<?php namespace Cysha\Modules\News\Controllers\Module;

use Cysha\Modules\News as News;

class NewsController extends BaseController
{

    public function getNews()
    {

        $posts = News\Models\News::getCurrent(5);

        return $this->setView('news.homepage', [
            'posts' => $posts
        ]);
    }

    public function getNewsById(News\Models\News $objNews)
    {

        return $this->setView('news._row', [
            'post' => $objNews->transform()
        ]);
    }

}
