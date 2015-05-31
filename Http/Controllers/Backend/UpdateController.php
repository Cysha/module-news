<?php namespace Cms\Modules\News\Http\Controllers\Backend;

use Cms\Modules\News\Repositories\Post\RepositoryInterface as PostRepository;
use Cms\Modules\News as News;
use Illuminate\Http\Request;
use Former;

class UpdateController extends BaseAdminController
{

    public function boot()
    {
        parent::boot();

        $this->theme->setTitle('Update News Post');
    }

    public function getUpdate(News\Models\Post $post)
    {
        $this->formAssets();
        Former::populate($post);

        return $this->setView('backend.form', [
            'content' => $post->getOriginal('content'),
        ]);
    }

    public function postUpdate(News\Models\Post $post, PostRepository $repo, Request $input)
    {
        if ($repo->slugExists($input->get('slug'), $post->id) === true) {
            return redirect(route('admin.news.update', $post->id))
                ->withInput()
                ->withError('Error, slug already exists, pick another.');
        }

        $post->fill($input->except('_token'));
        if (!$post->save()) {
            return redirect(route('admin.news.update', $post->id))
                ->withErrors($post->errors());
        }

        return redirect(route('admin.news.update', $post->id))
            ->withInfo('News Article Updated');
    }
}
