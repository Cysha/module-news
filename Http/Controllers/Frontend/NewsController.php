<?php

namespace Cms\Modules\News\Http\Controllers\Frontend;

use Cms\Modules\News\Repositories\Post\RepositoryInterface as PostRepository;
use Cms\Modules\News as News;

class NewsController extends BaseController
{
    public function getNews(PostRepository $repo)
    {
        return $this->setView('frontend.homepage', [
            'posts' => $repo->getLatest(5),
        ]);
    }

    public function getNewsById(News\Models\Post $post)
    {
        return $this->setView('frontend._row', [
            'post' => $post->transform(),
        ]);
    }
}
