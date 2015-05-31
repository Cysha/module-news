<?php namespace Cms\Modules\News\Repositories\Post;

use Cms\Modules\Core\Repositories\BaseEloquentRepository;
use Cms\Modules\News\Repositories\Post\RepositoryInterface as PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class EloquentRepository extends BaseEloquentRepository implements PostRepository
{
    public function getModel()
    {
        return 'Cms\Modules\News\Models\Post';
    }

    public function slugExists($slug, $id = 0)
    {
        $exists = $this->model
            ->whereSlug($slug);

        // when id is set, exclude it from the results
        if ($id > 0) {
            $exists->where('id', '<>', $id);
        }

        return ($exists->get()->first() === null ? false : true);
    }

    public function getLatest($count = 5)
    {
        return $this->model->where('publish_at', '<=', Carbon::now()->timezone(config('app.timezone')))
            ->whereHide(0)
            ->take($count)
            ->orderBy('publish_at', 'desc')
            ->get();
    }
}
